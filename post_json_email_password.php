<?php

include('setup.php');

include_once "lib/swift_required.php";

$calcTime = $_POST['calcTime'];
$schemaID = $_POST['schemaID'];

$name  = $_POST['name'];
$email = $_POST['email'];
$pass  = $_POST['pass'];

setupSchema($schemaID);

function emailPassword($connection, $name, $email, $pass) {
    $params = getParams($connection);

    $transport = Swift_SmtpTransport::newInstance($params["SMTP_SERVER"], $params["SMTP_PORT"], 'ssl')
        ->setUsername($params["SMTP_USER"])
        ->setPassword($params["SMTP_PASS"]);

    $sendCopy = $params["SMTP_SENDCOPY"];

    $salesEmail = "navispy@navispy.com";
    $salesRepName = "INCRAFT Team";

    $to = array($email => $name);
    $bcc = array(
        $salesEmail => $salesRepName,
        $sendCopy => "INCRAFT Team"
    );

    $swift = Swift_Mailer::newInstance($transport);


    $message = new Swift_Message();
    $message->setCharset('utf-8');
    //$message->setCharset('utf-8');

    $message->setContentType("text/html; charset=UTF-8");

    $from = array($params["SMTP_SENDERMAIL"] => $params["SMTP_SENDER"]);
    $crlf = "\r\n";

    //$inagroLogo = $message->embed(Swift_Image::fromPath('../../assets/images/header/logo.svg'));
    //$euLogo = $message->embed(Swift_Image::fromPath('../../assets/images/header/EU.png'));
    //$byLogo = $message->embed(Swift_Image::fromPath('../../assets/images/header/ministry of economy.png'));
    //$unLogo = $message->embed(Swift_Image::fromPath('../../assets/images/header/UNDP.png'));


    $subject = 'Восстановление учетной записи INCRAFT BY';
    //$html = "<html><head></head><body>HELLO</body></html>";//file_get_contents("Request is processed.html");
    $html = file_get_contents("password-restore.html");
    $html = str_replace('$name', $name, $html);
    $html = str_replace('$pass', $pass, $html);

    //$message->attach(Swift_Attachment::fromPath($attachment)->setFilename($filename));
    $message->setSubject($subject);

    //$html = utf8_encode($html);
    //$text = HTML2text($html, $crlf);

    $message->setFrom($from);
    $message->setBody($html);
    $message->setTo($to);
    $message->setBcc($bcc);
    //$message->addPart($text, 'text/plain');

    $failures = array();
    $result = "OK";
    $failures = [];

    if ($recipients = $swift->send($message, $failures)) {
        //echo 'Message successfully sent!';
    } else {
        $result = "error";
        logMessage("knud01.txt", json_encode($failures, true));
        print_r($failures);
    }
}

emailPassword($connection, $name, $email, $pass);

echo ('{"status":' . json_encode($status) . ',');
echo ('"error":' . json_encode($error) . ',');
echo ('"calcTime":' . json_encode($calcTime) . '}');
    