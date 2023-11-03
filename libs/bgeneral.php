<?php
//verificador de correos electronicos
function verificar_email($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

?>