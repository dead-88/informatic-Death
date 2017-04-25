jQuery(function(){
    var userOnline  = Number(jQuery('span.user_online').attr('id'));
    var clickiado   = [];

    function in_array(valor, array) {
        for(var i = 0; i<array.length;i++){
            if(array[i] == valor){
                return true;
            }
        }
        return false;
    }
    function add_janela(id, name, status) {
        var janelas     = Number(jQuery("#chats .windows").length);
        var pixels      = (270+5) * janelas;
        var style       = 'float:none;position:absolute;bottom:0;left:' + pixels + 'px';

        var splitdatos  = id.split(':');
        var id_user     = Number(splitdatos[1]);

        var janela  = '<div class="windows" id="janela_'+id_user+'" style="'+ style +'">';
            janela  += '<div class="header_windows"><a href="#" class="close">x</a><span class="name">' + name +'</span><span id="'+ id_user +'" class="'+ status +'"></span></div>';
            janela  += '<div class="body"><div class="message"><ul></ul></div>';
            janela  += '<div class="send_message" id="'+ id +'"><input type="text" name="message" class="msg" id="'+ id +'"/></div></div></div>';

        jQuery('#chats').append(janela);
    }
    function retornar_history(id_conversation) {
        jQuery.ajax({
            type    : "POST",
            data    : {conversacion: id_conversation, online: userOnline},
            url     : "../Controlador/histori.php",
            dataType: 'json',
            success : function (result) {
                // console.log(result);
                jQuery.each(result, function (i, msg) {
                    if(jQuery('#janela_'+msg.janela_de).length > 0){
                        if(userOnline == msg.id_de){
                            jQuery('#janela_'+msg.janela_de+' .message ul').append('<li id="'+ msg.id +'" class="eu"><p>'+ msg.message +'</p></li>')
                        }else{
                            jQuery('#janela_'+msg.janela_de+' .message ul').append('<li id="'+ msg.id +'"><div class="imgSmall"><img src="../../Views/app/Img/ImgUsers/thumb_'+ msg.name_foto +'" alt="Error"/></div><p>'+ msg.message +'</p></li>')
                        }
                        //console.log(msg)
                    }
                });
                [].reverse.call(jQuery('#janela_'+id_conversation+' .message li')).appendTo(jQuery('#janela_'+id_conversation+' .message ul'));
                jQuery('#janela_'+id_conversation+' .message').animate({scrollTop: 700}, '500');
            }
        });
    }

    var aviso = 0;
    jQuery('body').on('mouseover', '.message', function(){
        var esta        = jQuery(this);
        var altura      = jQuery(this).scrollTop();
        var janela      = jQuery(this).parent().parent().attr('id');
        var idConvers  = janela.split('_');
        idConvers      = Number(idConvers[1]);

        var primera     = Number(jQuery(this).find('li:eq(0)').attr('id'));
        if(altura == 0 && aviso == 0){
            aviso = 1;
            jQuery.ajax({
                type: 'POST',
                url: '../Controlador/loadMas.php',
                data: {loadMas: 'si', topid: primera, convers: idConvers, online: userOnline},
                dataType: 'json',
                success: function(result){
                    jQuery.each(result, function(i, msg){
                        if(jQuery('#janela_'+msg.janela_de).length > 0){
                            if(userOnline == msg.id_de){
                                jQuery('#janela_'+msg.janela_de+' .message ul').prepend('<li id="'+msg.id+'" class="eu"><p>'+msg.message+'</p></li>');
                            }else{
                                jQuery('#janela_'+msg.janela_de+' .message ul').prepend('<li id="'+msg.id+'"><div class="imgSmall"><img src="fotos/'+msg.name_foto+'" /></div><p>'+msg.message+'</p></li>');
                            }
                        }
                    });
                    jQuery('#janela_'+idConvers+' .message').animate({scrollTop: 30}, '500');
                    aviso = 0;
                }
            });
        }
    });
    jQuery('body').on('click', '#users_online a', function () {
        var id = jQuery(this).attr('id');
        jQuery(this).removeClass('conectado');

        var status      = jQuery(this).next().attr('class');
        var splitId     = id.split(':');
        var idJnalea    = Number(splitId[1]);

        if(jQuery('#janela_'+idJnalea).length == 0){
            var name = jQuery(this).text();
            add_janela(id, name, status);
            retornar_history(idJnalea);
            // console.log(retornar_history(idJnalea))
        }else{
            jQuery(this).removeClass('conectado');
        }
    });
    jQuery('body').on('click','.header_windows', function () {
        var next = jQuery(this).next();
        next.toggle(100);
    });
    jQuery('body').on('click', '.close', function () {
        var parent      = jQuery(this).parent().parent();
        var idParent    = parent.attr('id');
        var splitParent = idParent.split('_');
        var idJanelaFech= Number(splitParent[1]);

        var contagem    = Number(jQuery('.windows').length)-1;
        var indice      = Number(jQuery('.close').index(this));
        var restAfrente = contagem - indice;

        for(var i = 1; i <= restAfrente; i++ ){
            jQuery('.windows:eq('+ (indice + i) +')').animate({left: '-=275'}, 200);
        }
        parent.remove();
        jQuery('#users_online li#'+ idJanelaFech +'a').addClass('conectado');
    });
    jQuery('body').on('keyup', '.msg', function (e) {
        if(e.which == 13){
            var text    = jQuery(this).val();
            var id      = jQuery(this).attr('id');
            var split   = id.split(':');
            var para    = Number(split[1]);
            jQuery.ajax({
                type    : "POST",
                data    : {message: text, de: userOnline, para: para},
                url     : "../Controlador/regMsj.php",
                success : function (result) {
                    if(result == 'ok'){
                        jQuery('.msg').val('');
                    }else{
                        alert("Campo vació");
                    }
                }
            });
        }
    });
    jQuery('body').on('click', '.message', function () {
        var janela      = jQuery(this).parent().parent();
        var janelaId    = janela.attr('id');
        var idConversa  = janelaId.split('_');
        idConversa      = Number(idConversa[1]);

        jQuery.ajax({
            type    : "POST",
            data    : {leer: 'si', online: userOnline, user: idConversa},
            url     : "../Controlador/leer.php",
            success : function (result) {}
        });
    });

    function verify(timestamp, lastid, user){
        var t;
        jQuery.ajax({
            type: 'GET',
            data: 'timestamp='+timestamp+'&lastid='+lastid+'&user='+user,
            url: '../Controlador/stream.php',
            dataType: 'json',
            success: function(result){
                clearInterval(t);
                if(result.status == 'result' || result.status == 'vacio'){
                    t = setTimeout(function(){
                        verify(result.timestamp, result.lastid, userOnline);
                    },1000);

                    if(result.status == 'result'){
                        jQuery.each(result.datos, function(i, msg){
                            if(msg.id_para == userOnline){
                                jQuery.playSound('../Sound/leido');
                            }

                            if(jQuery('#janela_'+msg.janela_de).length == 0 && msg.id_para == userOnline){
                                jQuery('#users_online #'+msg.janela_de+' .conectado').click();
                                clickiado.push(msg.janela_de);
                            }

                            if(!in_array(msg.janela_de, clickiado)){
                                if(jQuery('.message ul li#'+msg.id).length == 0 && msg.janela_de > 0){
                                    if(userOnline == msg.id_de){
                                        jQuery('#janela_'+msg.janela_de+' .message ul').append('<li class="eu" id="'+msg.id+'"><p>'+msg.message+'</p></li>');
                                    }else{
                                        jQuery('#janela_'+msg.janela_de+' .message ul').append('<li id="'+msg.id+'"><div class="imgSmall"><img src="../../Views/app/Img/ImgUsers/thumb_'+msg.name_foto+'"/></div><p>'+msg.message+'</p></li>');
                                    }
                                }
                            }
                        });
                        jQuery('.message').animate({scrollTop: 700}, '500');
                        //console.log(clickiado);
                    }
                    clickiado = [];
                    jQuery('#users_online ul').html('');
                    jQuery.each(result.users, function(i, user){
                        var incluir = '<li id="'+user.id+'"><div class="imgSmall"><img src="../../Views/app/Img/ImgUsers/thumb_'+user.name_foto+'" border="0"/></div>';
                        incluir += '<a href="#" id="'+userOnline+':'+user.id+'" class="conectado">'+user.user+'</a>';
                        incluir += '<span id="'+user.id+'" class="status '+user.status+'"></span></li>';
                        jQuery('span#'+user.id).attr('class', 'status '+user.status);
                        jQuery('#users_online ul').append(incluir);
                    });
                }else if(result.status == 'error'){
                    alert('Recarga la pagina');
                }
            },
            error: function(result){
                clearInterval(t);
                t = setTimeout(function(){
                    verify(result.timestamp, result.lastid, userOnline);
                },15000);
            }
        });
    }

    verify(0,0,userOnline);
});