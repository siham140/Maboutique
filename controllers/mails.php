<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function envoyerMail(
    string $from,
    string $subject,
    string $body,
    string $to
) {
/*     $server = $_SERVER['SERVER_NAME']; */


    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';               //Adresse IP ou DNS du serveur SMTP
    $mail->Port = 465;                          //Port TCP du serveur SMTP
    $mail->SMTPAuth = 1;                        //Utiliser l'identification

    if ($mail->SMTPAuth) {
        $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
        $mail->Username   =  'siham140kamil@gmail.com';   //Adresse email à utiliser
        $mail->Password   =  'tqddckxxfkbnhbye';         //Mot de passe de l'adresse email à utiliser
    }
    $mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
    $mail->smtpConnect();
    $mail->From       =  $from;         //L'email à afficher pour l'envoi
    $mail->FromName   = $from;             //L'alias à afficher pour l'envoi
    $mail->Subject    =  $subject;                   //Le sujet du mail
    $mail->WordWrap   = 50;                                //Nombre de caracteres pour le retour a la ligne automatique
    $mail->AltBody = $body;            //Texte brut
    $mail->Body = $body;
    $mail->IsHTML(true);                                  //Préciser qu'il faut utiliser le texte brut
    $mail->MsgHTML($body);                         //Le contenu au format HTML
    $mail->AddAddress($to);
    if (!$mail->send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Message bien envoyé';
    }
}