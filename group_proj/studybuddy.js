// notes
function openNote(noteName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(noteName).style.display = "block";
    elmnt.style.backgroundColor = color;
}
document.getElementById("defaultOpen").click();

var myNodelist = document.getElementsByTagName("button");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Create a new tab when clicking on the "Add" button
function newTabElement() {
  var button = document.createElement("button");
  var inputValue = document.getElementById("theInput").value;
  var t = document.createTextNode(inputValue);
  button.appendChild(t);
  if (inputValue === "") {
    alert("You must write something!");
  } else {
    document.getElementById("myTabs").appendChild(button);
  }
  document.getElementById("theInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  button.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}

// timerSetup ----------------------------------------

var templateStr = '\n\t<form>'+
                  '\n\t\t<label id="minLabel" for="min">'+
                           '<span>Minutes</span><br />'+
                  '\n\t\t  <input type="number" v-model="minutes" name="time_m" id="min" min="0" max="59" value="15">'+
                  '\n\t\t</label>'+
                  '\n\t\t<label id="secLabel" for="sec">'+
                           '<span>Seconds</span><br />'+
                  '\n\t\t\t<input type="number" v-model="secondes" name="time_s" id="sec" max="59" min="0">'+
                  '\n\t\t</label>'+
                  '\n\t\t<div id="timeBtnContainer"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="button" @click="sendTime">Set time</button></div>'+
                  '\n\t</form>'
var timerSetup = {
  template: templateStr,
  data: function data() {
    return {
      minutes: 15,
      secondes: 0
    };
  },
  methods: {
    sendTime: function sendTime() {
      this.$emit('set-time', { minutes: this.minutes, secondes: this.secondes });
    }
  }
};

var Timer = {
  template: '\n\t\t <div class="timer">{{ time | prettify }}</div>\n\t',
  props: ['time'],
  filters: {
    prettify: function prettify(value) {
      var data = value.split(':');
      var minutes = data[0];
      var secondes = data[1];
      if (minutes < 10) {
        minutes = "0" + minutes;
      }
      if (secondes < 10) {
        secondes = "0" + secondes;
      }
      return minutes + ":" + secondes;
    }
  }
};

var app = new Vue({
  el: "#app",
  components: {
    'timer-setup': timerSetup,
    'timer': Timer },
  data: {
    isRunning: false,
    minutes: 0,
    secondes: 0,
    time: 0,
    timer: null,
    sound: new Audio("http://s1download-universal-soundbank.com/wav/nudge.wav") },
  computed: {
    prettyTime: function prettyTime() {
      var time = this.time / 60;
      var minutes = parseInt(time);
      var secondes = Math.round((time - minutes) * 60);
      return minutes + ":" + secondes;
    }
  },
  methods: {
    start: function start() {
      var _this = this;
      this.isRunning = true;
      if (!this.timer) {
        this.timer = setInterval(function () {
          if (_this.time > 0) {
            _this.time--;
          } else {
            clearInterval(_this.timer);
            _this.sound.play();
            _this.reset();
          }
        }, 1000);
      }
    },
    stop: function stop() {
      this.isRunning = false;
      clearInterval(this.timer);
      this.timer = null;
    },
    reset: function reset() {
      this.stop();
      this.time = 0;
      this.secondes = 0;
      this.minutes = 0;
    },
    setTime: function setTime(payload) {
      this.time = payload.minutes * 60 + payload.secondes;
    }
  }
});

// todo -----------------------------------------------
// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newListElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("Input").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === "") {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("Input").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
