function setFocus(){
	document.getElementById("username").focus();
}

function errorFocus(inputField) {
		inputField.style.border = "solid 1px red";
}	

function defaultFocus(inputField) {
		inputField.style.border = "1px solid blue !important";
}


function formReset(frm) {
	for(var i=0;i<frm.elements.length;i++)
	if(!(frm.elements[i].type && frm.elements[i].type == "submit") && !(frm.elements[i].type && frm.elements[i].type == "reset")){
	frm.elements[i].value = "";}
}

//VALIDATION FUNCTIONS
function validationScan() {
	var usernameIn = document.getElementById("userName");
	var passwordIn = document.getElementById("password");
	var repeatPasswordIn= document.getElementById("repeatPassword");
	var firstNameIn = document.getElementById("firstName");
	var lastNameIn = document.getElementById("lastName");
	var address1In = document.getElementById("address1");
	var address2In = document.getElementById("address2");
	var cityIn = document.getElementById("city");
	var stateIn = document.getElementById("state");
	var zipcodeIn = document.getElementById("zipCode");
	var emailIn = document.getElementById("email");
	var phoneNumberIn = document.getElementById("phoneNumber");
	var dateOfBirthIn = document.getElementById("dateOfBirth");
	
	var userRegEx = /^[a-zA-Z0-9]{6,50}$/;
	var passwordRegEx = /^[a-zA-Z0-9!@#$%^&]{8,50}$/;
	var nameRegEx = /^[a-zA-Z\.\s]{1,50}$/;
	var address1RegEx = /^[a-zA-Z0-9\.\s]{1,100}$/;
	var address2RegEx = /^[a-zA-Z0-9\.\s]{0,100}$/;
	var zipcodeFiveDigitRegEx = /^[0-9]{5}$/;
	var zipcodeNineDigitRegEx = /^[0-9]{5}\-[0-9]{4}$/;
	var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z\.]{2,4})+$/;
	var dateOfBirthRegEx = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
	var phoneNumberRegEx = /^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/;

	if ( userRegEx.test(usernameIn.value) == false)
	{
		alert("Username must only contain numbers or letters and be 6 - 50 characters long.");
		errorFocus( document.getElementById("username") );
		return false;
	}
	else if ( passwordRegEx.test(passwordIn.value) == false) {
		alert("Password must contain a capital letter, a lowercase letter, a number, and one of the following symbols: !@#$%^&");
		errorFocus(passwordIn);
		return false;
	}
	else if (passwordIn.value != repeatPasswordIn.value) {
		alert("Passwords don't match.");
		repeatPasswordIn.focus();
		errorFocus(repeatPasswordIn);
		return false;
	}
	else if (nameRegEx.test(firstNameIn.value) == false) {
		alert("First Name must be 1-50 characters and only contain letters, spaces, or '.'.");
		firstNameIn.focus();
		errorFocus(firstNameIn);
		return false;
	}
	else if (nameRegEx.test(lastNameIn.value) == false) {
		alert("Last Name must be 1-50 characters and only contain letters, spaces, or '.'.");
		lastNameIn.focus();
		errorFocus(lastNameIn);
		return false;
	}
	else if (address1RegEx.test(address1In.value) == false ) {
		alert("Address Line 1 must be 1-100 characters and contain only letters, numbers, '.', and spaces.");
		address1In.focus();
		errorFocus(address1In);
		return false;
	}
	else if (address2RegEx.test(address2In.value) == false ) {
		alert("Address Line 2 must be 0-100 characters and contain only letters, numbers, '.', and spaces.");
		address2In.focus();
		errorFocus(address2In);
		return false;
	}
	else if (nameRegEx.test(cityIn.value) == false) {
		alert("City must be 1-50 characters and only contain letters, spaces, or '.'.");
		cityIn.focus();
		errorFocus(cityIn);
		return false;
	}
	else if (stateIn.value == "") {
		alert("State must be selected");
		stateIn.focus();
		errorFocus(stateIn);
		return false;
	}
	else if (zipcodeFiveDigitRegEx.test(zipcodeIn.value) == false && zipcodeNineDigitRegEx.test(zipcodeIn.value) == false) {
		alert("Zip must be all digits in format ##### or #####-#####");
		zipcodeIn.focus();
		errorFocus(zipcodeIn);
		return false;
	}
	else if (emailRegEx.test(emailIn.value) == false) {
		alert("Email is required and must be no greater than 255 characters and have a valid email format.");
		emailIn.focus();
		errorFocus(emailIn);
		return false;
	}
	else if (buttonCheck() == false) { return false; }
	else if (dateOfBirthRegEx.test(dateOfBirthIn.value) == false) {
		alert("Date of birth is required and must be in format: MM-DD-YYYY.");
		dateOfBirthIn.focus();
		errorFocus(dateOfBirthIn);
		return false;
	}
	else if (phoneNumberRegEx.test(phoneNumberIn.value) == false) {
		alert("Phone number is required and must be in format: ###-###-####.");
		phoneNumberIn.focus();
		return false;
	}
	else if (dateOfBirthRegEx.test(dateOfBirthIn.value) == false) {
		alert("Date of birth is required and must be in format MM/DD/YYYY.");
		dateOfBirthIn.focus();
		return false;
	}
	else if ( legitDOB() == false ) { return false; } 
	else	{
		alert("Thanks for registering!");
		return true; 
	}
}

