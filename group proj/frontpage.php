<?php
   include 'config.php';
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['psw']);

      $sql = "SELECT user_id FROM Accounts WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myemail and $mypassword, table row must be 1 row

      if($count == 1) {

         $_SESSION['login_user'] = $myemail;

         header("location: notepad.html");
      }else {
         $error = "Your Login Name or Password is invalid";
         echo $error;
      }
   }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Study Buddy</title>
    <link href="frontPage.css" type="text/css" rel="stylesheet"/>

    <script type="text/javascript">
      function validateForm(){
        if(document.forms["SignUp"]["psw-repeat"].value != document.forms["SignUp"]["psw"].value){
            alert( "PASSWORDS DO NOT MATCH \n");
            return false;
        }

     }

    </script>

  </head>
  <style media="screen">
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
  <body>

    <button class= "log" onclick="document.getElementById('logIn').style.display='block'" style="width:auto;">Log In</button>
    <button class= "log" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>

    <div id="logIn" class="modal">

      <form method="post" class="modal-content animate">
        <div class="imgcontainer">
          <span onclick="document.getElementById('logIn').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <h1>Log In</h1>
        <p>Please enter email and password.</p>
        <hr>
        <div class="container">
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>

          <button type="submit">Log In</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('logIn').style.display='none'"
          class="cancelbtn">Cancel</button>
        </div>
      </form>
    </div>


  <div id="id01" class="modal">

    <form name = "SignUp" action = "signUp.php" method="post" class="modal-content animate" onsubmit="return validateForm();" >
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <div class="container">
        <label for="emailu"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="pss"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="pss-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <button type="submit">Sign Up</button>

      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>

      </div>
    </form>
  </div>

  <script>
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
