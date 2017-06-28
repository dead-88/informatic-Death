$(function () {

    $("#search_form").submit(function(e){
        e.preventDefault();
    });
    $("#searchForm").keyup(function () {
        var send = $("#searchForm").val();
        $("#result").html("<center>Cargando...</center>");

        $.ajax({
            type: 'POST',
            url: '../Controlador/search.php',
            data: ('searchForm=' + send),
            success: function (resp) {
                if(resp != ''){
                    $("#result").html(resp);

                    $("#status a").click(function(){
                        var idblog = $(this).data('id');
                        
                        if($(this).html() == 'Like'){
                           $.post("index.php", {like:1, postsid: idblog});
                           $(this).html('Unlike');
                        }else if($(this).html() == 'Unlike'){
                            $.post("index.php", {unlike:1, postsid: idblog});
                            $(this).html('Like');
                        }
                        return false;
                    });
                    
                }
            }
        });
    });
});