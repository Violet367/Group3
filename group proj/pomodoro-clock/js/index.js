Vue.component('app-header', {
  props: [
  'initWork',
  'initShortBreak',
  'initLongBreak',
  'initRound'],

  data: function data() {
    return {
      isSidebarOpen: false };

  },
  methods: {
    toggleSidebar: function toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    filterChange: function filterChange(data) {
      this.$emit('change', data);
    } },

  template: '#app-header',
  components: {
    'app-sidebar': {
      props: [
      'initWork',
      'initShortBreak',
      'isSidebarOpen'],

      methods: {
        reset: function reset() {
          this.$emit('reset');
        },
        handleChange: function handleChange(event) {
          var data = event.target.dataset.type || e.srcElement.dataset.type;
          var value = Number(event.target.value) || Number(event.srcElement.value);

          this.$emit('change', { data: data, value: value });
        } },

      template: '#app-sidebar' } } });




Vue.component('app-main', {
  props: [
  'isModalOpen',
  'isBreakTime',
  'minutes',
  'seconds'],

  methods: {
    closeModal: function closeModal() {
      this.$emit('close-modal');
    } },

  components: {
    'app-modal': {
      template: '#app-modal' } },


  template: '#app-main' });


Vue.component('app-footer', {
  props: [
  'isTimerActive'],

  methods: {
    toggleTimer: function toggleTimer() {
      this.$emit('toggle-timer');
    },
    reset: function reset() {
      this.$emit('reset');
    },
    toggleModal: function toggleModal() {
      this.$emit('toggle-modal');
    } },

  template: '#app-footer' });


var vm = new Vue({
  el: '#app',
  data: {
    // Settings
    initWork: 25,
    initShortBreak: 5,

    // App state
    isBreakTime: false,
    isTimerActive: false,
    minutes: 25,
    seconds: '00',
    timer: null,
    round: 0,

    // UI
    isModalOpen: false },

  methods: {

    toggleModal: function toggleModal() {
      this.isModalOpen = !this.isModalOpen;
    },

    resetSettings: function resetSettings() {
      this.initWork = 25;
      this.initShortBreak = 5;
      this.isBreakTime ? this.minutes = this.initShortBreak : this.minutes = this.initWork;
    },

    resetUI: function resetUI() {
      this.isBreakTime = false;
      this.isTimerActive = false;
      this.minutes = this.initWork;
      this.seconds = '00';
      clearInterval(this.timer);
    },

    toggleTimer: function toggleTimer() {
      var self = this;

      function countDown() {

        var seconds = Number(self.$data.seconds);
        var minutes = self.minutes;
        var isBreak = self.isBreakTime;

        if (seconds === 0) {
          if (minutes === 0) {// End of cycle => switch to break / work
            isBreak ? self.minutes = self.initWork : self.minutes = self.initShortBreak;
            self.isBreakTime = !self.isBreakTime;

          } else {// Remove minute + start counting down from 60 seconds again
            self.minutes--;
            self.seconds = '59';
          }
        } else {// Remove seconds + if less than 10 prepend 0
          seconds <= 10 ? self.seconds = '0' + (self.seconds - 1) : self.seconds = '' + (self.seconds - 1);
        }
      }

      // toggle timer
      self.isTimerActive ? clearInterval(self.timer) : self.timer = setInterval(countDown, 1000);
      self.isTimerActive = !self.isTimerActive;
    },

    handleChange: function handleChange(obj) {

      var data = obj.data;
      var value = obj.value;

      switch (data) {
        case "work":
          this.initWork = value;

          if (!this.isBreakTime) {
            this.minutes = value;
            this.seconds = '00';
          }

          break;
        case "short-break":
          this.initShortBreak = value;

          if (this.isBreakTime) {
            this.minutes = value;
            this.seconds = '00';
          }

          break;}

    } } });