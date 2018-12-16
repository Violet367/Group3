<?php
   include 'config.php'; /* Connects to the database */
   include 'helpers.php';
   session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Study Buddy </title>
    <link rel="stylesheet" href="studybuddy.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'></script>
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.grey-red.min.css" />
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
  </head>
  <body>
    <header class="" style=""><!-- d45046 -->
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title" style="margin-right: 50px;color:white;font-size:16px;">StudyBuddy</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
          <div class="mdl-navigation__link" style="color:white;margin-right:10px;">
            <img src="images/002-user.png" width="32px" height="32px" style="position:relative;bottom:1px;margin-right: 10px;opacity: 0.7;" />
            <?php echo $_SESSION['login_user']; ?>
          </div>
          <a class="mdl-navigation__link" href="save.php" style="color:white;">
            Save <img src="images/save-button.png" width="20px" height="20px" style="position:relative;bottom:1px;margin-left: 10px;opacity: 0.7;" />
          </a>
          <a class="mdl-navigation__link" href="logOut.php" style="color:white;">
            Log Out <img src="images/logout-button.png" width="20px" height="20px" style="position:relative;bottom:1px;margin-left: 10px;opacity: 0.7;" />
          </a>
        </nav>
      </div>
    </header>

    <div class="container" id="parent" style="padding: 0 25px;">
      <div id="left">

        <div id="timer"><!--timer-->
          <div id="app" v-cloak>
            <div style="font-size: 20px;font-weight: bold;">
              <img src="images/005-clock.png" width="20px" height="20px" style="position:relative;bottom:3px;margin-right: 5px;margin-left:5px ;opacity: 0.7;" />
              Timer
            </div>
            <timer-setup v-if="!time" @set-time="setTime"></timer-setup>
            <div v-else>
              <timer :time="prettyTime"></timer>
              <div id="timeBtnContainer">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" v-if="!isRunning" @click="start">Start</button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" v-if="isRunning" @click="stop">Stop</button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" @click="reset">Reset</button>
              </div>
            </div>
          </div>
        </div><!--timer-->

        <div id="todolist"> <!--Todo list-->
          <div id="myDIV">
            <h2>To Do List</h2>
            <input type="text" id="Input" placeholder="Enter a task...">
            <span onclick="newListElement()" class="addBtn">Add</span>
          </div>
          <ul id="myUL"></ul>
        </div><!--Todo list-->

      </div>

      <div id="right"> <!--right side of page, notepad-->
        <ol id="myTabs">
          <button class="tablink" onclick="openNote('INST201', this, '#555')" id="defaultOpen">INST201</button>
          <button class="tablink" onclick="openNote('INST377', this, '#555')">INST377</button>
          <button class="tablink" onclick="openNote('INST466', this, '#555')">INST466</button>
        </ol>
        <div id="tabDIV" class="tablink">
          <input type="text" id="theInput" placeholder="New Tab...">
          <span onclick="newTabElement()" class="add">Add</span>
        </div>
        <div id="INST201" class="tabcontent">
            <textarea class="notes" placeholder="Start typing..."></textarea>
        </div>
        <div id="INST377" class="tabcontent">
          <textarea class="notes" placeholder="Start typing..."></textarea>
        </div>
        <div id="INST466" class="tabcontent">
          <textarea class="notes" placeholder="Start typing..."></textarea>
        </div>
      </div><!--right side of page, notepad-->

    </div><!--parent-->
    <script src="studybuddy.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
  </body>
</html>
