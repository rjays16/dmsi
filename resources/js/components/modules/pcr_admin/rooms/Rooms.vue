<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Mini-Seminars / Rooms</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Rooms</span>
                    <el-button @click="$router.push('/admin/mini-seminars/rooms/add')" type="primary" size="mini" class="sponsors-add-btn ml-3">Add Room</el-button>
                        <el-table
                            stripe
                            :data="rooms"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'room_name', order: 'ascending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="room_name"
                                label="Room Name">
                            </el-table-column>
                            <el-table-column
                                prop="zoom_email"
                                label="Zoom Email">
                            </el-table-column>                            
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="">
                                <template slot-scope="scope">
                                    <el-button class="my-1 mx-0" size="mini" @click="editRoom(scope.row)" type="primary" icon="el-icon-edit">Update</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>                   
                </div>

            </div>
        </div>
      

            <el-dialog
            title="Edit Room Details"
            :visible.sync="editRoomDialog"
            width="50%"
            @close="closeEdit">      
            <div class="mt-3">
                <div class="col-sm-12 col-md-12">
                    <div class="ann-content">
                        <p class="mb-2 font-weight-bold">Room Name <span class="required-item">*</span></p>
                        <el-input class="mb-4" placeholder="Room Name" v-model="forEdit_room_name"></el-input>

                        <p class="mb-2 font-weight-bold">Zoom Email Address <span class="required-item">*</span></p>
                        <el-input class="mb-4" placeholder="Zoom Email Address" v-model="forEdit_zoom_email"></el-input>

                        <p class="mb-2 font-weight-bold">Zoom Key <span class="required-item">*</span></p>
                        <el-input class="mb-4" placeholder="Zoom Key" v-model="forEdit_zoom_key"></el-input>

                        <p class="mb-2 font-weight-bold">Zoom Secret <span class="required-item">*</span></p>
                        <el-input class="mb-4" placeholder="Zoom Secret" v-model="forEdit_zoom_secret"></el-input>

                        <p class="mb-2 font-weight-bold">Select Sponsor<span class="required-item">*</span></p>
                        
                        <el-select v-model="forEdit_sponsor_id" placeholder="Select">
                            <el-option
                                v-for="spons in sponsorOpt"
                                :key="spons.spons_id"
                                :label="spons.label"
                                :value="spons.spons_id">
                            </el-option>
                        </el-select>                                 

                    </div>

                    <el-button class="mt-5" type="primary" @click="saveRoom">Save</el-button>
                    <el-button @click="closeEdit">Cancel</el-button>
                </div>
            </div>
        </el-dialog>

    </div>
    
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            rooms: [],
            sponsors: [],
            sponsorOpt: [],            
            editRoomDialog: false,

            forEdit_room_id: '',
            forEdit_room_name: '',
            forEdit_zoom_email: '',
            forEdit_zoom_key: '',
            forEdit_zoom_secret: '',
			forEdit_sponsor_id: '',

            token: '',
        }
    },
    validations: {

    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM DD YYYY');
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
        getAllRooms() {
            axios.get(`/api/minisession/rooms`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.rooms = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        editRoom(room) {
            this.forEdit_room_id = room.id
            this.forEdit_room_name = room.room_name
            this.forEdit_zoom_email = room.zoom_email
            this.forEdit_zoom_key = room.zoom_key
            this.forEdit_zoom_secret = room.zoom_secret
            this.forEdit_sponsor_id = room.sponsor_id

            this.editRoomDialog = true
        },

        closeEdit() {
            this.forEdit_room_name === '',
            this.forEdit_zoom_email === '',
            this.forEdit_zoom_key === '',
            this.forEdit_zoom_secret === '',
            this.forEdit_sponsor_id === '',
            this.forEdit_room_id === '',
            this.editRoomDialog = false
        },

        saveRoom() {
            if (!this.forEdit_room_name) {
                this.$message.error('Please provide the room name.')
            } else if (!this.forEdit_zoom_email) {
                this.$message.error('Please provide the zoom email to use for this room.')
            } else if (!this.forEdit_zoom_key) {
                this.$message.error('Please provide the zoom key to use for this room.')
            } else if (!this.forEdit_zoom_secret) {
                this.$message.error('Please provide the zoom secret to use for this room.')
            } else if (!this.forEdit_sponsor_id) {
                this.$message.error('Please assign a sponsor for this room.')
            } else {

                axios.put(`/api/minisession/room/edit/${this.forEdit_room_id}`, {
                    room_name: this.forEdit_room_name,
                    zoom_email: this.forEdit_zoom_email,
                    zoom_key: this.forEdit_zoom_key,
                    zoom_secret: this.forEdit_zoom_secret,
                    sponsor_id: this.forEdit_sponsor_id},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Room details successfully updated.')
                    this.closeEdit()
                    this.getAllRooms()
                })
                .catch(error => {
                    this.$message.error('Room details could not be updated. Please try again.')
                    console.log(error)
                    this.closeEdit()
                    this.getAllRooms()
                })

            }

        },

        deleteConfirm(id) {
            this.deleteConfirmationTab = true
            this.forDeleteID = id
        },
        cancelDelete() {
            this.deleteConfirmationTab = false
            this.forDeleteID = ''
        },        
        deleteAnn() {
            this.is_processing = true
            var id = this.forDeleteID
            axios.delete(`/api/pcr/announcement/delete/${id}/`, { 
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
                console.log(res.data)
                this.forDeleteID = ''
                this.deleteConfirmationTab = false
                this.getAllAnnouncements()
                this.$message.success('Announcement successfully deleted.')
                this.is_processing = false
			})
			.catch(err => {
                console.log(err)
                this.forDeleteID = ''
                this.deleteConfirmationTab = false
                this.getAllAnnouncements()
                this.$message.error('Error deleting announcement.')
                this.is_processing = false
			})
        }
    },
	mounted() {
        this.getTokenCookie()
        this.getAllSponsors()
		this.getAllRooms()
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
</style>
