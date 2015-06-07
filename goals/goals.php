<?php session_start();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
	include 'dbinfo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="final.css">
<script src="final.js"></script>

</head>
<title>Goals</title>
<body>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '814482898606958',
    xfbml      : true,
    version    : 'v2.3'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.  
      // Redirect user to fb login page.
      location.href='http://web.engr.oregonstate.edu/~grubba/cs361/fblogin.html';
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '814482898606958',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

  	<?php
        echo '<h1>Goals</h1>';
        echo '<h2>Add a new Goal</h2>';
        echo '<label>Goal name: <input type="text" id="name" name="goal_name"></label><br>';
        echo '<label>Goal description: <textarea id="desc" name="goal_desc"></textarea></label><br>';
        echo '<label>Goal to meet: <textarea id="meet" name="goal_meet"></textarea></label><br>';
        echo '<label>Reward: <textarea id="reward" name="goal_reward"></textarea></label><br>';
 		echo '<button onclick="addGoal()">Add Goal</button><br><br>';    
        echo '<div id="status"></div><br><br>';  	

        $mysqli = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);
        $q =  "SELECT name,description,end_goal,reward from goals";
        $select = $mysqli->query($q);
       
            if ($select->num_rows >0 )
            {

                echo "<table>";
                echo "<th>Goal Name</th><th>Description</th><th>Goal to Reach</th><th>Reward</th>";
                while ($row = $select->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['name'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['description'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['end_goal'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['reward'];
                    echo "</td>";
                    echo "</tr>";

                }
                
            }
?>
    <button onclick="FB.logout(); location.href='http://web.engr.oregonstate.edu/~grubba/cs361/fblogin.html';">Logout
    </button>
</body>
</html>

