<!DOCTYPE html><!--Ok comenzamos diciendole que el documento sera de tipo html5 -->
<html lang="es"><!--Aca estamos iniciando codigo html para comenzar a escribirlo de echo... ya comenzamos al escribir el tipo de documento :) wuaoo ya estas avanzando ehh... -->
<head><!--Aca le estamos dando una cabezera.. Jejejeje si asi como lo oyen pues html es como un humano tiene un nombre un tipo de sexo un cuerpo una cabeza etc... (Y no hablo de la cabeza de abajo :VVVV) -->
    <meta charset="UTF-8"><!--Bueno las meta etiquetas se usan para identificar propiedades a un documento -->
    <title>IberoAmerica</title><!--Declaramos un titulo al index pueden tener cualquier caracter que quieras :) -->
    <script type="text/javascript">

        var max=0;
        function textlist()
        {
            max=textlist.arguments.length;
            for (i=0; i<max; i++)
                this[i]=textlist.arguments[i];
        }
        tl=new textlist
        (
                "Anonymous IberoAmerica",
                "Somos Hackers...",
                "Somos Legíon...",
                "No Olvidamos...",
                "No Perdonamos...",
                "Ya llegamos...",
                "Defaced On"
        );
        var x=0; pos=0;
        var l=tl[0].length;
        function textticker()
        {
            document.tickform.tickfield.value=tl[x].substring(0,pos)+"|";
            if(pos++==l) { pos=0; setTimeout("textticker()",2000); x++;
                if(x==max) x=0; l=tl[x].length; } else
                setTimeout("textticker()",50);
        }
    </script>
</head><!--Aca cerramos la etiqueta, mucho ojo a la hora de abrir una etiqueta y no cerrarla pueden tener errores a la hora de mostar en interfaz -->
<style>/*Etiquetas de estilo se utiliza para dar mas dinanismo a una pagina se supone que esto se deberia hacer en un archivo externo con extencion css,comentar en css--> dentro de las etiquetas de estilo se comenta de este modo con slash asterisco (/*) y se termina de la forma alreves como la escribiste()*/

    body{/*Aca lo unico que le ando diciendo es olle hoja de estilos quiero un color de fondo de pantall colo negro y las letras ban a tener un color blanco*/
        color: #ffffff;/*color white(blanco en español)*/
        background-origin: border-box;
        background-clip: padding-box;
        background-image: url("../Views/app/Img/Anonymous-hackers.jpg");
        background-attachment: fixed;
        background-size: cover;
    }

    .main{/*Aca estoy llamando a una clase que se llama main en css las clases de llaman al principio con un punto*/
        color: #ffffff;
        justify-content: center;
        width: 45%;
        margin: auto;
        border: 1px solid #ffffff;
        box-shadow: 0 0 10px #ffffff;
        background: url("../Views/app/Gif/th_matrix.gif");
        opacity: .7;
    }
    .main >  h1 {
        color: #ff0000;
        font-family: "Courier New";
        text-align: center;
        box-shadow: 0 0 10px #ffffff inset;
    }

    .main > h2{
        color: #ff0000;
        font-family: "Courier New";
        text-align: center;
        box-shadow: 0 0 10px #ffffff inset;
    }
    .main > .text-justify{
        text-justify: distribute;
        text-align: center;
    }
    .main > .img{
        margin-left: 10px;
        box-shadow: 0 0 10px #ffffff;
        opacity: .9;
        width: 180px;
        height: 400px;
        border-bottom: 3px solid #ff0000;
    }
    input[type="text"]{
        background: none;
        color: #ffffff;
        outline: none;
        border: none;
        padding: 20px;
        font-size: 20px;
        border-left: 3px solid #ff0000;
        margin-bottom: 20px;
    }
</style>
<body onload="textticker()"><!--Aca le decimos olle pendejo quiero comenzar hacer el cuerpo de mi index :) el te dira ok abre una etiqueta body (en español cuerpo) comó abro una etiqueta bueno muy fácil.... :) <EstoEsUnaEtiqueta> Fácil no? -->
<header><!--Y que es esto acaso un humano tiene dos cabezas :O No jajajaj ok si :) con la que haces hijos :V Jajajaj.... Pero no os salgamos del tema ehh... bueno en html puedes hacer humanos deformes :V pero esto no es obigatorio ok... -->
    <a href="../index.php">Volver</a>
</header>
<div class="main"><!--Que es esto de div ehhh.... Bueno div es un contenedor donde puedes meter mas contenedores hijos ok... Un ejemplo más claro ok imaginence que tienen una caja grande y en ella puedes meter mas cajas pequeñas :)  --><!--Clases qe son esas mamadas eh.. explicanos Ded_*88 :) ok ok jajajaj... Clases son atributos de codigo html :) es como darle un nombre que puede ser usado para fines de estilos oh hacerle alguna animacion con javascript oh con frameworks como ajx en fin :) no te enriedes, si no eniendes salta este paso -->
    <h1>Hacked by <br> ##~[Anoymous IberoAmerica]</h1><!--Aca puedes escribir un titulo, para tu cabezera -->
    <h2><marquee direction="alreves"><b>###Dead_*88###</b> <--> ##Unknown88##</marquee></h2><!--Aca puedes escribir un titulo, para tu cabezera -->
    <form name="tickform">
        <center><input type="text" name="tickfield" size="30"></center>
    </form>
    <img class="img" src="../Views/app/Img/4.jpg" alt="ReadError">
    <img class="img" src="../Views/app/Img/4.jpg" alt="ReadError">
    <img class="img" src="../Views/app/Img/4.jpg" alt="ReadError">
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut error excepturi exercitationem labore, libero quisquam recusandae sint. Corporis delectus eos explicabo illo illum iure! Ab in quasi quisquam sapiente sequi.</p>
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut error excepturi exercitationem labore, libero quisquam recusandae sint. Corporis delectus eos explicabo illo illum iure! Ab in quasi quisquam sapiente sequi.</p>
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut error excepturi exercitationem labore, libero quisquam recusandae sint. Corporis delectus eos explicabo illo illum iure! Ab in quasi quisquam sapiente sequi.</p>
</div>
<footer><!--Bueno footer se le declara al index como el pie de pagina no le pares mucha atencion a esto ya que no vamos a desarrollar una aplicacion web :) depronto mas adelante os enseño a crear una FanPage... Aquí mas que todo es como para meter un contacto oh los copyright(derechos de autor (:) -->

</footer>
</body>
</html>
<!--Ok se me olvido decirles que esto que esta encerrado en esta etiqueta no se mostrara en el navegador por que... fácil por que asi es como se comenta una linea de codigo en html :) -->
