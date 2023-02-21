<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Sponsors / Booth Changes</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Pending Sponsors / Booth Changes</h1>
                    <div class="table-responsive">
                        <el-table
                            stripe
                            :data="booths"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'updated_at', order: 'descending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="name"
                                label="Name">
                            </el-table-column>
                            <el-table-column
                                prop="type"
                                label="Type">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.type_id === 1">Platinum</div>
                                    <div v-if="scope.row.type_id === 2">Gold</div>
                                    <div v-if="scope.row.type_id === 3">Silver</div>
                                    <div v-if="scope.row.type_id === 4">Bronze</div>
                                    <div v-if="scope.row.type_id === 5">Event Supporter</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="contact_email"
                                label="Email">
                            </el-table-column>                            
                            <el-table-column
                                prop="contact_number"
                                label="Contact Number">
                            </el-table-column>
                            <!-- <el-table-column
                                prop="stamps"
                                label="Stamps">
                            </el-table-column> -->
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button v-if="scope.row.type_id === 1" plain class="my-1 mx-0" size="mini" @click="$router.push('/admin/sponsors/booth/preview/platinum?id=' + scope.row.id)" type="primary" icon="el-icon-search">View Changes</el-button>
                                    <el-button v-if="scope.row.type_id === 2" plain class="my-1 mx-0" size="mini" @click="$router.push('/admin/sponsors/booth/preview/gold?id=' + scope.row.id)" type="primary" icon="el-icon-search">View Changes</el-button>
                                    <el-button v-if="scope.row.type_id === 3" plain class="my-1 mx-0" size="mini" @click="$router.push('/admin/sponsors/booth/preview/silver?id=' + scope.row.id)" type="primary" icon="el-icon-search">View Changes</el-button>
                                    <el-button v-if="scope.row.type_id === 4" plain class="my-1 mx-0" size="mini" @click="$router.push('/admin/sponsors/booth/preview/bronze?id=' + scope.row.id)" type="primary" icon="el-icon-search">View Changes</el-button>
                                    <el-button v-if="scope.row.type_id === 5" plain class="my-1 mx-0" size="mini" @click="$router.push('/admin/sponsors/booth/preview/supporter?id=' + scope.row.id)" type="primary" icon="el-icon-search">View Changes</el-button>
                                    <el-button plain class="my-1 mx-0" size="mini" @click="approveBoothConfirmation(scope.row.id)" type="success" icon="el-icon-check">Approve</el-button>
                                    <el-button plain class="my-1 mx-0" size="mini" @click="declineBoothConfirmation(scope.row.id)" type="danger" icon="el-icon-delete">Decline</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>
                    </div>                    
                </div>

            </div>
        </div>

    <el-dialog class="booth-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
        <img :src="currentImageView" />
    </el-dialog>
    <el-dialog class="booth-view-image" :visible.sync="dialogVideoTab" @close="clearVideo()">

    </el-dialog>
    <el-dialog class="booth-review-dialog" :title="'View Changes to ' + boothName" :visible.sync="dialogBoothDraft">
        <table width="100%" cellspacing="0" cellpadding="7">
            <tr v-if="boothDraft.logo_file">
                <td width="40%"><span class="font-weight-bold">Logo: </span></td>
                <td width="60%">
                    <el-button @click="openImage(boothDraft.logo_file)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.banner_file">
                <td><span class="font-weight-bold">Banner (Top): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.banner_file)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.bannerstand1">
                <td><span class="font-weight-bold">Banner Stand (Outer Left): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.bannerstand1)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.bannerstand3 && boothType === 1">
                <td><span class="font-weight-bold">Banner Stand (Inner Left): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.bannerstand3)" type="primary">View</el-button>
                    
                </td>
            </tr>
            <tr v-if="boothDraft.bannerstand2">
                <td><span class="font-weight-bold">Banner Stand (Outer Right): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.bannerstand2)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.bannerstand4 && boothType === 1">
                <td><span class="font-weight-bold">Banner Stand (Inner Right): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.bannerstand4)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.magazinestand1">
                <td><span class="font-weight-bold">Magazine Stand (Left): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.magazinestand1)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.magazinestand2 && (boothType === 1 || boothType === 2)">
                <td><span class="font-weight-bold">Magazine Stand (Right): </span></td>
                <td>
                    <el-button @click="openImage(boothDraft.magazinestand2)" type="primary">View</el-button>
                </td>
            </tr>
            <tr v-if="boothDraft.video_url1">
                <td><span class="font-weight-bold">Video 1: </span></td>
                <td>
                    <a :href="boothDraft.video_url1" target="_blank">Video 1 Link</a>
                    <!-- <el-button @click="openVideo(boothDraft.video_url1)" type="primary">View</el-button> -->
                </td>
            </tr>
            <tr v-if="boothDraft.video_url2">
                <td><span class="font-weight-bold">Video 2: </span></td>
                <td>
                    <a :href="boothDraft.video_url2" target="_blank">Video 2 Link</a>
                </td>
            </tr>
            <tr v-if="boothDraft.video_url3">
                <td><span class="font-weight-bold">Video 3: </span></td>
                <td>
                    <a :href="boothDraft.video_url3" target="_blank">Video 3 Link</a>
                </td>
            </tr>

        </table>
        <div class="review-approve-buttons text-center mt-3 pt-3">
            <el-button :loading="review_approving" :disabled="review_approving" @click="approveBoothConfirmation(boothDraft.sponsor_id)" type="success" icon="el-icon-check">Approve</el-button>
            <el-button :loading="review_approving" :disabled="review_approving" @click="declineBoothConfirmation(boothDraft.sponsor_id)" type="danger" icon="el-icon-delete">Decline</el-button>
        </div>
    </el-dialog>

    <el-dialog :visible.sync="approvalBoothTab">
        <div class="text-center">Are you sure you want to approve the changes for this booth?</div>
        <div class="text-center mt-3">
            <el-button :loading="is_approving" :disabled="is_approving" @click="approve()" type="success" icon="el-icon-check">Approve</el-button>
            <el-button @click="cancelApprove" type="info">Cancel</el-button>
        </div>
    </el-dialog>
    <el-dialog :visible.sync="declineBoothTab">
        <div class="text-center">Enter comments for declining selected booth:</div>
        <div>
            <el-input
            class="mt-3"
            type="textarea"
            :rows="3"
            placeholder="Comments"
            v-model="declineComment">
            </el-input>            
        </div>
        <div class="text-center mt-3">
            <el-button :loading="is_approving" :disabled="is_approving" @click="decline()" type="danger" icon="el-icon-delete">Decline</el-button>
            <el-button @click="cancelDecline" type="info">Cancel</el-button>
        </div>
    </el-dialog>    

    </div>
