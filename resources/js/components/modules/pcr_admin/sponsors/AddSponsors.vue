<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Sponsors / Add Sponsor</span>
            </div>            
            <div class="container-fluid pb-5">
                
                <div class="admin-conent my-5 mx-3 p-4">
                    <div class="bg-white p-4">
                        <h1>Add New Sponsor</h1>      
                        <p class="mb-2 font-weight-bold">Booth Name <span class="required-item">*</span></p>
                        <div v-if="$v.sponsor_booth_name.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_booth_name.required">Required</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Booth Name" v-model="sponsor_booth_name"></el-input>

                        <p class="mb-2 font-weight-bold">Sponsor Type</p>
                        <div v-if="$v.sponsor_type.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_type.required">Required</div>
                        </div>  
                        <el-select class="mb-3" v-model="sponsor_type" placeholder="Select">
                            <el-option
                            v-for="item in sponsor_type_options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>

                        <p class="mb-2 font-weight-bold">Email <span class="required-item">*</span></p>
                        <div v-if="$v.sponsor_email.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_email.required">Required</div>
                            <div class="invalid-field" v-if="!$v.sponsor_email.email">Incorrect email format</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Email" v-model="sponsor_email"></el-input>

                        <p class="mb-2 font-weight-bold">Contact Number <span class="required-item">*</span></p>
                        <div v-if="$v.sponsor_contact_num.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_contact_num.required">Required</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Contact Number" v-model="sponsor_contact_num"></el-input>

                        <p class="mb-2 font-weight-bold">Booth Order Number</p>
                        <div>
                            <el-input-number class="mb-3" v-model="sponsor_order" :min="1" :max="1000"></el-input-number>
                        </div>                          

                        <p class="mb-2 font-weight-bold">Password <span class="required-item">*</span></p>
                        <div v-if="$v.sponsor_password.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_password.required">Required</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Password" v-model="sponsor_password" show-password></el-input>

                        <p class="mb-2 font-weight-bold">Confirm Password <span class="required-item">*</span></p>
                        <div v-if="$v.sponsor_conf_password.$dirty">
                            <div class="invalid-field" v-if="!$v.sponsor_conf_password.required">Required</div>
                            <div class="invalid-field" v-if="!$v.sponsor_conf_password.sameAsPassword">Should be same with the password</div>
                        </div>  
                        <el-input class="mb-3" placeholder="Confirm Password" v-model="sponsor_conf_password" show-password></el-input>

                    </div>
                    <el-button class="mt-4" type="primary" @click="createNewSponsor()">Save</el-button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { required, integer, email, sameAs, requiredIf } from 'vuelidate/lib/validators/'
export default {
    data() {
        return {
            sponsor_booth_name: '',
            sponsor_type: '',
            sponsor_email: '',
            sponsor_contact_num: '',
            sponsor_order: '',
            sponsor_password: '',
            sponsor_conf_password: '',
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
            token: ''
        }
    },
    validations: {
        sponsor_booth_name: { required },
        sponsor_type: { required },
        sponsor_email: { required, email },
        sponsor_contact_num: { required },
        sponsor_password: { required },
        sponsor_conf_password: { required, sameAsPassword: sameAs('sponsor_password') }
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
        fullname(item) {
            return item.first_name + " " + item.last_name;
        },

        residentInTraining(val) {
            return val ? "YES" : "NO";
        },

        createNewSponsor() {
            this.$v.$touch()
            if(!this.$v.$invalid){
                axios.post(`/api/sponsors/create`, {
                    contact_email: this.sponsor_email,
                    password: this.sponsor_password,
                    name: this.sponsor_booth_name,
                    description: '*',
                    address: '*',
                    contact_number: this.sponsor_contact_num,
                    order: this.sponsor_order,
                    type_id: this.sponsor_type,
                    booth_name: this.sponsor_booth_name},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Sponsor successfully added.')
                    this.$router.push('/admin/sponsors/booth')
                })
                .catch(error => {
                    this.$message.error('Sponsor could not be added. Please try again.')
                    console.log(error)
                })
            } else {
                this.$message.error('Please correctly fill in the required fields.')
            }

        }
    },
	mounted() {
        this.getTokenCookie()
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
 .required-item {
    color:#c14040;
}
.invalid-field{
    color: red;
}
</style>
