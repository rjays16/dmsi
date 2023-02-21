<template>
    <div>
        <div
		class="modal fade"
		id="createElection"
		tabindex="-1"
		role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Create new election period</h5>
                    </div>
                    <div class="modal-body modal-body-padding mt-2">
                        <p class="mb-2 font-weight-bold">Year <span class="required-item">*</span></p>
                        <div v-if="$v.election_year.$dirty">
                            <div class="invalid-field" v-if="!$v.election_year.required">Required</div>
                        </div>  
                       
                         <el-select class="mb-3 year" v-model="election_year" placeholder="Election Year">
                            <el-option
                            v-for="year in years"
                            :key="year"
                            :label="year"
                            :value="year">
                            </el-option>
                        </el-select>
                        <div class="date-start-holder">
                            <div class="date-holder">
                                <p class="mb-2 font-weight-bold">Date Start <span class="required-item">*</span></p>
                                <div v-if="$v.election_date_started.$dirty">
                                    <div class="invalid-field" v-if="!$v.election_date_started.required">Required</div>
                                </div>  
                                <el-date-picker class="mb-3" v-model="election_date_started" type="date" placeholder="Date Start"
                                format="dd-MM-yyyy" value-format="yyyy-MM-dd" >
                                </el-date-picker>
                            </div>
                            <div class="time-holder">
                                <p class="mb-2 font-weight-bold">Time Start <span class="required-item">*</span></p>
                                <div v-if="$v.election_start_time.$dirty">
                                    <div class="invalid-field" v-if="!$v.election_start_time.required">Required</div>
                                </div>  
                                <el-time-picker
                                    :default-value="default_time"
                                    v-model="election_start_time"
                                    placeholder="Select Time"
                                    format="HH:mm A"
                                    value-format="HH:mm:ss"
                                    >
                                </el-time-picker>
                                      
                            </div>
                        </div>
                        <div class="date-end-holder">
                            <div class="date-holder">
                                <p class="mb-2 font-weight-bold">Date End <span class="required-item">*</span></p>
                                <div v-if="$v.election_date_end.$dirty">
                                    <div class="invalid-field" v-if="!$v.election_date_end.required">Required</div>
                                </div>  
                                <el-date-picker class="mb-3" v-model="election_date_end" type="date" placeholder="Date End"
                                format="dd-MM-yyyy" value-format="yyyy-MM-dd">
                                </el-date-picker>
                            </div>
                            <div class="time-holder">
                                <p class="mb-2 font-weight-bold">Time End <span class="required-item">*</span></p>
                                <div v-if="$v.election_end_time.$dirty">
                                    <div class="invalid-field" v-if="!$v.election_end_time.required">Required</div>
                                </div>  
                                <el-time-picker
                                    :default-value="default_time"
                                    v-model="election_end_time"
                                    placeholder="Select Time"
                                    format="HH:mm A"
                                    value-format="HH:mm:ss"
                                    >
                                </el-time-picker>
                              
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block border-0 text-center">
                          <el-button class="float-right create-election-btn" type="primary" @click="createNewElection()">Create</el-button>
                        </div>
                </div>
            </div>
	    </div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Elections / Active</span>
               
            </div>  
            <div class="container-fluid">
                <div class="mx-2 p-4">
                    <span class="table-title">Election Period</span>
                </div>
            </div>                              
            <div class="container-fluid">
                <div class="admin-content bg-white mx-3 p-4">
                    <div class="row">
                    <div class="col-sm-12 col-md-6 create-period">
                        <div v-if="activeperiod === 0">There's no Active in progress <br/>
                            <button type="button" class="el-button sponsors-add-btn el-button--primary el-button--mini mt-3" @click="openModal()">
                                <span>Create new election period</span>
                            </button>
                        </div>
                        <div v-else>
                            <span class="">Election Voting In-Progress <b><template>{{activeElectionPeriod[0].year}}</template></b></span>
                            <div class="button-holder">
                               <!-- <button type="button" class="el-button election-period-open el-button--primary el-button--mini mt-3">
                                    <span>Open</span>
                                </button>-->
                                <button type="button" class="el-button election-period-close el-button--primary el-button--mini mt-3" @click="confirmationTab(0,'close')">
                                    <span>Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 election-history">
                        History of elections
                        <div class="mt-3">
                            <select class="el-input__inner" placeholder="History of Elections" v-model="passedElectionPeriod.data" @change="redirectHistory($event.target.value)" >
                                <option value="" disabled>Select Period</option>
                                <option v-for="period in passedElectionPeriod" :key="period.id" :value="period.id">Election Period ({{ period.date_started | passed_moment }} - {{ period.date_end | passed_moment }})</option>
                            </select>
                        </div>
                        <span>View all the previous elections that passed.</span>
                    </div>
                    </div>
                </div>
            </div>
         
                <div class="container-fluid" v-if="activeperiod === 1">
                    <div class="p-4" >
                        <span class="table-title">Election Voting In-Progress:
                             <template v-for="election in activeElectionPeriod">
                                {{election.year}} ({{ election.date_started | moment }} - {{ election.date_end | moment }})
                            </template></span>
                    </div>
                
                    <div class="container-fluid pb-5">
                        <div class="admin-conent bg-white  p-4">
                            <span class="table-title">Nominees</span>
                            <el-button @click="$router.push('/admin/election/add-nominees')" type="primary" size="mini" class="nominees-add-btn ml-3">Add Nominees</el-button>
                           <!-- <div class="row mb-4">
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
                            </div>-->
                                <el-table
                                    v-loading="tableLoading"
                                    stripe
                                    :data="electionPeriodNominees"
                                    class="election-nominee-table mt-3"
                                    style="width: 100%">
                                    <el-table-column
                                        prop="fname"
                                        label="First Name">
                                        <template slot-scope="scope">
                                            <div class="table-user-fname">{{ scope.row.pcr_member.first_name }}</div>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                        prop="lname"
                                        label="Last Name">
                                        <template slot-scope="scope">
                                            <div class="table-user-lname">{{ scope.row.pcr_member.last_name }}</div>
                                        </template>
                                    </el-table-column>
                                    <!--<el-table-column
                                        prop="suffix"
                                        label="Professional Suffix">
                                        
                                    </el-table-column>-->
                                    <el-table-column
                                        prop="email"
                                        label="Email">
                                        <template slot-scope="scope">
                                            <div class="table-user-suffx">{{ scope.row.pcr_member.email }}</div>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                        prop="bio"
                                        label="Bio">
                                        <template slot-scope="scope">
                                            <div class="table-user-bio">{{ scope.row.short_bio }}</div>
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                        prop="votes"
                                        label="Votes"
                                        class-name="vote-count"
                                         width="80">
                                        <template  slot-scope="scope">
                                        {{ scope.row.votes.length }}
                                        </template>
                                    </el-table-column>
                                    <el-table-column
                                        prop="actions"
                                        label="Actions"
                                        align="center"
                                        class-name="cell-actions">
                                        <template slot-scope="scope">
                                            <button type="button" class="el-button my-1 mx-0 el-button--primary el-button--mini is-plain"  @click="showEditNominee(scope.row)"><!----><i class="el-icon-edit"></i><span>Edit</span></button>
                                            <el-button plain class="my-1 mx-0" size="mini" @click="confirmationTab(scope.row.id,'delete')" type="danger" icon="el-icon-delete">Delete</el-button>                                    
                                        </template>
                                    </el-table-column>                       
                                </el-table>
                            </div>
                        </div>  
                </div>
        </div>
        <el-dialog :visible.sync="deleteConfirmationTab">
            <div class="text-center">Are you sure you want to delete the selected nominee?</div>
            <div class="text-center mt-3">
                <el-button  @click="deleteNominee()" type="danger" icon="el-icon-delete">Delete</el-button>
                <el-button @click="cancelDelete" type="info">Cancel</el-button>
            </div>
        </el-dialog>
         <el-dialog :visible.sync="updateConfirmationTab">
            <div class="text-center">Are you sure you want to update the selected nominee?</div>
            <div class="text-center mt-3">
                <button type="button" class="el-button my-1 mx-0 el-button--primary is-plain update-nominated-btn  "   @click="updateNominated()"><!----><span>Yes</span></button>       
                <el-button @click="cancelUpdate" type="info">Cancel</el-button>
            </div>
        </el-dialog>
         <el-dialog :visible.sync="closePeriodConfirmationTab">
            <div class="text-center">Are you sure you want to close this active election period?</div>
            <div class="text-center mt-3">
                 <el-button  @click="closeElectionPeriod()" type="danger" >Close</el-button>
                 <el-button @click="cancelElection" type="info">Cancel</el-button>
            </div>
        </el-dialog>
         <el-dialog class="update-nominate-dialog" title="" :visible.sync="editNomineeDialog">
               <div class="profile-holder">
                    <img :src="profilePic(currentReview.profile_pic)"><br/><br/>
                   <span class="profile-name">{{fullname(currentReview)}} {{currentReview.suffix_name}}, {{currentReview.prof_suffix}}</span>
                   <br/>
                   <span class="suffix-name">{{currentReview.prof_suffix_other}}</span>
               </div>
               <br/><br/>
                <span>Short Biography ({{remaincharactersText}})</span> 
                <el-input @keyup.native ="remaincharCount()"
                        class="mb-3"
                        type="textarea"
                        :rows=5
                        :maxlength="160"
                        v-model="selected_member.short_bio">
                      </el-input>
               <el-button class="mt-4" type="primary" @click="confirmationTab(selected_member.id,'update')">Update</el-button>
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
            passedElectionPeriod: [],
            electionPeriodNominees: [],
            token: '',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false,
            period_id: '',
            election_year: '',
            election_date_started: '',
            election_date_end: '',
            election_start_time: '',
            election_end_time: '',
            editNomineeDialog: false,
            currentReview:[],
            nominated_id: '',
            short_bio: '',
            selected_member: [],
            selectedID: '',
            deleteConfirmationTab: false,
            updateConfirmationTab: false,
            closePeriodConfirmationTab: false,
            spinner: _spinner,
            maxcharacter: 160,
            remaincharactersText: "min. 160 characters",
            duration: '',
            dateOpt: [{
                    value: '2021-02-22',
                    label: 'Februrary 22, 2021 (Monday)'
                    }, {
                    value: '2021-02-23',
                    label: 'Februrary 23, 2021 (Tuesday)'
                    }, {
                    value: '2021-02-24',
                    label: 'Februrary 24, 2021 (Wednesday)'
                    }, {
                    value: '2021-02-25',
                    label: 'Februrary 25, 2021 (Thursday)'
                    }, {
                    value: '2021-02-26',
                    label: 'Februrary 26, 2021 (Friday)'
                    }],              
            durationOpt: [{
                    value: '60',
                    label: '1 Hour'
                    }, {
                    value: '120',
                    label: '2 Hours'
                    }, {
                    value: '180',
                    label: '3 Hours'
                    }, {
                    value: '240',
                    label: '4 Hours'
                    }],  
                     default_time: new Date(0, 0, 0, 8, 0),

            
        }
    },
    validations: {
        election_year: { required,integer},
        election_date_started: { required },
        election_date_end: { required },
        election_start_time: { required },
        election_end_time: { required }
      
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM. DD, YYYY h:mm A');
        },
        passed_moment: function (date) {
            return moment(date).format('MMMM DD, YYYY');
        },
        formatnumber: function(num){
            return numeral(num).format("0,0")
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
        openModal() {
            $("#createElection").modal();
        },
         cancelDelete() {
            this.deleteConfirmationTab = false
            this.selectedID = ''
        },
        cancelUpdate() {
            this.updateConfirmationTab = false
            this.selectedID = ''
        },
        cancelElection(){
            this.closePeriodConfirmationTab = false
            this.selectedID = ''
        },
        fullname(item) {
            return item.first_name + " "+ item.middle_name +" "+ item.last_name;
        },
         remaincharCount(){
         if(this.selected_member.short_bio.length > this.maxcharacter){
           this.remaincharactersText = "Exceeded "+this.maxcharacter+" characters limit.";
         }else{

           var remainCharacters = this.maxcharacter - this.selected_member.short_bio.length;
           this.remaincharactersText = "min. 160 characters, remaining " + remainCharacters + " characters.";

         }
 
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
        checkActiveElection(){
             axios.get('/api/election/checkActive', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    console.log(res.data);
                } 
			})
			.catch(err => {
				console.log(err);
            })
        }, 
        getActiveElectionPeriod() {
            axios.get('/api/election/active/admin', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.activeElectionPeriod = res.data;
                    if(res.data.length >= 1){
                         this.getElectionPeriodNominees(this.activeElectionPeriod[0].id)
                    }
                   
                    console.log(res.data);
                } 
			})
			.catch(err => {
				console.log(err);
            })
           
        },
        getPassedElectionPeriod() {
            axios.get('/api/election/passed/admin', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.passedElectionPeriod = res.data;
                    console.log(res.data);
                } 
			})
			.catch(err => {
				console.log(err);
            })
        },

        getElectionPeriodNominees(id) {
            this.period_id = id;
            axios.get('/api/election/nominees/'+id, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.electionPeriodNominees = res.data;
                    console.log(this.electionPeriodNominees)
                }
			})
			.catch(err => {
				console.log(err);
            })
        },
        redirectHistory(id){
            this.$router.push('history/'+id);
        },
       
        closeElectionPeriod(){
             var id = this.period_id;
             //console.log(id);
                axios.put('/api/election/close/'+id, {
                    is_active: 0},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    
                    this.$message.success('Election period successfully closed.')
                   this.getActiveElectionPeriod()
                     this.getPassedElectionPeriod()
                    this.closePeriodConfirmationTab = false
                })
                .catch(error => {
                    this.$message.error('Election period could not be close. Please try again.')
                    
                })          
             
        },
        getSearchResults() {
            this.tableLoading = true
             var id = this.period_id;
            axios.get(`/api/election/nominated/search?keyword=${this.searchTerm}&id=${id}`, {
                headers: { "Authorization": "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.electionPeriodNominees= res.data;
                    console.log(res.data)
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
           this.getActiveElectionPeriod()
        },
        createNewElection() {
          
            this.$v.$touch();
           
            if(!this.$v.$invalid){
                if(this.election_date_started > this.election_date_end){
                    this.$message.error('Invalid date end. Must be higher from date started');
                }else if(this.activeElectionPeriod.length >= 1){
                    this.$message.error('Another election period is still active!');          
                }else {

                    axios.post('/api/election/create', {
                        year: this.election_year,
                        date_started: this.election_date_started+" "+this.election_start_time,
                        date_end: this.election_date_end+" "+this.election_end_time},
                        {
                        headers: { Authorization: "Bearer " + this.token }
                    })
                    .then(response => {
                        console.log(response);
                        this.$message.success('Election period successfully created.');
                         $("#createElection").modal('hide');
                        this.getActiveElectionPeriod();
                           $('.create-election-btn').removeAttr('disabled');
                    })
                    .catch(error => {
                        if(error.response.data.status_code == 400){
                            this.$message.error('ELection period could not be added. Please try again.')
                        }else{
                             this.$message.error(error.response.data.response);
                        }
                        console.log(error)
                    })
                }
            } else {
                this.$message.error('Please correctly fill in the required fields.')
            }
            
        },
        showEditNominee(row) {
            this.editNomineeDialog = true
            this.selected_member = row
         
            axios.get('/api/election/nominee/' +row.pcr_member.id, {
                headers: { "Authorization": "Bearer " + this.token }
            }).then(response => {
                if(response.data) {
                    this.currentReview = response.data
                       this.remaincharCount()
                    console.log(response.data)
                }
            })
            .catch(error => {
                console.log(error);    
            });	
        },
        updateNominated(){
              $('.update-nominated-btn').attr('disabled','disabled');
            this.updateConfirmationTab = false
            axios.put('/api/election/updateNominated/'+this.selectedID, {
                short_bio: this.selected_member.short_bio},
                 {
                 headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
                this.$message.success('Nominated member successfully updated.')
                this.getElectionPeriodNominees(this.period_id);
                setTimeout(function () { 
                this.editNomineeDialog = false  
                }.bind(this), 1000)
                   
             })
            .catch(error => {
                this.$message.error('Update failed. Please try again.')
                    
            })          
            
        },
        deleteNominee(){
            this.deleteConfirmationTab = false
            axios.delete('/api/election/deleteNominee/'+this.selectedID,{
                 headers: { Authorization: "Bearer " + this.token }
            })
            .then(response => {
                this.$message.success('Nominee successfully deleted.')
                this.getElectionPeriodNominees(this.period_id);
                setTimeout(function () { 
                this.editNomineeDialog = false  
                }.bind(this), 1000)
                   
             })
            .catch(error => {
                this.$message.error('Delete failed. Please try again.')
                    
            })          
            
        },
        confirmationTab(id,type) {
            this.selectedID = id
            if(id == 0){
                 this.selectedID = this.period_id
            }
            if(type == "delete"){
                this.deleteConfirmationTab = true
            }else if(type == "update"){
                 $('.update-nominated-btn').removeAttr('disabled');
                this.updateConfirmationTab = true
            }
            else if(type == "close"){
                this.closePeriodConfirmationTab = true
            }
            
        }, 
        getCurrentURL() {
            var currentUrl = window.location.href
            // console.log('go: ' + currentUrl)
            if (currentUrl.includes('127.0.0.1')) {
                this.thisServerUrl = ''
            } else {
                this.thisServerUrl = process.env.MIX_MEMBER_LIVE_URL
            }
            console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
        
        
    },
	mounted() {
        this.getTokenCookie()
        this.getActiveElectionPeriod()
        this.getPassedElectionPeriod()
        this.getCurrentURL()
        this.checkActiveElection()

      
	}
}
</script>

<style>
.create-period button {
    margin-left: 0px !important;
}
.vote-count {
    font-weight: bold;
}
.content-wrapper {
    padding-top: 65px;
}
.profile-holder img {
    width: 150px;
    border-radius: 50%;
    height: 150px;
}
.add-content-box {
     height: 70px;
     width: 100%;
     border: 3px dashed #ccc;
}
.el-table th>.cell {
    color: #000
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
.nominees-add-btn {
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
