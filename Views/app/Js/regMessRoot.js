// $(document).ready(pagination(1));
$(document).on("ready",function () {
    var element = $(".obj");
    $(".view").click(function () {
        element.slideToggle("slow");
    });

    var elementtwo = $(".objtwo");
    $(".viewtwo").click(function () {
        elementtwo.slideToggle("slow");
    })

    var elementtree = $(".objtree");
    $(".viewtree").click(function () {
        elementtree.slideToggle("slow");
    })
});

$(document).on("ready",function(){
    registerMessages();
    $.ajaxSetup({"cache":false});
    // setInterval("loadOldMessages()",1000)
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