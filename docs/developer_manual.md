# StudyBuddy
****
## Developer’s Manual

Team members: Violet Gooding (team lead), Kanika Taneja, Lina Abdo, Yasmin Ibrahim

### File Structure

In our group’s repository on Github, there is a folder labeled group_proj which contains all of our project files. Inside that folder, there are the original files for all the elements of our interface, and the one that combines them all together. The files for the first page one would see upon clicking on a link to StudyBuddy are called frontpage.php and frontpage.css. The background image featured on the front page is called StudyBuddy.png in our project folder. There is also a file for the sign-up page where users are directed after clicking the “sign-up” button on the front page called signup.php.

The page users are directed to after signing up or logging in to our interface is called studybuddy.html, which has code from notepad.html, todoList.html, and index.html (which is found in the folder labeled vue-js-timer). The accompanying external stylesheet studybuddy.css has combined CSS code from notepad.css, todoList.css, and style.css (also found in the css folder of the vue-js-timer folder). The file snackbar.css is the stylesheet that handles the design of the pop-ups that occur on the site. There are also php and javascript files called studybuddy.php and studybuddy.js that contribute to making StudyBuddy run smoothly. When a user is ready to log out, the files that make up the log out button and function are logOut.html and logOut.php. Should any issues arise, these files contain the entirety of the system’s make-up.
In our repository, there is also a folder call docs, which contains our documents that explain our project and what it is about. In this folder there are the developer_manual.md (which you are reading), and user_manual.md files. The README.md file is located outside of the group_proj and docs folders.

### Software/Libraries
The following technologies is included in the wed application. These links can be referenced in order for the frameworks/libraries can be updated automatically.

#### Vue.js  

````
https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js
````

#### Design Lite

````
https://code.getmdl.io/1.3.0/material.grey-red.min.css
````

#### AJAX

````
https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css
````
#### jQuery

````
https://code.jquery.com/jquery-3.3.1.min.js
````

### System Environment
StudyBuddy is compatible with MacOS as well as other PC operating systems. That being said, it works on the internet browsers Safari and Google Chrome. Our interface also runs on an Amazon AWS server(LINUX).

#### Logging into AWS server  

Copy and paste folloing code into the terminal to access the AWS server.
````
ssh inst377@<machine.address>.amazonaws.com
````
Then enter password.

#### Clone the repository
Copy and paste the following code into the AWS server at /var/www/html  
````
sudo git clone https://github.com/Violet367/Group3.git
````

Make sure to update repository as collaborators push new code onto the repository
````
sudo git pull
````

### Database Structure

<img src="https://github.com/Violet367/Group3/blob/master/group_proj/db.png?raw=true"/>


Show in the figure above is the database structure of StudyBuddy. The accounts tables stores the username and password of the unique accounts made on the sign-up page. Then retrieved during login-in for password verification. The ToDo and Notes table is dependent on the Accounts tables by the foreign key( user_id ) and saved at log-out. The notes table stores the name and contents on the note to its respective user account. The ToDo table saves the name of the task the user creates. Both the Note and ToDo tables contents are retrieved at log-in to restore the users last setting.

To copy the database on your local computer you would download the dumpfile in the repository located at **Group3/StudyBuddyDump.sql** then run on your local sql software.

#### Database connection
To connect to the database you can include the config.php file located in group_proj/config.php to your php files.
````
include 'config.php';
````
