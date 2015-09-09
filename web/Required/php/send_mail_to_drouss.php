<?php
/**
 * Created by PhpStorm.
 * User: NDOUR
 * Date: 01/04/2015
 * Time: 23:45
 */
/*$_POST['email'] = "moussa_ndour@gmail.com";
$_POST['object'] = "test";
$_POST['message'] = 'Hello Word, From Brian Kernigan 1978 "C Programming Language"';*/

require_once('../../phpmailer/PHPMailerAutoload.php');

if((isset($_POST['email']) && $_POST['email'] != "") && (isset($_POST['object']) && $_POST['object'] != "") && (isset($_POST['message']) && $_POST['message'] != ""))
{
    $mail = new PHPMailer();
    $mail->isSMTP();                                      // Set mailer to use SMTP
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'drousssmtpserver@gmail.com';                 // SMTP username
    $mail->Password = 'drouss.org';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";
    $mail->SetFrom($_POST['email'], substr($_POST['email'], 0, strpos($_POST['email'],'@')));
    $mail->addReplyTo($_POST['email'], substr($_POST['email'], 0, strpos($_POST['email'],'@')));
    $mail->Subject = $_POST['object'];
    $mail->Body = $_POST['message'];
    $mail->AddAddress('drouss.org@gmail.com');
    $mail->addCC('moussa_ndour@hotmail.fr');
    if(isset($_FILES['fichier']))
    {
        $infosfichier = pathinfo($_FILES['fichier']['name']);

        $extension_upload = $infosfichier['extension'];

        $extensions_autorisees = array('pdf', 'epub', 'txt', 'doc', 'docx', 'ppt', 'htm', 'html');

        if (in_array($extension_upload, $extensions_autorisees))

        {

            $filepath = '../../uploads/'.$_POST['email'].'_'.basename($_FILES['fichier']['name']).'_'.date('m_y_d_H_i_s').'.'.$extension_upload;
            move_uploaded_file($_FILES['fichier']['tmp_name'], $filepath);

            $mail->addAttachment($filepath);
        }

    }

   if(!$mail->send())
    {
        $file_name = sprintf('../../error_log/%s_%s.%s',$_POST['email'],date('d_m_y-H_i_s'),'txt');
        $file = fopen($file_name,'w');
        fwrite($file, sprintf('Error: Message from "%s" where object is "%s" and message is << %s >>  at %s with ErrorMessage "%s"',$_POST['email'],$_POST['object'],$_POST['message'],date('d-m-y H:i:s'), $mail->ErrorInfo));
        fclose($file);
    }

}
header('Location:http:www.drouss.org');