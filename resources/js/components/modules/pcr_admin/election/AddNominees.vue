<template>

    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Elections / Add Nominees</span>
            </div>  
            
            <div class="container-fluid my-5" v-if="activeperiod === 1">
                   
                <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                         <h1>Nominees</h1> 
              
                     <div class="row mb-4">
                        <div class="col-sm-12 col-md-12 text-right float-left">
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
                                class="election-nominee-table"
                                @row-click="review"
                                ref="tableData"
                                style="width: 100%">
                                <el-table-column
                                    prop="name"
                                    label="Name">
                                    <template slot-scope="scope">
                                        <div class="table-user-fname">{{ fullname(scope.row)}} {{ scope.row.suffix_name }}</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="email"
                                    label="Email">
                                    <template slot-scope="scope">
                                        <div class="table-user-lname">{{ scope.row.email }}</div>
                                    </template>
                                </el-table-column>
                               
                                <el-table-column
                                    prop="prc_number"
                                    label="PRC Number">
                                    <template slot-scope="scope">
                                        <div class="table-user-suffx">{{ scope.row.prc_number }}</div>
                                    </template>
                                </el-table-column>
                                 <el-table-column
                                    prop="pcr_chapter"
                                    label="PCR Chapter">
                                    <template slot-scope="scope">
                                        <div class="table-user-suffx" v-if="scope.row.pcr_chapter !== null">{{ scope.row.pcr_chapter.chapter_name }}</div>
                                        <div class="table-user-suffx" v-else>N/A</div>
                                    </template>
                                </el-table-column>
                            </el-table>
                           <div class="block text-center mt-5" v-if="!showSearchRes">
                            <ul id="member-pages" class="pcr-pagination">
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedMembers(members.first_page_url)" size="mini" plain type="primary">
                                        First
                                    </el-button>                                    
                                </li>
                                <li class="mx-1" v-for="page in members.links" :key="page.label">
                                    <el-button class="px-2" @click="getPagedMembers(page.url)" size="mini" :plain="page.active ? false : true" type="primary">
                                        {{ paginLabel(page.label) }}
                                    </el-button>
                                </li>
                                <li class="mx-1">
                                    <el-button class="px-1" @click="getPagedMembers(members.last_page_url)" size="mini" plain type="primary">
                                        Last
                                    </el-button>                                    
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
                </div>  
         
            </div>
        </div>

        <el-dialog class="member-nominate-dialog" title="" :visible.sync="dialogReviewTab">
               <div class="profile-holder">
                   <img :src="profilePic(currentReview.profile_pic)"><br/><br/>
                   <span class="profile-name">{{fullname(currentReview)}} {{currentReview.suffix_name}}, {{currentReview.prof_suffix}}</span>
                   <br/>
                   <span class="suffix-name">{{currentReview.prof_suffix_other}}</span>
               </div>
               <br/><br/>
               <span>Short Biography ({{remaincharactersText}})</span> 
               <div v-if="$v.short_bio.$dirty">
                    <div class="invalid-field" v-if="!$v.short_bio.required">Required</div>
                </div>  
                <el-input @keyup.native ="remaincharCount()"
                        class="mb-3"
                        type="textarea"
                        :rows=5
                        :maxlength="160"
                        v-model="short_bio">
                      </el-input>
               <el-button class="mt-4  " type="primary" @click="confirmationTab()">Nominate</el-button>
        </el-dialog>  
         <el-dialog :visible.sync="nominateConfirmationTab">
            <div class="text-center">Are you sure you want to nominate the selected member?</div>
            <div class="text-center mt-3">
                <button type="button" class="el-button my-1 mx-0 el-button--primary is-plain  nomite-btn"   @click="nominate()"><span>Confirm</span></button>       
                <el-button @click="cancelNominate" type="info">Cancel</el-button>
            </div>
        </el-dialog>   
    </div>
    
</template>

