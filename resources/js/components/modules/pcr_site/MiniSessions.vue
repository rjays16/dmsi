<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-minisessions-login" v-loading="loading">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-minisessions-header">
                <div class="pcr-page-title font-weight-bold">Mini-Sessions</div>
                <div class="pcr-page-subtitle">Philippine College of Radiology Annual Convention 2021</div>
              </div>
            </section>
            <section class="content content-80">
              <div class="d-flex justify-content-center">
                  <div class="session-tabs">
                        <div>
                          <div class="mini-sess-cont" v-for="session in allSessSorted" :key="session.id">
                              <div class="row">
                                  <!--<div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                      <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                  </div> -->
                                  <div class="col-sm-12 col-md-9 mini-sess-btn-body py-3">
                                      <h3>{{ session.topic }}</h3>
                                      <el-button class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</el-button>
                                      <!-- <p>{{ session.description }}</p> -->
                                      <div v-html="session.description"></div>
                                      <div class="mini-sess-spons">
                                          <span>Sponsor:</span>
                                          <span>{{ session.sponsor.name }}</span>

                                      </div>
                                      <div class="mini-sess-date mt-4">
                                          <span>{{ session.start_time | moment }}</span>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                      <!--<el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                      <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button> -->
                                      <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <el-tabs v-model="schedtab" class="sess-sched-tabs d-none">
                            <el-tab-pane name="day1">
                              <div slot="label" class="sess-sched-tab-label">
                                <span class="sched-day">DAY 1</span>
                                <span class="sched-date">February 22, 2021 (Mon)</span>
                              </div>
                              <template>
                                <div class="mini-sess-day1">
                                  <div v-if="day1.length < 1">
                                    <p class="text-center">There are no Mini-Sessions currently scheduled for this day.</p>
                                  </div>
                                  <div v-else>
                                    <div class="mini-sess-cont" v-for="session in day1Sorted" :key="session.id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>{{ session.topic }}</h3>
                                                <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                <!-- <p>{{ session.description }}</p> -->
                                                <div v-html="session.description"></div>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <span>{{ session.sponsor.name }}</span>

                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>{{ session.start_time | moment }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                    <!--<div class="mini-sess-cont">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img src="/images/booth/video_placeholder.png" />
                                                <el-button class="mt-3 w-100" type="primary" size="small" round>Click here to Enter</el-button>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>Session 2 Title</h3>
                                                <el-button class="mini-sess-room-btn mb-2" size="mini" type="warning" round>Room 2B</el-button>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget quam pellentesque, ornare dolor ac, luctus ex.</p>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <img class="mini-sess-spons-logo" src="/images/layout/spons_anke.png" />
                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>February 22, 2021 | 8:30am - 9:30am</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round>Join</el-button>
                                                <el-button type="primary" round>More Info</el-button>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                              </template>
                            </el-tab-pane>
                            <el-tab-pane name="day2">
                              <div slot="label" class="sess-sched-tab-label">
                                <span class="sched-day">DAY 2</span>
                                <span class="sched-date">February 23, 2021 (Tue)</span>
                              </div>
                              <template>
                                <div class="mini-sess-day2">
                                  <div v-if="day2.length < 1">
                                    <p class="text-center">There are no Mini-Sessions currently scheduled for this day.</p>
                                  </div>
                                  <div v-else>
                                    <div class="mini-sess-cont" v-for="session in day2Sorted" :key="session.id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>{{ session.topic }}</h3>
                                                <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                <!-- <p>{{ session.description }}</p> -->
                                                <div v-html="session.description"></div>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <span>{{ session.sponsor.name }}</span>

                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>{{ session.start_time | moment }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                </div>
                              </template>
                            </el-tab-pane>
                            <el-tab-pane name="day3">
                              <div slot="label" class="sess-sched-tab-label">
                                <span class="sched-day">DAY 3</span>
                                <span class="sched-date">February 24, 2021 (Wed)</span>
                              </div>
                              <template>
                                <div class="mini-sess-day3">
                                  <div v-if="day3.length < 1">
                                    <p class="text-center">There are no Mini-Sessions currently scheduled for this day.</p>
                                  </div>
                                  <div v-else>
                                    <div class="mini-sess-cont" v-for="session in day3Sorted" :key="session.id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>{{ session.topic }}</h3>
                                                <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                <!-- <p>{{ session.description }}</p> -->
                                                <div v-html="session.description"></div>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <span>{{ session.sponsor.name }}</span>

                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>{{ session.start_time | moment }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                </div>
                              </template>
                            </el-tab-pane>
                            <el-tab-pane name="day4">
                              <div slot="label" class="sess-sched-tab-label">
                                <span class="sched-day">DAY 4</span>
                                <span class="sched-date">February 25, 2021 (Thu)</span>
                              </div>
                              <template>
                                <div class="mini-sess-day4">
                                  <div v-if="day4.length < 1">
                                    <p class="text-center">There are no Mini-Sessions currently scheduled for this day.</p>
                                  </div>
                                  <div v-else>
                                    <div class="mini-sess-cont" v-for="session in day4Sorted" :key="session.id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>{{ session.topic }}</h3>
                                                <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                <!-- <p>{{ session.description }}</p> -->
                                                <div v-html="session.description"></div>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <span>{{ session.sponsor.name }}</span>

                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>{{ session.start_time | moment }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                </div>
                              </template>
                            </el-tab-pane>
                            <el-tab-pane name="day5">
                              <div slot="label" class="sess-sched-tab-label">
                                <span class="sched-day">DAY 5</span>
                                <span class="sched-date">February 26, 2021 (Fri)</span>
                              </div>
                              <template>
                                <div class="mini-sess-day5">
                                  <div v-if="day5.length < 1">
                                    <p class="text-center">There are no Mini-Sessions currently scheduled for this day.</p>
                                  </div>
                                  <div v-else>
                                    <div class="mini-sess-cont" v-for="session in day5Sorted" :key="session.id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-vid">
                                                <img class="minisess-spons-logo-btn" :src="getImageSrc(session.sponsor.logo_file)" />
                                            </div>
                                            <div class="col-sm-12 col-md-6 mini-sess-btn-body py-3">
                                                <h3>{{ session.topic }}</h3>
                                                <span class="mini-sess-room-btn mb-2" size="mini" type="warning" round>{{ session.room_name }}</span>
                                                <!-- <p>{{ session.description }}</p> -->
                                                <div v-html="session.description"></div>
                                                <div class="mini-sess-spons">
                                                    <span>Sponsors:</span>
                                                    <span>{{ session.sponsor.name }}</span>

                                                </div>
                                                <div class="mini-sess-date mt-4">
                                                    <span>{{ session.start_time | moment }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mini-sess-btn-col">
                                                <el-button type="info" round @click="regSess(session.id)">Sign Up</el-button>
                                                <el-button type="primary" round @click="gotoMiniSessVid(session.id)">More Info</el-button>
                                                <el-button type="primary" class="join-sess-btn" round @click="joinMiniSessVid(session.id, session.join_url)">Join</el-button>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                </div>
                              </template>
                            </el-tab-pane>
                        </el-tabs>

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
    name: 'MiniSessions',
    data() {
        return {
          token: this.$cookies.get('token'),
          reg_id: this.$cookies.get('reg_id'),
          loading: false,
          schedtab: null,
          day1: [],
          day2: [],
          day3: [],
          day4: [],
          day5: [],
          allSess: [],
          currentURL: window.location.origin + '/',

          dateSetting:  this.$route.query.date,
          allowAnyDate: false,
          serverDateTime: null
        }
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM DD YYYY, h:mm a')
        }
    },
    computed: {
        day1Sorted() {
            return this.day1.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        },
        day2Sorted() {
            return this.day2.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        },
        day3Sorted() {
            return this.day3.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        },
        day4Sorted() {
            return this.day4.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        },
        day5Sorted() {
            return this.day5.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        },
        allSessSorted() {
            return this.allSess.sort((a, b) => new Date(a.start_time) - new Date(b.start_time))
        }
    },
    methods: {
      getDay1() {
        axios.get(`/api/minisession/rooms/schedule?date=2021-02-22`, {
          headers: { Authorization: "Bearer " + this.token }
        })
		    .then(res => {
				  if(res.data) {
            this.day1 = res.data
            console.log(res.data)
          }
        })
        .catch(err => {
          console.log(err);
        })
      },
      getDay2() {
        axios.get(`/api/minisession/rooms/schedule?date=2021-02-23`, {
          headers: { Authorization: "Bearer " + this.token }
        })
		    .then(res => {
				  if(res.data) {
            this.day2 = res.data
            console.log(res.data)
          }
        })
        .catch(err => {
          console.log(err);
        })
      },
      getDay3() {
        axios.get(`/api/minisession/rooms/schedule?date=2021-02-24`, {
          headers: { Authorization: "Bearer " + this.token }
        })
		    .then(res => {
				  if(res.data) {
            this.day3 = res.data
            console.log(res.data)
          }
        })
        .catch(err => {
          console.log(err);
        })
      },
      getDay4() {
        axios.get(`/api/minisession/rooms/schedule?date=2021-02-25`, {
          headers: { Authorization: "Bearer " + this.token }
        })
		    .then(res => {
				  if(res.data) {
            this.day4 = res.data
            console.log(res.data)
          }
        })
        .catch(err => {
          console.log(err);
        })
      },
      getDay5() {
        axios.get(`/api/minisession/rooms/schedule?date=2021-02-26`, {
          headers: { Authorization: "Bearer " + this.token }
        })
		    .then(res => {
				  if(res.data) {
            this.day5 = res.data
            console.log(res.data)
          }
        })
        .catch(err => {
          console.log(err);
        })
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

      getImageSrc(img) {
          if (img) {
              var image = img.replace('public', 'storage')
              var image_src = this.currentURL + image
              return image_src
          }
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
        this.$router.push('/mini-sessions-video?id=' + id)
        // axios.get(`/api/minisession/register/exists/${id}/${this.reg_id}`, {
        //     headers: { Authorization: "Bearer " + this.token }
        // })
        // .then(response => {
        //   console.log(response)
        //     if (response.data.message === 'user not yet registered') {
        //       this.$message({
        //           message: 'You must register first before you can enter the Mini-Session Page.',
        //           type: 'error',
        //           duration: 10000
        //       })
        //     }
        // })
        // .catch(error => {
        //     if (error.response.data.message === 'user already registered') {
        //       this.$router.push('/mini-sessions-video?id=' + id)
        //     }
        // });
      },

      joinMiniSessVid(id, url) {

        var target = '_blank'
        window.open(url, target)        

        // axios.get(`/api/minisession/register/exists/${id}/${this.reg_id}`, {
        //     headers: { Authorization: "Bearer " + this.token }
        // })
        // .then(response => {
        //   console.log(response)
        //     if (response.data.message === 'user not yet registered') {
        //       this.$message({
        //           message: 'You must register first before you can join this Mini-Session.',
        //           type: 'error',
        //           duration: 10000
        //       })
        //     }
        // })
        // .catch(error => {
        //     if (error.response.data.message === 'user already registered') {
        //       var target = '_blank'
        //       window.open(url, target)
        //     }
        // });
      },

      getDateSetting() {
          if (this.dateSetting === '1') {
              this.allowAnyDate = true
          } else {
              this.allowAnyDate = false
          }
      },

      setTabDates() {
        axios.get(`/api/getdatetime`)
        .then(response => {
            console.log(response)
            var date = response.data.datetime
            var formatDate = moment(date, 'YYYY-MM-DDTHH:mm:ss').toDate()
            this.serverDateTime = formatDate
            var day1 = new Date('2021-02-22T00:00:00')
            var day2 = new Date('2021-02-23T00:00:00')
            var day3 = new Date('2021-02-24T00:00:00')
            var day4 = new Date('2021-02-25T00:00:00')
            var day5 = new Date('2021-02-26T00:00:00')
            var day6 = new Date('2021-02-27T00:00:00')

            console.log('the original date from server is: ' + response.data.datetime)
            console.log('the converted date from server is: ' + this.serverDateTime)

            if ((this.serverDateTime > day1) && (this.serverDateTime < day2)) {
              this.mSesstab = 'day1'
              this.schedtab = 'day1'
            } else if ((this.serverDateTime > day2) && (this.serverDateTime < day3)) {
              this.mSesstab = 'day2'
              this.schedtab = 'day2'
            } else if ((this.serverDateTime > day3) && (this.serverDateTime < day4)) {
              this.mSesstab = 'day3'
              this.schedtab = 'day3'
            } else if ((this.serverDateTime > day4) && (this.serverDateTime < day5)) {
              this.mSesstab = 'day4'
              this.schedtab = 'day4'
            } else if ((this.serverDateTime > day5) && (this.serverDateTime < day6)) {
              this.mSesstab = 'day5'
              this.schedtab = 'day5'
            } else {
              this.mSesstab = 'day1'
              this.schedtab = 'day1'
            }
        })
        .catch(error => {
            console.log(error)
        });
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
      this.setTabDates()
      this.getDay1()
      this.getDay2()
      this.getDay3()
      this.getDay4()
      this.getDay5()
      this.getAllSessions()
      this.getDateSetting()
    },
    created() {
      this.checkMemberLoginStatus()
    }
  }
</script>

<style>
  .page-minisessions-login .page-header {
    padding-top:80px;
    margin-top:0;
  }
  .page-header .page-minisessions-header {
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
	.pcr-login-error .el-notification__content {
		text-align:left!important;
	}
  @media only screen and (max-width: 1220px)  {
    .page-minisessions-header .pcr-page-title,
    .page-minisessions-header .pcr-page-subtitle {
      padding-left:20px;
      padding-right:20px;
    }
    .col-sm-6 {
      width:50%!important;
    }
  }
	@media only screen and (max-width: 768px)  {
    .page-minisessions-header .pcr-page-title {
      padding-top:30px;
    }
	}
    .sess-sched-tabs .sched-day,
    .sess-sched-tabs .sched-date {
        display:block;
        font-size:0.8rem;
        line-height:0.7rem;
        color:#0174cc;
    }
    .sess-sched-tabs .sched-date {
        margin-top:5px;
        background:none;
    }
    .sess-sched-tabs .el-tabs__item.is-active,
    .sess-sched-tabs .el-tabs__item:hover {
        background-color:#0174cc;
    }
    .sess-sched-tabs .el-tabs__item.is-active span,
    .sess-sched-tabs .el-tabs__item:hover span {
        color:#fff;
    }
    .sess-sched-tabs .el-tabs__item {
        padding:0;
        border:1px solid #0174cc;
        border-left:none;
    }
    .sess-sched-tabs #tab-day1 {
        border-left:1px solid #0174cc;
    }
    .sess-sched-tab-label {
        padding:5px 20px 10px;
    }
    .sess-sched-tabs .el-tabs__active-bar {
        display: none;
    }
    .session-tabs,
    .session-tabs .el-tabs__nav.is-top {
        width:100%;
    }
    .session-tabs .el-tabs__nav-scroll {
        text-align: center;
    }
    .session-tabs .el-tabs__nav-wrap::after {
        display:none;
    }
    .session-tabs .el-tabs__content {
        padding-top:50px;
    }
    .mini-sess-cont {
        padding:20px 0;
        border-bottom:20px solid #f2f2f2;
    }
    .mini-sess-btn-col button {
        margin:20px 0 0!important;
        width:100%;
    }
    .mini-sess-btn-vid img {
        width:100%;
    }
    .mini-sess-btn-body {
        /*border-left:1px solid #dadada; */
    }
        .mini-sess-btn-body h3 {
            color:#0174cc;
            font-size:0.9rem;
            font-weight:bold;
        }
        .mini-sess-room-btn {
            background:#f75202!important;
            color:#fff;
            padding:8px 20px;
            display:inline-block;
            border-radius: 50px;
        }
        .mini-sess-spons-logo {
            max-height:30px;
        }
    .join-sess-btn {
        background-color:#00005c!important;
        color:#fff!important;
        border:1px solid #00005c!important;
    }
</style>
