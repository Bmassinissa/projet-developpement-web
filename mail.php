<?php

$destMail=$_POST['AdresseMail'];

   function mail_inscription($mail){
     $to = $mail;
     $subject = 'No_Replay-Confirmation inscription';
     $message = 'Bonjour nous vous confirmons votre inscription !';
       
if (mail($to, $subject, $message)){
 
    echo 'message sent';

}
       else {
           
           echo 'message not sent';
   }
   }
 mail_inscription($destMail);

 ?>