<script>
import moment from 'moment'
import { required, integer, email, sameAs, requiredIf } from 'vuelidate/lib/validators/'
const _spinner = '<i class="fa fa-spinner fa-spin"></i>';
export default {
    data() {
        return {
            activeElectionPeriod: [],
            electionPeriodNominees: [],
            members:[],
            token: '',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false,
            period_id: '',
            dialogReviewTab: false,
            currentReview:[],
            thisServerUrl: '',
            selected_member: '',
            short_bio: '',
            nominateConfirmationTab: false,
            spinner: _spinner,
            maxcharacter: 160,
            remaincharactersText: "min. 160 characters"
            
        }
    },
     validations: {
        short_bio: { required}
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM. DD, YYYY h:mm A');
        },
        passed_moment: function (date) {
            return moment(date).format('MMMM YYYY');
        }
    },  
    computed: {
        activeperiod(){
            return this.activeElectionPeriod.length;
        },
        numberofnominee(){
            return this.electionPeriodNominees.length;
        },
        years () {
            const year = new Date().getFullYear()
            return Array.from({length: year - 2020}, (value, index) => 2021 + index)
        }
        
       
    },    
    methods: {
        fullname(item) {
            return item.first_name + " "+ item.middle_name +" "+ item.last_name;
        },
        remaincharCount(){
         if(this.short_bio.length > this.maxcharacter){
           this.remaincharactersText = "Exceeded "+this.maxcharacter+" characters limit.";
         }else{

           var remainCharacters = this.maxcharacter - this.short_bio.length;
           this.remaincharactersText = "min. 160 characters, remaining " + remainCharacters + " characters.";

         }
 
       },
        cancelNominate() {
            this.nominateConfirmationTab = false
        },
        profilePic(filepath) {
            if(filepath){
                this.dialogImageTab = true
                var currentHost =window.location.hostname
         
                if(filepath.includes(currentHost)){
                        return filepath
                }else {
                    return this.thisServerUrl+filepath
                }
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
        getActiveElectionPeriod() {
            axios.get('/api/election/active/admin', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.activeElectionPeriod = res.data;
                    this.period_id = this.activeElectionPeriod[0].id;
                    this.getMembers(this.activeElectionPeriod[0].id);
                    this.getElectionPeriodNominated(this.activeElectionPeriod[0].id);
                } 
			})
			.catch(err => {
				console.log(err);
            })
           
        },
        
        getMembers() {
            axios.get('/api/election/members/'+this.period_id+'?page=1', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.members = res.data;
                    console.log(this.members);
                }
			})
			.catch(err => {
				console.log(err);
            })
        },
        getPagedMembers(url){
            if (!url) {

            } else {
                this.tableLoading = true
                axios.get(url, {
                headers: { Authorization: "Bearer " + this.token }
                })
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
        getSearchResults() {
            this.tableLoading = true
             var id = this.period_id;
            axios.get(`/api/election/search?keyword=${this.searchTerm}&id=${id}`, {
                headers: { "Authorization": "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.members.data = res.data;
                    
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
            this.getMembers()
        },
       
         review (row) {
           
            if(this.electionPeriodNominees.length >= 13) {
                this.$message.error('Number of nominees allowed is already reached!')
            }else{
                this.dialogReviewTab = true
                axios.get('/api/election/nominee/' + row.id, {
                    headers: { "Authorization": "Bearer " + this.token }
                }).then(response => {
                    if(response.data) {
                        this.currentReview = response.data
                        this.selected_member = this.currentReview.id
                        console.log(this.currentReview)
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.is_approving = false
                });	
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
        nominate() {
            $('.nomite-btn').attr('disabled','disabled');
             this.nominateConfirmationTab = false 
                this.$v.$touch();
                if(!this.$v.$invalid){
                    axios.post('/api/election/nominate', {
                            election_period_id: this.period_id,
                            member_id: this.selected_member,
                            short_bio: this.short_bio},
                            {
                            headers: { Authorization: "Bearer " + this.token }
                        })
                        .then(response => {
                            this.$message.success('Successfully Nominated!.')
                            this.getElectionPeriodNominated(this.period_id)
                            setTimeout(function () { 
                                this.getMembers() 
                                this.dialogReviewTab = false
                                $('textarea').val('')
                                }.bind(this), 1000)
                        })
                        .catch(error => {
                            this.$message.error('Failed to nominate. Please try again.')
                            console.log(error)
                        })
                } else {
                    this.$message.error('Please correctly fill in the required fields.')
                }
        },
        getElectionPeriodNominated(id) {
            this.period_id = id;
            axios.get('/api/election/nominees/'+id, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.electionPeriodNominees = res.data;
                }
			})
			.catch(err => {
				console.log(err);
            })
        },
        confirmationTab() {
             $('.nomite-btn').removeAttr('disabled');
             this.nominateConfirmationTab = true 
        }, 
        
    },
	mounted() {
        this.getTokenCookie()
        this.getActiveElectionPeriod()
        this.getCurrentURL()
        
      
	}
}
</script>

<style>
.create-period button {
    margin-left: 0px !important;
}
.profile-holder img {
    width: 150px;
    border-radius: 50%;
    height: 150px;
}
.content-wrapper {
    padding-top: 65px;
}
.add-content-box {
     height: 70px;
     width: 100%;
     border: 3px dashed #ccc;
}
.profile-holder {
    text-align: center;
}
.profile-holder .profile-name {
    color: #174A84;
    font-size: 1rem;
    font-weight: bold;
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
.table-title {
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
.election-history span{
    font-style: italic;
    font-size: 0.8rem;
    color:gray
}
</style>
