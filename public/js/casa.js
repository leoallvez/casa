
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





