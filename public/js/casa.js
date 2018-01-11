
$(document).ready(function(e) {

    var delay = 5000, fadeTime = 10000;
    $('.fadein img:gt(0)').hide();
    setInterval(function(){
        $('.fadein .img').fadeOut(fadeTime);
        $(".fadein .img:first-child").fadeOut(fadeTime) 
                                     .next(".fadein .img")
                                     .fadeIn(fadeTime) 
                                     .end() 
                                     .appendTo(".fadein")
    }, delay + fadeTime);
    /** 
     * .fadeOut    - Anima a opacidade dos elementos correspondentes.
     * .fadeIn     - Anima a opacidade dos elementos correspondentes.
     * .end()      - Retorna o objeto ao seu estado antes da proxima chamada.
     * .appendTo() - Insere esse elemento da classe .img no fim do elemento pai. 
    */   
});

function buscarIdEstado(uf) {

    var estados = [];

    var siglas = [
        'SP','AC','AL','AM','AP',
        'BA','CE','DF','ES','GO',
        'MA','MT','MS','MG','PA',
        'PB','PR','PE','PI','RJ',
        'RN','RO','RS','RR','SC',
        'SE','TO'
    ];

    for(var i = 1; i < 28; i++) {
        estados[siglas[i-1]] = i;
    }
    return estados[uf];
}

  





