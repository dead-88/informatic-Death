$(document).on("ready",function(){
    var timer;
    registerMessages();
    $.ajaxSetup({"cache":false});
    /**timer = setInterval("loadOldMessages()",1000);
    $("#conversation").mouseover(function () {
        clearInterval(timer);
    }).mouseout(function () {
        timer = setInterval("loadOldMessages()",1000);
    });**/
});

var registerMessages = function () {
    $("#send").on("click" ,function (e) {
        e.preventDefault();
        var frm = $("#formChat").serialize();
        $.ajax({
            type: "POST",
            url: "../Controlador/registerMsj.php",
            data: frm
        }).done(function (info) {
            alert(info);
            $("#message").val("");
            var altura = $("#formChat").prop("scrollHeight");
            $("#formChat ").scrollTop(altura);
            //console.log(info);
        });
    });
};

var loadOldMessages = function () {
    $.ajax({
        type: "POST",
        url: "../Controlador/loadConversations.php"
    }).done(function(info) {
        $("#conversation").html(info);
        $("#conversation p:last-child").css({
            "background-color": "#c5c5c5",
            "border-radius":    "50px",
            "color":            "#000000",
            "font-weight":      "700"});
        var altura = $("#formChat").prop("scrollHeight");
        $("#formChat").scrollTop(altura);
    });
};