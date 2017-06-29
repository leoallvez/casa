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

        if(request.status == 200){

            /** Convertendo JSON em um objeto javascript.*/
            var result = JSON.parse(request.responseText);

            console.log(result.logradouro);

            $('#endereco').val(result.logradouro);
            $('#complemento').val(result.complemento);
            $('#cidade').val(result.localidade);
            $('#bairro').val(result.bairro);
            
            var id_estado = buscarIdEstado(result.uf);
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
    // Pegando o valor CEP digitado
    var cep = $('#cep').val();
    cep = cep.replace("-", "");
    // A URL da API que será feita a consulta.
    request.open("GET", 'https://viacep.com.br/ws/'+cep+'/json/', true);

    request.onreadystatechange = atualizaPagina;

    request.send(null);
}