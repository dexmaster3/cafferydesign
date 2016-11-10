<?php

// By Dex - 2015
// FORM RECEIVING/SEND MAIL PHP SCRIPT

$ip = $_SERVER['REMOTE_ADDR'];
$ip_file = fopen('ip_list.txt', 'r');
$ips = array();
if ($ip_file) {
	while(($line = fgets($ip_file)) !== false) {
		$ips[] = $line;
	}
} else {
	die('sendmail script broke - contact webmaster dex');
}
fclose($ip_file);
$mod_time = time() - $ips[0];

if (in_array($ip, $ips)) {
	die('Sorry only one Email per day through the Contact Page - Reach me at colleencaffery@aol.com');
} else {
$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$headers = 'From: mail@cafferydesign.com' . "\r\n" .
    'Reply-To: mail@cafferydesign.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = wordwrap($message, 70, "\r\n");

$warning = "Mrs. Caffery - The following is a message from your
website (cafferydesign.com). This message came from someone filling out
the form on the contact page. If you have any questions about this (it could be spam
or a malicious email) ask Dex - I wrote all of this. The message is below:<br/>";

$message_data = "Email: " . $email . " <br/> Name: " . $name . " <br/> Phone: " . $phone . " <br/> Message: <br/>";

$message = $warning . $message_data . $message;

mail('colleencaffery@aol.com', 'CafferyDesign.com Contact Page Email', $message, $headers);

// Save Ip Address
$ip_file_write = fopen('ip_list.txt', 'w');

if ($mod_time > 50000) {
	ftruncate($ip_file_write, 0);
	fwrite($ip_file_write, time() . "\n");
}
fwrite($ip_file_write, $ip . "\n");
fclose($ip_write_file);
}
