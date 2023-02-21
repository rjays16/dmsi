<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Mini-Seminars / Rooms / Add Room</span>
            </div>            
            <div class="container-fluid pb-5">
                
                <div class="admin-conent my-5 mx-3 p-4">
                    <el-button size="small" class="mb-4" type="primary" @click.native="$router.push('/admin/mini-seminars/rooms')">Back</el-button>
                    <div class="bg-white p-4">
                        <h1>Add New Room</h1>      
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="ann-content">
                                    <p class="mb-2 font-weight-bold">Room Name <span class="required-item">*</span></p>
                                    <el-input class="mb-4" placeholder="Room Name" v-model="room_name"></el-input>

                                    <p class="mb-2 font-weight-bold">Zoom Email Address <span class="required-item">*</span></p>
                                    <el-input class="mb-4" placeholder="Zoom Email Address" v-model="zoom_email"></el-input>

                                    <p class="mb-2 font-weight-bold">Zoom Key <span class="required-item">*</span></p>
                                    <el-input class="mb-4" placeholder="Zoom Key" v-model="zoom_key"></el-input>

                                    <p class="mb-2 font-weight-bold">Zoom Secret <span class="required-item">*</span></p>
                                    <el-input class="mb-4" placeholder="Zoom Secret" v-model="zoom_secret"></el-input>

                                    <p class="mb-2 font-weight-bold">Select Sponsor<span class="required-item">*</span></p>
                                    
                                    <el-select v-model="sponsor_id" placeholder="Select">
                                        <el-option
                                            v-for="spons in sponsorOpt"
                                            :key="spons.spons_id"
                                            :label="spons.label"
                                            :value="spons.spons_id">
                                        </el-option>
                                    </el-select>                                 

                                </div>

                                <el-button class="mt-5" type="primary" @click="saveRoom">Save Room</el-button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>


export default {
    data() {
        return {
            sponsors: [],
            sponsorOpt: [],
            room_name: '',
            zoom_email: '',
            zoom_key: '',
            zoom_secret: '',
			sponsor_id: '',
            token: ''
        }
    },
    methods: {
        getAllSponsors() {
            axios.get(`/api/sponsors/all`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.sponsors = res.data;
                    this.sponsors.forEach(element => {
                        this.sponsorOpt.push({ label: element.name, spons_id: element.id })
                    })
                }
			})
			.catch(err => {
				console.log(err);
			});		
        },        
        saveRoom() {
            if (!this.room_name) {
                this.$message.error('Please provide the room name.')
            } else if (!this.zoom_email) {
                this.$message.error('Please provide the zoom email to use for this room.')
            } else if (!this.zoom_key) {
                this.$message.error('Please provide the zoom key to use for this room.')
            } else if (!this.zoom_secret) {
                this.$message.error('Please provide the zoom secret to use for this room.')
            } else if (!this.sponsor_id) {
                this.$message.error('Please assign a sponsor for this room.')
            } else {

                axios.post(`/api/minisession/room`, {
                    room_name: this.room_name,
                    zoom_email: this.zoom_email,
                    zoom_key: this.zoom_key,
                    zoom_secret: this.zoom_secret,
                    sponsor_id: this.sponsor_id},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Room successfully added.')
                    this.$router.push('/admin/mini-seminars/rooms')
                })
                .catch(error => {
                    this.$message.error('Room could not be added. Please try again.')
                    console.log(error)
                })

            }

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
