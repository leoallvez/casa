Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

var app = new Vue({
    el: '#app',
    methods: {
        excluir(id_adotante) {
            swal({
                title: "Tem certeza?",
                text: "O adotante será inativado!",
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
                    resource.remove({ id: id_adotante }).then((response) => {
                        swal({
                            title: "Inativado!",
                            text: "Adotante foi Inativado!",
                            type: "success"
                        }, function () {
                            window.location.reload();
                        });
                    }, (response) => {
                        //Colocar uma mensagem de erro aqui Aqui
                    });
                } else {
                    swal("Cancelado", "Adotante ainda ativo!", "error");
                }
            });
        },
        alertaNaoExcluir() {
            swal({
                title: "Atenção",
                text: "Não é possivel inativar adotante por possuir vínculo com um ou mais adotivos.",
                type: "error"
            }, function () {
                // window.location.reload();
            });
        }
    }
});