function buttonCheck() {
	var genderIn = document.getElementsByName("gender");
	var maritalStatusIn = document.getElementsByName("maritalStatus");
	
	if(!genderIn[0].checked && !genderIn[1].checked) {
		alert("Please select gender.");
		return false;
	}
	else if(!maritalStatusIn[0].checked && !maritalStatusIn[1].checked) {
		alert("Please select marriage status.");
		return false;
	}
	else 
		return true; 
}

function legitDOB() {
	var dobIn = document.getElementById("dateOfBirth");
	
	if ( /[^0-3]/.test(dobIn.value[3]) == true) {//If the fourth char ##/4# is not 0, 1, 2 or 3, the date is invalid
		alert("Invalid day field in date of birth.");
		errorFocus(dobIn);
		dobIn.focus();
		return false;
	}//If the month has 31 days....
	else if (dobIn.value[0] + dobIn.value[1] == "01"  || 
			dobIn.value[0] + dobIn.value[1] == "03"  || 
			dobIn.value[0] + dobIn.value[1] == "05"  ||
			dobIn.value[0] + dobIn.value[1] == "07"  || 
			dobIn.value[0] + dobIn.value[1] == "08"  || 
			dobIn.value[0] + dobIn.value[1] == "10"  || 
			dobIn.value[0] + dobIn.value[1] == "12"  ) {
			
			if (dobIn.value[3] == "3" && /[^0-1]/.test(dobIn.value[4]) ){
				alert("Invalid day field in date of birth.");
				errorFocus(dobIn);
				dobIn.focus();
				return false;
			}
			else { return true; }
	}//If the month has 30 days....
	else if (dobIn.value[0] + dobIn.value[1] == "04"  || 
				 dobIn.value[0] + dobIn.value[1] == "06"  || 
				 dobIn.value[0] + dobIn.value[1] == "09"  ||
				 dobIn.value[0] + dobIn.value[1] == "11"  ) {
			if (dobIn.value[3] == "3" && /[^0]/.test(dobIn.value[4])  ){
				alert("Invalid day field in date of birth.");
				dobIn.focus();
				errorFocus(dobIn);
				return false;
			} 
			else { return true; }
	}//if the month is February
	else if (dobIn.value[0] + dobIn.value[1] == "02" ) {
			if (dobIn.value[3] == "3"){
				alert("Invalid day field in date of birth.");
				dobIn.focus();
				errorFocus(dobIn);
				return false;
			}
			else if (dobIn.value[3] == "2" && /[^0-8]/.test(dobIn.value[4]) ){
				alert("Invalid day field in date of birth.");
				dobIn.focus();
				errorFocus(dobIn);
				return false;
			}
			else {return true;}
	}
	else {
		alert("Invalid month field in date of birth.");
		return false;
	} 	
}
//FORMATTING FUNCTIONS
function toggleLink(isSingle) {
	if (isSingle)
	{
		document.getElementById("singleLink").innerHTML = '<img src=single.jpg alt="Keep smiling they can still see you" width="60px" height="30px">';
	}
	else
		document.getElementById("singleLink").innerHTML = "";
	
}

