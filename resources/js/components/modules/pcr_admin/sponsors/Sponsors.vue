<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Sponsors</span>
            </div>            
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Active Sponsors</span>
                    <el-button @click="$router.push('/admin/sponsors/add')" type="primary" size="mini" class="sponsors-add-btn ml-3">Add New</el-button>
                        <el-table
                            stripe
                            :data="sponsors"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'updated_at', order: 'descending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="name"
                                label="Booth Name">
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
                                    <el-button plain class="my-1 mx-0" size="mini" @click="showEditSponsor(scope.row)" type="primary" icon="el-icon-edit">Edit</el-button>
                                </template>
                            </el-table-column>                            
                        </el-table>                   
                </div>

            </div>
        </div>
        <el-dialog class="edit-sponsor-dialog" title="Edit Sponsor" :visible.sync="editSponsorsDialog">
            <div class="mt-3">
                        <p class="mb-2 font-weight-bold">Booth Name <span class="required-item">*</span></p>
                        <div v-if="$v.currentSponsor.name.$dirty">
                            <div class="invalid-field" v-if="!$v.currentSponsor.name.required">Required</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Booth Name" v-model="currentSponsor.name"></el-input>

                        <p class="mb-2 font-weight-bold">Sponsor Type</p>
                        <div v-if="$v.currentSponsor.type_id.$dirty">
                            <div class="invalid-field" v-if="!$v.currentSponsor.type_id.required">Required</div>
                        </div>  
                        <el-select class="mb-3" v-model="currentSponsor.type_id" placeholder="Select">
                            <el-option
                            v-for="item in sponsor_type_options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>

                        <p class="mb-2 font-weight-bold">Email <span class="required-item">*</span></p>
                        <div v-if="$v.currentSponsor.contact_email.$dirty">
                            <div class="invalid-field" v-if="!$v.currentSponsor.contact_email.required">Required</div>
                            <div class="invalid-field" v-if="!$v.currentSponsor.contact_email.email">Incorrect email format</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Email" v-model="currentSponsor.contact_email"></el-input>

                        <p class="mb-2 font-weight-bold">Contact Number <span class="required-item">*</span></p>
                        <div v-if="$v.currentSponsor.contact_number.$dirty">
                            <div class="invalid-field" v-if="!$v.currentSponsor.contact_number.required">Required</div>
                           
                        </div>  
                        <el-input class="mb-3" placeholder="Contact Number" v-model="currentSponsor.contact_number"></el-input>

                        <p class="mb-2 font-weight-bold">Booth Order Number</p>
                        <div>
                            <el-input-number class="mb-3" v-model="currentSponsor.order" :min="1" :max="1000"></el-input-number>
                        </div>                
                
                <el-button class="mt-4" type="primary" @click="editSponsor()">Save</el-button>
            </div>
        </el-dialog>        
    </div>
</template>

<script>
import { required, integer, email, sameAs, requiredIf } from 'vuelidate/lib/validators/'
export default {
    data() {
        return {
            sponsors: [],
            editSponsorsDialog: false,
            sponsor_type_options: [{
                value: 1,
                label: 'Platinum Sponsor'
                }, {
                value: 2,
                label: 'Gold Sponsor'
                }, {
                value: 3,
                label: 'Silver Sponsor'
                }, {
                value: 4,
                label: 'Bronze Sponsor'
                }, {
                value: 5,
                label: 'Event Supporter'
            }],            
            currentSponsor: {
                contact_email: '',
                name: '',
                description: '',
                address: '',
                contact_number: '',
                type_id: '',
                booth_name: '',
                order: ''           
            },
            token: '',
        }
    },
    validations: {
        currentSponsor: {
            name: { required },
            type_id: { required },
            contact_email: { required, email },
            contact_number: { required }
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
        getAllSponsors() {
            axios.get(`/api/sponsors/all`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.sponsors = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			});		
        },
        showEditSponsor(a) {
            this.currentSponsor = a
            console.log(this.currentSponsor)
            this.editSponsorsDialog = true
        },
        editSponsor() {
            var id = this.currentSponsor.id
            this.$v.$touch()
            if(!this.$v.$invalid){
                axios.put(`/api/sponsors/update/${id}`, {
                    contact_email: this.currentSponsor.contact_email,
                    name: this.currentSponsor.name,
                    description: this.currentSponsor.description,
                    address: this.currentSponsor.address,
                    contact_number: this.currentSponsor.contact_number,
                    type_id: this.currentSponsor.type_id,
                    order: this.currentSponsor.order,
                    booth_name: this.currentSponsor.name},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Sponsor changes successfully added.')
                    this.editSponsorsDialog = false
                    this.getAllSponsors()
                })
                .catch(error => {
                    this.$message.error('Sponsor changes could not be added. Please try again.')
                    console.log(error)
                    this.getAllSponsors()
                })                
            } else {
                this.$message.error('Please correctly fill in the required fields.')
            }            
        }
    },
	mounted() {
        this.getTokenCookie()
		this.getAllSponsors()
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
.admin-conent .table-title {
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
</style>
