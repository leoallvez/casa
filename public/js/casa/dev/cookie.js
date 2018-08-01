/*
* Cookie Javascript  
* @version v1.0.0
* @link https://github.com/leoallvez/cookie.js
* @author Leonardo Pereira Alves
* @copyright Released under the MIT license
* Copyright 2018
*/

/** 
*  Creaing or updating cookie
*  @param {string} name - The name of the cookie
*  @param {string} value - The value of the cookie
*  @return {void}
*/ 
function setCookie(name, value) { 
    // Set an expiration date.
    var date = new Date(new Date().getFullYear() + 5, 0, 01);
    // Converts the date to GMT
    date = date.toGMTString();
    // Encodes cookie value to avoid problems.
    value = encodeURI(value);
    // Set cookie values
    document.cookie = name + '=' + value + '; expires=' + date + '; path=/';
}

/**
*  Gets the value of a cookie
*  @param {string} name - The name of the cookie to get value.
*  @return {string} - The cookie value.
*/
function getCookie(name) {
    // Adds the = sign in front of the cookie name
    var cname = ' ' + name + '=';
    // Get all document cookies
    var cookies = document.cookie;
    // Checks if your cookie exists
    if (cookies.indexOf(cname) == -1) {
        return false;
    }
    // Removes the non-cookies part
    cookies = cookies.substr(cookies.indexOf(cname), cookies.length);
    // Gets the value of the cookie until the ';'
    if (cookies.indexOf(';') != -1) {
        cookies = cookies.substr(0, cookies.indexOf(';'));
    }
    // Removes the cookie name and the '='
    cookies = cookies.split('=')[1];
    // Returns only the value of the cookie
    return decodeURI(cookies);
}

/**
*  Delete the cookie
*  @param {string} name - The cookie name as the parameter you want to delete
*  @return {void} 
*/
function removeCookie(name) {
    // Creates a date in the past 01/01/2010
    var date = new Date(2010, 0, 01);
    // Converts the date to GMT
    date = date.toGMTString();
    // Attempts to modify the cookie value for the expired date.
    // So it will be erased.
    document.cookie = name + '=; expires=' + date + '; path=/';
}