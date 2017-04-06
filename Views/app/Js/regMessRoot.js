$(document).on("ready",function(){
    var timer;
    registerMessages();
    $.ajaxSetup({"cache":false});
    timer = setInterval("loadOldMessages()",1000);
    $("#formChat").mouseover(function () {
        clearInterval(timer);
    }).mouseout(function () {
        timer = setInterval("loadOldMessages()",1000);
    });
});

var registerMessages = function () {
    $("#send").on("click" ,function (e) {
        e.preventDefault();
        var frm = $("#formChat").serialize();
        $.ajax({
            type: "POST",
            url: "../../Core/Controlador/registerMsj.php",
            data: frm
        }).done(function (info) {
            $("#message").val("");
            var altura = $("#formChat").prop("scrollHeight");
            $("#formChat ").scrollTop(altura);
            //console.log(info);
        })
    });
};
var loadOldMessages = function () {
    $.ajax({
        type: "POST",
        url: "../ControllersRoot/loadConversationsRoot.php"
    }).done(function(info) {
        $("#conversation").html(info);
        $("#conversation p:last-child").css({"background-color": "#c5c5c5",
            "padding":"10px",
            "border-radius":"50px",
            "color":"#000000","font-weight":"bold"});
        var altura = $("#conversation").prop("scrollHeight");
        $("#conversation").scrollTop(altura);
    });
}
    // function pagination(page){
    //     var url = "../Controlador/loadarticlesrootController.php";
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: 'page='+page,
    //         success:function(data){
    //             var array = eval(data);
    //             $('#agrega-registros').html(array[0]);
    //             $('#pagination').html(array[1]);
    //         }
    //     });
    //     return false;
    // }