function formatZIP(zipcode) {
	if (zipcode) {
		switch(zipcode.value.length) {
			case 1: 
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					break;
			case 2: 
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					break;
			case 3: 
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					break;	
			case 4: 
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					break;	
			case 5: 
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					break;
			case 6:
					zipcode.value = zipcode.value.replace(/[^0-9]/g, "");
					if (zipcode.value[5] != "-" && /[0-9]/.test(zipcode.value[5]) == true ) {
						zipcode.value = zipcode.value[0] + 
										zipcode.value[1] + 
										zipcode.value[2] + 
										zipcode.value[3] + 
										zipcode.value[4] + "-" +
										zipcode.value[5];
					}
					break;
			case 7:
					zipcode.value = zipcode.value.replace(/[^0-9\-]/g, "");
					if (zipcode.value[5] != "-" && /[0-9]/.test(zipcode.value[6]) == true ) {
						zipcode.value = zipcode.value[0] + 
										zipcode.value[1] + 
										zipcode.value[2] + 
										zipcode.value[3] + 
										zipcode.value[4] + "-" +
										zipcode.value[5] +
										zipcode.value[6];
										
					}
					break;
					
			case 8:
					zipcode.value = zipcode.value.replace(/[^0-9\-]/g, "");
					if (zipcode.value[5] != "-" && /[0-9]/.test(zipcode.value[7]) == true ) {
						zipcode.value = zipcode.value[0] + 
										zipcode.value[1] + 
										zipcode.value[2] + 
										zipcode.value[3] + 
										zipcode.value[4] + "-" +
										zipcode.value[5] +
										zipcode.value[6] +
										zipcode.value[7];
										
					}
					break;	
			case 9:
					zipcode.value = zipcode.value.replace(/[^0-9\-]/g, "");
					if (zipcode.value[5] != "-" && /[0-9]/.test(zipcode.value[8]) == true ) {
						zipcode.value = zipcode.value[0] + 
										zipcode.value[1] + 
										zipcode.value[2] + 
										zipcode.value[3] + 
										zipcode.value[4] + "-" +
										zipcode.value[5] +
										zipcode.value[6] +
										zipcode.value[7] +
										zipcode.value[8];
										
					}
					break;
			case 10:
					zipcode.value = zipcode.value.replace(/[^0-9\-]/g, "");
					if (zipcode.value[5] != "-" && /[0-9]/.test(zipcode.value[9]) == true ) {
						zipcode.value = zipcode.value[0] + 
										zipcode.value[1] + 
										zipcode.value[2] + 
										zipcode.value[3] + 
										zipcode.value[4] + "-" +
										zipcode.value[5] +
										zipcode.value[6] +
										zipcode.value[7] +
										zipcode.value[8] +
										zipcode.value[9];
										
					}		
			default: 
					break;
		}
	}
	
	
}
	
