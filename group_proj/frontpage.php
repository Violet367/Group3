<?php
   include 'config.php'; /* Connects to the database */
   include 'helpers.php';
   session_start();

   if (isset($_SESSION['errors'])) {
     $errors = $_SESSION['errors'];
     unset($_SESSION['errors']);
   }

   if($_SERVER["REQUEST_METHOD"] == "POST") {  /* Inserts new account in database */
      // username and password sent from form
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['psw']);

      $sql = "SELECT user_id FROM Accounts WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myemail and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['login_user'] = $myemail;
         header("location: studybuddy.html");
      } else {
         $_SESSION['errors'] = "Your Login Name or Password is invalid";
         header("location: frontpage.php");
      }
   }


?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Study Buddy</title>
    <link href="frontPage.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.grey-red.min.css" />
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <style media="screen"> /* Background*/
      body {
        background-image: url("StudyBuddy.png");
        background-color: #cccccc;
        height: 500px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
      }
    </style>
    <!-- Script to check sign up form fields -->
    <script type="text/javascript">
      function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return !re.test(String(email).toLowerCase());
      }
      function validateForm(){
        if(document.forms["SignUp"]["psw-repeat"].value != document.forms["SignUp"]["psw"].value){
          $('.form-errors').text(" * Passwords do not match *");
          $('.form-errors').show();
          return false;
        } else if (validateEmail(document.forms["SignUp"]["email"].value)){
          $('.form-errors').text(" * Need to put in a valid email *");
          $('.form-errors').show();
          return false;
        }
      }
    </script>
  </head>

  <body>
    <div style="position:absolute;top:0;left:0;right:0;bottom:0;">
      <div style="width:300px;margin:0 auto;top:60%;position:relative;padding-left:20px;">
        <button class= "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="document.getElementById('logIn').style.display='block'" style="width: 120px;height:45px;background-color: #eee;text-transform:capitalize;font-size: 24px;margin-right: 20px;">Log In</button>
        <button class= "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="document.getElementById('id01').style.display='block'" style="width: 140px;height:45px;background-color: #eee;text-transform:capitalize;font-size: 24px;">Sign Up</button>
      </div>
    </div>

    <div id="logIn" class="modal">
      <div class="modal-content animate">
        <form method="post">
          <div class="closeModal" onclick="document.getElementById('logIn').style.display='none'" title="Close Modal">&times;</div>
          <div class="container" style="padding-bottom: 60px;">
            <h2 style="margin-top:0;">Log In</h2>
            <h5>Please enter email and password.</h5>
            <p class="form-errors"></p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <br/><br/>
            <button class="submitBtn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">Log In</button>
            <button class="cancelBtn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="document.getElementById('logIn').style.display='none'" style="margin-right: 10px;background-color: #fff;">Cancel</button>
          </div>
        </form>
      </div>
    </div>

    <div id="id01" class="modal">
      <div class="modal-content animate">
        <form name="SignUp" action="signUp.php" method="post" onsubmit="return validateForm();">
          <div class="closeModal" onclick="document.getElementById('id01').style.display='none'" title="Close Modal">&times;</div>

          <div class="container" style="padding-bottom: 60px;">
            <h2 style="margin-top:0;">Sign Up</h2>
            <h5>Please fill in this form to create an account.</h5>
            <p class="form-errors"></p>
            <hr>

            <label for="emailu"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="pss"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <label for="pss-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

            <br/><br/>
            <button class="submitBtn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">Sign Up</button>
            <button class="cancelBtn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="document.getElementById('id01').style.display='none'" style="margin-right: 10px;background-color: #fff;">Cancel</button>

          </div>

        </form>
      </div>
    </div>

    <div class="centered" style="visibility: hidden";>
    	<button class="btn btn-raised" onclick="$('.notification').toggleClass('active')">
    		toggle
    	</button>
    </div>

    <div id="notification" class="notification">
    	<div id="notification-text" class="snackbar-text">
    		<?php if (isset($errors)){echo $errors;} ?> <!--<a class="ripple rect" href="#cookies">learn more</a>-->
    	</div>
    	<div class="snackbar-close ripple" onclick="$('.notification').toggleClass('active')">
    		<div class="snackbar-text">
    			<span style="font-size:20px;position:relative;left:4px;bottom:1px;">&times;</span>
    		</div>
    	</div>
    </div>

    <script>
      $(document).ready(function(){
        if ($("#notification-text").text().trim() != ""){
          $("#notification").toggleClass("active");
        } else {
          $("#notification").removeClass("active");
        }
      })
      // --- SCRIPT TO CLOSE THE MODALS ---//
      // Get the modal
      var modal = document.getElementById('id01');
      var mod = document.getElementById('logIn');
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == mod) {
            mod.style.display = "none";
        }
      }
    </script>

  </body>
</html>
