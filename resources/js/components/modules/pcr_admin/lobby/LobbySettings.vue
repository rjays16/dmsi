<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Lobby / Settings</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Lobby Settings</span>
                    <p class="mt-3 font-weight-bold">Lobby Video Name:</p>
                    <el-input placeholder="Enter Plenary Video Name" v-model="vidName" style="max-width:50%;"></el-input>                    
                    <p class="mt-3 font-weight-bold">URL for Lobby Video Embed:</p>
                    <el-input placeholder="Enter URL" v-model="vidURL" style="max-width:50%;"></el-input>
                    <p class="mt-3 mb-3"><em>Note: URLs must begin with 'https://'</em></p>
                    <el-button v-if="newStatus" @click="saveLobbySettings" class="mb-4" type="success">Save</el-button>
                    <el-button v-else @click="updateLobbySettings" class="mb-4" type="success">Update</el-button>                    
                </div>

            </div>
       

        </div>

    </div>
    
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            lobbySettings: [],
            vidName: "",
            vidURL: "",
            id: "",          
            newStatus: true,
            token: ''            
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
        getLobbySettings() {
            axios.get(`/api/lobby`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
                console.log(res.data)
				if(res.data.status_code === 200) {
                    if (res.data.data.length > 0) {
                        console.log(res.data.data.length)
                        this.vidName = res.data.data[0].video_name
                        this.vidURL = res.data.data[0].video_url
                        this.id = res.data.data[0].id
                        this.newStatus = false                 
                    } else {
                        console.log(res.data.data.length)
                        this.lobbySettings = res.data.data
                        this.newStatus = true                        
                    }
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        saveLobbySettings() {
            axios.post(`/api/lobby`, {
                video_name: this.vidName,
                video_url: this.vidURL},
                {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
                console.log(response)
                this.$message.success('Lobby Video URL successfully set.')
                this.getLobbySettings()
            })
            .catch(error => {
                this.$message.error('Error in setting Lobby Video URL.')
                console.log(error)
            })           
        },
        updateLobbySettings() {
            axios.put(`/api/lobby/update/${this.id}`, {
                video_name: this.vidName,
                video_url: this.vidURL},
                {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
                console.log(response)
                this.$message.success('Lobby Video URL successfully updated.')
                this.getLobbySettings()
            })
            .catch(error => {
                this.$message.error('Error in setting Lobby Video URL.')
                console.log(error)
            })           
        }            
   
    },
	mounted() {
        this.getTokenCookie()
        this.getLobbySettings()
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
