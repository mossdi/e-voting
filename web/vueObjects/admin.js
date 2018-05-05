new Vue ({
    el: '#appAdmin',
    data: {
        nowSpeech: [],
        completedSpeech: [],
        speechUsersVoted: [],
        nowVoting: false,
        usersOnline: '0',
    },
    methods: {
        switchNow: function(id) {
            if (confirm('Начать новое выступление?')) {
                axios.post('/vue-data/switch-now', {
                    id: id
                }).then(response => {
                    if (response.data) {
                        alert('Начато выступление №' + response.data.sort_order + '\n\n' + 'Коллектив - ' + (response.data.collective).replace(/<.*?>/g, "") + '\n\n' + 'Тема - ' + (response.data.name).replace(/<.*?>/g, ""));
                    }
                }).catch(error => {
                    alert(error)
                });
            }
        },
        switchVoting: function(id) {
            if (confirm('Начать голосование?')) {
                axios.post('/vue-data/switch-voting', {
                    id: id
                }).then(response => {
                    if (response.data) {
                        alert('Начато голосование за коллектив - ' + (response.data.collective).replace(/<.*?>/g, "") + '\n\n' + 'Тема - ' + (response.data.name).replace(/<.*?>/g, ""));
                    }
                }).catch(error => {
                    alert(error)
                });
            }
        },
        switchEnd: function(id) {
            if (confirm('Завершить голосование?')) {
                axios.post('/vue-data/switch-end', {
                    id: id
                }).then(response => {
                    statisticReload();
                    if (response.data) {
                        timerStop();
                        alert('Завершено голосование за коллектив - ' + (response.data.collective).replace(/<.*?>/g, "") + '\n\n' + 'Тема - ' + (response.data.name).replace(/<.*?>/g, ""));
                    }
                }).catch(error => {
                    alert(error)
                });
            }
        },
        speechMarker: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_end) {
                return 'Завершено';
            } else {
                return this.nowSpeech.id == id ? 'V' : '';
            }
        },
        votingMarker: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_end) {
                return 'Завершено';
            } else {
                return (this.nowSpeech.id == id && this.nowSpeech.voting) ? 'V' : '';
            }
        },
        beginButtonDisabled: function() {
            return this.nowSpeech.voting == 1 ? true : false;
        },
        beginButton: function(id) {
            let isNow = this.nowSpeech.id == id;
            let isCompleted = this.completedSpeech[id] && this.completedSpeech[id].voting_end;
            return (!(isNow || isCompleted));
        },
        votingButton: function(id) {
            let isNow = this.nowSpeech.id == id;
            let isVoting = this.nowSpeech.voting;
            return  (isNow && !isVoting);
        },
        endButton: function(id) {
            let isNow = this.nowSpeech.id == id;
            let isVoting = this.nowSpeech.voting;
            return  (isNow && isVoting);
        },
        speechStart: function(id) {
            if (this.completedSpeech[id]) {
                let date = new Date(this.completedSpeech[id].speech_start * 1000);
                let time = {
                    hours:   ('0' + date.getHours()).substr(-2),
                    minutes: ('0' + date.getMinutes()).substr(-2),
                    seconds: ('0' + date.getSeconds()).substr(-2),
                };
                return time.hours + ':' + time.minutes + ':' + time.seconds;
            } else {
                return null;
            }
        },
        votingStart: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_start) {
                let date = new Date(this.completedSpeech[id].voting_start * 1000);
                let time = {
                    hours:   ('0' + date.getHours()).substr(-2),
                    minutes: ('0' + date.getMinutes()).substr(-2),
                    seconds: ('0' + date.getSeconds()).substr(-2),
                };
                return time.hours + ':' + time.minutes + ':' + time.seconds;
            } else {
                return null;
            }
        },
        speechEnd: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_end) {
                let date = new Date(this.completedSpeech[id].voting_end * 1000);
                let time = {
                    hours:   ('0' + date.getHours()).substr(-2),
                    minutes: ('0' + date.getMinutes()).substr(-2),
                    seconds: ('0' + date.getSeconds()).substr(-2),
                };
                return time.hours + ':' + time.minutes + ':' + time.seconds;
            } else {
                return null;
            }
        },
        speechInterval: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_start) {
                let speechTime = this.completedSpeech[id].voting_start - this.completedSpeech[id].speech_start;
                let time = {
                    hours:   ('0' + Math.floor(speechTime / 3600)).substr(-2),
                    minutes: ('0' + Math.floor(speechTime / 60)).substr(-2),
                    seconds: ('0' + speechTime % 60).substr(-2),
                };
                return time.hours + ':' + time.minutes + ':' + time.seconds;
            } else {
                return null;
            }
        },
        votingInterval: function(id) {
            if (this.completedSpeech[id] && this.completedSpeech[id].voting_end) {
                let votingTime = this.completedSpeech[id].voting_end - this.completedSpeech[id].voting_start;
                let time = {
                    hours:   ('0' + Math.floor(votingTime / 3600)).substr(-2),
                    minutes: ('0' + Math.floor(votingTime / 60)).substr(-2),
                    seconds: ('0' + votingTime % 60).substr(-2),
                };
                return time.hours + ':' + time.minutes + ':' + time.seconds;
            } else {
                return null;
            }
        },
        pushNowSpeechArray: function() {
            axios.post('/vue-data/now-speech').then(response => {
                this.$data.nowSpeech = response.data;
            }).catch(error => {
                alert(error)
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
                alert(error);
            });
        },
        getUsersVoted: function() {
            axios.post('/vue-data/get-users-voted').then(response => {
                let arr = [];
                if (response.data) {
                    response.data.forEach((element) => {
                        arr[element.speech_id] = element;
                    })
                }
                this.$data.speechUsersVoted = arr;
            })
        },
        getUsersOnline: function() {
            axios.post('/vue-data/get-users-online').then(response => {
                this.$data.usersOnline = response.data;
                usersOnline(this.$data.usersOnline)
            }).catch(error => {
                alert(error);
            })
        },
        checkVoting: function() {
            this.$data.nowVoting = !!(this.nowSpeech && this.nowSpeech.voting);
        },
        usersVoted: function(id) {
            return this.speechUsersVoted[id] ? this.speechUsersVoted[id].users : null;
        },
        listenMethods: function() {
            this.pushNowSpeechArray();
            this.pushCompletedSpeechArray();
            this.getUsersOnline();
            this.getUsersVoted();
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
        nowVoting: function (val) {
            if (val) {
                timerStart(this.$data.completedSpeech[this.$data.nowSpeech.id].voting_start);
            } else {
                timerStop();
            }
        },
        completedSpeech: function () {
            if (this.$data.nowSpeech) {
                this.checkVoting();
            }
        }
    },
    mounted() {
        this.pushNowSpeechArray();
        this.pushCompletedSpeechArray();
        this.getUsersOnline();
        this.getUsersVoted();
        this.startListen();
    },
    beforeDestroy () {
        this.stopListen();
    }
});
