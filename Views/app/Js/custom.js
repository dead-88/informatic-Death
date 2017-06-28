function goScroll(id){
	$('html,body').animate({
		scrollTop: $("#"+id).offset().top
	},'fast');
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

var loadContent = function(p, num_total){
	$("#more-items").remove();
	number 	= ((p - 1) * 10) + 1;
	page 	= p + 1;
	n_start = number;

	$.ajax({
		type: "POST",
		url : '../Controlador/pagination_ajax.php?p='+p,
		async: true,
		success : function (datos){
			var dataJson = eval(datos);
			// console.log(dataJson);
			for(var i in dataJson){
				$("#list-posts").append('<h1 class="post-fecha post-h1 text-center">'+dataJson[i].categoria+'</h1>'+dataJson[i].DelPost+''+dataJson[i].status+'<li class="post clearfix" id="item-'+number+'"><a href="#Img" class="thumb pull-right"><img class="img-rounded" src="../../Views/app/Img/imgPost/thumb_'+dataJson[i].name_img+'" alt="ReadError"></a><h2 class="post-title text-capitalize">'+dataJson[i].tema+'</h2><p><span class="post-fecha">'+dataJson[i].date+'</span><span class="post-title"> by </span><span class="post-autor">'+dataJson[i].autor+'</span></p><p class="post-content text-left">'+dataJson[i].article+'</p></li>');
				number++;
			}

			if(number < num_total){
				$("#list-posts").append('<li id="more-items"><center><a href="#more" class="btn btn-sm btn-success btn-sm" onclick="loadContent('+ page +','+ num_total +')">Cargar más...</a></center></li>');	
			}
			goScroll("item-"+n_start);
		}
	});
	return false;	
};