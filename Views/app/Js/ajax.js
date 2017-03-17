    function Consultations() {
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
        }catch (e){
            try{
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (E){
                xmlhttp = false;
            }
        }
        if(!xmlhttp && typeof  XMLHttpRequest != 'undefined'){
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

    function Delete(id_blog) {
        ajax = Consultations();

        ajax.open("GET","../ControllersRoot/delete.php?id_blog="+id_blog);
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 4){
                c.innerHTML = ajax.responseText;
            }
        };
        ajax.send(null);
        location.reload();
    }

    function Confirm(id_blog) {
        c = confirm('¿Realmente Deseas Eliminar Este Post?');
        if(c){
            Delete(id_blog);
        }else {
            return false;
        }
    }

    function DeleteUser(id_blog) {
        ajax = Consultations();

        ajax.open("GET","../ControllersRoot/deleteUser.php?id_users="+id_blog);
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 4){
                c.innerHTML = ajax.responseText;
            }
        };
        ajax.send(null);
        location.reload();
    }

    function ConfirmUser(id_blog) {
        c = confirm('¿Realmente Deseas Eliminar Este Usuario?');
        if(c){
            DeleteUser(id_blog);
        }else {
            return false;
        }
    }

    function DeleteMensaje(id_conversations) {
        ajax = Consultations();

        ajax.open("GET","../ControllersRoot/deletemsj.php?id_conversations="+id_conversations);
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 4){
                c.innerHTML = ajax.responseText;
            }
        };
        ajax.send(null)
    }

    function Confirmmsj(id_conversations) {
        c = confirm('¿Realmente Deseas Eliminar Este Mensaje?');
        if(c){
            DeleteMensaje(id_conversations);
        }else {
            return false;
        }
    }

    function DeleteMensajeUser(id_conversations) {
        ajax = Consultations();

        ajax.open("GET","../../CoreRoot/ControllersRoot/deletemsj.php?id_conversations="+id_conversations);
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 4){
                c.innerHTML = ajax.responseText;
            }
        };
        ajax.send(null)
    }

    function ConfirmmsjUser(id_conversations) {
        c = confirm('¿Realmente Deseas Eliminar Este Mensaje?');
        if(c){
            DeleteMensajeUser(id_conversations);
        }else {
            return false;
        }
    }