<!DOCTYPE html>
	<?php
		#define variables and error messages
		$firstName = $lastName = $username = $password = $repeatPassword = $address1 = $address2 = "";
		$city = $state = $zipcode = $phoneNumber = $email = $gender = $maritalStatus = $dateOfBirth = "";
		$firstNameErr = $lastNameErr = $usernameErr = $passwordErr = $repeatPasswordErr = $address1Err = $address2Err = "";
		$cityErr = $stateErr = $zipcodeErr = $phoneNumberErr = $emailErr = $genderErr = $maritalStatusErr = $dateOfBirthErr = "";
		#define cookie names, which for clarity will be accessed the same way thoughout the domain.
		$usernameCookie = "usernameCookie";
		$firstNameCookie = "firstNameCookie";
		$lastNameCookie = "lastNameCookie";
		$address1Cookie = "address1Cookie";
		$address2Cookie = "address2Cookie";
		$cityCookie = "cityCookie";
		$stateCookie = "stateCookie";
		$zipcodeCookie = "zipcodeCookie";
		$emailCookie = "emailCookie";
		$dateOfBirthCookie = "dateOfBirthCookie";
		$phoneNumberCookie = "phoneNumberCookie";
			
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			#USERNAME: test for existence, then letters and numbers.
			$username = test_input($_POST["userName"]);
			if (empty($username)) {
				$usernameErr = "Username is required." . '<script>document.getElementById("username").style.border = "solid 1px red";</script>';
			} 
			else {
				if (!preg_match("/^[a-zA-Z0-9]{6,50}+$/", $username)) {
					$usernameErr = "Username must only contain letters and numbers.";	}
			}
			#PASSWORD: test for existence, then test for length and correct character set, then confirm each required character type 
			#has been used, then confirm the passwords match.  If the password is repeated but doesn't match, then
			#repeatPasswordErr is "passwords don't match", but if the passwords match but don't meet the character set requirements
			#just use "*" for repeatPasswordErr to avoid repetition. 
			$password = test_input($_POST["password"]);
			if (empty($password)) {
				$passwordErr = "Password is required.";
			} 
			else if (!preg_match("/^[a-zA-Z0-9!@#$%^&*]{8,50}+$/", $password)) {
				$passwordErr = "Password must be 8-50 characters and contain only letters, numbers and (!@#$%^&*) symbols.";	
			}
			else {
				if (!preg_match("/[a-z]/", $password) || 
				    !preg_match("/[A-Z]/", $password) ||
					!preg_match("/[0-9]/", $password) ||
					!preg_match("/[!@#$%^&*]/", $password) ) {
					$passwordErr = "Password must contain at least one capital and lowercase letter, symbol(!@#$%^&* allowed), and number.";	}
			}
			$repeatPassword = test_input($_POST["repeatPassword"]);
			if (empty($repeatPassword)) {
				$repeatPasswordErr = "Please repeat your password";
			} 
			else if (strcmp($password, $repeatPassword) != 0) {
				$repeatPasswordErr = "Passwords don't match";	
			}
			else {
				if (!empty($passwordErr) ) {
					$repeatPasswordErr = "**";	}
			}
			#NAMES and ADDRESS and CITY: check for existence, then for valid characters.  Allow letters, whitespace and '.' for names
			#and cities, and those in addition to numbers for addresses.
			$firstName = test_input($_POST["firstName"]);
			if (empty($firstName)) {
				$firstNameErr = "First Name is required";
			} 
			else {
				if (!preg_match("/^[a-zA-Z\. ]+$/", $firstName)) {
					$firstNameErr = "First name must only contain alphabetical characters and '.' (spaces allowed)."; }
			}
			$lastName = test_input($_POST["lastName"]);
			if (empty($lastName)) {
				$lastNameErr = "Last name is required.";
			} 
			else {
				if (!preg_match("/^[a-zA-Z\. ]+$/", $lastName)) {
					$lastNameErr = "Last name must only contain alphabetical characters and '.' (spaces allowed).";	}
			}
			$address1 = test_input($_POST["address1"]);
			if (empty($address1)) {
				$address1Err = "Address Line 1 is required.";
			} 
			else {
				if (!preg_match("/^[a-zA-Z0-9\. ]+$/", $address1)) {
					$address1Err = "Address must consist of letters, numbers, '.'s, and spaces.";	}
			}
			$address2 = test_input($_POST["address2"]);
			if (!empty($address2)) {
				if (!preg_match("/^[a-zA-Z0-9 ]+$/", $address2)) {
					$address2Err = "Address must consist of letters, numbers, and spaces.";	}
			}
			$city = test_input($_POST["city"]);
			if (empty($city)) {
					$cityErr = "City is required.";
			} 
			else {
				if (!preg_match("/^[a-zA-Z\. ]+$/", $city)) {
					$cityErr = "City must only contain alphabetical characters (spaces allowed).";	}
			}
			#ZIPCODE: check for existence, then length, then formatting.
			$zipcode = test_input($_POST["zipCode"]);
			if (empty($zipcode)) {
				$zipcodeErr = "Zip is required.";
			} 
			else if ( strlen($zipcode) == 5) {
				if (!preg_match("/^[0-9]+$/", $zipcode) )	{
					$zipcodeErr = "Zip must be all digits."; }
			}
			else if ( strlen($zipcode) == 10) {
				if (!preg_match("/^[0-9]{5}+\-+[0-9]{4}+$/", $zipcode) )	{
						$zipcodeErr = "Zip must be all digits in format ##### or #####-#####"; }	
			}
			else {
				$zipcodeErr = "Zipcode must be 5 or 9 digits";	
			}
			#STATE is a dropdown; just confirm a selection has been made.
			$state = test_input($_POST["state"]);
			if (empty($state)) {
				$stateErr = "State is required";
			}   
			#EMAIL: use library validation filter.
			$email = test_input($_POST["email"]);
			if (empty($email)) {
				$emailErr = "Email is required";
			} 
			else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	
					$emailErr = "Invalid email format";	}
			}
			#GENDER and MARITAL STATUS: just confirm a value has been selected. 
			if (!empty($_POST["gender"])) {
			$gender = test_input($_POST["gender"]); }
			if (empty($_POST["gender"])) {
				$genderErr = "Gender is required";
			}
			if (!empty($_POST["maritalStatus"])){
			$maritalStatus = test_input($_POST["maritalStatus"]); }
			if (empty($_POST["maritalStatus"])) {
				$maritalStatusErr = "Marital status is required";
			}
			
			#DATE OF BIRTH: check existence, then ##/##/#### format.  I have
			$dateOfBirth = test_input($_POST["dateOfBirth"]);
			if (empty($dateOfBirth)) {
				$dateOfBirthErr = "Date of birth is required.";
			}
			else if (strlen($dateOfBirth) == 10) {
				if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $dateOfBirth) ) {
					$dateOfBirthErr = "DOB must be in format ##/##/####."; }
			}
			else {
				$dateOfBirthErr = "DOB must be ten digits in format ##/##/####.";
			}
			
			#NOW FIX DOB FORMAT FOR SQL
			$dateOfBirth = substr($dateOfBirth,6) . "-" . substr($dateOfBirth,0,2) . "-" . substr($dateOfBirth,3,2);
			
			#PHONE NUMBER: check existence, then ###-###-#### format.
			$phoneNumber = test_input($_POST["phoneNumber"]);
			if (empty($phoneNumber)) {
				$phoneNumberErr = "Phone number is required";
			} 
			else if ( strlen($phoneNumber) == 12) {
				if (!preg_match("/^[0-9]{3}+\-+[0-9]{3}+\-+[0-9]{4}$/", $phoneNumber) )	{
					$phoneNumberErr = "Phone number must be all digits in format ###-###-####";}	
			}
			else {
						$phoneNumberErr = "Phone number must be 10 digits.";	
				}
				
			#Final validation before storing cookies and linking.  Test to see that the error strings are empty
			#and if so, set all the cookies and link to the confirmation page.
			if ( $usernameErr == "" && $passwordErr == "" && $repeatPasswordErr == "" && $firstNameErr == "" && $lastNameErr == "" && $address1Err == "" &&
				 $cityErr == "" && $stateErr == "" && $zipcodeErr == "" && $emailErr == "" && $dateOfBirthErr == "" && $phoneNumberErr == "")  {
				$server = "localhost";
				
				$conn = mysqli_connect($server, "root", "", "project");

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());}
				echo "Connected successfully";
				
				$sql = "INSERT INTO registration (userName, password, firstName, lastName, address1, address2, 
				city, state, zipCode, phone, email, gender, maritalStatus, dateOfBirth)
				VALUES ('$username', '$password', '$firstName', '$lastName', '$address1', '$address2', 
				'$city', '$state', '$zipcode', '$phoneNumber', '$email', '$gender', '$maritalStatus', '$dateOfBirth')";
				//Now that the data has been sent to the database, get the id (which the user doesn't input) and 
				//send that value to the confirmation page. 
				
				if ( mysqli_query($conn,$sql) ){
					echo "Successfully sent to server";
					$last_id = mysqli_insert_id($conn);
					header("Location:confirmation.php" . "?id=" . $last_id);
					exit;
				}
				else { echo "0 results";}
					
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
<html lang ="en">
	<head>
		<title>Join Our Enterprise</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="javascript.js"></script>
		<script>
		$( function() {
				$("#dateOfBirth").datepicker();
		});
		</script>
	</head>
	<body onload="setFocus()">
	<div class="container-fluid">
		<div id="topRow" class="row">
			<div id="header" class="col-xs-12">Register</div>
		</div>
		<div id="middleRow" class="row">
			<div id="menu" class="col-xs-12 col-sm-4 col-md-2">
				<p>
					<a href="home.html" id="navLink" target="_self">Home</a><br>
					<a href="registration.php" id="navLink" target="_self">Register</a>
				</p>
			</div>
			
			<form method="post" onsubmit="return validationScan()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="theForm" onreset="formReset(this);return false;">
			<p id="resetScript"></p>
			<div id="formField" class="col-xs-12 col-sm-8 col-md-5"> 
				<img src=king.png alt="Keep smiling they can still see you" width="200px" height="100px"><br>
				<label for="userName">Username:</label><span class="error"><?php echo $usernameErr;?></span><br>
				<input id="userName" type="text" name="userName" value="<?php echo $username;?>" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="password">Password:</label><span class="error"><?php echo $passwordErr;?></span><br>
				<input id="password" type="password" name="password" value="<?php echo $password;?>" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="repeatPassword">Repeat Password:</label><span class="error"><?php echo $repeatPasswordErr;?></span><br>
				<input id="repeatPassword" type="password" name="repeatPassword" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="firstName">First Name:</label><span class="error"><?php echo $firstNameErr;?></span><br>
				<input id="firstName" type="text" name="firstName" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="lastName">Last Name:</label><span class="error"><?php echo $lastNameErr;?></span><br>
				<input id="lastName" type="text" name="lastName" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="address1">Address:</label><span class="error"><?php echo $address1Err;?></span><br>
				<input id="address1" type="text" name="address1" maxLength="100" onkeypress="defaultFocus(this)"><br>
				<label for="address2">Address Line 2:</label><span class="error"> <?php echo $address2Err;?></span><br>
				<input id="address2" type="text" name="address2"  maxLength="100" onkeypress="defaultFocus(this)"><br>
				<label for="city">City:</label><span class="error"><?php echo $cityErr;?></span><br>
				<input id="city" type="text" name="city" maxLength="50" onkeypress="defaultFocus(this)"><br>
				<label for="state" >State</label><span class="error"><?php echo $stateErr;?></span><br>
				<select id="state" name="state" type="text" >
					<option value="">---</option>
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Conneticut</option>
					<option value="DE">Delaware</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KA">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>	
					<option value="MI">Michigan</option>						
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
					</select><br>
			</div> 
			<div id="formField" class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-5 col-md-offset-0">
				<label for="zipCode">Zipcode:</label><span class="error"><?php echo $zipcodeErr;?></span><br>
				<input id="zipCode" type="text" name="zipCode" placeholder="#####-####" onkeyup="formatZIP(this);" maxLength="10"><br>
				<label for="email">E-mail:</label><span class="error"><?php echo $emailErr;?></span><br>
				<input id="email" type="text" name="email"><br>			
				<label for="gender">Gender:</label> <span class="error"><?php echo $genderErr;?></span><br>
				<label for="female">Female</label>
				<input type="radio" id="female" name="gender" 
					<?php if (isset($gender) && $gender=="female") echo "checked";?>
					value="female"><br>		
				<label for="male">Male</label>
				<input type="radio" id="male" name="gender"
					<?php if (isset($gender) && $gender=="male") echo "checked";?> value="male"><br>
				<label for="maritalStatus">Marital Status:</label> <span class="error"><?php echo $maritalStatusErr;?></span><br>
				<label for="maritalStatus" >Single</label>
				<input type="radio" id="single" name="maritalStatus" 
					<?php if (isset($maritalStatus) && $maritalStatus=="single") echo "checked";?>
					value="single" onclick="toggleLink(1);"><p id="singleLink"></p>	
				<label for="maritalStatus">Married</label>
				<input type="radio" id="married" name="maritalStatus"
					<?php if (isset($maritalStatus) && $maritalStatus =="married") echo "checked";?>
					value="married" onchange="toggleLink(0);"><br>		
				<label for="dateOfBirth">Date of Birth</label><span class="error"><?php echo $dateOfBirthErr;?></span><br>
				<input id="dateOfBirth" type="text" name="dateOfBirth" onkeyup="formatDOB(this);" placeholder="MM/DD/YYYY" maxlength="10"><br>
				<label for="phoneNumber">Phone Number:</label><span class="error"><?php echo $phoneNumberErr;?></span><br>
				<input id="phoneNumber" type="text" name="phoneNumber" placeholder="###-###-####" onkeyup="formatPhone(this);" maxLength="12"><br>
				<input type="submit" name="submit" value="Submit">  
				<input type="reset" value="Reset"><!--onclick="resetFormFunc()"-->
			</div>
			
			</form>
		</div>
		<div class="row">
			<div id="footer" class="col-xs-12">
				<a href="https://github.com/christiannuckols" target="_blank">Contact</a> 
				<a href="https://github.com/christiannuckols" target="_blank">About Us</a> 
				<a href="https://github.com/christiannuckols" target="_blank">Help</a> 
			</div>
			
		</div>
	</div>	
	</body>
</html>