
var turl = "http://web.engr.oregonstate.edu/~grubba/cs361/goals/data.php";
function addGoal()
{
	var error_area = document.getElementById("status");
	error_area.innerHTML = "";
		var elem = document.createElement("div");
		var uid = 1; // change based on verification code
        var name = document.getElementById("name").value;
   		var description = document.getElementById("desc").value;
   		var endgoal = document.getElementById("meet").value;		
   		var reward = document.getElementById("reward").value;		        
        var valid = true;
		if (name == "" || description == "" || endgoal == "")
		{
		    var elem = document.createElement("div");
		    var content_html = "<div class='error'>You must enter a name, description, reward, and goal to meet!</div>";	
		    elem.id = "errors";
		    elem.innerHTML = content_html;
		    error_area.appendChild(elem);
		    valid = false;
		}
		
		if (valid)
		{
			var httpRequest = new XMLHttpRequest();
			httpRequest.open('POST', turl, true);
			var params = "action=addGoal&name="+name+"&desc="+description+"&reward="+reward+"&endgoal="+endgoal+"&uid="+uid;
			httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			httpRequest.send(params);	
            console.log(params)
			httpRequest.onreadystatechange = function()
			{
				if(httpRequest.readyState == 4)
				{
					if(httpRequest.status == 200)
					{
						console.log("All good!");
						console.log(httpRequest.responseText);
						var response = httpRequest.responseText;
						if(response == "Duplicate")
						{
							document.getElementById("status").innerHTML = name+" already exists!";
						}
						else if (response == "Success")
						{
							document.getElementById("status").innerHTML = name+ " has been added!";

						}
					}
					else
					{
						console.log(httpRequest.responseText);
						console.log("All bad!");
					}
				}
			};

		}

}


