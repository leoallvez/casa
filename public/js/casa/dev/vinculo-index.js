    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

    var app = new Vue({
        el: '#app',
        methods: {
        desvincular(id_adotivo) {
            swal({
            title: "Tem certeza?",
            text: "O vínculo entre adotivo e adontate(s) será desfeito!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
            }, function(isConfirm) {
            if (isConfirm) {
                var placeholder = "placeholder='Digite o motivo para o fim do vínculo'";
                swal({
                title: "Informe o motivo do fim do vínculo!",
                text: "<textarea class='form-control sweet-alert-textarea' rows='12' "+ placeholder +" id='text-motivo'></textarea><br>",
                html: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Desvincular",
                cancelButtonText: "Cancelar",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: false
                }, function(isConfirm) {
                if(isConfirm) {
                    var inputValue = $('#text-motivo').val();
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                    swal.showInputError("É obrigatório informar o motivo!");
                    return false
                    }
                    var body = { id_adotivo: id_adotivo, observacoes: inputValue };
                
                    app.$http.put(url_request, body).then((response) => {
                    console.log(response);
                    
                    swal({
                        title: "Desvinculado!",
                        text: "Adotivo e adotante(s) foram desvinculados!",
                        type: "success"
                    }, function() {
                        //window.location.reload();

                        window.location = url_base + '/vinculos/adotivo/' + id_adotivo + "/#tab_vinculo_atual" ;
                    });
                    }, (response) => {
                    //Colocar uma mensagem de erro aqui.
                    });
                }
                }); /** Fim do primeiro if isConfirm */
            } else {
                swal("Cancelado", "Adotivo e adotante(s) ainda estão associados!", "error");
            }
            });
        }
        }
    });
	
    $(document).ready(function() {
        $("#adotante_id").select2({
        language: {
            noResults: function() {
            return "Adotante não encontrado!";
            }
        }
        });
        
        if(window.location.hash == "#tab_vinculo_atual") {
        $('a[href="#tab_vinculo_atual"]').tab('show');
        }
    });