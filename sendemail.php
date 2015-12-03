<div id="confirm-email-sent" style="display: none;" title="CONTACT US">
  <p><span class="ui-icon ui-icon-alert" style="float:left;"></span>
	E-mail sent<br/><br/>
	<b>Continue?</b></p>
</div>

<?php
//ob_start();

$to = "contact@spartanbrew.net";
$name = $_POST['name'];
$from = $_POST['email'];
$tel = $_POST['tel'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$message = str_replace("\n.", "\n..", $message);
//$cc = $_POST['cc'];

$headers = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "To: " . $to;
$headers[] = "From: " . $name. " <" . $from . ">";
//$headers[] = "CC: " . $name. " <" . $from . ">";
$headers[] = "Reply-To: " . $name. " <" . $from . ">";
$headers[] = "Subject: {" . $subject . "}";
$headers[] = "X-Mailer: PHP/" . phpversion();

if ( mail($to,$subject,$message,implode("\r\n", $headers)) ) {
	?> 	<script> javascript:confirmEmailSent("YES"); </script> <?php
} else {
	?> 	<script> javascript:confirmEmailSent("NO"); </script> <?php
}


//header('Location: contact.php');
//exit();
?>