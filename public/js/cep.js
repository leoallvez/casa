var request = null;

function createRequest() {
    //Criar um novo objeto para fazer solicitações AJAX ao servidor.
    try {
    request = new XMLHttpRequest();
    } catch (trymicrosoft) {
    try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (othermicrosoft) {
            try {
            request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (failed) {
            request = null;
            }
        }
    }
    if (request == null)
        console.log("Error creating request object!");
}
/**
    Todo o código abaixo da condicional “if (request.readyState == 4)” 
    será executado quando a solicitação ao servidor for totalmente concluída, 
    ou seja, quando uma resposta for trazida do servidor.
*/
function atualizaPagina() {

    if (request.readyState == 4) {
        
        var result = request.responseText;
        // Convertendo JSON em um objeto javascript.
        result = JSON.parse(result);

        if(result.status){
            $('#endereco').val(result.endereco.ds_abrev_logradouro);
            $('#cidade').val(result.endereco.ds_localidade);
            $('#bairro').val(result.endereco.ds_bairro);
            
            var id_estado = buscarIdEstado(result.endereco.ds_uf);
            //Select de Estado.
            $('.estado option')
                .removeAttr('selected')
                .filter('[value='+id_estado+']')
                .attr('selected', true);
        } else {
            swal({
                title: "CEP não encontrado!",
                text: "Você ainda pode preencher as informações de endereço manualmente.",
                showConfirmButton: true
            });
        }
    }
}

function buscarCEP() {
    createRequest();
    // Pegando o valor cep digitado
    var cep = $('#cep').val();
    // A url da API que será feita a consulta.
    request.open("GET", url + cep, true);

    request.onreadystatechange = atualizaPagina;

    request.send(null);
}