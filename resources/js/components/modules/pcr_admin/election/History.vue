<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Elections / History</span>
            </div>
            <div class="container-fluid">
                <div class="mx-2 p-4">
                    <span class="table-title">Election History</span>
                </div>
            </div>
            <div class="container-fluid">
                <div class="admin-content bg-white mx-3 p-4">
                    <div class="row">
                    <div class="col-sm-12 col-md-6 history" v-if="numberofpassperiod > 0">
                        <span class="history-title">Previous Election Period
                            <b><template v-for="history in selectedElectionPeriod">
                                {{history.year}}
                            </template></b>
                        </span>
                        <br/><br/>

                        <span id="details"><template v-for="history in selectedElectionPeriod">
                               {{ history.date_started | passed_moment }} - {{ history.date_end | passed_moment }}
                        </template></span>
                    </div>
                    <div class="col-sm-12 col-md-6 history" v-else>
                         <span class="history-title">Previous Election Period
                            <b><template v-for="history in selectedElectionPeriod">
                                {{history.year}}
                            </template></b>
                        </span>
                        <br/><br/>

                        <span id="details">No passed election recorded.</span>
                    </div>
                    <div class="col-sm-12 col-md-6 election-history">
                        History of elections
                        <div class="mt-3">
                            <select class="el-input__inner" v-model="passedElectionPeriod.data" @change="getElectionPeriodNominees($event.target.value,'select')" >
                                <option value="" disabled>Select Period</option>
                                <option v-for="period in passedElectionPeriod" :key="period.id" :value="period.id">Election Period ({{ period.date_started | passed_moment }} - {{ period.date_end | passed_moment }})</option>
                            </select>
                        </div>
                        <span>View all the previous elections that passed.</span>
                    </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Nominees</h1>
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-12 text-right float-left">
                            <el-button @click="exportResult()" type="primary" size="mini" class="nominees-export-btn ml-3">Export Result</el-button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <el-table
                                    stripe
                                    :data="electionPeriodNominees"
                                    class="election-nominee-table"
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

                            </el-table>
                        <div class="block text-center mt-5" v-if="!showSearchRes">

                        </div>
                    </div>
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
            selectedElectionPeriod: [],
            passedElectionPeriod: [],
            electionPeriodNominees: [],
            token: '',
            tableLoading: false,
            searchTerm: '',
            showSearchRes: false,
            period_id: ''

        }
    },
    validations: {

    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM. DD, YYYY h:mm A');
        },
        passed_moment: function (date) {
            return moment(date).format('MMMM DD, YYYY');
        }
    },
    computed: {
        numberofnominee(){
            return this.electionPeriodNominees.length;
        },
        selectedperiod(){
             return this.$route.params.id;
        },
        numberofpassperiod(){
            return this.passedElectionPeriod.length;
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
        getPassedElectionPeriod() {
            axios.get('/api/election/passed/admin', {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.passedElectionPeriod = res.data;
                  //  console.log(res.data);
                }
			})
			.catch(err => {
				console.log(err);
            })
        },

        getElectionHistory(type) {
            this.period_id = this.$route.params.id;
            if(type == 'load'){
                this. getElectionPeriodNominees(this.period_id,type);
            }


            axios.get('/api/election/history/'+this.period_id, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.selectedElectionPeriod = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
            })
        },
        getElectionPeriodNominees(id,type) {
            this.period_id = id;
            this.$router.push(id);
           console.log(type);
           if(type == 'select'){
               this.getElectionHistory('select');
           }
            axios.get('/api/election/nominees/'+id, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.electionPeriodNominees = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
            })
        },
        exportResult(){
            window.open('../export/'+this.$route.params.id
					);
        },
        getSearchResults() {
            console.log(this.searchTerm);
        },
        clearSearchResults () {
            this.searchTerm = ''
            this.showSearchRes = false
            this.getInitialApprovedMembers(this.period_id)
        },

    },
	mounted() {
        this.getTokenCookie()
        this.getPassedElectionPeriod()
        this.getElectionHistory('load')


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
.election-history span, .history span#details{
    font-style: italic;
    font-size: 0.8rem;
    color:gray
}
</style>
