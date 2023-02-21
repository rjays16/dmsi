<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="mt-2">
                            <i class="el-icon-s-home"></i>
                            <span> / Members / Active</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <el-button size="small" type="success" @click="getAllApprovedMembers()">Export</el-button>

                    </div>
                </div>                
            </div>              
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Active Members</h1>
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
                            class="member-approved-table"
                            style="width: 100%">
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="Name"
                                width="200"
                                label="Name">
                                <template slot-scope="scope">
                                    <div class="table-user-name">{{ scope.row.last_name }}, {{ scope.row.first_name }}</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                width="200"
                                prop="email"
                                label="Email">
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                width="150"
                                prop="prc_number"
                                label="PRC Number">
                            </el-table-column>
                            <el-table-column
                                prop="is_trainee"
                                align="center"
                                width="100"
                                label="Residents">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.is_trainee === 1">Yes</div>
                                    <div v-if="scope.row.is_trainee === 0">No</div>
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
                                label="PRC Chapter">
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
                                prop="updated_at"
                                align="center"
                                label="Approval Date">
                                <template slot-scope="scope">
                                    <div>{{ scope.row.updated_at | moment }}</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="actions"
                                label="View Details"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button plain class="my-1 mx-0" size="mini" :loading="is_approving" :disabled="is_approving" @click="review(scope.row.id)" type="primary" icon="el-icon-search">Details</el-button>
                                </template>
                            </el-table-column>                             
                        </el-table>

                        <div class="block text-center mt-5" v-if="!showSearchRes">
                            <ul id="member-pages" class="pcr-pagination">
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedApprovedMembers(members.first_page_url)" size="mini" plain type="primary">
                                        First
                                    </el-button>                                    
                                </li>
                                <li class="mx-1" v-for="page in members.links" :key="page.label">
                                    <el-button class="px-2" @click="getPagedApprovedMembers(page.url)" size="mini" :plain="page.active ? false : true" type="primary">
                                        {{ paginLabel(page.label) }}
                                    </el-button>
                                </li>
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedApprovedMembers(members.last_page_url)" size="mini" plain type="primary">
                                        Last
                                    </el-button>                                    
                                </li>                                
                            </ul>
                        </div>                        

                        <!-- <table class="table table-sm table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>PRC Number</th>
                                <th>Resident in Training</th>
                                <th>Membership</th>
                                <th>PCR Chapter</th>
                                <th class="text-center">Approval Date</th>
                            </thead>
                            <tbody>
                                <tr v-for="item in members" :key="item.id">
                                    <td>{{fullname(item)}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.prc_number}}</td>
                                    <td>{{residentInTraining(item.is_trainee)}}</td>
                                    <td>{{item.mem_type_id}}</td>
                                    <td></td>
                                    <td class="text-center">{{ item.updated_at | moment }}</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>

                    <div class="table-responsive d-none export-table mt-5">
                        <el-table
                            v-loading="tableLoading"
                            ref="memberTable"
                            stripe
                            :data="allMembers"
                            class="member-approved-table"
                            style="width: 100%">
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="last_name"
                                width="200"
                                label="Last Name">
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="first_name"
                                width="200"
                                label="First Name">
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                width="200"
                                prop="email"
                                label="Email">
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                width="150"
                                prop="prc_number"
                                label="PRC Number">
                            </el-table-column>
                            <el-table-column
                                prop="email"
                                align="center"
                                width="100"
                                label="Resident"
                                :formatter="residentFormatter">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.is_trainee === 1">Yes</div>
                                    <div v-if="scope.row.is_trainee === 0">No</div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="memberships"
                                label="Memberships"
                                :formatter="membershipFormatter">
                            </el-table-column>
                            <el-table-column
                                prop="chapter_id"
                                label="PRC Chapter"
                                :formatter="chapterFormatter">
                            </el-table-column>
                            <el-table-column
                                prop="updated_at"
                                align="center"
                                label="Approval Date">
                                <template slot-scope="scope">
                                    <div>{{ scope.row.updated_at | moment }}</div>
                                </template>
                            </el-table-column>
                           
                        </el-table>
                        

                    </div>                    
                </div>

            </div>
        </div>

    <el-dialog :visible.sync="exportDialog" class="export-dialog">
        <div v-if="exportProgress">
            Please wait while active member data is being loaded. Depending on the number of members, this may take a few minutes.
        </div>
        <div v-else>
            Member data is now ready to be exported. Please click on 'Start Export' to export the data to CSV.
        </div>
        <div v-loading="exportProgress" class="mt-4">
            <el-button type="success" @click="exportFile()">Start Export</el-button>
            <el-button type="primary" @click="exportDialog = false">Cancel</el-button>
        </div>
    </el-dialog>
    <el-dialog class="member-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
        <img :src="currentImageView" />
    </el-dialog>
    <el-dialog class="member-review-dialog" title="View Member Details" :visible.sync="dialogReviewTab">
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
            
            <tr>
                <td><span class="font-weight-bold">Deposit Slip: </span></td>
                <td>
                    <div v-if="currentReview.deposit_slip">
                    <el-button @click="openImage(currentReview.deposit_slip)" type="primary">View</el-button>
                    </div>
                    <div v-else>None uploaded</div>
                </td>
            </tr>

        </table>
    </el-dialog>        
    </div>
