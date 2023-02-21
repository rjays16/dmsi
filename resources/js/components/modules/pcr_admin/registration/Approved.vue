<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Registrations / Approved</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Approved Registrations</h1>
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
                            class="reg-approved-table"
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
                                prop="email"
                                width="200"
                                label="Email">
                            </el-table-column>
                            <el-table-column
                                prop="type"
                                label="Type">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.reg_type_id === 1">PCR Member</div>
                                    <div v-if="scope.row.reg_type_id === 2">Resident in Training</div>
                                    <div v-if="scope.row.reg_type_id === 3">Non-PCR Member</div>
                                    <div v-if="scope.row.reg_type_id === 4">Fellow in Training</div>
                                    <div v-if="scope.row.reg_type_id === 5">RadTech</div>
                                    <div v-if="scope.row.reg_type_id === 6">Foreign Delegate</div>
                                    <div v-if="scope.row.reg_type_id === 7">Other<span v-if="scope.row.reg_type_other">: {{ scope.row.reg_type_other }}</span></div>                                    
                                </template>
                            </el-table-column>
                            <el-table-column
                                class-name="cell-nowrap"
                                prop="prc_number"
                                width="150"
                                label="PRC Number">
                                <template slot-scope="scope">
                                    <div v-if="scope.row.prc_number === '0'"></div>
                                    <div v-else>{{ scope.row.prc_number }}</div>
                                </template>                                
                            </el-table-column>
                            <el-table-column
                                prop="contact_number"
                                label="Contact Num">
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
                                label="Details"
                                align="center"
                                class-name="cell-actions">
                                <template slot-scope="scope">
                                    <el-button plain class="my-1 mx-0" size="mini" @click="review(scope.row.id)" type="primary" icon="el-icon-search">Details</el-button>
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
                                <th>Contact Number</th>
                                <th class="text-center">Approval Date</th>
                            </thead>
                            <tbody>
                                <tr v-for="item in members" :key="item.id">
                                    <td>{{fullname(item)}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.contact_number}}</td>
                                    <td class="text-center">{{ item.updated_at | moment }}</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>                    
                </div>

            </div>
        </div>
    <el-dialog class="reg-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
        <img :src="currentImageView" />
    </el-dialog>
    <el-dialog class="reg-review-dialog" title="View Details for Convention Attendee" :visible.sync="dialogReviewTab">
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
                <td><span class="font-weight-bold">Suffix: </span></td>
                <td>
                    <div v-if="currentReview.suffix_name">{{ currentReview.suffix_name }}</div>
                    <div v-else>None</div>                    
                </td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Professional Suffix: </span></td>
                <td>{{ currentReview.prof_suffix }} <span v-if="currentReview.prof_suffix_other">: {{ currentReview.prof_suffix_other }}</span></td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Email: </span></td>
                <td>{{ currentReview.email }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Contact Number: </span></td>
                <td>{{ currentReview.contact_number }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Address: </span></td>
                <td valign="top">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-1">City: {{ currentReview.city }}</div>
                            <div>State/Region: {{ currentReview.state }}</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div>Country: {{ currentReview.country }}</div>
                            <div>Zip Code: {{ currentReview.zip_code }}</div>                            
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Type / Category: </span></td>
                <td>
                    <div v-if="currentReview.reg_type_id === 1">PCR Member</div>
                    <div v-if="currentReview.reg_type_id === 2">Resident in Training</div>
                    <div v-if="currentReview.reg_type_id === 3">Non-PCR Member</div>
                    <div v-if="currentReview.reg_type_id === 4">Fellow in Training</div>
                    <div v-if="currentReview.reg_type_id === 5">RadTech</div>
                    <div v-if="currentReview.reg_type_id === 6">Foreign Delegate</div>
                    <div v-if="currentReview.reg_type_id === 7">Other<span v-if="currentReview.reg_type_other">: {{ currentReview.reg_type_other }}</span></div>                  
                </td>
            </tr>
            <tr v-if="currentReview.reg_type_id === 1">
                <td><span class="font-weight-bold">Membership: </span></td>
                <td>{{ checkMemberships(currentReview.memberships) }}</td>
            </tr>
            <tr v-if="currentReview.reg_type_id === 1">
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
            <tr  v-if="currentReview.reg_type_id === 2 || currentReview.reg_type_id === 3">
                <td><span class="font-weight-bold">Training Institution: </span></td>
                <td>{{ currentReview.training_ins }}</td>
            </tr>
            <tr v-if="currentReview.prc_number != 0">
                <td><span class="font-weight-bold">PRC Number: </span></td>
                <td>{{ currentReview.prc_number }}</td>
            </tr>
            <tr v-if="currentReview.prc_number != 0">
                <td><span class="font-weight-bold">Date of Expiration: </span></td>
                <td>{{ currentReview.date_of_expiration | moment }}</td>
            </tr>
            <tr v-if="currentReview.prc_number != 0">
                <td><span class="font-weight-bold">PRC ID Photo: </span></td>
                <td>
                    <div v-if="currentReview.prc_upload">
                        <el-button @click="openImage(currentReview.prc_upload)" type="primary">View</el-button>
                    </div>
                    <div v-else>None uploaded</div>
                </td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Type of Payment: </span></td>
                <td>{{ currentReview.type_of_payment }}</td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Date of Payment: </span></td>
                <td>
                    {{ currentReview.date_of_payment | moment }}
                </td>
            </tr>
            <tr>
                <td><span class="font-weight-bold">Proof of Payment: </span></td>
                <td>
                    <div v-if="currentReview.payment_file_path !== 'none'">
                        <el-button @click="openImage(currentReview.payment_file_path)" type="primary">View</el-button>
                    </div>
                    <div v-else>None uploaded</div>
                </td>
            </tr>            
        </table>
    </el-dialog>        
    </div>
</template>

<script>

import moment from 'moment'

export default {
    data() {
        return {
            members: [],
            currentReview: [],
            dialogReviewTab: false,
            token: '',
            thisServerUrl: '',
            dialogImageTab: false,
            currentImageView: '',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false
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
        getSearchResults() {
            this.tableLoading = true
            axios.get(`/api/convention/search?keyword=${this.searchTerm}`, {
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
            axios.get(`/admin/registration/approved/get`)
			.then(res => {
				if(res.data) {
                    this.members = res.data;
                    console.log(res.data)
                    this.tableLoading = false
                }
			})
			.catch(err => {
                console.log(err)
                this.tableLoading = false
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
                    this.tableLoading = false
                });	
            }
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
        approve(id) {
            axios.put(`/admin/registration/pending/${id}/approve`)
            .then(res => {
                if(res.data) {
                    this.getPendingMembers();
                }
            })
            .catch(err => {
                console.log(err);
            })
        },
        review (id) {
            this.dialogReviewTab = true
            axios.get('/api/convention/profile/' + id, {
                headers: { "Authorization": "Bearer " + this.token }
            }).then(response => {
				if(response.data) {
                    this.currentReview = response.data
                    console.log(response.data)
                }
			})
			.catch(error => {
                console.log(error);
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
.reg-approved-table th .cell {
    color:#131313;
}
.reg-approved-table .el-table__row .cell {
    word-break: normal!important;
} 
.table-user-name {
    text-transform:uppercase;
}
</style>
