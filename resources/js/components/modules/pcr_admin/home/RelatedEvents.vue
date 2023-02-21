<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Home Page / Related Events</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Related Events</span>
                        <el-table
                            stripe
                            :data="relEvents"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'event_type', order: 'ascending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="link_text"
                                label="Event Title">
                            </el-table-column>
                            <el-table-column
                                prop="link_photo"
                                align="center"
                                label="Link Image">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.link_photo">
                                    <el-button @click="openImage(scope.row.link_photo)" type="primary">View</el-button>
                                    </div>
                                    <div v-else>None uploaded</div>
                                </template>                                 
                            </el-table-column>
                            <el-table-column
                                prop="link_url"
                                label="Link URL">
                            </el-table-column>                            
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button plain class="my-1 mx-0" size="mini" @click="editEvent(scope.row)" type="primary" icon="el-icon-edit">Edit</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>                   
                </div>

            </div>

            <el-dialog
            title="Edit Related Event Link"
            :visible.sync="editEventDialog"
            width="50%"
             @close="closeEdit">
            <p class="mb-1 font-weight-bold">Related Event Name</p>
            <el-input class="mb-4" placeholder="Related Event Name" v-model="forEdit_link_text"></el-input>
            <p class="mb-1 font-weight-bold">Link URL</p>
            <p class="mb-3 rel-img-rec"><em>URLs entered should start with either 'http://' or 'https://'</em></p>
            <el-input class="mb-4" placeholder="Related Event URL" v-model="forEdit_link_url"></el-input>
            <p class="mb-1 font-weight-bold">Link Image</p>

            <el-upload
                class="avatar-uploader ann-featured-upload"
                action="/"
                accept="image/png, image/jpeg, image/jpg"
                :auto-upload="false"
                :show-file-list="false"
                :on-change="onImageChange"
            >
                <div v-if="event_file_url">
                    <div class="msg-img-thumb">
                        <img
                            :src="event_file_url"
                            class="avatar"
                        />
                    </div>
                    <span class="msg-img-change">Click above to change link image.</span>
                </div>
                <div v-else class="blank-featured-img">
                    <i class="el-icon-plus avatar-uploader-icon"></i> Set Link Image
                </div>
                <div class="rel-img-rec"><em>Recommended Size: 600 x 360 pixels</em></div>
                
            </el-upload>             

            <span slot="footer" class="dialog-footer">
                <el-button type="success" @click="saveEdit(forEdit_id)">Save</el-button>
                <el-button @click="closeEdit">Cancel</el-button>
            </span>
            </el-dialog>

            <el-dialog class="member-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
                <img :src="currentImageView" />
            </el-dialog>            

        </div>

    </div>
    
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            relEvents: [],
            editEventDialog: false,
            token: '',
            is_processing: false,
                    forEdit_link_text: '',
                    forEdit_link_photo: '',
                    forEdit_link_url: '',
                    forEdit_event_type: '',
                    forEdit_id: '',
            image_types: ["image/png", "image/jpg", "image/jpeg"],
            event_file: null,
			event_file_url: null,
			event_file_change: false,
            event_file_deleted: false,
            dialogImageTab: false,
            currentImageView: '',
        }
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM DD YYYY');
        }
    },
    methods: {
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
        getAlllinks() {
            axios.get(`/api/events/sitelinks`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.relEvents = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        editEvent(event) {
            this.forEdit_id = event.id
            this.forEdit_link_text = event.link_text
            this.forEdit_link_url = event.link_url
            this.forEdit_event_type = event.event_type
            if (event.link_photo) {
                this.event_file_url = window.location.origin + '/' + event.link_photo.replace("public", "storage")
            }
            this.editEventDialog = true
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
					this.event_file = file.raw;
					this.event_file_url = URL.createObjectURL(file.raw);
					this.event_file_change = true;
				}
			})
        },
        closeEdit() {
            this.event_file = null,        
			this.event_file_url = null,
			this.event_file_change = false,
            this.event_file_deleted = false,
            this.editEventDialog = false
        }, 
        saveEdit(id) {

            const eventData = new FormData();
            eventData.append("link_text", this.forEdit_link_text)
            eventData.append("event_type", this.forEdit_event_type)
            eventData.append("link_url", this.forEdit_link_url)
            if (this.event_file_change) {
                eventData.append("link_photo", this.event_file) 
            }

            axios.post(`/api/events/sitelink/edit/${id}`, eventData,
                {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
                console.log(response)
                this.getAlllinks()
                this.$message.success('Related event link successfully edited.')
                this.editEventDialog = false
            })
            .catch(error => {
                console.log(error)
                this.getAlllinks()
                this.$message.error('Error editing related event link.')
                this.editEventDialog = false
            })            
        },
        openImage(filepath) {
            // this.currentImageView = '/images/layout/loading.gif'
            this.dialogImageTab = true
            var fileurl = filepath.replace("public", "storage")
            this.currentImageView = window.location.origin + '/' +  fileurl
            // this.currentImageView = 'https://beta2.73rdpcrannualconvention.com/' + fileurl
        },
        clearImage() {
            this.currentImageView = ''
        }        
    },
	mounted() {
        this.getTokenCookie()
		this.getAlllinks()
	}
}
</script>

<style>

.content-wrapper {
    padding-top: 65px;
}

.add-content-box {
     height: 70px;
     width: 100%;
     border: 3px dashed #ccc;
}

.rounded-add-btn {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    border: 3px dashed #ccc;
}

.add-btn-default {
    color: #ccc;
    transition: all 0.20s;
}

.add-btn-hovered {
    background-color: #ccc;
    color: #fff;
    transition: all 0.20s;
}

.fa-icon-custom {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.5em;
}
.paper-container {
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
	padding: 20px 25px 35px 25px;
	background-color: #fff;
	margin-top: 30px;
}
.admin-conent .table-title {
    color:#174A84;
    font-size:1rem;
    font-weight:bold;
    margin-bottom:20px;
}
.enrolled-sponsors-table th .cell {
    color:#131313;
}
.sponsors-add-btn {
    background:#0c015d!important;
    border-color:#0c015d!important;
}
.edit-sponsor-dialog .el-dialog {
    margin-top:5vh!important;
}
.edit-sponsor-dialog .el-dialog__body {
    padding-top:10px;
}
.edit-sponsor-dialog .el-dialog__title {
    font-weight:bold;
    color:#174A84;
}
.rel-img-rec {
    margin-top:10px;
    font-size:0.8rem;
}
</style>
