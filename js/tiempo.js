var tiempo =  new Date;

dia = tiempo.getDay();
mes = tiempo.getMonth();
año = tiempo.getFullYear();

$(document).ready(function () {
    $("#hora").html(dia);
});