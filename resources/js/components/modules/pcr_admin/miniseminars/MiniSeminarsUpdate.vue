<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Mini-Sessions / Update Mini-Session</span>
            </div>
            <div class="container-fluid pb-5">

                <div class="admin-conent my-5 mx-3 p-4">
                    <el-button size="small" class="mb-4" type="primary" @click.native="$router.push('/admin/mini-sessions')">Back</el-button>
                    <div class="bg-white p-4">
                        <h1>Update Mini-Session</h1>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <p class="mb-2 font-weight-bold">Mini-Session Title <span class="required-item">*</span></p>
                                <el-input class="mb-4" placeholder="Title" v-model="topic"></el-input>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                <p class="mb-2 font-weight-bold">Description <span class="required-item">*</span></p>
                                    <el-tiptap
                                    v-model="description"
                                    :charCounterCount="false"
                                    :extensions="extensions"
                                    placeholder="Description"
                                    height="500"
                                    />
                                    <div class="ann-char-count text-right">
                                        Characters: {{ description.length }}
                                    </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <p class="mb-2 font-weight-bold">Select Sponsor <span class="required-item">*</span></p>
                                <el-select v-model="sponsor_id" placeholder="Select" class="w-100 mb-4">
                                    <el-option
                                        v-for="spons in sponsorOpt"
                                        :key="spons.value"
                                        :label="spons.label"
                                        :value="spons.value">
                                    </el-option>
                                </el-select>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <p class="mb-2 font-weight-bold">Select Room <span class="required-item">*</span></p>
                                <el-select v-model="room_name" placeholder="Select" class="w-100 mb-4">
                                    <el-option
                                        v-for="room in roomOpt"
                                        :key="room.value"
                                        :label="room.label"
                                        :value="room.value">
                                    </el-option>
                                </el-select>
                            </div>

                            <div v-if="!allowAnyDate" class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Select Start Date <span class="required-item">*</span></p>
                                <el-select v-model="start_date" placeholder="Select" class="w-100 mb-4">
                                    <el-option
                                        v-for="date in dateOpt"
                                        :key="date.value"
                                        :label="date.label"
                                        :value="date.value">
                                    </el-option>
                                </el-select>
                            </div>

                            <div v-if="allowAnyDate" class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Select Start Date <span class="required-item">*</span></p>
                                <el-date-picker
                                    class="w-100 mb-4"
                                    v-model="start_date"
                                    type="date"
                                    @change="setDate"
                                    value-format="yyyy-MM-dd"
                                    placeholder="Select Date">
                                </el-date-picker>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Select Start Time <span class="required-item">*</span></p>
                                <el-time-picker
                                    class="w-100"
                                    :default-value="default_time"
                                    v-model="start_time"
                                    placeholder="Select Time"
                                    format="HH:mm A"
                                    value-format="HH:mm:ss"
                                    @change="setTime">
                                </el-time-picker>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Select Mini-Session Duration <span class="required-item">*</span></p>
                                <el-select v-model="duration" placeholder="Select" class="w-100">
                                    <el-option
                                        v-for="duration in durationOpt"
                                        :key="duration.value"
                                        :label="duration.label"
                                        :value="duration.value">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Zoom Email Address <span class="required-item">*</span></p>
                                <el-input class="mb-4" placeholder="Zoom Email Address" v-model="zoom_email"></el-input>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Zoom Key <span class="required-item">*</span></p>
                                <el-input class="mb-4" placeholder="Zoom Key" v-model="zoom_key"></el-input>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <p class="mb-2 font-weight-bold">Zoom Secret <span class="required-item">*</span></p>
                                <el-input class="mb-4" placeholder="Zoom Secret" v-model="zoom_secret"></el-input>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <p class="mb-2 font-weight-bold">Maximum Number of Participants</p>
                            <el-input-number class="mb-3" v-model="max_user" :min="1"></el-input-number>
                        </div>

                        <el-button class="mt-5" type="primary" @click="saveSesion1" >Save</el-button>
                    </div>
                </div>

            </div>

        </div>

        <el-dialog
        :visible.sync="updateConfirmdialog"
        width="50%"
        class="text-center">
        <div style="word-break:normal;">Are you sure you want to edit this session? It will create another zoom link entirely and your old scheduled zoom session will no longer be accessible.</div>
        <el-button class="mt-3" :loading="savingStatus" type="primary" @click="saveSesion2">Update</el-button>
        <el-button class="mt-3" type="Info" @click="updateConfirmdialog = false">Cancel</el-button>
        </el-dialog>

    </div>
