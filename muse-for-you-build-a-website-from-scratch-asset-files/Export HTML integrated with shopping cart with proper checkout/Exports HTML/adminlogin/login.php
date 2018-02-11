<?php
$con = mysqli_connect("localhost","root","","swapdb"); //connect to database
if (!$con)
{
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
?>

<?php
date_default_timezone_set( 'Asia/Singapore' );

if ((date ("G") >= 9) && (date ("G") <= 19)) 
{
	session_start();

	$_SESSION["username"] = mysqli_real_escape_string($con, $_REQUEST['user']);
	$_SESSION["password"] = mysqli_real_escape_string($con, $_REQUEST['pass']);

	$recaptcha_secret = "6LcUgkMUAAAAAKHpQefwRmO18J24UaAVN4-4EmUA";
	$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptcha_secret.'&response='.$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	$login=mysqli_query($con, "SELECT `password`,`email` from admin WHERE username='". $_SESSION["username"] ."'");

	while($row = mysqli_fetch_array($login))
	{
		$hash= $row['password'];
		$email1= $row['email'];
	}

	if(password_verify($_SESSION["password"], $hash))
	{
		if($response["success"]==true)
		{
			$_SESSION["time"] = time();
			$_SESSION["otp"] = rand(100000,999999); //generate OTP
			require_once("phpmailer.php"); //send OTP
			$mail_status = sendOTP($email1,$_SESSION["otp"]);
			echo"Welcome";
			header ("Location: otpv2.html");
		}
		else
		{
			header ("Location: loginpage.html");
		}
	}
	else
	{	
		echo"Incorrect Password";
		header ("Location: loginpage.html");
	}
}
else
{
	die("Sorry, access is restricted at this timing. Pleaseeeeeeee Come back between 9am and 7pm.");
}	
?>


