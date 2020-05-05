/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


"use strict";

const init = function (e) {
    let btn = document.querySelector("#button");
    let value = document.getElementById('net_total').innerHTML;

    btn.addEventListener('click', function () {
        localStorage.setItem('start-time', value);
        window.document.location = 'checkout.php';
    }

    );

};


document.addEventListener('DOMContentLoaded', function () {
    init();
});