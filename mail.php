<?php

$sender_name = "your website name";
$sender_email ="oduongo123@gmail.com";
$redirect_email="oduongo1234@gmail.com";
$subject="this is a test email";
$body=" Your body text";


if(mail($redirect_email,$subject,$body,"From: $sender_name <$sender_email>")){

    echo "Email Sent";
}else
echo "Something went wrong"

?>