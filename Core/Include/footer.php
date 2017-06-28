<footer>
    <div class="color-footer col-xs-12">
        <p>Copyright &COPY; <?php echo date("Y"); ?> Created By Death_*88 & BL0CK_LT3 <strong>Team Security-Hack</strong></p>
    </div>
</footer>
<script type="text/javascript" src="../../Views/app/Js/jquery.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.js"></script>
<script type="text/javascript" src="../../Views/app/Js/jquery.form.js"></script>
<script type="text/javascript" src="../../Views/app/Js/regMess.js"></script>
<script type="text/javascript" src="../../Views/app/Js/UploadImgPerfil.js"></script>
<script type="text/javascript" src="../../Views/app/Js/search.js"></script>
<script type="text/javascript" src="../../Views/app/Js/disenos.js"></script>
<script type="text/javascript" src="../../Views/app/Js/regPost.js"></script>
<?php 
    if($sesion[0]['rango'] >= 2){
?>
<script type="text/javascript" src="../../Views/app/Js/ajax.js"></script>
<?php } ?>
<script type="text/javascript" src="../../Views/app/Js/mdb.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/custom.js"></script>

<script>
    $(document).ready(function () {
        $("#status a").click(function(){
            var idblog = $(this).data('id');
            
            if($(this).html() == 'Like'){
               $.post("index.php", {like:1, postsid: idblog});
               $(this).html('Unlike');
            }else if($(this).html() == 'Unlike'){
                $.post("index.php", {unlike:1, postsid: idblog});
                $(this).html('Like');
            }
            //console.log($(this).html());
            return false;
        });
    });
</script>

</body>
</html>