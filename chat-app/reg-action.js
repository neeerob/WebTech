function isValid(register){
	const userName = register.userName.value;
	const password = register.password.value;
	const email = register.email.value;

	if(userName === "" || password === "" || email === ""|| password.length < 8){
		if(userName === ""){

			document.getElementById("errorMsgUser").innerHTML = "Please provide username!";
		}
		if(password === ""){

			document.getElementById("errorMsgPass").innerHTML = "Please provide Password!";
		}
		if(password.length < 8){
			document.getElementById("errorMsgPass").innerHTML = "Password must be at least 8 cherecter!";
		}
		if(email === ""){

			document.getElementById("errorMsgEmail").innerHTML = "Please provide email!";
		}

		return false;
	}
	else{
		return true;
	}

}
