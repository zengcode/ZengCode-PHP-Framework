Send Email
<?php
$to      = 'chiwa@th.fujitsu.com';
$subject = 'test na ja';
$message = 'hello ÊÇÑÊ´Õ ';
$headers = 'From: kchiwa@gamil.com' . "\r\n" .
    'Reply-To: kchiwa@gamil.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 
