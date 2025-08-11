<?php
include("connection.php");
?>

<?php
if(isset($_POST['searchdata']))
{
	$search = $_POST['search'];

	$query = "SELECT * from form where id = '$search' ";
	$data = mysqli_query($conn, $query);

	$result = mysqli_fetch_assoc($data);

	//$name = $result['emp_name'];
	//echo $name;
}
?>      

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Software Development</title>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div class="center">
		<form action="#" method="POST">
		<h1>Employee Data Entry Automation Software</h1>

		<div class="form">
			<input type="text" name="search" class="textfield" placeholder="Search ID" value="<?php if(isset($_POST['searchdata'])){echo $result['id'];}?>">
			<input type="text" name="name" class="textfield" placeholder="Employee Name" value="<?php if(isset($_POST['searchdata'])){echo $result['emp_name'];}?>" >
			<select class="textfield" name="gender">
				<option value="Not Selected">Select Gender</option>
				<option valu="Male"
				<?php
				if($result['emp_gender'] == 'Male')
					{
						echo "selected";
				    }
				?>
				>Male</option>
				<option value="Female"
				<?php
				if($result['emp_gender'] == 'Female')
					{
						echo "selected";
				    }
				?>
				>Female</option>
				<option value="Other"
				<?php
				if($result['emp_gender'] == 'Other')
					{
						echo "selected";
				    }
				?>
				>Other</option>
			</select>


			<input type="text" name="email" class="textfield" placeholder="Email Address" value="<?php if(isset($_POST['searchdata'])){echo $result['emp_email'];}?>">
			<select class="textfield" name="department">
				<option value="Not Selected">Select Department</option>

				<option value="IT"
				<?php
				if($result['emp_dept'] == 'IT')
					{
						echo "selected";
				    }
				?>
				>IT</option>

				<option value="Accounts"
				<?php
				if($result['emp_dept'] == 'Accounts')
					{
						echo "selected";
				    }
				?>
				>Accounts</option>

				<option value="Sales"
				<?php
				if($result['emp_dept'] == 'Sales')
					{
						echo "selected";
				    }
				?>
				>Sales</option>

				<option value="HR"
				<?php
				if($result['emp_dept'] == 'HR')
					{
						echo "selected";
				    }
				?>
				>HR</option>

				<option value="Business Development"
				<?php
				if($result['emp_dept'] == 'Business Development')
					{
						echo "selected";
				    }
				?>
				>Business Development</option>

				<option value="Marketing"
				<?php
				if($result['emp_dept'] == 'Marketing')
					{
						echo "selected";
				    }
				?>
				>Marketing</option>

			</select>

			<textarea placeholder="Address" name="address"><?php if(isset($_POST['searchdata'])){echo $result['emp_address'];}?></textarea>
			<input type="submit"  value="Search" name="searchdata" class="btn">
			<input type="submit" value="Save" name="save" class="btn" style="background-color: green;">
			<input type="submit" value="Update" name="update" class="btn" style="background-color: orange;">
			<input type="submit" value="Delete" name="delete" class="btn" style="background-color: red;" onclick="return checkdelete()">
			<input type="reset" value="Clear" name="" class="btn" style="background-color: blue;">
		</div>
	    </form>
	</div>
</body>
</html>

<script>
	function checkdelete()
	{
		return confirm('Are You Sure You Want To Delete This Record?');
	}
</script>


<?php
if(isset($_POST['save']))
{
   
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);

   
    $query = "INSERT INTO `form` (emp_name, emp_gender, emp_email, emp_dept, emp_address) 
              VALUES ('$name', '$gender', '$email', '$department', '$address')";

    $data = mysqli_query($conn, $query);

    if($data)
    {
        echo "<script> alert('Data saved into Database!') </script>";
    }
    else
    {
        echo "<script> alert('Failed To Insert Data!') </script>";
    }
}
?>


<?php
    if(isset($_POST['delete']))
    {
    	$id = $_POST['search'];


    	$query = "DELETE FROM form WHERE id = '$id' ";
    	$data = mysqli_query($conn, $query);

    	if($data)
    	{
    		echo "<script> alert('Data Deleted Sucessfully!') </script>";
    	}
    	else
    	{
    		echo "<script> alert('Failed to Delete!') </script>";
    	}
    }
?>


<?php

if(isset($_POST['update']))
{
	$id       = mysqli_real_escape_string($conn, $_POST['search']);
	$name       = mysqli_real_escape_string($conn, $_POST['name']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "UPDATE form SET emp_name = '$name',emp_gender = '$gender',emp_email = '$email',emp_dept = '$department',emp_address = '$address' WHERE id = '$id'";


    $data = mysqli_query($conn, $query);

    if($data)
    {
        echo "<script> alert('Record Updated Sucessfully!') </script>";
    }
    else
    {
        echo "<script> alert('Fail To Update Record!') </script>";
    }
}
?>