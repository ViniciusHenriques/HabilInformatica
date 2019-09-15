<?php
$email_address = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	    ||
   !$email_address)
   {
	echo "No arguments Provided!";
	return false;
   }
$name = $_POST['name'];
if ($email_address === FALSE) {
    echo 'Invalid email';
    exit(1);
}
$phone = $_POST['phone'];
$message = $_POST['message'];

$to = 'vinicius9194@gmail.com';
$email_subject = "
Formulário de contato do site de $name";
$email_body = "$name fez contato conosco através de nosso website.\n\n"."Detalhes:\n\nEmail: $email_address\n\nTelefone: $phone\n\nMensagem:\n$message";
$headers = "From: contato@pedrita.com\n";
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
return true;
?>