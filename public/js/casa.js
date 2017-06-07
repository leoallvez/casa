
 $(document).ready(function(e) {
    var delay = 2000, fadeTime = 2000;
    $('.fadein img:gt(0)').hide();
    setInterval(function(){
        $('.fadein .img').fadeOut(fadeTime);
        $(".fadein .img:first-child").fadeOut(fadeTime) 
                                     .next(".fadein .img")
                                     .fadeIn(fadeTime) 
                                     .end() 
                                     .appendTo(".fadein")
    }, delay+fadeTime);
    /** 
     * .fadeOut    - Anima a opacidade dos elementos correspondentes.
     * .fadeIn     - Anima a opacidade dos elementos correspondentes.
     * .end()      - Retorna o objeto ao seu estado antes da proxima chamada.
     * .appendTo() - Insere esse elemento da classe .img no fim do elemento pai. 
    */   
});

function buscarIdEstado(uf) {
      var id = 1;
      
      switch(uf) {
        case 'SP':
            id = 1;
            break;
        case 'AC':
            id = 2;
            break;
        case 'AL':
            id = 3;
            break;
        case 'AM':
            id = 4;
            break;
        case 'AP':
            id = 5
            break;
        case 'BA':
            id = 6;
            break;
        case 'CE':
            id = 7;
            break;
        case 'DF':
            id = 8;
            break;
        case 'ES':
            id = 9;
            break;
        case 'GO':
            id = 10;
            break;
        case 'MA':
            id = 11;
            break;
        case 'MT':
            id = 12;
            break;
        case 'MS':
            id = 13;
            break;
        case 'MG':
            id = 14;
            break;
        case 'PA':
            id = 15;
            break;
        case 'PB':
            id = 16;
            break;
        case 'PR':
            id = 17;
            break;
        case 'PE':
            id = 18;
            break;
        case 'PI':
            id = 19;
            break;
        case 'RJ':
            id = 20;
            break;
        case 'RN':
            id = 21;
            break;
        case 'RO':
            id = 22;
            break;
        case 'RS':
            id = 23;
            break;
        case 'RR':
            id = 24;
            break;
        case 'SC':
            id = 25;
            break;
        case 'SE':
            id = 26;
            break;
        case 'TO':
            id = 27;
            break;  
     }
     return id;
  }

  





