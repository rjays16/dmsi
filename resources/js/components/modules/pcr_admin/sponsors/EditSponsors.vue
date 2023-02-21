<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / sponsors / Edit Sponsor</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <h1>Edit Sponsor</h1>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>PRC Number</th>
                                <th>Resident in Training</th>
                                <th>Membership</th>
                                <th>PCR Chapter</th>
                            </thead>
                            <tbody>
                                <tr v-for="item in members" :key="item.id">
                                    <td>{{fullname(item)}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.prc_number}}</td>
                                    <td>{{residentInTraining(item.is_trainee)}}</td>
                                    <td>{{item.mem_type_id}}</td>
                                    <td></td>
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
export default {
    data() {
        return {
            members: []
        }
    },
    created() {
        this.getApprovedMembers();
    },
    methods: {
        fullname(item) {
            return item.first_name + " " + item.last_name;
        },

        residentInTraining(val) {
            return val ? "YES" : "NO";
        },

        getApprovedMembers() {
            axios.get(`/admin/registration/approved/get`, {
                    headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.members = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			});		
        },

        approve(id) {
            axios.put(`/admin/registration/pending/${id}/approve`, {
                    headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.getPendingMembers();
                }
            })
            .catch(err => {
                console.log(err);
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
