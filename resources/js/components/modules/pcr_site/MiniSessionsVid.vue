<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-ms-vid">

            <section class="page-header">
                <div v-if="miniSess.length < 1" class="page-ms-vid-header">
                    <div class="pcr-page-title font-weight-bold">Mini-Sessions</div>
                    <div class="pcr-page-subtitle">Philippine College of Radiology Annual Convention 2021</div>
                </div>
                <div v-else class="page-ms-vid-header text-center">
                    <div class="pcr-page-title font-weight-bold">{{ miniSess.topic }}</div>
                    <div class="pcr-page-subtitle">Start Date: {{ miniSess.start_time | moment }}</div>
                    <!--<el-button :disabled="miniSessDateCheck(miniSess.start_time)" class="join-sess-btn mt-3 mb-5" @click="joinMiniSess(miniSess.join_url)" type="default" icon="el-icon-video-play" round>Join Mini-Session</el-button>-->
                </div>
            </section>
            <!-- Main content -->
            <section class="content content-80">
                <div class="box">
                    <div class="sec-sessvid-buttons mb-5">

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <el-button @click="$router.push('/mini-sessions')" type="warning" icon="el-icon-back">Mini-Sessions</el-button>
                            </div>
                            <!-- <div class="col-sm-6 col-md-3">
                                <el-button type="info" round>Register</el-button>
                                <el-button type="primary" round>Send Info</el-button>
                            </div> -->
                        </div>
                    </div>

                    <div class="sec-sessvid-desc mb-5">
                        <h4 class="mb-4">MINI-SESSION DESCRIPTION</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <!-- <p v-if="miniSess">{{ miniSess.description }}</p> -->
                                <div v-html="miniSess.description"></div>
                            </div>
                        </div>
                    </div>

                    <div class="sec-sessvid-speak mb-5">
                        <h4 class="mb-4">MINI-SESSION SPONSOR</h4>
                        <div class="row" >
                            <div class="col-sm-12 col-md-2" v-if="miniSess.sponsor">
                                <img :src="getImageSrc(miniSess.sponsor.logo_file)" />
                            </div>
                            <div class="col-sm-12 col-md-10" v-if="miniSess.sponsor">
                                <p>{{ miniSess.sponsor.description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="sec-sessvid-mat mb-5">
                        <h4 class="mb-4">MINI-SESSION MATERIALS</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-4" v-for="material in materials" :key="material.id">
                                <div class="sess-vid-mat">
                                    <a :href="getMatSrc(material.file_path)" target="_blank">
                                    <span class="material-icons">picture_as_pdf</span>
                                    <span class="sess-mat-name">{{ material.file_name }}</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>


            <section class="page-home-sponsors text-center">
              <div class="container text-center">
                <h3>PLATINUM SPONSORS</h3>
                <div class="align-items-center spons-plat-row">
                  <div class="spons-logo-box text-center spons-fuji">
                    <img src="/images/layout/spons_fuji.png" style="max-width:240px;" />
                  </div>
                  <div class="spons-logo-box text-center spons-npk">
                    <img src="/images/layout/spons_npk.png" />
                  </div>
                  <div class="spons-logo-box text-center spons-bayer">
                    <img src="/images/layout/spons_bayer.png" />
                  </div>
                  <div class="spons-logo-box text-center spons-elan">
                    <img src="/images/layout/spons_elan_vita.png" />
                  </div>
                </div>
                <div class="align-items-center spons-gold-row mt-2">
                  <h4>GOLD SPONSORS</h4>
                  <div class="spons-logo-box text-center spons-guerbet">
                    <img src="/images/layout/spons_guerbet.png" />
                  </div>
                  <div class="spons-logo-box text-center">
                    <img src="/images/layout/spons_ge.png" />
                  </div>
                </div>
                <div class="align-items-center spons-silver-row mt-2">
                  <h5>SILVER SPONSORS</h5>
                  <div class="spons-logo-box text-center">
                    <img src="/images/layout/spons_bullseye.png" />
                  </div>
                  <div class="spons-logo-box text-center spons-anke">
                    <img src="/images/layout/spons_anke.png" />
                  </div>
                  <div class="spons-logo-box text-center spons-lifetrack">
                    <img src="/images/layout/spons_lifetrack.png" />
                  </div>
                </div>
                <div class="align-items-center spons-bronze-row mt-2">
                  <h6>BRONZE SPONSORS</h6>
                  <div class="spons-logo-box text-center">
                    <img src="/images/layout/spons_siemens.png" />
                  </div>

                </div>
              </div>
            </section>



                    <div class="row sec-sessvid-sched">

                        <div class="col-sm-12">

                            <div class="mini-sess-schedule">
                                <h4 class="mb-4">SCHEDULE</h4>
                                            <!--<div class="row sched-heading mt-5 font-weight-bold">
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">Time</p>
                                                </div>
                                                <div class="col-md-10 sched-details">
                                                    Agenda
                                                </div>
                                            </div> -->
                                            <div v-for="session in allSessSorted" :key="session.id">
                                            <div class="row sched-entry" v-if="checkIfNotMe(session.id)">
                                                <!--<div class="col-md-12 sched-date">
                                                    <div class="sched-date-text">
                                                        <p>8:30</p>
                                                        <p>Sunday, 10th Jan</p>
                                                    </div>
                                                </div>-->
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">{{ session.start_time | momentDate }}</p>
                                                    <p class="sched-time-text">{{ session.start_time | momentTime }}</p>
                                                </div>
                                                <div class="col-md-8 sched-details">
                                                    <div class="sched-details-heading">
                                                        <h3>{{ session.topic }}</h3>
                                                        <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                    </div>
                                                    <div class="sched-details-event">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div v-html="session.description"></div>
                                                            </div>                                                            
                                                            <div class="col-md-12 mt-2">
                                                                <div class="sched-speakers mb-2">
                                                                    <img :src="getImageSrc(session.sponsor.logo_file)" />
                                                                    <span class="ml-3">Sponsor: {{ session.sponsor.name }} </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 sched-link mini-sess-btn-col">
                                                    <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                    <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                    <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                                </div>
                                            </div>
                                            </div>
                                            <!--<div class="row sched-entry sched-break">
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">9:30</p>
                                                    <p class="sched-time-text time-to">9:40</p>
                                                </div>
                                                <div class="col-md-10 sched-details">
                                                    <div class="sched-details-heading">
                                                        <div class="sched-details-title mb-2">Break Time</div>
                                                        <div class="sched-details-subtitle mb-2">Channel 1</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row sched-entry">

                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">9:40</p>
                                                    <p class="sched-time-text time-to">10:40</p>
                                                </div>
                                                <div class="col-md-8 sched-details">
                                                    <div class="sched-details-heading">
                                                        <el-button @click="$router.push('/')" type="primary" round>Room 1B</el-button>
                                                    </div>
                                                    <div class="sched-details-event">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="sched-speakers mb-2">
                                                                    <img src="/images/layout/speak-vilgrain.png" />
                                                                    <span class="ml-3">Speaker Name</span>
                                                                </div>
                                                                <div class="sched-speakers mb-2">
                                                                    <img src="/images/layout/speak-vilgrain.png" />
                                                                    <span class="ml-3">Speaker Name</span>
                                                                </div>
                                                                <div class="sched-speakers mb-2">
                                                                    <img src="/images/layout/speak-vilgrain.png" />
                                                                    <span class="ml-3">Speaker Name</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <p>Brain Vascular Anatomy: What Should We Know?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 sched-link">
                                                    <el-button class="font-weight-bold" @click="$router.push('/')" type="text" round>
                                                        Go to Session
                                                        <i class="ti-arrow-circle-right"></i>
                                                    </el-button>
                                                </div>
                                            </div>-->

                            </div>
                        </div>
                        <!--  END OF SPONSORS CONTENT -->

                    </div>
                </div>
            </section>
            <!-- /.content -->


        </div>
    </transition>
</template>

<script>
import moment from 'moment'

  export default {
    name: 'Platinum-Sponsor',
    data () {
        return {
            session_id: this.$route.query.id,
            token: this.$cookies.get('token'),
            user_role: this.$cookies.get('user_role'),
            reg_id: this.$cookies.get('reg_id'),
            miniSess: [],
            materials: [],
            allSess: [],
            currentURL: window.location.origin + '/',
        }
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM DD YYYY, h:mm a')
        },
        momentDate: function (date) {
            return moment(date).format('MMM DD YYYY')
        },
        momentTime: function (date) {
            return moment(date).format('h:mm a')
        }
    },
    computed: {
        allSessSorted() {
            return this.allSess.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        }
    },
    methods: {
        getMiniSess() {
            axios.get(`/api/minisession/session/${this.session_id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.miniSess = res.data
                    console.log(this.miniSess)
                }
            })
            .catch(err => {
                console.log(err);
            })
        },
        getMiniSessMaterials() {
                axios.get(`/api/minisession/materials/session/${this.session_id}`, {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(res => {
                    if(res.data) {
                        this.materials = res.data
                        console.log(this.materials)
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        getImageSrc(img) {
            if (img) {
                var image = img.replace('public', 'storage')
                var image_src = this.currentURL + image
                return image_src
            }
        },
        getAllSessions() {
            axios.get(`/api/minisession/rooms`, {
            headers: { Authorization: "Bearer " + this.token }
            })
                .then(res => {
                    if(res.data) {
                        this.allSess = res.data
                        console.log(res.data)
                    }
            })
            .catch(err => {
            console.log(err);
            })
        },

        regSess(id) {
            console.log(id)
            console.log(this.reg_id)

            axios.post(`/api/minisession/attendee/register`, {
                session_id: id,
                reg_id: this.reg_id},
                {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
            this.$message.success('You have successfully registered for this mini-session.')
            console.log(response)
            })
            .catch(error => {
                console.log(error.response)
                if (error.response.data.message === 'user already registered for mini session') {
                this.$message({
                    message: 'You are already registered for this mini-session.',
                    type: 'error',
                    duration: 10000
                })
                } else if (error.response.data.message === 'mini session already full') {
                this.$message({
                    message: 'There are no more available slots for this mini-session.',
                    type: 'error',
                    duration: 10000
                })
                }
            });
        },
        gotoMiniSessVid(id) {
            location.href='/mini-sessions-video?id=' + id
            // axios.get(`/api/minisession/register/exists/${id}/${this.reg_id}`, {
            //     headers: { Authorization: "Bearer " + this.token }
            // })
            // .then(response => {
            // console.log(response)
            //     if (response.data.message === 'user not yet registered') {
            //     this.$message({
            //         message: 'You must register first before you can enter the Mini-Session Page.',
            //         type: 'error',
            //         duration: 10000
            //     })
            //     }
            // })
            // .catch(error => {
            //     if (error.response.data.message === 'user already registered') {
            //         location.href='/mini-sessions-video?id=' + id

            //     }
            // });
        },
        joinMiniSess(url) {
            // axios.get(`/api/getdatetime`, {
            //    headers: { Authorization: "Bearer " + this.token }
            //})
            //.then(response => {

            //    var date = response.data.date | moment
            //    console.log(date)
            //})
            //.catch(error => {
            //    console.log(error.response)
            //});

            var target = '_blank'
            window.open(url, target)
        },
        joinMiniSessVid(id, url) {

            axios.get(`/api/minisession/register/exists/${id}/${this.reg_id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
            console.log(response)
                if (response.data.message === 'user not yet registered') {
                this.$message({
                    message: 'You must register first before you can join this Mini-Session.',
                    type: 'error',
                    duration: 10000
                })
                }
            })
            .catch(error => {
                if (error.response.data.message === 'user already registered') {
                var target = '_blank'
                window.open(url, target)
                }
            });
        },
        miniSessDateCheck(date) {
            return false
            // var sessDate = new Date(date)
            // var nowDate = Date.now()
            //if (nowDate < sessDate) {
            //    return true
            //} else {
            //    return false
            //}
        },
        getMatSrc(img) {
            if (img) {
                var image = img.replace('public', 'storage')
                var image_src = this.currentURL + image
                return image_src
            }
        },
        checkIfNotMe(id) {
            if (id == this.session_id) {
                return false
            } else {
                return true
            }
        },
        checkMemberLoginStatus() {
            if (this.token) {
            console.log('logged in')
            } else {
            location.href='/login'
            }
        }

    },
	mounted() {
        this.getMiniSess()
        this.getMiniSessMaterials()
        this.getAllSessions()
	},
    created() {
      this.checkMemberLoginStatus()
    }
  }
</script>

<style>
    .page-ms-vid .page-header {
        padding-top:80px;
        margin-top:0;
    }
    .page-header .page-ms-vid-header {
        background-image:url(/images/layout/page-head-bg-1.png);
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;
        min-height:160px;
    }
    .pcr-page-title,
    .pcr-page-subtitle {
        width:100%;
        text-align: center;
        color:#fff;
    }
    .pcr-page-title {
        font-size:24px;
        padding-top:50px;
    }
    .pcr-page-subtitle {
        font-size:18px;
    }

    .spons-sched-tabs .el-tabs__item {
        border:1px solid #0174cc;
        border-left:none;
    }
    .spons-sched-tabs #first {
        border-left:1px solid #0174cc;
    }
    .spons-sched-tabs .el-tabs__item.is-active,
    .spons-sched-tabs .el-tabs__item:hover {
        background-color:#0174cc;
        color:#fff;
    }
    .spons-sched-tabs .el-tabs__item {
        padding: 0 50px!important;
    }
    .spons-sched-tabs .el-tabs__active-bar,
    .spons-sched-tabs .el-tabs__nav-wrap::after {
        display: none;
    }
    .sched-heading .sched-time {
        border-right:2px solid #8a8a8a;
    }
    .sched-time {
        border-right:2px solid #d5d5d5;
    }
    .sched-entry {
        padding:20px 0;
    }
    .sched-break {
        background:#f5f5f5;
        margin:20px 0;
    }
    .sched-date-text {
        padding:10px 20px;
    }
    .sched-date p {
        margin:0 0 5px;
    }
    .sched-time-text {
        margin:0 0 0 20px;
    }
    .sched-time-text.time-to {
        font-weight:bold;
    }
    .sched-details-heading button {
        background:#ff642b;
        border:none;
    }
    .sched-details-title {
        color:#0174cc;
        font-weight:bold;
    }
    .sched-details-event {
        margin:20px 0;
    }
    .mini-sess-schedule .sched-details-event img {
        max-width:50px;
        border-radius:0px;
    }


	@media only screen and (max-width: 768px)  {
        .page-ms-vid .page-header {
            padding:120px 0 0;
            margin-top:0;
            margin-bottom:0!important;
            background-image:url(/images/booth/booth-bg.png);
            background-repeat:no-repeat;
            background-position: center;
        }
    }

