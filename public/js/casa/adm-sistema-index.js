Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

var app = new Vue({
    el: '#app',
    methods: {
        excluir(id) {
            swal({
            title: "Tem certeza?",
            text: "O admistrador será inativado!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false
            }, function(isConfirm) {
            if (isConfirm) {
                var resource = app.$resource(url);
                resource.remove({id: id}).then((response) => {
                swal({
                    title: "Inativado!",
                    text: "Admistrador foi Inativado!",
                    type: "success"
                }, function() {
                    window.location.reload();
                });
                }, (response) => {
                //Colocar uma mensagem de erro aqui Aqui
                });
            } else {
                swal("Cancelado", "Usuário ainda ativo!", "error");
            }
            });
        }
    }
});