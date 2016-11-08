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
        if(!xmlhttp && typeof  XMLHttpRequest!='undefined'){
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

    // function Buscar() {
    //     q = document.getElementById('valor').value;
    //     c = document.getElementById('resultados');
    //     ajax = Consultations();
    //
    //     ajax.open("GET","../Controlador/search.php?id_blog="+q);
    //     ajax.onreadystatechange = function () {
    //         if(ajax.readyState == 4){
    //             c.innerHTML = ajax.responseText;
    //         }
    //     };
    //     ajax.send(null)
    // }

    function Delete(id_blog) {
        ajax = Consultations();

        ajax.open("GET","../Controlador/delete.php?id_blog="+id_blog);
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 4){
                c.innerHTML = ajax.responseText;
            }
        };
        ajax.send(null);
        location.href="../../../Admin/blog.php";
    }

    function Confirm(id_blog) {
        c = confirm('¿Realmente Deseas Eliminar Este Articulo?');
        if(c){
            Delete(id_blog);
        }else {
            return false;
        }
    }

    function DeleteMensaje(id_conversations) {
        ajax = Consultations();

        ajax.open("GET","../Controlador/deletemsj.php?id_conversations="+id_conversations);
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