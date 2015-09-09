/**
 * Created by Administrateur on 23/03/2015.
 */

var t = $('#time');

setInterval(function(){
    var now = new Date();
    t.text('le '+now.getDay()+ '/'+now.getMonth()+'/'+now.getFullYear() + '  '+now.getHours()+ ':'+now.getMinutes()+':'+now.getSeconds()).toString();
},1000);
