<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Members / Non-Active</span>
            </div>              
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Non-Active Members</h1>
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-12 text-right">
                            <el-input
                                class="search-box"
                                placeholder="Search"
                                v-model="searchTerm"
                                @keyup.enter.native="getSearchResults">
                                <i slot="suffix" class="el-input__icon el-icon-search"></i>
                            </el-input>                            
                            <el-button class="ml-2" :loading="tableLoading" @click="getSearchResults">Search</el-button>
                        </div>
                        <div v-if="showSearchRes" class="col-sm-12 col-md-12 text-center">
                            <div class="show-search-res">
                                <span class="show-search-res-txt">Showing Search Results...</span>
                                <el-button class="ml-2" size="mini" type="info" :loading="tableLoading" @click="clearSearchResults">Clear</el-button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <el-table
                            v-loading="tableLoading"
                            stripe
                            :data="members.data"
                            class="member-pending-table"
                            style="width: 100%">
                            <el-table-column
                                prop="Name"
                                width="200"
                                label="Name"
                                class-name="cell-nowrap">
                                <template slot-scope="scope">
                                    <div class="table-user-name">{{ scope.row.last_name }}, {{ scope.row.first_name }}</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="email"
                                width="200"
                                label="Email">
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="prc_number"
                                width="150"
                                label="PRC Number">
                            </el-table-column>
                            <el-table-column
                                prop="is_trainee"
                                align="center"
                                width="100"
                                label="Residents">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.is_trainee === 0">NO</div>
                                    <div v-if="scope.row.is_trainee === 1">YES</div>
                                </template>                                
                            </el-table-column>
                            <el-table-column
                                prop="memberships"
                                label="Memberships">
                                <template slot-scope="scope">
                                    {{ checkMemberships(scope.row.memberships) }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="chapter_id"
                                label="PCR Chapter">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.chapter_id === 1">Northern Luzon</div>
                                    <div v-if="scope.row.chapter_id === 2">Central Luzon</div>
                                    <div v-if="scope.row.chapter_id === 3">Southern Luzon</div>
                                    <div v-if="scope.row.chapter_id === 4">NCR</div>
                                    <div v-if="scope.row.chapter_id === 5">Cebu</div>
                                    <div v-if="scope.row.chapter_id === 6">Negros</div>
                                    <div v-if="scope.row.chapter_id === 7">Panay Island</div>
                                    <div v-if="scope.row.chapter_id === 8">Southern Mindanao</div>
                                    <div v-if="scope.row.chapter_id === 9">Northern Mindanao</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="created_at"
                                align="center"
                                label="Application Date">
                                <template slot-scope="scope">
                                    <div>{{ scope.row.created_at | moment }}</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button plain class="my-1 mx-0" size="mini" :loading="is_approving" :disabled="is_approving" @click="review(scope.row.id)" type="primary" icon="el-icon-search">Review</el-button>
                                    <el-button plain class="my-1 mx-0" size="mini" :loading="is_approving" :disabled="is_approving" @click="approvalConfirmation(scope.row.id)" type="success" icon="el-icon-check">Approve</el-button>
                                    <el-button plain class="my-1 mx-0" size="mini" :loading="is_approving" :disabled="is_approving" @click="deleteConfirmation(scope.row.id)" type="danger" icon="el-icon-delete">Delete</el-button>                                    
                                </template>
                            </el-table-column>
                        </el-table>

                        <div class="block text-center mt-5" v-if="!showSearchRes">
                            <ul id="member-pages" class="pcr-pagination">
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedPendingMembers(members.first_page_url)" size="mini" plain type="primary">
                                        First
                                    </el-button>                                    
                                </li>
                                <li class="mx-1" v-for="page in members.links" :key="page.label">
                                    <el-button class="px-2" @click="getPagedPendingMembers(page.url)" size="mini" :plain="page.active ? false : true" type="primary">
                                        {{ paginLabel(page.label) }}
                                    </el-button>
                                </li>
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedPendingMembers(members.last_page_url)" size="mini" plain type="primary">
                                        Last
                                    </el-button>                                    
                                </li>                                
                            </ul>
                        </div>

                        <!-- <table class="table table-sm table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Contact Number</th>
                                <th class="text-center">Registration Date</th>
                                <th class="text-center">Actions</th>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in members" :key="item.id">
                                    <td>{{fullname(item)}}</td>
                                    <td>{{item.email}}</td>
                                    <td>
                                        <div v-if="item.reg_type_id === 1">PCR Member</div>
                                        <div v-if="item.reg_type_id === 2">Resident in Training</div>
                                        <div v-if="item.reg_type_id === 3">Non-PCR Member</div>
                                        <div v-if="item.reg_type_id === 4">Fellow in Training</div>
                                        <div v-if="item.reg_type_id === 5">RadTech</div>
                                        <div v-if="item.reg_type_id === 6">Foreign Delegate</div>
                                        <div v-if="item.reg_type_id === 7">Other<span v-if="item.reg_type_other">: {{ item.reg_type_other }}</span></div>
                                    </td>
                                    <td>{{item.contact_number}}</td>
                                    <td class="text-center">{{ item.created_at | moment }}</td>
                                    <td class="text-center">
                                        <el-button size="mini" :loading="is_approving && indexClicked === index" :disabled="is_approving && indexClicked === index" @click="review(item.id)" type="primary" icon="el-icon-search">Review</el-button>
                                        <el-button size="mini" :loading="is_approving && indexClicked === index" :disabled="is_approving && indexClicked === index" @click="approve(item.id, index)" type="success" icon="el-icon-check">Approve</el-button>
                                        <el-button size="mini" :loading="is_approving && indexClicked === index" :disabled="is_approving && indexClicked === index" @click="deny(item.id, index)" type="danger" icon="el-icon-delete">Delete</el-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </div>
    <el-dialog :visible.sync="approvalConfirmationTab">
        <div class="text-center">Are you sure you want to approve the pending registration for this user?</div>
        <div class="text-center mt-3">
            <el-button :loading="is_approving" :disabled="is_approving" @click="approve()" type="success" icon="el-icon-check">Approve</el-button>
            <el-button @click="cancelApprove" type="info">Cancel</el-button>
        </div>
    </el-dialog>
    <el-dialog :visible.sync="deleteConfirmationTab">
        <div class="text-center">Are you sure you want to delete the pending registration for this user?</div>
        <div class="text-center mt-3">
            <el-button :loading="is_approving" :disabled="is_approving" @click="deleteReg()" type="danger" icon="el-icon-delete">Delete</el-button>
            <el-button @click="cancelDelete" type="info">Cancel</el-button>
        </div>
    </el-dialog>
    <el-dialog class="member-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
        <img :src="currentImageView" />
    </el-dialog>
    <el-dialog class="member-review-dialog" title="Review Member Application" :visible.sync="dialogReviewTab">
        <table width="100%" cellspacing="0" cellpadding="7">
            <!-- <tr>
                <td><span class="font-weight-bold">Profile Photo: </span></td>
                <td>
                    <el-button @click="openImage(currentReview.prc_upload)" type="primary">View</el-button>
                </td>
            </tr> -->        
            <tr>
                <td width="30%"><span class="font-weight-bold">First Name: </span></td>
                <td width="70%">{{ currentReview.first_name }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Middle Name: </span></td>
                <td>{{ currentReview.middle_name }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Last Name: </span></td>
                <td>{{ currentReview.last_name }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Email: </span></td>
                <td>{{ currentReview.email }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Contact Number: </span></td>
                <td>{{ currentReview.contact_number }}</td>
            </tr>
            <tr v-if="currentReview.prc_number != 0">
                <td><span class="font-weight-bold">PRC Number: </span></td>
                <td>{{ currentReview.prc_number }}</td>
            </tr>            
            <tr>
                <td  valign="top"><span class="font-weight-bold">Address: </span></td>
                <td>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-1">City: {{ review_address_split[0] }}</div>
                            <div>State/Region: {{ review_address_split[1] }}</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div>Country: {{ review_address_split[2] }}</div>
                            <div>Zip Code: {{ review_address_split[3] }}</div>                            
                        </div>
                    </div>
                </td>                
            </tr>
            <tr>
                <td><span class="font-weight-bold">Resident in Training: </span></td>
                <td>
                    <div v-if="currentReview.is_trainee === 0">NO</div>
                    <div v-if="currentReview.is_trainee === 1">YES</div>
                </td>
            </tr>
            <tr v-if="currentReview.is_trainee === 1">
                <td><span class="font-weight-bold">Training Institution: </span></td>
                <td>
                    {{ currentReview.training_ins }}
                </td>
            </tr>
            <tr v-if="currentReview.is_trainee === 0">
                <td><span class="font-weight-bold">Membership: </span></td>
                <td>{{ checkMemberships(currentReview.memberships) }}</td>
            </tr>
            <tr v-if="currentReview.is_trainee === 0">
                <td><span class="font-weight-bold">PRC Chapter: </span></td>
                <td>
                    <div v-if="currentReview.chapter_id === 1">Northern Luzon</div>
                    <div v-if="currentReview.chapter_id === 2">Central Luzon</div>
                    <div v-if="currentReview.chapter_id === 3">Southern Luzon</div>
                    <div v-if="currentReview.chapter_id === 4">NCR</div>
                    <div v-if="currentReview.chapter_id === 5">Cebu</div>
                    <div v-if="currentReview.chapter_id === 6">Negros</div>
                    <div v-if="currentReview.chapter_id === 7">Panay Island</div>
                    <div v-if="currentReview.chapter_id === 8">Southern Mindanao</div>
                    <div v-if="currentReview.chapter_id === 9">Northern Mindanao</div>
                </td>
            </tr>
            <!--
            <tr>
                <td><span class="font-weight-bold">Deposit Slip: </span></td>
                <td>
                    <el-button @click="openImage(currentReview.payment_file_path)" type="primary">View</el-button>
                </td>
            </tr>
            -->
        </table>
        <div class="review-approve-buttons text-center mt-3 pt-3">
            <el-button :loading="review_approving" :disabled="review_approving" @click="approvalConfirmation(currentReview.id)" type="success" icon="el-icon-check">Approve</el-button>
            <el-button :loading="review_approving" :disabled="review_approving" @click="deleteConfirmation(currentReview.id)" type="danger" icon="el-icon-delete">Delete</el-button>
        </div>
    </el-dialog>        
    </div>
</template>

<script>
const _spinner = '<i class="fa fa-spinner fa-spin"></i>';

import moment from 'moment'

export default {
    data() {
        return {
            members: [],
            review_address_split: [],
            spinner: _spinner,
            is_approving: false,
            indexClicked: '',
            currentReview: [],
            dialogReviewTab: false,
            dialogImageTab: false,
            currentImageView: '',
            review_approving: false,
            approvalConfirmationTab: false,
            deleteConfirmationTab: false,
            forApproveID: '',
            forDeleteID: '',
            token: '',
            thisServerUrl: '',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false
        }
    },
    created() {
        this.getInitialPendingMembers();
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM DD YYYY');
        }
    },      
    methods: {
        fullname(item) {
            return item.first_name + " " + item.last_name;
        },

        residentInTraining(val) {
            return val ? "YES" : "NO";
        },
        getSearchResults() {
            this.tableLoading = true
            axios.get(`/api/pcr/search?keyword=${this.searchTerm}`, {
                headers: { "Authorization": "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.members.data = res.data;
                    console.log(this.members.data)
                    this.tableLoading = false
                    this.showSearchRes = true
                }
			})
			.catch(err => {
                console.log(err)
                this.tableLoading = false
			});		
        },
        clearSearchResults () {
            this.searchTerm = ''
            this.showSearchRes = false
            this.getInitialPendingMembers()
        },
        getInitialPendingMembers() {
            this.tableLoading = true
            axios.get(`/admin/members/pending/get?page=1`)
			.then(res => {
				if(res.data) {
                    this.members = res.data;
                    console.log(this.members)
                    this.tableLoading = false
                }
			})
			.catch(err => {
                console.log(err)
                this.tableLoading = false
			});		
        },
        getPagedPendingMembers(url) {
            if (!url) {

            } else {
                this.tableLoading = true
                axios.get(url)
                .then(res => {
                    if(res.data) {
                        this.members = res.data;
                        console.log(this.members)
                        this.tableLoading = false
                    }
                })
                .catch(err => {
                    console.log(err)
                    this.tableLoading = false
                });	
            }
        },
        approvalConfirmation(id) {
            this.approvalConfirmationTab = true
            this.forApproveID = id
        },
        deleteConfirmation(id) {
            this.deleteConfirmationTab = true
            this.forDeleteID = id
        },        
        cancelApprove() {
            this.approvalConfirmationTab = false
            this.forApproveID = ''
        },
        cancelDelete() {
            this.deleteConfirmationTab = false
            this.forDeleteID = ''
        },
        approve() {
            var id = this.forApproveID
            this.is_approving = true
            axios.put(`/admin/members/pending/${id}/approve`)
            .then(res => {
                if(res.data) {
                    this.getInitialPendingMembers();
                    this.is_approving = false
                    this.approvalConfirmationTab = false
                    this.dialogReviewTab = false
                    this.$notify({
                        message: 'Selected application has been approved.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })                                     
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error approving selected application.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.approvalConfirmationTab = false
                this.dialogReviewTab = false
            })
        },
        deleteReg() {
            var id = this.forDeleteID
            this.is_approving = true
            axios.put('/api/member/decline/' + id, {
                headers: { "Authorization": "Bearer " + this.token }
            }).then(res => {
                if(res.data) {
                    this.getInitialPendingMembers();
                    this.is_approving = false
                    this.deleteConfirmationTab = false
                    this.dialogReviewTab = false
                    this.$notify({
                        message: 'Selected application has been deleted.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })                                     
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error deleting selected application.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.deleteConfirmationTab = false
                this.dialogReviewTab = false
            })
        },
        approveReview(id) {
            this.review_approving = true
            axios.put(`/admin/registration/pending/${id}/approve`)
            .then(res => {
                this.getInitialPendingMembers();
                this.review_approving = false
                this.dialogReviewTab = false
                this.$notify({
                    message: 'Selected registrant has been approved.',
                    type: 'success',
                    customClass: 'pcr-login-error',
                    position: 'bottom-right'
                })  
            })
            .catch(err => {
                console.log(err);
                this.review_approving = false
				this.$notify({
					message: 'Error approving selected registrant.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
				})
            })
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
        checkMemberships(mem) {
            var memberships = []
            if (!mem) {
                memberships.push('None Selected')
            } else {
                if (mem.includes('1')) {
                    memberships.push('DBPR')
                }
                if (mem.includes('2')) {
                    memberships.push('FPCR')
                }
                if (mem.includes('3')) {
                    memberships.push('FUSP')
                }
                if (mem.includes('4')) {
                    memberships.push('FCT-MRISP')
                }
                if (mem.includes('5')) {
                    memberships.push('FPSVIR')
                }
                if (mem.includes('6')) {
                    memberships.push('FPROS')
                }
            }
            return memberships.join(', ')
        },
        review (id) {
            this.dialogReviewTab = true
            this.is_approving = true
            axios.get('/api/pcr/member/' + id, {
                headers: { "Authorization": "Bearer " + this.token }
            }).then(response => {
				if(response.data) {
                    this.currentReview = response.data
                    console.log(response.data)
                    this.is_approving = false
                    var address = this.currentReview.address.slice(0, -1)
                    var address_array = address.split(',')
                    this.review_address_split = address_array
                    console.log(this.review_address_split)
                }
			})
			.catch(error => {
                console.log(error);
                this.is_approving = false
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
        getCurrentURL() {
            var currentUrl = window.location.href
            // console.log('go: ' + currentUrl)
            if (currentUrl.includes('127.0.0.1')) {
                this.thisServerUrl = ''
            } else {
                this.thisServerUrl = process.env.MIX_CONVENTION_LIVE_URL
            }
            console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
        paginLabel(label) {
            var currentLabel = String(label)
            if (currentLabel.includes('Previous')) {
                return '<'
            } else if (currentLabel.includes('Next')) {
                return '>'
            } else {
                return currentLabel
            }
        }
    },
    mounted: function () {
        this.getTokenCookie()
        this.getCurrentURL()
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
.review-approve-buttons {
    border-top:1px solid #ccc;
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
.cell-actions button {
    width:100%;
}
.member-review-dialog .el-dialog {
    margin-top:5vh!important;
}
.member-review-dialog .el-dialog__body {
    padding-top:10px;
}
.member-review-dialog .el-dialog__title {
    font-weight:bold;
}
.member-pending-table th,
.member-pending-table th .cell {
    color:#131313;
    word-break:normal!important;
}
.member-view-image img {
    width:100%;
}
.pcr-pagination,
.pcr-pagination li {
    display: inline;
}

.member-pending-table .el-table__row .cell {
    word-break: normal!important;
    text-overflow: clip!important;
}
.table-user-name {
    text-transform:uppercase;
}
.cell-nowrap .cell {
    white-space: nowrap!important;
}
.search-box {
    max-width:250px;
}
.show-search-res {
    margin-top: 20px;
    border-top:1px solid #dadada;
    border-bottom:1px solid #dadada;
    padding: 10px 0;
}
.show-search-res-txt {
    font-weight:bold;
}
</style>
