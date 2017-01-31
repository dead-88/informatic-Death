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
    setInterval("loadOldMessages()",1000);
});

var registerMessages = function () {
    $("#send").on("click" ,function (e) {
       e.preventDefault();
        var frm = $("#formChat").serialize();
        $.ajax({
           type: "POST",
            url: "../Controlador/register.php",
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
        url: "../Core/Controlador/loadConversations.php"
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