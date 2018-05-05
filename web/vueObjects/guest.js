new Vue ({
    el: '#appGuest',
    data: {
        showError: true,
        completedSpeech: [],
        nowSpeech: null,
        nowVoting: false,
        speechConcluding: false,
        criterionShow: false,
    },
    methods: {
        pushNowSpeechArray: function() {
            axios.post('/vue-data/now-speech').then(response => {
                this.$data.nowSpeech = response.data;
                this.checkVoting();
            }).catch(error => {
                if (this.$data.showError) {
                    alert(error);
                }
            });
        },
        pushCompletedSpeechArray: function() {
            axios.post('/vue-data/completed-speech').then(response => {
                let arr = [];
                if (response.data) {
                    response.data.forEach((element) => {
                        arr[element.speech_id] = element;
                    });
                }
                this.$data.completedSpeech = arr;
            }).catch(error => {
                if (this.$data.showError) {
                    alert(error);
                }
            });
        },
        checkVoting: function() {
            this.$data.nowVoting = !!(this.nowSpeech && this.nowSpeech.voting);
        },
        checkComplete: function(id) {
            return !!(this.completedSpeech[id] && this.completedSpeech[id].voting_end);
        },
        checkConcluding: function() {
            axios.post('/vue-data/get-concluding-setting').then(response => {
                this.$data.speechConcluding = response.data;
                if (this.$data.speechConcluding) {
                    this.checkCriterionShow();
                }
            }).catch(error => {
                if (this.$data.showError) {
                    alert(error);
                }
            })
        },
        checkCriterionShow: function() {
            axios.post('/vue-data/get-criterion-show').then(response => {
                if (response.data) {
                    this.$data.criterionShow = response.data;
                    criterionTopLoad('/rating/criterion-top', response.data);
                    formShow();
                } else {
                    formHide();
                }
            }).catch(error => {
                if (this.$data.showError) {
                    alert(error);
                }
            })
        },
        loadingCriterionForm: function() {
            axios.post('/vue-data/check-form-visible', {
                speechID: this.$data.nowSpeech.id
            }).then(response => {
                if (response.data) {
                    formLoad('/rating/criterion-form', this.$data.nowSpeech.collective, null, false);
                    formShow();
                }
            });
        },
        setLastActivity: function() {
            axios.post('/vue-data/set-last-activity');
        },
        listenMethods: function() {
            this.pushNowSpeechArray();
            this.pushCompletedSpeechArray();
            this.setLastActivity();
            this.checkConcluding();
        },
        startListen: function() {
            this.stopListen();
            this.interval = window.setInterval(() => {
                this.listenMethods()
            }, 5000);
        },
        stopListen: function() {
            if (this.interval) {
                window.clearInterval(this.interval);
            }
        },
    },
    watch: {
        nowSpeech: function(val) {
            if (val) {
                if (!this.nowVoting) {
                    titleRewrite('Выступление')
                }
            } else {
                titleRewrite('Список номинантов')
            }
        },
        nowVoting: function(val) {
            if (val) {
                titleRewrite('Голосование')
                this.loadingCriterionForm();
            } else {
                formHide();
            }
        },
    },
    mounted() {
        this.pushNowSpeechArray();
        this.pushCompletedSpeechArray();
        this.setLastActivity();
        this.checkConcluding();
        this.startListen();
    },
    beforeDestroy () {
        this.stopListen();
    }
});