function formatPhone(phone) {
	
	if (phone) {
		switch(phone.value.length) {
			case 1: 
					phone.value = phone.value.replace(/[^0-9]/g, "");
					break;
			case 2: 
					phone.value = phone.value.replace(/[^0-9]/g, "");
					break;
			case 3: 
					phone.value = phone.value.replace(/[^0-9]/g, "");
					break;
			case 4: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[3] != "-" && /[0-9]/.test(phone.value[3]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + "-" +
									  phone.value[3];
					}
					break;
			case 5: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[3] != "-" && /[0-9]/.test(phone.value[4]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + "-" +
									  phone.value[3] +
									  phone.value[4];
					}
					break;
			case 6: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[3] != "-" && /[0-9]/.test(phone.value[5]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + "-" +
									  phone.value[3] +
									  phone.value[4] +
									  phone.value[5];
					}
					break;
			case 7: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					break;
			case 8: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[7] != "-" && /[0-9]/.test(phone.value[7]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + 
									  phone.value[3] +
									  phone.value[4] +
									  phone.value[5] + 
									  phone.value[6] + "-" +
									  phone.value[7];
								
					}
					break;
			case 9: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[7] != "-" && /[0-9]/.test(phone.value[8]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + 
									  phone.value[3] +
									  phone.value[4] +
									  phone.value[5] + 
									  phone.value[6] + "-" +
									  phone.value[7] +
									  phone.value[8];
								
					}
					break;	
			case 10: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[7] != "-" && /[0-9]/.test(phone.value[9]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + 
									  phone.value[3] +
									  phone.value[4] +
									  phone.value[5] + 
									  phone.value[6] + "-" +
									  phone.value[7] +
									  phone.value[8] +
									  phone.value[9];
								
					}
					break;
			case 11: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					if (phone.value[7] != "-" && /[0-9]/.test(phone.value[10]) == true ) {
						phone.value = phone.value[0] + 
									  phone.value[1] + 
									  phone.value[2] + 
									  phone.value[3] +
									  phone.value[4] +
									  phone.value[5] + 
									  phone.value[6] + "-" +
									  phone.value[7] +
									  phone.value[8] +
									  phone.value[9] +
									  phone.value[10];
								
					}
					break;
			case 12: 
					phone.value = phone.value.replace(/[^0-9\-]/g, "");
					break;				
			default:
					break;
		}
	}
}	
//This one works, but I took it off because when you use jquery to pick the date then try and replace
//the year with text, it's likely to trip up if you type too fast.  I
/*
function formatDOB(dob) {
	if (dob) {
		switch(dob.value.length) {
			case 1: 
					dob.value = dob.value.replace(/[^0-9]/g, "");
					break;
			case 2: 
					dob.value = dob.value.replace(/[^0-9]/g, "");
					break;
			case 3:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[2] != "/" && /[0-9]/.test(dob.value[2]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + "/" +
									dob.value[2] ;
					}
					break;
			case 4:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[2] != "/" && /[0-9]/.test(dob.value[3]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + "/" +
									dob.value[2] +
									dob.value[3];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					break;
			case 5:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					break;
			case 6:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[5] != "/" && /[0-9]/.test(dob.value[5]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + 
									dob.value[2] +
									dob.value[3] +
									dob.value[4] + "/" +
									dob.value[5];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					break;
			case 7:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[5] != "/" && /[0-9]/.test(dob.value[6]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + 
									dob.value[2] +
									dob.value[3] +
									dob.value[4] + "/" +
									dob.value[5] +
									dob.value[6];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					if ( /[^0-9]/.test(dob.value[6]) ) { dob.value = dob.value.replace(dob.value[6], ""); }
					break;
			case 8:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[5] != "/" && /[0-9]/.test(dob.value[7]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + 
									dob.value[2] +
									dob.value[3] +
									dob.value[4] + "/" +
									dob.value[5] +
									dob.value[6] +
									dob.value[7];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					if ( /[^0-9]/.test(dob.value[6]) ) { dob.value = dob.value.replace(dob.value[6], ""); }
					if ( /[^0-9]/.test(dob.value[7]) ) { dob.value = dob.value.replace(dob.value[7], ""); }
					break;
			case 9:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[5] != "/" && /[0-9]/.test(dob.value[8]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + 
									dob.value[2] +
									dob.value[3] +
									dob.value[4] + "/" +
									dob.value[5] +
									dob.value[6] +
									dob.value[7] +
									dob.value[8];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					if ( /[^0-9]/.test(dob.value[6]) ) { dob.value = dob.value.replace(dob.value[6], ""); }
					if ( /[^0-9]/.test(dob.value[7]) ) { dob.value = dob.value.replace(dob.value[7], ""); }
					if ( /[^0-9]/.test(dob.value[8]) ) { dob.value = dob.value.replace(dob.value[8], ""); }
					break;
			case 10:
					dob.value = dob.value.replace(/[^0-9\/]/g, "");
					if (dob.value[5] != "/" && /[0-9]/.test(dob.value[9]) == true ) {
						dob.value = dob.value[0] + 
									dob.value[1] + 
									dob.value[2] +
									dob.value[3] +
									dob.value[4] + "/" +
									dob.value[5] +
									dob.value[6] +
									dob.value[7] +
									dob.value[8] +
									dob.value[9];
										
					}
					if ( /[^0-9]/.test(dob.value[0]) ) { dob.value = dob.value.replace(dob.value[0], ""); }
					if ( /[^0-9]/.test(dob.value[1]) ) { dob.value = dob.value.replace(dob.value[1], ""); }
					if ( /[^0-9]/.test(dob.value[3]) ) { dob.value = dob.value.replace(dob.value[3], ""); }
					if ( /[^0-9]/.test(dob.value[4]) ) { dob.value = dob.value.replace(dob.value[4], ""); }
					if ( /[^0-9]/.test(dob.value[6]) ) { dob.value = dob.value.replace(dob.value[6], ""); }
					if ( /[^0-9]/.test(dob.value[7]) ) { dob.value = dob.value.replace(dob.value[7], ""); }
					if ( /[^0-9]/.test(dob.value[8]) ) { dob.value = dob.value.replace(dob.value[8], ""); }
					if ( /[^0-9]/.test(dob.value[9]) ) { dob.value = dob.value.replace(dob.value[9], ""); }
					break;
			default:
					break;
		}
	}
}
*/



