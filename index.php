<?php
// Send out an e-mail with PHP mail() Function
//----------------------------------------------------------------------
function sendmail($to,$subject,$body,$template,$custom){	
	// Remove all illegal characters from email
	$to = filter_var($to, FILTER_SANITIZE_EMAIL);	
	// Validate e-mail
	if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
		echo($to . ' is NOT a valid email address');
		return;
	} 
	// custom or template
	if ($custom === true && $template === 'custom'){
		$array['custom']['subject'] = $subject;
		$array['custom']['body'] = $body;
	}elseif(($template === 'success' || $template === 'warning' || $template === 'alert') && ($custom === false)){
		// templates
		$array['success']['subject'] = 'Notification: Success';
		$array['success']['body'] = 'Congrats! We deliver you success!';
		$array['warning']['subject'] = 'Notification: Warning';
		$array['warning']['body'] = 'Warning! We deliver you a warning!';	
		$array['alert']['subject'] = 'Notification: Alert';
		$array['alert']['body'] = 'Alert! We deliver you an alert!';	
	}else{
		// no template or custom message set, we send an error notification...
		$template = 'error';
		$array[$template]['subject'] = 'Notification: Error';
		$array[$template]['body'] = 'Error while processing your e-mail, please contact admin.';
	}	
	$subject = $array[$template]['subject'];
	$body = $array[$template]['body'];
	$headers = "From: webmaster@example.com";
	mail($to,$subject,$body,$headers);	
}

// Samples
//----------------------------------------------------------------------
//sendmail($to,$subject,$body,$template,$custom);

// send template message
//sendmail('test@example.com','Custom subject', 'Custom body','success',false);
//sendmail('test@example.com','Custom subject', 'Custom body','warning',false);
//sendmail('test@example.com','Custom subject', 'Custom body','alert',false);

// we set the wrong template name, instead of alert we typed "alert1", thus sending out an error mail.
//sendmail('test@example.com','Custom subject', 'Custom body','alert1',false);

// send custom message
//sendmail('test@example.com','Custom subject', 'Custom body','custom',true);

?>
