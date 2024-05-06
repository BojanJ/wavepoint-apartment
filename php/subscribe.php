<?php
include 'db.php';

$email   = $_POST['email'];


$sql = "INSERT INTO `mail_list` (`email`) VALUES ('$email')";

// Check if email has been entered and is valid
if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$sendstatus = 0;
	$message = '<div class="alert alert-danger subscription-error" role="alert"><strong>Error:</strong> Please enter a valid email address.</div>';
} else if ($conn->query($sql) === TRUE) {
	$sendstatus = 1;
	$message = '<div class="alert alert-success subscription-success" role="alert"><strong>Success!</strong> Thank you for your your email.</div>';
} else {
	$sendstatus = 0;
	$message = '<div class="alert alert-danger subscription-error" role="alert"><strong>Error:</strong> Something went wrong...</div>';
}
$result = array(
	'sendstatus' => $sendstatus,
	'message' => $message
);

echo json_encode($result);
$conn->close();
?>