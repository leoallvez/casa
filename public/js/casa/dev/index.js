Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

var app = new Vue({
    el: '#app',
    methods: {
        excluir(elementId) {
            swal({
                title: "Tem certeza?",
                text: "O registro será inativado!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    var resource = app.$resource(url);
                    resource.remove({ id: elementId }).then((response) => {
                        swal({
                            title: "Inativado!",
                            text: "Registro foi Inativado!",
                            type: "success"
                        }, function () {
                            window.location.reload();
                        });
                    }, (response) => {
                        swal("ERRO", "Não foi possível excluir o registro !", "error");
                    });
                } else {
                    swal("Cancelado", "Registro ainda ativo!", "error");
                }
            });
        },
        //Mensagens
        alertaNaoExcluir() {
            swal({
                title: "Atenção",
                text: "Não é possivel inativar o registo, pois o mesmo pois possui vínculo(s).",
                type: "error"
            });
        }
    }
});