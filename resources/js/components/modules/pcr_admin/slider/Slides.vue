<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Virtual Exhibitor Slider</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Virtual Exhibitor Slider</span>
                    <el-button @click="$router.push('/admin/slider/add')" type="primary" size="mini" class="sponsors-add-btn ml-3">Add New Slide</el-button>
                        <el-table
                            stripe
                            :data="slides"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'updated_at', order: 'descending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="title"
                                label="Title">
                            </el-table-column>
                            <el-table-column
                                prop="body_text"
                                label="Description">
                            </el-table-column>
                            <el-table-column
                                prop="order"
                                align="center"
                                label="Order Number">
                            </el-table-column>
                            <el-table-column
                                prop="updated_at"
                                label="Update On">
                                <template slot-scope="scope">
                                    <div>{{ scope.row.updated_at | moment }}</div>
                                </template>                                
                            </el-table-column>                            
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button plain class="my-1 mx-0" size="mini" @click="editSlide(scope.row.id)" type="primary" icon="el-icon-edit">Edit</el-button>
                                    <el-button plain class="my-1 mx-0" size="mini" @click="deleteConfirm(scope.row.id)" type="danger" icon="el-icon-edit">Delete</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>                   
                </div>

            </div>
        </div>
      
        <el-dialog :visible.sync="deleteConfirmationTab">
            <div class="text-center">Are you sure you want to delete this slide?</div>
            <div class="text-center mt-3">
                <el-button :loading="is_processing" :disabled="is_processing" @click="deleteSlide()" type="danger" icon="el-icon-delete">Delete</el-button>
                <el-button @click="cancelDelete" type="info">Cancel</el-button>
            </div>
        </el-dialog>

    </div>
    
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            slides: [],
            editSponsorsDialog: false,
            token: '',
            deleteConfirmationTab: false,
            is_processing: false,
            forDeleteID: ''
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
        getAllslides() {
            axios.get(`/api/pcr/ads/all`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.slides = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        editSlide(id) {
            this.$router.push('/admin/slider/edit?id=' + id)
        },
        deleteConfirm(id) {
            this.deleteConfirmationTab = true
            this.forDeleteID = id
        },
        cancelDelete() {
            this.deleteConfirmationTab = false
            this.forDeleteID = ''
        },        
        deleteSlide() {
            this.is_processing = true
            var id = this.forDeleteID
            axios.delete(`/api/pcr/ads/delete/${id}/`, { 
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
                console.log(res.data)
                this.forDeleteID = ''
                this.deleteConfirmationTab = false
                this.getAllslides()
                this.$message.success('Slide successfully deleted.')
                this.is_processing = false
			})
			.catch(err => {
                console.log(err)
                this.forDeleteID = ''
                this.deleteConfirmationTab = false
                this.getAllslides()
                this.$message.error('Error deleting slide.')
                this.is_processing = false
			})
        }
    },
	mounted() {
        this.getTokenCookie()
		this.getAllslides()
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
