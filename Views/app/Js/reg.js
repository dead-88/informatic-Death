function RegUser() {
    var connect, form, result, user, pass, email, tyc, pass_dos;
    user = document.getElementById('userReg').value;
    pass = document.getElementById('passwdReg').value;
    pass_dos = document.getElementById('passwd_rReg').value;
    email = document.getElementById('emailReg').value;
    tyc = document.getElementById('tyc_regReg').checked ? (true) : (false);

    if(true == tyc) {
        if(user.length > 1 && pass.length > 1 && pass_dos.length > 1 && email.length > 1) {
            if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)){
                if(pass == pass_dos) {
                    form = 'user=' + user + '&passwd=' + pass + '&passwd_r=' + pass_dos + '&email=' + email;
                    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    connect.onreadystatechange = function() {
                        if(connect.readyState == 4 && connect.status == 200) {
                            if(connect.responseText == 1) {
                                result = '<div class="alert alert-dismissible alert-success">';
                                result += '<h4>Registro completado!</h4>';
                                result += '<p><strong>Estamos redireccionandote...</strong></p>';
                                result += '</div>';
                                document.getElementById('_AJAX_REG_').innerHTML = result;
                                location.reload();
                            } else {
                                document.getElementById('_AJAX_REG_').innerHTML = connect.responseText;
                            }
                        } else if(connect.readyState != 4) {
                            result = '<div class="alert alert-dismissible alert-warning">';
                            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                            result += '<h4>Procesando...</h4>';
                            result += '<p><strong>Estamos procesando tu registro...</strong></p>';
                            result += '</div>';
                            document.getElementById('_AJAX_REG_').innerHTML = result;
                        }
                    }
                    connect.open('POST','Core/Controlador/registerUser.php',true);
                    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                    connect.send(form);
                } else {
                    result = '<div class="alert alert-dismissible alert-danger">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<h4>ERROR!</h4>';
                    result += '<p><strong>Las contraseñas no coinciden.</strong></p>';
                    result += '</div>';
                    document.getElementById('_AJAX_REG_').innerHTML = result;
                }
                return (true);
            }else{
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<h4>ERROR!</h4>';
                result += '<p><strong>Tú email es invalido.</strong></p>';
                result += '</div>';
                document.getElementById('_AJAX_REG_').innerHTML = result;
                return (false);
            }
        }else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<h4>ERROR!</h4>';
            result += '<p><strong>Todos los campos deben estar llenos.</strong></p>';
            result += '</div>';
            document.getElementById('_AJAX_REG_').innerHTML = result;
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<h4>ERROR!</h4>';
        result += '<p><strong>Los términos y condiciones deben ser aceptados.</strong></p>';
        result += '</div>';
        document.getElementById('_AJAX_REG_').innerHTML = result;
    }

}

function EnterRunReg(e) {
    if(e.keyCode == 13) {
        RegUser();
    }
}