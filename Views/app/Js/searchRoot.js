$(function () {
    $("#search_form").submit(function (e) {
        e.preventDefault();
    });
    $("#searchForm").keyup(function () {
       var send = $("#searchForm").val();
       $("#result").html("<center>Cargando...</center>");

       $.ajax({
           type: 'POST',
           url: '../ControllersRoot/search.php',
           data: ('searchForm=' + send),
           success: function (resp) {
               if(resp != ''){
                   $("#result").html(resp);
               }
           }
       });
    });
});