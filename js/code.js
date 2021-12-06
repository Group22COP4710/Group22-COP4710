var urlBase = "http://andregr.xyz/api";
var extension = 'php';

let userId;
let Name;
let usrType;

function doLogin()
{
	userId = 0;
	var email = document.getElementById("email").value;
	var Password = document.getElementById("password").value;
	
	document.getElementById("loginResult").innerHTML = "";

	const jsonPayload = JSON.stringify({
		'email': email,
		'Password': Password
	});

	var url = urlBase + '/login.' + extension;

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				var jsonObject = JSON.parse( xhr.responseText );
				userId = jsonObject.User_Id;
		
				if( userId < 1 )
				{		
					document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
					alert("Invalid Username/Password combination");
					return;
				}
		
				Name = jsonObject.name;
				usrType = jsonObject.User_Type;


				saveCookie();
				if (usrType == "Professor")
					window.location.href = homepage.php;
				else
					window.location.href = admin_homepage.php;
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}

function saveCookie()
{
	var minutes = 20;
	var date = new Date();
	date.setTime(date.getTime()+(minutes*60*1000));	
	document.cookie = "Name=" + Name + ",User_Id=" + userId + ",User_Type=" + usrType +";expires=" + date.toGMTString();
}

function readCookie()
{
	userId = -1;
	var data = document.cookie;
	var splits = data.split(",");
	for(var i = 0; i < splits.length; i++) 
	{
		var thisOne = splits[i].trim();
		var tokens = thisOne.split("=");
		if( tokens[0] == "Name" )
		{
			Name = tokens[1];
		}
		else if( tokens[0] == "User_Type" )
		{
			User_Type = tokens[1];
		}
		else if( tokens[0] == "User_Id" )
		{
			userId = parseInt( tokens[1].trim() );
		}
	}
	
	if( userId < 0 )
	{
		window.location.href = "index.html";
	}
	else
	{
		document.getElementById("userName").innerHTML = "Logged in as " + firstName + " " + lastName;
	}
}


