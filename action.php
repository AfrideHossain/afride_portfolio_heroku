<?php

use PHPMailer\PHPMailer\PHPMailer;


require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

function input_tester($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mailer = new PHPMailer(true);

if (isset($_POST["submit"])) {
    //echo "Your request is being processing...";
    $name = input_tester($_POST["client_name"]);
    $mail = htmlspecialchars($_POST["client_mail"]);
    $subject = htmlspecialchars($_POST["client_subject"]);
    $message = htmlspecialchars($_POST["client_message"]);
    $mbody = "<div style='font-size: 1.2em; padding: 5px;'>

            <div style='border-bottom: 1px solid gray;'>
                <p style='color: red; font-weight: bold; margin-bottom: 20px; padding: 0; font-size: 2.5em; line-height:0;'>Afride</p>
            </div>
            <p><b>Client Name:</b> $name</p>
            <p><b>Client Email:</b> $mail</p>
            <p><b>Subject:</b> $subject</p>
            <br>
            <span style='background: rgba(0,191,239,0.1); font-size: 1.2em; border: 1px solid #00b1dd; margin: 5px 0px; border-radius: 3px; padding: 10px 30px; margin: 10px 0px; font-weight: bold; text-align: center;'>$message
            </span>
            <br>
            <p style='margin-top: 25px;'>Thank You</p>
        </div>";

        try {
            //$mailer->SMTPDebug  = 3;
            $mailer -> isSMTP();
            $mailer -> Host = /*'smtp.gmail.com'*/ 'smtp.elasticemail.com';
            $mailer -> SMTPAuth = true;
            $mailer -> Username = /*'maskfreedom093@gmail.com'*/ 'maskhere@no-reply.com';
            $mailer -> Password = /*"QwerAsdf@#12"*/ "D9BF40DF3F9A3592C705D9EF7C6CD21DBEFF";
            $mailer -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer -> Port = '2525';

            $mailer -> setFrom('maskhere@no-reply.com');
            $mailer -> addAddress('asafridehossain142@gmail.com');
            $mailer -> isHTML(true);
            $mailer -> Subject = $subject;
            $mailer -> Body = $mbody;
            $mailer -> send();
            header("Location: index.php");
        }
        catch (Exception $e) {
            echo "An error occured while sending Email.";
        }
} else {
    header("Location: index.php");
}
?>
