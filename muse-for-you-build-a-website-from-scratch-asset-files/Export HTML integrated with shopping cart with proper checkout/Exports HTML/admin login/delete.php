<html>
<body>
<b><center>USER ACCOUNT</center></b>
<?php
$con = mysqli_connect("localhost","root","","swapdb"); //connect to database
if (!$con)
{
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
?>

<?php
session_start();

$showuser= mysqli_query($con,"SELECT `password` from admin WHERE userID='". $_SESSION["id"] ."'");
$username = mysqli_real_escape_string($con, $_REQUEST['user']);
$password = mysqli_real_escape_string($con, $_REQUEST['pass']);
while($row = mysqli_fetch_array($showuser))
{
	$hash= $row['password'];
}
if(password_verify($password, $hash))
{							
	echo "Account successfully removed.";
	$deleteuser=mysqli_query($con, "DELETE FROM admin WHERE userID='". $_SESSION["id"] ."'");
	?>
	
	<td><a href="loginpage.html"><button type="submit" value="Submit" class="button"><span>Complete</span></button></td>
	<?php
}
else
{
  echo "Error occured while removing account.";
  header ("Location: deletepage.html");
}
?>
</br>

</body>
</html> 