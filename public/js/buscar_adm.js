var requestAdm = null;

function createRequestAdm() {
    //Criar um novo objeto para fazer solicitações AJAX ao servidor.
    try {
    requestAdm = new XMLHttpRequest();
    } catch (trymicrosoft) {
    try {
            requestAdm= new ActiveXObject("Msxml2.XMLHTTP");
        } catch (othermicrosoft) {
            try {
            requestAdm = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (failed) {
            requestAdm = null;
            }
        }
    }
    if(requestAdm == null)
        console.log("Error creating request object!");
}
/**
    Todo o código abaixo da condicional “if (request.readyState == 4)” 
    será executado quando a solicitação ao servidor for totalmente concluída, 
    ou seja, quando uma resposta for trazida do servidor.
*/
function atualizaPaginaAdm() {
    if (requestAdm.readyState == 4) {
        if(requestAdm.status == 200){

            /** Convertendo JSON em um objeto javascript.*/
            var r = JSON.parse(requestAdm.responseText);

            //console.log(r.adm);

            $('#name').val(r.adm.name);
            $('#cpf').val(r.adm.cpf);
            $('#cargo').val(r.adm.cargo);
            $('#email_adminstrador').val(r.adm.email);
        }
    }
}

function buscarAdm() {
    createRequestAdm();
    // Pegando o valor CEP digitado
    var id = $('#adm_id').val();

    //console.log('id: '+id);
    // A URL da API que será feita a consulta.
    requestAdm.open("GET", url+id, true);

    requestAdm.onreadystatechange = atualizaPaginaAdm;

    requestAdm.send(null);
}