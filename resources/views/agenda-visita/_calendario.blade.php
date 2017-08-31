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
                <form id="crud-form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::label('adotante_id', 'Adotante(s)') !!}
                                {!! Form::select(
                                    'adotante_id',
                                    $adotantes,
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Selecione Adotante(s)',
                                        'onchange'    => 'buscarAdotivos()',
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::label('adotivo_id', 'Adotivo(s)') !!}<br>
                                {!! Form::select(
                                    'adotivo_id',
                                    $adotivos,
                                    null,
                                    [
                                        'class'    => 'form-control',
                                        'multiple' => 'multiple',
                                        'style'    => 'width: 100%',
                                        'disabled'
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('dia', 'Data') !!}
                                {!! Form::text('dia', null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '00/00/0000',
                                        'disabled'
                                    ])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('hora_inicio', 'Hora Inicial') !!}
                                {!! Form::time('hora_inicio', null,
                                    [
                                        'class' => 'form-control',
                                        'onblur' => 'calcularTempoTotal()',
                                    ])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('hora_fim', 'Hora Final') !!}
                                {!! Form::time('hora_fim', null,
                                    [
                                        'class' => 'form-control',
                                        'onblur' => 'calcularTempoTotal()',
                                    ])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('tempo_total', 'Tempo Total') !!}
                                {!! Form::text('tempo_total', '--:--',
                                    [
                                        'id' => 'tempo_total',
                                        'class' => 'form-control',
                                        'disabled'
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    {{--
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
                    --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Voltar
                </button>
            </div>
        </div>
    </div>
</div>

@section('calendar-js')
    <script type="text/javascript">
        var url_base = "{{ url('/') }}";

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                    eventLimit: true,
                    navLinks: true,
                    timeFormat: 'H(:mm)',
                    //theme: true,
                    //weekNumbers: true,
                    handleWindowResize: false,
                    header: {
                        left: 'prev, next, today',
                        center: 'title',
                        right: 'month, basicWeek, basicDay'
                    },
                    // Get all events stored in database
                    events: url_base + "/visitas/listar",
                    // Handle Day Click
                    dayClick: function(date, event, view) {

                        currentDate = date.format();
                        // Open modal to add event
                        modal({
                            // Available buttons when adding
                            buttons: {
                                add: {
                                    id: 'add-event', // Buttons id
                                    css: 'btn btn-success', // Buttons class
                                    label: 'Agendar' // Buttons label
                                }
                            },
                            title: 'Agendar Visita dia: ' + date.format('DD/MM/Y') // Modal title
                        });
                        $('#dia').val(date.format('DD/MM/Y'));
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
                                    css: 'btn btn-danger',
                                    label: 'Cancelar Visita'
                                },
                                update: {
                                    id: 'update-event',
                                    css: 'btn-success',
                                    label: 'Reagendar'
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
                    if(validator(['adotante_id', 'dia', 'hora_inicio', 'hora_fim'])) {

                        $.ajax({
                            url: url_base + "/visitas", // your api url
                            method: 'POST', // method is any HTTP method
                            data: {
                                //dia: $('#dia').val(),
                                adotante_id: $('#adotante_id').val(),
                                hora_inicio: $('#hora_inicio').val(),
                                hora_fim: $('#hora_fim').val(),
                                status: 'agendado',
                                //color: $('#color').val(),
                                dia: currentDate
                            }, // data as js object
                            success: function(data) {
                                $('.modal').modal('hide');
                                limparCampos();
                                $('#calendar').fullCalendar("refetchEvents");  
                                swal(
                                    'Agendado',
                                    JSON.parse(data).message,
                                    'success'
                                );
                                console.log(data); // JSON
                            },
                            error: function(data) {
                                console.log(data.responseText);
                            }
                        });
                    }
                });
                // Handle click on Update Button
                $('.modal').on('click', '#update-event',  function(e){
                    if(validator(['title', 'description'])) {
                        $.ajax({
                            url: url_base + "/visitas/" + currentEvent._id, // your api url
                            method: 'PUT', // method is any HTTP method
                            data: {
                                title: $('#title').val(),
                                description: $('#description').val(),
                                color: $('#color').val(),
                                date: currentEvent.date.split(' ')[0]  + ' ' +  getTime()
                            }, // data as js object
                            success: function(data) {
                                $('.modal').modal('hide');
                                $('#calendar').fullCalendar("refetchEvents"); 
                                swal(
                                    'Reagendo',
                                    JSON.parse(data).message,
                                    'success'
                                );
                                console.log(data);    
                            },
                            error: function(data) {
                                console.log(data.responseText);
                            }
                        });
                    }
                });
                // Handle Click on Delete Button
                $('.modal').on('click', '#delete-event',  function(e){
                    $.ajax({
                        url: url_base + "/visitas/" + currentEvent._id, // your api url
                        method: 'DELETE', // method is any HTTP method
                        data: {}, // data as js object
                        success: function(data) {
                            $('.modal').modal('hide');
                            $('#calendar').fullCalendar("refetchEvents");    
                            swal(
                                    'Cancelada',
                                    JSON.parse(data).message,
                                    'success'
                            );
                            console.log(data);  
                        },
                        error: function(data) {
                            console.log(data.responseText);
                        }
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
                    console.log(elements);
                    $.each(elements, function(index, element){
                        if($.trim($('#' + element).val()) == '') errors++;
                    });
                    if(errors) {
                        $('.error').html('Por favor preencher todos os campos');
                        return false;
                    }
                    return true;
                }
            }); // Fim do script do calendario
    
            $("#adotivo_id").select2({            
                placeholder: "--",
                multiple: true
            });
        });

        function limparCampos() {
            $('#dia').val(null);
            $('#adotivo_id').val('').trigger("change");
            $('#adotante_id').val(null);
            $('#hora_inicio').val(null);
            $('#hora_fim').val(null);
            $('#tempo_total').val('--:--');
        }

        function calcularTempoTotal() {

            var startTime = $('#hora_inicio').val();
            var endTime   = $('#hora_fim').val();

            if(startTime && endTime) {

                startTime = moment(startTime, "HH:mm");
                endTime = moment(endTime, "HH:mm");

                var duration = moment.duration(endTime.diff(startTime));
                var hours = parseInt(duration.asHours());
                if(hours < 10) { hours = "0" + hours; }
                var minutes = parseInt(duration.asMinutes()) - hours * 60;
                if(minutes < 10) { minutes = "0" + minutes; }

                $('#tempo_total').val(hours + ':' + minutes);
            } else {
                $('#tempo_total').val('--:--');
            }
        }


        function buscarAdotivos() {
            var id_adotante = $('#adotante_id').val();

            $.ajax({
                url: url_base + "/visitas/busca-adotivos/adotantes/"+ id_adotante, 
                method: 'GET', // method is any HTTP method
                success: function(data) {
                    var adotivos = JSON.parse(data).adotivos;
                    $('#adotivo_id').val(adotivos).trigger("change");
                    console.log(adotivos); // JSON
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });
        }
    </script>
@endsection