<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
                <div id='calendar'></div>
        </div>
    </div>
</div>

<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">
                    Close
                    </span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <form class="form-horizontal" id="crud-form">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title">Título</label>
                        <div class="col-md-4">
                            <input id="title" name="title" type="text" class="form-control input-md" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="time">Hora</label>
                        <div class="col-md-4 input-append bootstrap-timepicker">
                            <input id="time" name="time" type="text" class="form-control input-md" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="description">Descrição</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="color">Cor</label>
                        <div class="col-md-4">
                            <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                            <span class="help-block">Click para mudar cor</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@section('calendar-js')
    <script type="text/javascript">

        $(document).ready(function() {
            $(function(){
                var currentDate; // Holds the day clicked when adding a new event
                var currentEvent; // Holds the event object when editing an event
                $('#color').colorpicker(); // Colopicker
                $('#time').timepicker({
                    minuteStep: 5,
                    showInputs: false,
                    disableFocus: true,
                    showMeridian: false
                });  // Timepicker
                // Fullcalendar
                $('#calendar').fullCalendar({
                    timeFormat: 'H(:mm)',
                    header: {
                        left: 'prev, next, today',
                        center: 'title',
                        right: 'month, basicWeek, basicDay'
                    },
                    // Get all events stored in database
                    events: 'http://casa2.dev/visitas/listar',
                    // Handle Day Click
                    dayClick: function(date, event, view) {

                        currentDate = date.format();
                        // Open modal to add event
                        modal({
                            // Available buttons when adding
                            buttons: {
                                add: {
                                    id: 'add-event', // Buttons id
                                    css: 'btn-success', // Buttons class
                                    label: 'Adicionar' // Buttons label
                                }
                            },
                            title: 'Adicionar Evento: ' + date.format('DD/MM/Y') // Modal title
                        });

                    },
                    // Event Mouseover
                    eventMouseover: function(calEvent, jsEvent, view) {
                        var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
                        $("body").append(tooltip);
                        $(this).mouseover(function(e) {
                            $(this).css('z-index', 10000);
                            $('.event-tooltip').fadeIn('500');
                            $('.event-tooltip').fadeTo('10', 1.9);
                        }).mousemove(function(e) {
                            $('.event-tooltip').css('top', e.pageY + 10);
                            $('.event-tooltip').css('left', e.pageX + 20);
                        });
                    },
                    eventMouseout: function(calEvent, jsEvent) {
                        $(this).css('z-index', 8);
                        $('.event-tooltip').remove();
                    },
                    // Handle Existing Event Click
                    eventClick: function(calEvent, jsEvent, view) {
                        // Set currentEvent variable according to the event clicked in the calendar
                        currentEvent = calEvent;
                        // Open modal to edit or delete event
                        modal({
                            // Available buttons when editing
                            buttons: {
                                delete: {
                                    id: 'delete-event',
                                    css: 'btn-danger',
                                    label: 'Deletar'
                                },
                                update: {
                                    id: 'update-event',
                                    css: 'btn-success',
                                    label: 'Atualizar'
                                }
                            },
                            title: 'Editar Evento "' + calEvent.title + '"',
                            event: calEvent
                        });
                    }
                });
                // Prepares the modal window according to data passed
                function modal(data) {
                    // Set modal title
                    $('.modal-title').html(data.title);
                    // Clear buttons except Cancel
                    $('.modal-footer button:not(".btn-default")').remove();
                    // Set input values
                    $('#title').val(data.event ? data.event.title : '');
                    if(!data.event) {
                        // When adding set timepicker to current time
                        var now = new Date();
                        var time = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes());
                    } else {
                        // When editing set timepicker to event's time
                        var time = data.event.date.split(' ')[1].slice(0, -3);
                        time = time.charAt(0) === '0' ? time.slice(1) : time;
                    }
                    $('#time').val(time);
                    $('#description').val(data.event ? data.event.description : '');
                    $('#color').val(data.event ? data.event.color : '#3a87ad');
                    // Create Butttons
                    $.each(data.buttons, function(index, button) {
                        $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
                    })
                    //Show Modal
                    $('.modal').modal('show');
                }
                // Handle Click on Add Button
                $('.modal').on('click', '#add-event',  function(e){
                    if(validator(['title', 'description'])) {
                        $.post('crud/addEvent.php', {
                            title: $('#title').val(),
                            description: $('#description').val(),
                            color: $('#color').val(),
                            date: currentDate + ' ' + getTime()
                        }, function(result){
                            $('.modal').modal('hide');
                            $('#calendar').fullCalendar("refetchEvents");
                        });
                    }
                });
                // Handle click on Update Button
                $('.modal').on('click', '#update-event',  function(e){
                    if(validator(['title', 'description'])) {
                        $.post('crud/updateEvent.php', {
                            id: currentEvent._id,
                            title: $('#title').val(),
                            description: $('#description').val(),
                            color: $('#color').val(),
                            date: currentEvent.date.split(' ')[0]  + ' ' +  getTime()
                        }, function(result){
                            $('.modal').modal('hide');
                            $('#calendar').fullCalendar("refetchEvents");
                        });
                    }
                });
                // Handle Click on Delete Button
                $('.modal').on('click', '#delete-event',  function(e){
                    $.get('crud/deleteEvent.php?id=' + currentEvent._id, function(result){
                        $('.modal').modal('hide');
                        $('#calendar').fullCalendar("refetchEvents");
                    });
                });
                // Get Formated Time From Timepicker
                function getTime() {
                    var time = $('#time').val();
                    return (time.indexOf(':') == 1 ? '0' + time : time) + ':00';
                }
                // Dead Basic Validation For Inputs
                function validator(elements) {
                    var errors = 0;
                    $.each(elements, function(index, element){
                        if($.trim($('#' + element).val()) == '') errors++;
                    });
                    if(errors) {
                        $('.error').html('Por favor inserir titulo e descrição.');
                        return false;
                    }
                    return true;
                }
            });
        });
    </script>
@endsection