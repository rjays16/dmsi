<template>
	<transition name="el-zoom-in-top">
		<div
			class="content-wrapper page-site-profile"
			v-loading.fullscreen.lock="fullscreenLoading"
		>
		 <el-dialog class="show-nominate-dialog" title="" :visible.sync="showSelectedNomineeDialog">
			<h5 class="mb-5">Here's your list of nominees:</h5>  
                <template v-for="(name, value ) in selectedNomineeData" >
					<h5 v-bind:key="value+1">{{ value+1 }}. {{fullname(name)}}</h5>
                </template>
           
            <h5 class="mt-5">Are you sure you want to submit your votes?</h5>
			<span class="vote-note">IMPORTANT NOTE: You cannot change your vote once you submitted the form.</span><br/> 

            <el-button class="mt-4 submit-vote-btn" type="primary" @click="submitVote()" round>Yes</el-button>
			<el-button  @click="closeDialog" type="primary" class="btn-no" round>No</el-button>
        </el-dialog>     
			<!-- Main content -->
			<section class="page-header">
				<div class="page-site-profile-header">
					<div class="page-site-election-header-text">PCR Election</div>
				</div>
			</section>
			<section class="content">
				<div class="container">
					<div class="row">
                        <div class="col-lg-12 mt-5 elec-header">
                            <h1>
                                <template v-for="election in activeElectionPeriod">
                                    {{ election.date_started | moment }} - {{ election.date_end | moment }}
                                </template>
                            </h1>
                            <p class="mt-5 heading">Click on your choice candidates then click the button below to submit.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-5 nominees">
							 <el-checkbox-group v-model="selectedNominee">
								<div class="checkbox col-md-3 float-left" v-for="nominee in nomineeData" :key="nominee.id" :id="nominee.id">
									<el-checkbox :label="nominee.id" :v-for="nominee.id" @change="getCheck(nominee.id)">
									<div class="nominee-pic">
										  <img :src="profilePic(nominee.profile_pic)">
									</div>
									<p class="nominee-name mt-3">
										{{fullname(nominee)}}<br/>
										 <span class="suffix-name mt-3">{{nominee.prof_suffix_other}}</span>
									</p>
									</el-checkbox>
									<p class="nominee-bio">
										{{nominee.short_bio}}
									</p>
								</div>
								
							</el-checkbox-group>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-lg-12 mt-5 mb-5 vote-btn ">
								<el-button
								class="submit-vote-btn"
								type="primary"
								round
								@click="showSelectedNominee()"
								>SUBMIT VOTE</el-button>
						</div>
					 </div>
				</div>
			</section>
			<!-- /.content -->
		</div>
	</transition>
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
			selectedNominee:[],
			selectedNomineeData:[],
           	token: this.$cookies.get("token"),
            tableLoading: false,
            period_id: '',
            fullscreenLoading: false,
			showSelectedNomineeDialog: false,
			nomineeData:[],
			member_id: this.$cookies.get("member_id"),
        }
    },
   
    filters: {
        moment: function (date) {
            return moment(date).format('MMMM DD, YYYY (h:mm A)');
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
        },
    },    
    methods: {
		getCheck(id){
		if($("#"+id).hasClass('bordered')){
			$("#"+id).css('border','none');
				$("#"+id).removeClass("bordered");
		}else {
			$("#"+id).css('border','2px solid #67c23a');
			$("#"+id).addClass("bordered");
		}
	
	
			
		
			
		},
		fullname(item) {
            return item.first_name + " "+ item.middle_name +" "+ item.last_name;
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
        
        getActiveElectionPeriod() {
            axios.get('/api/election/active/profile', {
                headers: { Authorization: "Bearer " + this.$cookies.get("token") }
            })
			.then(res => {
				if(res.data) {
                    this.activeElectionPeriod = res.data;
                    this.getElectionPeriodNominees(this.activeElectionPeriod[0].id)
					this.getNomimeeDetails()
					this.checkVoteStatus(this.activeElectionPeriod[0].id)
                    //console.log(res.data);
                } 
			})
			.catch(err => {
				console.log(err);
            })
        },
        
        getElectionPeriodNominees(id) {
            this.period_id = id;
            axios.get('/api/election/nominees/'+id, {
                headers: { Authorization: "Bearer " + this.$cookies.get("token") }
            })
			.then(res => {
				if(res.data) {
                    this.electionPeriodNominees = res.data;
                   // console.log(this.electionPeriodNominees)
                }
			})
			.catch(err => {
				console.log(err);
            })
        },

		getNomimeeDetails(){
            axios.get('/api/election/nomineeDetails/'+this.activeElectionPeriod[0].id, {
                headers: { Authorization: "Bearer " + this.$cookies.get("token") }
            })
			.then(res => {
				if(res.data) {
                    this.nomineeData = res.data;
                   //console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
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
                this.thisServerUrl = process.env.MIX_CONVENTION_LIVE_URL
            }
            console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
		showSelectedNominee() {
			if(this.selectedNominee.length == 0){
				 this.$message.error('Please select nominee first.')
			}else{
				this.showSelectedNomineeDialog = true
				let data = {
							selected_member: this.selectedNominee
				};
				axios.put(`/api/election/selectedNominee`, data, {
								headers: {
									Authorization: "Bearer " + this.$cookies.get("token"),
								},
				}).then(response => {
					if(response.data) {
					this.selectedNomineeData = response.data
					}
				})
				.catch(error => {
					console.log(error);    
				});	
			}
        },
		submitVote(){
			$('.submit-vote-btn').attr('disabled','disabled');
			var voterID = this.$route.query.id
			let data = {
						selected_member: this.selectedNominee,
						voter_id: voterID,
						period_id: this.period_id
			};
           	axios.put(`/api/election/vote`, data, {
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
			}).then(response => {
                if(response.data) {
                  if(response.data.voted == this.selectedNominee.length){
					    setTimeout(function () { 
							this.$router.push('election/thank-you' )
						}.bind(this), 1000)
						}
                }
            })
            .catch(error => {
                console.log(error);    
            });	
			
		
		},
          closeDialog(){
            this.showSelectedNomineeDialog = false
          
        },
		checkVoteStatus(election) {
				var member = this.$route.query.id
				axios.get('/api/election/checkVoteStatus/'+member+'/'+election, {
					headers: { Authorization: "Bearer " + this.$cookies.get("token"), }
					})
					.then((res) => {
					
						 if(res.data){
							this.voted = res.data
							if(this.voted.length > 0){
								this.$router.push('profile')
							}
						 }
					
					})
					.catch((err) => {
						console.log(err);
					});
		},
		
        
    },
	mounted() {
       
        this.getActiveElectionPeriod()
        this.getCurrentURL()
		

      
	}
}

</script>

<style>
p.mt-5.heading {
    font-weight: bold;
    text-align: center;
    font-size: 1.5rem;
}
.nominees .el-checkbox, .nominees .el-checkbox__input {
    white-space: unset !important;
}
.nominees .el-checkbox-group {
	font-size: 14px !important;
}
.nominees span.el-checkbox__input {
    width: 100%;

}
.nominee-pic {
	text-align: center;
}
.nominees .checkbox.bordered {
    border-radius: 30px;
    padding-top: 8px;
}
.nominees .el-checkbox__inner {
    border-radius: 3px !important;
	transform: scale(1.5);
	display:none !important
}
.nominees  span.el-checkbox__input.is-checked .el-checkbox__inner {
	display:block !important
}
.nominees  .el-checkbox__label {
	padding: 18px;
	padding-bottom: 0px;
}
.nominees .el-checkbox__input.is-checked+.el-checkbox__label {
    color: #000 !important;
	
}
 .nominees  .checkbox label.el-checkbox.is-checked:parent {
	border: 1px solid #000 !important
}
.nominees  .checkbox {
    margin-left: 20px;
    max-width: 22%;
	margin-bottom: 3rem;
	padding: 10px;
	height: 430px;
	text-align: center;
}

p.nominee-name {
	font-weight: bold;
}
p.nominee-name,.nominee-bio {
    text-align: center;
}
span.suffix-name {
    font-weight: normal;
}
.nominees  .el-checkbox__label {
  margin-bottom: 5px;
  font-size: 16px;
  float: right;
}
.nominees  .el-checkbox {
	margin-bottom: 0px !important
}
	button.el-button.reg-goto-btn.is-disabled{
		background-color: rgb(190, 190, 190) !important;
	}
	.elec-header h1 {
		text-align: center;
		color: #ea7a19;
		font-weight: 600;
		font-size: 1.9rem;
	}
	.page-site-profile .page-header {
		padding-top: 80px;
		margin-top: 0;
		margin-bottom: 0;
	}
	.page-header .page-site-profile-header {
		background-image: url(/images/layout/pcr-site-reg-bg.png);
		background-repeat: no-repeat;
		background-size: contain;
		width: 100%;
		height: 0;
		padding-top: 26.0417%;
		position: relative;
	}
	.page-site-election-header-text {
		position: absolute;
		width: 100%;
		bottom: 0;
		top: 42%;
		text-align: center;
		font-size: 2.2rem;
		color: #fff;
		font-weight: bold;
	}
	.pcr-page-title {
		font-size: 24px;
		padding-top: 50px;
	}
	.pcr-page-subtitle {
		font-size: 18px;
	}
	.profile-card h1 {
		font-size: 24px;
		text-align: center;
	}
	.sec-facebook-info img {
		height: 35px;
		width: 35px;
	}
	.reg-goto-btn {
		background-color: #00005c !important;
		color: #fff !important;
		border: none !important;
	}
	.page-sponsors {
		padding: 30px;
		margin-right: auto;
		margin-left: auto;
		background-color: #f2f2f2;
	}
	.page-sponsors img {
		max-width: 100%;
		max-height: 50px;
		display: inline-block;
	}
	.invalid-field {
		color: red;
	}
	.profile-card .el-input.is-disabled .el-input__inner,
	.profile-card .el-textarea.is-disabled .el-textarea__inner {
		background-color: #fff;
		border-color: #c0c4cc;
		color: #606266;
	}
	.sec-profile-photo {
		text-align: center;
		margin-bottom: 1.5rem;
	}
	.sec-profile-photo img {
		border-radius: 500px;
		max-width: 180px;
	}
	.page-site-reg .page-header {
		padding-top: 80px;
		margin-top: 0;
		margin-bottom: 0;
	}
	.page-header .page-site-reg-header {
		background-image: url(/images/layout/pcr-site-reg-bg.png);
		background-repeat: no-repeat;
		background-size: contain;
		width: 100%;
		height: 0;
		padding-top: 26.0417%;
		position: relative;
	}
	.page-site-reg-header-text {
		position: absolute;
		width: 100%;
		bottom: 0;
		top: 42%;
		text-align: center;
		font-size: 2.2rem;
		color: #fff;
		font-weight: bold;
	}
	.pcr-page-title {
		font-size: 24px;
		padding-top: 50px;
	}
	.pcr-page-subtitle {
		font-size: 18px;
	}
	.registration-card h1 {
		font-size: 24px;
		text-align: center;
	}
	.sec-facebook-info img {
		height: 35px;
		width: 35px;
	}
	.reg-submit-btn {
		width: 100%;
	}
	.invalid-field {
		color: red;
	}
	.sec-photo {
		text-align: center;
	}
	.sec-photo .avatar-uploader .el-upload {
		border-radius: 500px;
		cursor: pointer;
		position: relative;
		overflow: hidden;
	}
	.sec-photo .avatar-uploader .el-upload:hover {
		background: #409eff;
	}
	.sec-photo .avatar-uploader-icon {
		font-size: 28px;
		color: #8c939d;
		width: 100px;
		height: 100px;
		line-height: 100px;
		text-align: center;
		background: #dddddd;
	}
	.sec-photo .avatar-uploader .el-upload:hover .avatar-uploader-icon {
		color: #ffffff;
	}
	.sec-photo .avatar {
		width: 100px;
		height: 100px;
		display: block;
		margin: 0 !important;
	}
	.sec-photo .avatar-uploader.ava-icon-square .el-upload {
		border-radius: 0;
	}
	.nominees img {
		width: 130px;
		border-radius: 50%;
		height: 130px;
	}
	button.el-button.submit-vote-btn.el-button--primary.is-round {
    	text-align: center;
   
	}
	.col-lg-12.mt-5.vote-btn {
    text-align: center;
}
@media only screen and (max-width: 768px) {
 .nominees  .checkbox {
    max-width: 47%;
 }
}
@media only screen and (max-width: 425px) {
 .nominees  .checkbox {
    max-width: 100%;
	margin-left: 0px;
 }
}
	
	/* @media only screen and (min-width: 960px)  {
																													.profile-card {
																													width:35%;
																													}
																												} */
</style>