</template>

<script>
export default {
    data() {
        return {
            token: '',
            booths: [],
            boothDraft: [],
            boothName: '',
            boothType: '',
            currentImageView: '',
            currentVideoView: '',
            dialogImageTab: false,
            dialogVideoTab: false,
            dialogBoothDraft: false,
            review_approving: false,
            thisServerUrl: '',
            approvalBoothTab: false,
            declineBoothTab: false,
            is_approving: false,
            forApproveID: '',
            forDeclineID: '',
            declineComment: ''
        }
    },
    methods: {
        getBooths() {
            axios.get(`/api/sponsors/pendingbooth`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.booths = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			});	
        },
        viewBoothDraf(id, name, type) {
            this.boothDraft = []
            this.boothName = ''
            this.boothType = ''
            this.boothName = name
            this.boothType = type
            axios.get(`/api/sponsors/samplebooth/${id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.boothDraft = res.data
                    this.dialogBoothDraft = true
                    console.log(res.data)
                }
			})
			.catch(err => {
                // this.dialogBoothDraft = false
				console.log(err)
			});	
        },
        openImage(filepath) {
            // this.currentImageView = '/images/layout/loading.gif'
            this.dialogImageTab = true
            var fileurl = filepath.replace("public", "storage")
            this.currentImageView = this.thisServerUrl + fileurl
            // this.currentImageView = 'https://beta2.73rdpcrannualconvention.com/' + fileurl
        },
        clearImage() {
            this.currentImageView = ''
        },
        openVideo(videopath) {
            this.dialogVideoTab = true
            this.currentVideoView = videopath
        },
        clearVideo() {
            this.currentVideoView = ''
        },
        approveBoothConfirmation(id) {
            this.approvalBoothTab = true
            this.forApproveID = id
        },
        declineBoothConfirmation(id) {
            this.declineBoothTab = true
            this.forDeclineID = id
        },
        cancelApprove() {
            this.approvalBoothTab = false
            this.forApproveID = ''
        },
        cancelDecline() {
            this.declineBoothTab = false
            this.forDeclineID = ''
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
        approve() {
            var body = ''
            var id = this.forApproveID
            this.is_approving = true
            axios.put(`/api/sponsors/approvebooth/${id}`, body, {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.getBooths()
                    this.is_approving = false
                    this.approvalBoothTab = false
                    this.dialogBoothDraft = false
                    this.$notify({
                        message: 'Booth Changes Successfully Approved.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })                                     
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error approving booth changes.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.approvalBoothTab = false
                this.dialogBoothDraft = false
            })
        },
        decline() {
            var id = this.forDeclineID
            this.is_approving = true
            axios.put(`/api/sponsors/declinebooth/${id}`, {
                    comment: this.declineComment},
                    {
                    headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.getBooths()
                    this.is_approving = false
                    this.declineBoothTab = false
                    this.dialogBoothDraft = false
                    this.$notify({
                        message: 'Booth Changes Successfully Approved.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })                                     
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error approving booth changes.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.declineBoothTab = false
                this.dialogBoothDraft = false
            })
        },
        getCurrentURL() {
            var currentUrl = window.location.href
            // console.log('go: ' + currentUrl)
            if (currentUrl.includes('127.0.0.1')) {
                this.thisServerUrl = '/'
            } else {
                this.thisServerUrl = process.env.MIX_CONVENTION_LIVE_URL
            }
            console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
    },
    mounted: function () {
        this.getTokenCookie()
        this.getCurrentURL()
        this.getBooths()
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
.admin-conent h1 {
    color:#174A84;
    font-size:1rem;
    font-weight:bold;
    margin-bottom:20px;
}
.booths-admin-table th .cell {
    color:#131313;
}

.booth-view-image img {
    width:100%;
}
</style>