</template>

<script>

import {
  // necessary extensions
  Doc,
  Text,
  Paragraph,
  Heading,
  Bold,
  Underline,
  Italic,
  Strike,
  ListItem,
  BulletList,
  OrderedList,
} from 'element-tiptap';


export default {
    data() {
        return {
            extensions: [
                new Doc(),
                new Text(),
                new Paragraph(),
                new Heading({ level: 5 }),
                new Bold({ bubble: false }),
                new Underline({ bubble: false, menubar: false }),
                new Italic(),
                new Strike(),
                new ListItem(),
                new BulletList(),
                new OrderedList(),
            ],
            dateSetting:  this.$route.query.date,
            allowAnyDate: false,
            savingStatus: false,
            session_id: this.$route.query.id,
            sponsors: [],
            sponsorOpt: [],
            room_name: '',
            roomOpt: [{
                    value: 'Room A',
                    label: 'Room A'
                    }, {
                    value: 'Room B',
                    label: 'Room B'
                    }, {
                    value: 'Room C',
                    label: 'Room C'
                    }, {
                    value: 'Room D',
                    label: 'Room D'
                    }],
            sponsor_id: '',
            topic: '',
            description: '',
            zoom_email: '',
            zoom_key: '',
            zoom_secret: '',
            max_user: '',
            session: [],
            default_time: new Date(0, 0, 0, 8, 0),
            start_date: '',
            start_time: '',
            duration: '',
            dateOpt: [{
                    value: '2021-02-22',
                    label: 'Februrary 22, 2021 (Monday)'
                    }, {
                    value: '2021-02-23',
                    label: 'Februrary 23, 2021 (Tuesday)'
                    }, {
                    value: '2021-02-24',
                    label: 'Februrary 24, 2021 (Wednesday)'
                    }, {
                    value: '2021-02-25',
                    label: 'Februrary 25, 2021 (Thursday)'
                    }, {
                    value: '2021-02-26',
                    label: 'Februrary 26, 2021 (Friday)'
                    }],
            durationOpt: [{
                    value: '60',
                    label: '1 Hour'
                    }, {
                    value: '120',
                    label: '2 Hours'
                    }, {
                    value: '180',
                    label: '3 Hours'
                    }, {
                    value: '240',
                    label: '4 Hours'
                    }, {
                    value: '300',
                    label: '5 Hours'
                    }], 
            token: '',
            updateConfirmdialog: false
        }
    },
    methods: {
        getDateSetting() {
            if (this.dateSetting === '1') {
                this.allowAnyDate = true
            } else {
                this.allowAnyDate = false
            }
        },
        getMiniSess() {
            axios.get(`/api/minisession/session/${this.session_id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    console.log(res.data)
                    console.log(res.data.start_time.slice(11))
                    this.topic = res.data.topic
                    this.description = res.data.description
                    this.room_name = res.data.room_name
                    this.sponsor_id = res.data.sponsor_id
                    this.start_date = res.data.start_time.slice(0, -9)
                    this.start_time = res.data.start_time.slice(11)
                    this.duration = res.data.end_time
                    this.max_user = res.data.max_user
                    this.zoom_email = res.data.zoom_email
                    this.zoom_key = res.data.zoom_key
                    this.zoom_secret = res.data.zoom_secret
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        getAllSponsors() {
            axios.get(`/api/sponsors/all`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.sponsors = res.data;
                    console.log(res.data)
                    this.sponsors.forEach(element => {
                        this.sponsorOpt.push({ label: element.name, value: element.id })
                    })
                }
			})
			.catch(err => {
				console.log(err);
			});
        },
        setTime() {
            console.log(this.start_date + 'T' + this.start_time)
        },
        setDate() {
            console.log(this.start_date)
        },
        saveSesion1() {
            if (!this.topic) {
                this.$message.error('Please provide the Mini-Session Title name.')
            } else if (!this.description) {
                this.$message.error('Please provide a description for this Mini-Session.')
            } else if (!this.zoom_email) {
                this.$message.error('Please provide the zoom email to use for this Mini-Session.')
            } else if (!this.zoom_key) {
                this.$message.error('Please provide the zoom key to use for this Mini-Session.')
            } else if (!this.zoom_secret) {
                this.$message.error('Please provide the zoom secret to use for this Mini-Session.')
            } else if (!this.sponsor_id) {
                this.$message.error('Please assign a sponsor for this Mini-Session.')
            } else if (!this.room_name) {
                this.$message.error('Please select a room for this Mini-Session.')
            } else if (!this.start_date) {
                this.$message.error('Please select a start date for this Mini-Session.')
            } else if (!this.start_time) {
                this.$message.error('Please select a start time for this Mini-Session.')
            } else if (!this.duration) {
                this.$message.error('Please select a duration for this Mini-Session.')
            } else {

                this.updateConfirmdialog = true

            }

        },
        saveSesion2() {
                this.savingStatus = true

                var randomPW = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15)
                var finpw = String(randomPW).slice(0, 10)

                axios.put(`/api/minisession/room/edit/${this.session_id}`, {
                    max_user: this.max_user,
                    room_name: this.room_name,
                    description: this.description,
                    zoom_email: this.zoom_email,
                    zoom_key: this.zoom_key,
                    zoom_secret: this.zoom_secret,
                    sponsor_id: this.sponsor_id,
                    topic: this.topic,
                    type: 2,
                    start_time: this.start_date + 'T' + this.start_time,
                    duration: this.duration,
                    timezone: 'Asia/Singapore',
                    password: finpw,
                    settings: {
                        host_video: true,
                        participant_video: true,
                        mute_upon_entry: true,
                        waiting_room: true
                    }
                    },
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Mini-Session successfully updated.')
                    this.$router.push('/admin/mini-Sessions')
                })
                .catch(error => {
                    this.$message({
                        message: 'Mini-session could not be updated. Please make sure you have provided a valid Zoom Email Account, API, and Secret.',
                        type: 'error',
                        duration: 10000
                    })
                    console.log(error)
                    this.savingStatus = false
                })
        },
		validateFile(file, type, callback) {

			let valid_types = this.image_types;
			if (!file) {
				callback(false);
			} else if (file.size > this.file_max) {
				this.$message.error("File is too big");
				callback(false);
			} else if (!valid_types.includes(file.type)) {
				this.$message.error("Invalid file type");
				callback(false);
			} else {
				callback(true);
			}
        },
		onImageChange(file) {
			this.validateFile(file.raw, 'photo', (result) => {
				if (result == true) {
					this.ann_file = file.raw;
					this.ann_file_url = URL.createObjectURL(file.raw);
					this.ann_file_change = true;
				}
			})
		},
        getTokenCookie() {
            var token = 'token'
            var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
            if (match) {
                this.token = match[2].replace('%7C', '|')
                console.log(this.token)
            }
            else{
                console.log('No token found');
            }
        },
    },
	mounted() {
        this.getTokenCookie()
        this.getAllSponsors()
        this.getMiniSess()
        this.getDateSetting()
	}
}
</script>

<style>

.content-wrapper {
    padding-top: 65px;
}

.ann-sidebar button {
    width:100%;
}
.ann-sidebar .el-card__header {
    font-weight:bold;
    color:#174A84;
}
.ann-featured-upload,
.ann-featured-upload .el-upload,
.ann-featured-upload img {
    width:100%;
}
.blank-featured-img {
    border:1px solid #DCDFE6;
    border-radius:4px;
    width:100%;
    padding:8px 10px;
}
.msg-img-thumb {
    border:1px solid #DCDFE6;
    margin-bottom:10px;
    padding:10px;
}
.msg-img-change {
    color:#131313;
    font-style: italic;
}
.el-tiptap-editor__content strong {
    font-weight: bold;
}
.admin-conent .el-tiptap-editor__content h1 {
    font-size:2.5rem!important;
    color:#000;
    margin-top:20px!important;
    margin-bottom:20px!important;
    font-weight: normal;
}
.ann-char-count {
    padding:10px;
    border:1px solid #ebeef5;
}
</style>
