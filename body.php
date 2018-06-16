<html>
<head></head>
<body>
<br>
<?php

echo "-----------------------------------------------------------------\n<br>";
echo "Information: Attachment are not included !\n<br>";
echo "Information: Some parts may not display properly !\n<br>";
echo "-----------------------------------------------------------------\n<br><br>";

$conn = imap_open('ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT', OP_READONLY);

$mail_number_id = $_POST['BODY_MAIL'];

$body_TEXT = imap_qprint(imap_fetchbody($conn, $mail_number_id, 1.2));
 if(!strlen($body_TEXT)>0) {
  $body_TEXT = imap_qprint(imap_fetchbody($conn, $mail_number_id, 1));
 }

$out_body = $body_TEXT;
//session_start();
echo "<br>";
echo $out_body;
echo "<br>";

imap_close($conn);

?>
</body>
</html>

