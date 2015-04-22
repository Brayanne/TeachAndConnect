
function signUp(){
	var myDataRef = new Firebase('https://blistering-fire-5737.firebaseio.com/');
	ref.createUser({
	  email    : ,
	  password : 
	}, function(error, userData) {
	  if (error) {
	    console.log("Error creating user:", error);
	  } else {
	    console.log("Successfully created user account with uid:", userData.uid);
	  }
	});
}
function logIn(){
	var ref = new Firebase('https://blistering-fire-5737.firebaseio.com/');
	ref.authWithPassword({
	  email    : ,
	  password : 
	}, function(error, authData) {
	  if (error) {
	    console.log("Login Failed!", error);
	  } else {
	    console.log("Authenticated successfully with payload:", authData);
	  }
	},{remember: "sessionOnly"});
}