</template>

<script>
const _spinner = '<i class="fa fa-spinner fa-spin"></i>';

import moment from 'moment'

import elTableExport from "el-table-export"

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
            thisServerUrl: window.location.origin + '/',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false,
            supportType: ["csv", "txt", "json", "xls"],
            exportType: "csv",
            exportDialog: false,
            exportProgress: false,
            allMembers: []
        }
    },
    created() {
        this.getInitialApprovedMembers();
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
        checkMemberships(mem) {
            var memberships = []
            if (mem) {
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
                return memberships.join(', ')
            } else {
                return ''
            }

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
            this.getInitialApprovedMembers()
        },
        getInitialApprovedMembers() {
            this.tableLoading = true
            axios.get(`/admin/members/approved/get`)
			.then(res => {
				if(res.data) {
                    this.members = res.data
                    console.log(this.members)
                    this.tableLoading = false
                }
			})
			.catch(err => {
                console.log(err)
                this.tableLoading = false
			});		
        },
        getAllApprovedMembers() {
            this.exportDialog = true
            this.exportProgress = true
            axios.get(`/api/getallmembers`)
			.then(res => {
				if(res.data) {
                    this.allMembers = res.data
                    this.exportProgress = false
                    console.log(res.data)
                }
			})
			.catch(err => {
                console.log(err)
			});		
        },        
        getPagedApprovedMembers(url) {
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
                    this.tableLoading = true
                });	
            }
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
        paginLabel(label) {
            var currentLabel = String(label)
            if (currentLabel.includes('Previous')) {
                return '<'
            } else if (currentLabel.includes('Next')) {
                return '>'
            } else {
                return currentLabel
            }
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
        exportFile() {
            elTableExport(this.$refs.memberTable, {
                fileName: "approved-members",
                type: this.exportType,
                useFormatter: true,
            })
                .then(() => {
                    console.info("ok");
                    this.exportDialog = false
                })
                .catch((err) => {
                    console.info(err);
                    this.exportDialog = false
                });
        },
        nameFormatter(row, column) {
            return row.last_name + ', ' + row.first_name
        },
        residentFormatter(row, column) {
            if (row.is_trainee === 0) {
                return 'No'
            } else {
                return 'Yes'
            }
        },
        membershipFormatter(row, column) {
            var memberships = []
            if (row.memberships) {
                if (row.memberships.includes('1')) {
                    memberships.push('DBPR')
                }
                if (row.memberships.includes('2')) {
                    memberships.push('FPCR')
                }
                if (row.memberships.includes('3')) {
                    memberships.push('FUSP')
                }
                if (row.memberships.includes('4')) {
                    memberships.push('FCT-MRISP')
                }
                if (row.memberships.includes('5')) {
                    memberships.push('FPSVIR')
                }
                if (row.memberships.includes('6')) {
                    memberships.push('FPROS')
                }
                return memberships.join(', ')
            } else {
                return 'None Selected'
            }
        },
        chapterFormatter(row, column) {
            if (row.chapter_id === 1) {
                return 'Northern Luzon'
            } else if (row.chapter_id === 2) {
                return 'Central Luzon'
            } else if (row.chapter_id === 3) {
                return 'Southern Luzon'
            } else if (row.chapter_id === 4) {
                return 'NCR'
            } else if (row.chapter_id === 5) {
                return 'Cebu'
            } else if (row.chapter_id === 6) {
                return 'Negros'
            } else if (row.chapter_id === 7) {
                return 'Panay Island'
            } else if (row.chapter_id === 8) {
                return 'Southern Mindanao'
            } else if (row.chapter_id === 9) {
                return 'Northern Mindanao'
            }
        }
    },
    mounted: function () {
        this.getTokenCookie()
        //this.getCurrentURL()
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
.member-approved-table th {
    color:#131313;
}
.member-approved-table th .cell {
    word-break: normal;
}

.member-approved-table .el-table__row .cell {
    word-break: normal!important;
}
.table-user-name {
    text-transform:uppercase;
}
.export-dialog .el-dialog__body {
    word-break: normal!important;
    text-align: center;
}
</style>
