<html>
<body>
<b><h1> UPDATE PRODUCT</h1></b>


<?php
$con = mysqli_connect("localhost","root","","swapdb"); //connect to database
if (!$con)
{
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
?>

<?php
	$id = mysqli_real_escape_string($con, $_REQUEST['idnum']);	
	$showprod=mysqli_query($con, "select productID,productName,price,code,size from products WHERE productID='". $id ."'");
	
	while($row1 = mysqli_fetch_array($showprod))
	{
		$id1= $row1['productID'];
		$productName1= $row1['productName'];
		$price1= $row1['price'];
		$code1= $row1['code'];
		$size1= $row1['size'];
	}
	
	if (!empty($productName1))
	{
?>
	<form action="updateprod.php" method="post">
	<table>
		<br>
		<tr>
			<td>Product Name:</td> <td><input type="text"  name="name" maxlength="50" value="<?php echo $productName1 ?>" required pattern="{1,}" /></td>
		</tr>
		<tr>
			<td>Product Price:</td> <td><input type="decimal" min="1" name="price" value="<?php echo $price1 ?>" required pattern="[0-9.-]+\.[0-9.-]{2}" title=" example: $XXX.XX " /></td>
		</tr>
		<tr>
			<td>Product Code:</td> <td><input type="text"  name="code" value="<?php echo $code1 ?>" required pattern="[A-Za-z].{1,}" title="enter characters only"/></td>
		</tr>
		<tr>
			<td>Product Size:</td> <td><input type="text" name="size" maxlength="10" value="<?php echo $size1 ?>" required pattern="[A-Za-z].{1,}" title="enter characters only"/></td>
		 </tr>
		<tr>
			<td><input type="hidden" name="id" value="<?php echo $id1 ?>" /></td>
		</tr>
		<tr>
			<td><a href="selectprodupdate.html"><button type="button" class="button" style="vertical-align:middle"><span>Back</span></button></a></td>
			<td><button type="submit" value="Submit" class="button" style="vertical-align:middle"><span>Confirm</span></button></td>
		
		</tr>
	</table>
	</form>
	<?php
	}
	else
	{
		die ("Item dont exist, Please re-enter");
	}
	?>
</body>
</html>
