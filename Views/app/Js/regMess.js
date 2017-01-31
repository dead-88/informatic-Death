// $(document).ready(function () {
//     $("#send").click(function () {
//         var iduser = $("#idUser").val();
//         var userConver = $("#userConvers").val();
//         var message = $("#message").val();
//
//         var now = new Date();
//         var date = now.getDate() + '-' + now.getMonth() + '-' + now.getFullYear() + ' ' + now.getHours() + ':' + + now.getMinutes() + ':' + + now.getSeconds();
//
//         var form = 'idUser=' + iduser + '&userConvers=' + userConver + '&message=' + message;
//
//         $.ajax({
//             type: 'POST',
//             url: '../Controlador/registerMsj.php',
//             data: form,
//             success: function () {
//                 $("#conversation").append('<div><div><img src="#"></div><strong>'+ userConver +'</strong>dice: <small>'+ date +'</small>'+message+'</div>')
//             }
//         });
//         return false;
//     });
// });


$(document).on("ready",function(){
    var element = $(".obj");
    $(".view").click(function () {
        element.slideToggle("slow");
    });

    var elementtwo = $(".objtwo");
    $(".viewtwo").click(function () {
        elementtwo.slideToggle("slow");
    });

    var elementtree = $(".objtree");
    $(".viewtree").click(function () {
        elementtree.slideToggle("slow");
    });

    registerMessages();
    $.ajaxSetup({"cache":false});
    // setInterval("loadOldMessages()",1000);
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
            $("#message").val("");
            var altura = $("#formChat").prop("scrollHeight");
            $("#formChat ").scrollTop(altura);
            // console.log(info);
        });
    });
};

var loadOldMessages = function () {
    $.ajax({
        type: "POST",
        url: "../Controlador/loadConversations.php"
    }).done(function(info) {
        $("#conversation").html(info);
        $("#conversation p:last-child").css({"background-color": "#c5c5c5",
            "padding":"10px",
            "border-radius":"50px",
            "color":"#000000","font-weight":"bold"});
        var altura = $("#conversation").prop("scrollHeight");
        $("#conversation").scrollTop(altura);
    });
};