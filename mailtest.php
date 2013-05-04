<?php
include 'includes.php';
$mail = new PHPMailer();
            
$mail->IsSMTP();
$mail->Host = $config->getSmtpHost();
$mail->SMTPAuth = true;
$mail->Username = $config->getSmtpLogin();
$mail->Password = $config->getSmtpPassword();
$mail->SMTPSecure = 'tls'; 

$mail->From = $config->getSmtpFrom();

$mail->FromName = $config->getSmtpFromName();

$mail->AddAddress('kaj@telenet.be');

$mail->AddReplyTo($config->getSmtpFrom());

$mail->IsHTML(true);

$mail->Subject = 'Here is the subject';

$mail->Subject = 'Welkom op Zottebeatjes.be!';

$htmlbody = "Hey, Kaj!<br /><br />";
$htmlbody.= "Welkom op Zottebeatjes.be, het muziekforum voor de allerzotste beatjes!<br />";
$htmlbody.= "Om je registratie te vervolledigen moet je je e-mailadres nog verifi&#235;ren, dit doe je door op onderstaande link te klikken:<br />";
$htmlbody.= "<a href='url'>url</a><br /><br />";
$htmlbody.= "Alvast veel forumplezier!<br /><br />";
$htmlbody.= "~Het Zottebeatjes Team";

$plainbody = "Hey, Kaj!\n\n";
$plainbody.= "Welkom op Zottebeatjes.be, het muziekforum voor de allerzotste beatjes!\n";
$plainbody.= "Om je registratie te vervolledigen moet je je e-mailadres nog verifiëren, dit doe je door op onderstaande link te klikken:\n";
$plainbody.= "url\n\n";
$plainbody.= "Alvast veel forumplezier!\n\n";
$plainbody.= "~Het Zottebeatjes Team";

$mail->Body    = $htmlbody;
$mail->AltBody = $plainbody;

if(!$mail->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    exit;
 }

 echo 'Message has been sent';
             
?>