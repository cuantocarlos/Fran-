<?php
session_start();
    //pongo el Mailer sin composer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../libs/PHPMailer/src/PHPMailer.php";
    require "../libs/PHPMailer/src/Exception.php";
    require "../libs/PHPMailer/src/SMTP.php";
    
    $mail=new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host= 'smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username="losmanes3@gmail.com";
        $mail->Password="xizu dtms unfp xpoq";

        /*
        * Encriptación a usar ssl o tls, dependiendo cual usemos hay que utilizar uno u otro puerto
        */
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = "465";
        /**TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        * $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        * $mail->Port = 587;
        */
                /*
        Receptores y remitente
        */
        //Remitente
        $mail->setFrom('losmanes3@gmail.com', 'Manes');
        //Receptores. Podemos añadir más de uno. El segundo argumento es opcional, es el nombre
        $mail->addAddress($_SESSION['email']); //Add a recipient
        //$mail->addAddress('ejemplo@example.com');
        //Copia
        //$mail->addCC('cc@example.com');
        //Copia Oculta
        //$mail->addBCC('bcc@example.com');
        //Archivos adjuntos
        //$mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
        //Contenido
        //Si enviamos HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF8";
        //Asunto
        $mail->Subject = 'Confirma tu cuenta';
        //Conteido HTML
        $mail->Body = 'location:../templates/validToken.php?token='.$token;//enviar token
        //Contenido alternativo en texto simple
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //Enviar correo
        $mail->send();
        echo 'El mensaje se ha enviado con exito';
        } catch (Exception $e) {
        echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
        }
?>
