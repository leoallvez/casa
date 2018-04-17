function buscarCEP() {
    $("#spinner").show();
    var cep = $('#cep').val().replace("-", "");
    
    $.ajax({
        type: "GET",
        url: "https://viacep.com.br/ws/" + cep + "/json/",
        success: function (data) {

            if (!data.erro) {

                $('#endereco_numero').val('');
                $('#endereco').val(data.logradouro);
                $('#complemento').val(data.complemento);
                $('#cidade').val(data.localidade);
                $('#bairro').val(data.bairro);

                var id_estado = buscarIdEstado(data.uf);
                //Select de Estado.
                $('.estado option')
                    .removeAttr('selected')
                    .filter('[value=' + id_estado + ']')
                    .attr('selected', true);

                $("#spinner").hide();

            } else {
                $("#spinner").hide();
                swal({
                    title: "CEP não encontrado!",
                    text: "Você ainda pode preencher as informações de endereço manualmente.",
                    showConfirmButton: true
                });
            }
        },
        error: function (request, status, error) {
            $("#spinner").hide();
            swal({
                title: "CEP não encontrado!",
                text: "Não foi possível realizar a busca de CEP.",
                showConfirmButton: true
            });
        },
    });
}