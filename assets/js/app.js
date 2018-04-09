/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

require('bootstrap/dist/js/bootstrap.bundle');
//alert("Un peu long cette configggg....");
//$(document).ready(function () {
//    console.log("jquery est actif, le document html est chargé, je peux exécuter du jquery");
//});
var randomcolor = require('randomcolor');
$(document).ready(function () {
    $("#secret").click(function () {
        toggle_color_body(50, 25);
        function toggle_color_body(cycle_time, wait_time) {
            setInterval(function first_color() {
                document.body.style.backgroundColor = randomcolor();
                setTimeout(change_color, wait_time);
            }, cycle_time);
            function change_color() {
                document.body.style.backgroundColor = randomcolor();
            }
        }
        toggle_color_form(50, 25);
        function toggle_color_form(cycle_time, wait_time) {
            setInterval(function first_color() {
                document.getElementById("formFun").style.backgroundColor = randomcolor();
                setTimeout(change_color, wait_time);
            }, cycle_time);
            function change_color() {
                document.getElementById("formFun").style.backgroundColor = randomcolor();
            }
        }
        toggle_color_bord(50, 25);
        function toggle_color_bord(cycle_time, wait_time) {
            setInterval(function first_color() {
                document.getElementById("formFun").style.borderColor = randomcolor();
                setTimeout(change_color, wait_time);
            }, cycle_time);
            function change_color() {
                document.getElementById("formFun").style.borderColor = randomcolor();
            }
        }
        toggle_color_btn(50, 25);
        function toggle_color_btn(cycle_time, wait_time) {
            setInterval(function first_color() {
                document.getElementById("form_class_Enregistrer").style.backgroundColor = randomcolor();
                setTimeout(change_color, wait_time);
            }, cycle_time);
            function change_color() {
                document.getElementById("form_class_Enregistrer").style.backgroundColor = randomcolor();
            }
        }
    });
});