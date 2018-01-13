Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

var app = new Vue({
    el: '#app',
    methods: {
        excluir(id_adotivo) {
            swal({
                title: "Tem certeza?",
                text: "O adotivo será inativado!",
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
                    var resource = app.$resource("{{ url('adotivos{/id}') }}");
                    resource.remove({ id: id_adotivo }).then((response) => {
                        swal({
                            title: "Inativado!",
                            text: "Adotivo foi Inativado!",
                            type: "success"
                        }, function () {
                            window.location.reload();
                        });
                    }, (response) => {
                        //Colocar uma mensagem de erro aqui Aqui
                    });
                } else {
                    swal("Cancelado", "Adotivo ainda ativo!", "error");
                }
            });
        },
        alertaNaoExcluir() {
            swal({
                title: "Atenção",
                text: "Não é possivel inativar adotivo pois possui vínculo.",
                type: "error"
            }, function () {
                // window.location.reload();
            });
        }
    }
});