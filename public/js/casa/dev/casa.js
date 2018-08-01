
$(document).ready(function () {
    getMenuCookie();
});

function setMenuCookie(){
    // aberto = nav-md
    // fechado = nav-sm
    setTimeout(function (){
        var body = $("body");
        var isOpen = body.hasClass("nav-sm");
        setCookie("menuIsOpen", isOpen);
        //console.log("setado que esta aberto: "+isOpen);
    }, 500);
}
	
function getMenuCookie(){	
    var isOpen = getCookie("menuIsOpen");	
    console.log('esta aberto is '+isOpen);
    var body = $("body");	
    if(isOpen == 'true'){	
        body.removeClass("nav-md");
        body.addClass("nav-sm");
        console.log('is true');	
    }else{	
        body.removeClass("nav-sm");
        body.addClass("nav-md");	
        console.log('is false');
    }	
}



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

  





