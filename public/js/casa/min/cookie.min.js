/*
* Cookie Javascript  
* @version v1.0.0
* @link https://github.com/leoallvez/cookie.js
*/
function setCookie(e, o) { var t = new Date((new Date).getFullYear() + 5, 0, 1); t = t.toGMTString(), o = encodeURI(o), document.cookie = e + "=" + o + "; expires=" + t + "; path=/" } function getCookie(e) { var o = " " + e + "=", t = document.cookie; return -1 != t.indexOf(o) && (-1 != (t = t.substr(t.indexOf(o), t.length)).indexOf(";") && (t = t.substr(0, t.indexOf(";"))), t = t.split("=")[1], decodeURI(t)) } function removeCookie(e) { var o = new Date(2010, 0, 1); o = o.toGMTString(), document.cookie = e + "=; expires=" + o + "; path=/" }