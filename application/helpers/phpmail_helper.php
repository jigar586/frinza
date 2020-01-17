<?php
function SendEmail($email,$subject,$msg,$htmlEnable = 1)
{
	$CI =& get_instance();
	$CI->load->library('PHPMailer');
	$objMail = $CI->phpmailer->load();
	$objMail->Host = 'smtp.zoho.com';
	$objMail->Port = 465;
	if ($htmlEnable) {
		$objMail->IsHTML(true);
	}
	$objMail->SMTPDebug = 0;
	$objMail->SMTPAuth = true; 
	$objMail->SMTPSecure = 'tls'; 
	$objMail->Username = 'support@frinza.com'; 
	$objMail->Password = '*MBApsr93#'; 
	$objMail->From = 'support@frinza.com';
	$objMail->FromName = 'Frinza';
	$objMail->AddAddress($email); 
	$objMail->Subject = $subject;
	$objMail->Body    = $msg;
	$objMail->AltBody = $msg;
	return $objMail->Send();
}
