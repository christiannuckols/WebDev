<!DOCTYPE html>
<!--  comments go in these deals
  -->
<html lang ="en">
	<head>
		<title>Bound together, eternally.</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="javascript.js"></script>
	</head>
	
	<body onload="setFocus()">
	<div class="container-fluid">
		<div id="topRow" class="row">
			<div id="header" class="col-xs-12">Confirmation</div>
		</div>
		<div id="middleRow" class="row">
			<div id="menu" class="col-xs-12 col-sm-4 col-md-2">
				<p>
					<a href="home.html" id="navLink" target="_self">Home</a><br>
					<a href="registration.php" id="navLink" target="_self">Register</a>
				</p>
			</div>
			<div id="formField" class="col-xs-12 col-sm-8 col-md-5">
			<h2>Account successfully created!</h2>
			<img src=congrads.png alt="I will never let you go again" width="250px" height="200px"><br>
			<i id="tinyText">Never, ever leave us. </i><br>
			<?php
				$last_id = $_REQUEST["id"];//get id from url
				$servername = "localhost";
				$conn = mysqli_connect($servername, "root", "", "project");
				// Check connection
				if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT DISTINCT userName, firstName, lastName, address1, address2, city, state, zipCode FROM registration
				WHERE id = '$last_id'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {echo "Username:<br>" . $row["userName"]. "<br>Name:<br>" . $row["firstName"]. " " . $row["lastName"]. "<br>";
					echo "Address:<br>" . $row["address1"]. "<br>"; 
						if($row["address2"]) {echo $row["address2"]. "<br>" . $row["city"]. ", " . $row["state"]. " " . $row["zipCode"]. "<br>";}
						else {echo  $row["city"]. ", " . $row["state"]. " " . $row["zipCode"]. "<br>";}
					}
				} else {
				echo "0 results";
					}
				mysqli_free_result($result);
				mysqli_close($conn);
			?>	
			</div> 
			<div id="formField" class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-5 col-md-offset-0">
			<p id="demo"></p>
			<?php
			
				$last_id = $_REQUEST["id"];//get id from url again
				$servername = "localhost";
				$conn2 = mysqli_connect($servername, "root", "", "project");
				if (!$conn2) {
				die("Connection failed: " . mysqli_connect_error());
				}
				$sqlPart2 = "SELECT email, phone, dateOfBirth FROM registration
				WHERE id = '$last_id'";
				
				$result2 = mysqli_query($conn2, $sqlPart2);
				if (mysqli_num_rows($result2) > 0) {
					while($row = mysqli_fetch_assoc($result2)) {echo "Email:<br>" . $row["email"]. "<br>Phone Number:<br>" . $row["phone"].  "<br>" . "Date of Birth:<br>" . $row["dateOfBirth"];}
				} else {
				echo "0 results";
					}
				mysqli_free_result($result2);
				mysqli_close($conn2);
			?>
			</div>
			</form>
		</div>
		<div class="row">
			<div id="footer" class="col-xs-12">
				<a href="https://www.youtube.com/watch?v=MJbTjBLEKBU" target="_blank">Contact</a> 
				<a href="http://theflatearthsociety.org/home/" target="_blank">About Us</a> 
				<a href="https://www.nintendo.com" target="_blank">Help</a> 
			</div>
			
		</div>
	</div>	
	</body>
</html>