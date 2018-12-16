<?php
   include 'config.php'; /* Connects to the database */
   include 'helpers.php';
   session_start();
   include 'todoList.php';

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
          <a class="mdl-navigation__link" href="save.php" style="color:white;">
            Save <img src="images/save-button.png" width="20px" height="20px" style="position:relative;bottom:1px;margin-left: 10px;opacity: 0.7;" />
          </a>
          <a class="mdl-navigation__link" href="logOut.php" style="color:white;">
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
            <form method="POST" action="studybuddy.php" style="min-height: 60px;">
              <?php if (isset($errors) || $errors != "") { ?>
                <div style="color:red;font-size:14px;margin-top:4px;"><?php echo "$errors"; ?></div>
              <?php } ?>

              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" name="task" type="text" placeholder="Enter a task..">
              </div>

              <div id="addTaskBtnContainer">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name= "submit" class="">Add</button>
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
              <li class="<?php echo ($task_checked ? "checked" : ""); ?>" style="padding:0;font-size: 16px;">
                <a href="studybuddy.php?mark_task_completed=<?php echo $row['idToDo']; ?>" style="text-decoration:none;color:#333;">
                  <div style="height:100%;width:100%;padding: 10px 8px 10px 32px;">
                    <span style="margin-right: 10px;"><?php echo $i; ?></span>
                    <?php echo $row['name']; ?>
                  </div>
                </a>
                <a href="studybuddy.php?del_todo=<?php echo $row['idToDo']; ?>" class="closeTask">&times;</a>
              </li>
            <?php $i++; } ?>
          </ul>
        </div><!--Todo list-->

      </div>

      <div id="right"> <!--right side of page, notepad-->
        <div id="notesHeader">
          <ol id="myTabs">
            <button class="tablink" onclick="openNote('INST201', this, '#555')" id="defaultOpen">INST201</button>
            <button class="tablink" onclick="openNote('INST377', this, '#555')">INST377</button>
            <button class="tablink" onclick="openNote('INST466', this, '#555')">INST466</button>
          </ol>
          <div id="tabDIV" class="tablink">
            <input type="text" id="newTabInput" placeholder="New Tab...">
            <span onclick="newTabElement()" class="add">Add</span>
          </div>
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

    USER_ID: <?php echo get_user_id_from_email($conn); ?>
    <script src="studybuddy.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
  </body>
</html>
