//INSERT IMAGEN POST

$(document).ready(function () {
    var wrapper = $("<div/>").css({height:0,width: 0,'overflow': 'hidden'});
    var  fileInput1 = $("#imgPost").wrap(wrapper);

    $("#photo-1").on("click",function () {
        fileInput1.click();
    }).show();

    fileInput1.on("change",function () {
        var file = this.files[0],
            fileName = file.name,
            fileSize = file.size,
            fileType = file.type;

        if(fileType.match('image.*')){
            //Validamos el tipo de archivo
            //FileReader API HTML5
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#photo-1").html("");
                $("#cerrar-photo-1").html("");
                $("#photo-1").append("<img src='" + e.target.result + "' id='thumb-1' class='viewPhoto' alt='Error'/>");
                $("#cerrar-photo-1").show(function () {
                    $("#cerrar-photo-1").append("<img src='../../Views/app/Img/close.png' style='width: 30px;' alt='Error'/>");
                });
            };
            reader.readAsDataURL(file);
        }else{
            alert("Error solo se permiten Imagenes");
        }
    });

    $("#cerrar-photo-1").on("click",function () {
        $("#thumb-1,#cerrar-photo-1").hide();

        fileInput1.replaceWith(fileInput1 = fileInput1.val('').clone(true));
    });

    // JQUERY UPLOAD
    // BARRA DE PROGRESO UPLOAD

    var bar     = $('.bar'),
        percent = $('.percent'),
        status  = $('.msj');
    $('#formularioPost').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },complete: function(data) {
            // alert(data.responseText);
            if(data.responseText == 2){
                status.html("");
                status.append('<div class="alert alert-dismissible alert-danger"><p><strong>ERROR!</strong> Imagen vacia.</p></div>');
            }else if(data.responseText == 3){
                status.html("");
                status.append('<div class="alert alert-dismissible alert-warning"><p><strong>ERROR!</strong>La carpeta no tiene Permisos</p></div>');
            }else if(data.responseText == 4){
                status.html("");
                status.append('<div class="alert alert-dismissible alert-info"><p>Extensiones permitidas JPG, GIF, PNG</p></div>');
            }else if(data.responseText == 5){
                status.html("");
                status.append('<div class="alert alert-dismissible alert-success"><strong>Carga completa!</strong></div>');
                location.reload();
            }
        }
    });

    // FIN JQUERY UPLOAD
});