.sec-sessvid-speak img {
    width:100%;
}
.sess-vid-mat {
    padding: 20px 0;
    border-bottom:1px solid #dadada;
}
    .sess-vid-mat .material-icons {
        color:#dc1d00;
        margin-right:10px;
        font-size:1.1rem;
    }
    .sess-vid-mat .sess-mat-name {
        font-weight:bold;
        font-size:1.1rem;
    }

.sec-sessvid-spons {
    padding:30px;
    margin-right:auto;
    margin-left:auto;
    background-color:#f2f2f2;
}
    .sec-sessvid-spons img {
        max-height:120px;
        max-width:100%;
        display:inline-block;
    }
    .sec-sessvid-spons .spons-gold img {
        max-height:60px;
    }
    .sec-sessvid-spons .spons-silver img {
        max-height:35px;
    }

    .sched-details-heading h3 {
        color:#0174cc;
        font-size:0.9rem;
        font-weight:bold;
    }

    .join-sess-btn {
        background-color:#00005c!important;
        color:#fff!important;
        border:1px solid #00005c!important;
    }
    .join-sess-btn.is-disabled {
        background-color:#9e9ec1!important;
        color:#c7c7c7!important;
        border:1px solid #9e9ec1!important;
    }
    .sess-vid-mat .sess-mat-name {
        color:#131313;
    }
</style>
