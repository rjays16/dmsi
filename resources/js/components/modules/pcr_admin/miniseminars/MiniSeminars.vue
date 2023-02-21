<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Manage Mini-Sessions </span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Mini-Sessions</span>
                    <el-button @click="$router.push('/admin/mini-sessions/add')" type="primary" size="mini" class="sponsors-add-btn ml-3">Add Mini-Session</el-button>
                        <el-table
                            stripe
                            :data="sessions"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'start_time', order: 'ascending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="topic"
                                label="Mini-Sessions Title">
                            </el-table-column>
                            <el-table-column
                                prop="start_time"
                                label="Start Date / Time">
                                <template slot-scope="scope">
                                    <div>{{ scope.row.start_time | moment }}</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="end_time"
                                label="Duration">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.end_time === '60'">1 Hour</div>
                                    <div v-if="scope.row.end_time === '120'">2 Hours</div>
                                    <div v-if="scope.row.end_time === '180'">3 Hours</div>
                                    <div v-if="scope.row.end_time === '240'">4 Hours</div>
                                    <div v-if="scope.row.end_time === '300'">5 Hours</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="room_name"
                                label="Room">
                            </el-table-column>
                            <el-table-column
                                prop="sponsor.name"
                                label="Sponsor">
                            </el-table-column>                            
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button class="my-1 mx-0" size="mini" @click="editMiniSess(scope.row.id)" type="primary" icon="el-icon-edit">Update</el-button>
                                    <el-button class="my-1 mx-0" size="mini" @click="showDeleteDialog(scope.row.id)" type="danger" icon="el-icon-edit">Delete</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>                   
                </div>

            </div>
        </div>
      



        <el-dialog
        :visible.sync="deleteMiniSessDialog"
        width="50%"
        class="text-center">
        <div>Are you sure you want to delete this Mini-Session?</div>
        <el-button class="mt-3" type="danger" @click="deleteMiniSess">Delete</el-button>
        <el-button class="mt-3" type="Info" @click="deleteMiniSessDialog = false">Cancel</el-button>
        </el-dialog>        

    </div>
    
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            sessions: [],
            sponsors: [],
            sponsorOpt: [],            
            deleteMiniSessDialog: false,
            forDeleteID: '',

            noRoomNotice: false,

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
            return moment(date).format('MMM DD YYYY, h:mm a')
        }
    },
    computed: {
        showMiniSessions() {
            return this.sessions.filter(data => data.topic)
        } 
    },
    methods: {
        editMiniSess(id) {
            this.$router.push('/admin/mini-sessions/update?id=' + id)
        },
        showDeleteDialog(id) {
            this.forDeleteID = id
            this.deleteMiniSessDialog = true
        },
        deleteMiniSess() {
            axios.delete(`/api/minisession/session/${this.forDeleteID}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				this.deleteMiniSessDialog = false
                this.getAllRooms()
                this.forDeleteID === ''
			})
			.catch(err => {
				console.log(err);
                this.deleteMiniSessDialog = false
                this.getAllRooms()
                this.forDeleteID === ''
			})
        },
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
                    this.sessions = res.data;
                    
                    //if (this.rooms.length === 0) {
                    //    this.noRoomNotice = true
                    //}
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
