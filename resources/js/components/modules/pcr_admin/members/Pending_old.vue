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
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>PRC Number</th>
                                <th>Resident in Training</th>
                                <th>Membership</th>
                                <th>PCR Chapter</th>
                                <th class="text-center">Application Date</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in members" :key="item.id">
                                    <td>{{fullname(item)}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.prc_number}}</td>
                                    <td>{{residentInTraining(item.is_trainee)}}</td>
                                    <td>{{item.mem_type_id}}</td>
                                    <td></td>
                                    <td class="text-center">{{ item.created_at | moment }}</td>
                                    <td class="text-center">
                                        <el-button :loading="is_approving && indexClicked === index" :disabled="is_approving && indexClicked === index" @click="approve(item.id, index)" type="primary">Approve</el-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const _spinner = '<i class="fa fa-spinner fa-spin"></i>'

import moment from 'moment'

export default {
    data() {
        return {
            members: [],
            spinner: _spinner,
            is_approving: false,
            indexClicked: ''
        }
    },
    created() {
        this.getPendingMembers();
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

        getPendingMembers() {
            axios.get(`/admin/members/pending/get`)
			.then(res => {
				if(res.data) {
                    this.members = res.data;
                    console.log(this.members)
                }
			})
			.catch(err => {
				console.log(err);
			});		
        },

        approve(id, index) {
            this.is_approving = true
            this.indexClicked  = index
            axios.put(`/admin/members/pending/${id}/approve`)
            .then(res => {
                if(res.data) {
                    this.getPendingMembers()
                    this.is_approving = false
                    this.indexClicked  = ''
                    this.$notify({
                        message: 'Selected member has been approved.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })
                }
            })
            .catch(err => {
                console.log(err)
				this.$notify({
					message: 'Error approving selected member.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
				})                
            })
        }
    }
}
</script>

<style scoped>

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
</style>
