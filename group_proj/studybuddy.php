<?php
   include 'config.php'; /* Connects to the database */
   include 'helpers.php';
   include 'todoList.php';
   include 'classes.php';
   include 'notepad.php';

   if (!isset($_SESSION['login_user'])){
     header("location: frontpage.php");
   }

   if (isset($_SESSION['errors'])) {
     $errors = $_SESSION['errors'];
     unset($_SESSION['errors']);
   }

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Study Buddy </title>
    <link rel="stylesheet" href="studybuddy.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link href="snackbar.css" type="text/css" rel="stylesheet"/>
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
        <span class="mdl-layout-title" style="margin-right: 50px;color:white;font-size:20px;font-weight:bold;">
          <img src="images/oldman.png" width="32px" height="32px" style="position:relative;bottom:1px;margin-right: 10px;" />
          <span style="position: relative;top:2px;">Study Buddy</span>
        </span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
          <div class="mdl-navigation__link" style="color:white;margin-right:10px;">
            <img src="images/002-user.png" width="32px" height="32px" style="position:relative;bottom:1px;margin-right: 10px;opacity: 0.7;" />
            <?php echo $_SESSION['login_user']; ?>

          </div>
          <a class="mdl-navigation__link" onclick="$('#saveNotesBtn').click();" style="color:white;cursor: pointer;">
            Save Notes <img src="images/save-button.png" width="20px" height="20px" style="position:relative;bottom:1px;margin-left: 10px;opacity: 0.7;" />
          </a>
          <a class="mdl-navigation__link" href="logOut.php" style="color:white;cursor: pointer;">
            Log Out <img src="images/logout-button.png" width="20px" height="20px" style="position:relative;bottom:1px;margin-left: 10px;opacity: 0.7;" />
          </a>
        </nav>
      </div>
    </header>
    <div style="height:25px;"></div>
    <div id="parent">
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

        <div id="todoList"> <!--Todo list-->
          <div id="todoListHeader">
            <div style="font-size: 20px;font-weight: bold;">
              <img src="images/006-files-and-folders.png" width="20px" height="20px" style="position:relative;bottom:3px;margin-right: 5px;opacity: 0.7;" />
              To Do List
            </div>
            <form method="POST" action="todoList.php" style="min-height: 60px;">
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" name="task" type="text" placeholder="Enter a task...">
              </div>

              <div id="addTaskBtnContainer">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name= "submit">Add</button>
              </div>
            </form>
          </div>

          <ul id="todoListItems">
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
              <?php
                $key_exists = array_key_exists($row['idToDo'], $_SESSION['completed_tasks']);
                $task_checked = FALSE;
                if ($key_exists){
                  $task_checked = $_SESSION['completed_tasks'][$row['idToDo']];
                }
              ?>
              <li class="<?php echo ($task_checked ? "checked" : ""); ?>" style="padding:0;font-size: 16px;overflow:hidden;">
                <a href="todoList.php?mark_task_completed=<?php echo $row['idToDo']; ?>" style="text-decoration:none;color:#333;">
                  <div style="height:100%;width:100%;padding: 10px 8px 10px 32px;">
                    <span style="margin-right: 10px;"><?php echo $i; ?></span>
                    <?php echo $row['name']; ?>
                  </div>
                </a>
                <a href="todoList.php?del_todo=<?php echo $row['idToDo']; ?>" class="closeTask" style="text-decoration: none;">
                  <span style="position:relative;bottom:2px;font-size:20px;font-weight:bold;">&times;</span>
                </a>
              </li>
            <?php $i++; } ?>
          </ul>
        </div><!--Todo list-->

      </div>

      <div id="right"> <!--right side of page, notepad,  mdl-button-accent-->

        <!-- Add a class -->
        <form method="POST" action="classes.php" style="min-height: 70px;position:relative;">

          <div class="mdl-textfield mdl-js-textfield" style="margin-left:20px;">
            <input class="mdl-textfield__input" name="class_name" type="text" placeholder="Add class name..."><!--  id="classInput" -->
          </div>
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit" style="position:absolute;top:15px;right:20px;">Add Class</button>

        </form>

        <div id="notesHeader" style="margin-bottom:10px;padding-left:20px;">
          <?php $i = 1; while ($row = mysqli_fetch_array($classes)) { ?>
              <button id="<?php echo $row['class_name']; ?>" class="<?php echo ($_SESSION['current_class'] == $row['class_name']) ? 'mdl-button--accent' : 'mdl-button--colored'; ?> tablink mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="margin-right:10px;position:relative;color:white;margin-bottom:10px;padding:0;">
                <a href="notepad.php?change_current_class=<?php echo $row['class_name']; ?>" style="text-decoration: none;">
                  <div style="color:white;padding: 0 40px 0 16px;"><?php echo $row['class_name']; ?></div>
                </a>
                <a href="classes.php?del_class=<?php echo $row['class_name']; ?>">
                  <div class="close">&times;</div>
                </a>
              </button>
              <!-- remember to put delete buttons in each of the tabs -->
          <?php $i++; } ?>
        </div>

        <!-- Save Notes for current class-->
        <form method="POST" action="notepad.php" style="min-height: 60px;">
          <input type="hidden" name="class_name" value="<?php if (isset($_SESSION['current_class'])){echo $_SESSION['current_class'];} ?>">
          <textarea class="notes" name="contents" placeholder="Start typing..."><?php if (isset($_SESSION['current_notes'])){echo $_SESSION['current_notes'];} ?></textarea>
          <button id="saveNotesBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit" style="visibility:hidden;">Save Notes</button>
        </form>

      </div><!--right side of page, notepad-->

    </div><!--parent-->

    <div id="notification" class="notification">
      <div id="notification-text" class="snackbar-text">
        <?php if (isset($errors) && $errors != "") { ?>
          <div style="color:red;"><?php echo "$errors"; ?></div>
        <?php } ?>
      </div>
      <div class="snackbar-close ripple" onclick="$('.notification').toggleClass('active')">
        <div class="snackbar-text">
          <span style="font-size:20px;position:relative;left:4px;bottom:1px;">&times;</span>
        </div>
      </div>
    </div>

    <script src="studybuddy.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
    <script>
      $(document).ready(function(){
        if ($("#notification-text").text().trim() != ""){
          $("#notification").toggleClass("active");
        } else {
          $("#notification").removeClass("active");
        }
      })
    </script>

  </body>
</html>
