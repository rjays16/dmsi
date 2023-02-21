<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-site-profile">
            <!-- Main content -->
            <section class="page-header">
				<div class="page-site-profile-header">
					<div class="page-site-profile-header-text">Profile</div>
				</div>
            </section>
            <section class="content">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-5">
                          <el-card class="box-card profile-card my-5">

                            <div class="sec-profile-photo">
                                <img :src="profile_pic" />
                            </div>
                            <div class="sec-personal-info">
                                <p class="mb-3 font-weight-bold">Personal Information</p>
                                <p class="mb-1 font-weight-bold">Name</p>
                                <el-input class="mb-3" :disabled="true" v-model="full_name"></el-input>
                                <p class="mb-1 font-weight-bold">Email</p>
                                <el-input class="mb-3" :disabled="true" v-model="email"></el-input>
                                <p class="mb-1 font-weight-bold">Contact Number</p>
                                <el-input class="mb-3" :disabled="true" v-model="phone_num"></el-input>
                                <p class="mb-1 font-weight-bold">PRC Number</p>
                                <el-input class="mb-3" :disabled="true" v-model="pcr_num"></el-input>
                            </div>
                            <div>
                                <div class="sec-mailing-info mt-3">
                                <p class="mb-3 font-weight-bold">Mailing Information</p>
                                <el-input
                                    class="mb-3"
                                    type="textarea"
                                    autosize
                                    v-model="mailing_address"
                                    placeholder="Number / Street / Town / City / Municipality / Province / Postal code">
                                </el-input>
                                </div>
                                <div class="sec-membership-info mt-4">
                                <p class="mb-3 font-weight-bold">Resident in Training</p>
                                    <el-input class="mb-3" v-model="is_trainee"></el-input>
                                </div>
                                <div class="sec-membership-info mt-4">
                                <p class="mb-3 font-weight-bold">Membership</p>
                                    <el-input class="mb-3" v-model="membership"></el-input>

                                </div>
                                <div class="sec-prc-chapter-info mt-4">
                                <p class="mb-3 font-weight-bold">PRC Chapter</p>
                                    <el-input class="mb-3" v-model="prc_chapter"></el-input>

                                </div>

                            </div>


                            <div class="sec-profile-register mt-4 text-center">
                                <div class="mb-3"><el-button type="text" @click="$router.push('login')" class="font-weight-bold">Forgot Password?</el-button>.</div>
                                <el-button  class="reg-goto-btn" type="primary" round  @click="gotoConvReg()">Register to Convention</el-button>
                            </div>

                            </el-card>
                      </div>
                      <div class="col-lg-7">
                           <div class="row">
                                <div class="col">
                                    <el-card class="box-card profile-card w-100 mt-5">
                                    <div class="class-text-center mt-4">
                                        <div class="text-center" style="font-size:30px;">Your Annual Dues</div>
                                        <hr>
                                        <div class="p-3 my-2" style="border-style: dashed; border-color: #AFAFAF;">
                                            <div style="font-size:22px;">₱{{balance.toFixed(2)}}</div>
                                            <!-- <p style="font-size:12px;">or contactsecretarist for dues ABOVE ₱{{balance.toFixed(2)}}</p> -->
                                        </div>
                                        <!-- <p style="font-size:12px;">Deposite your dues to __________ and send your deposit slip to pcr_secretariat@yahoo.com</p> -->
                                    </div>
                                    </el-card>
                                </div>
                            </div>
                            <div  class="row">
                                <div  class="col-md-6">
                                    <el-card class="box-card profile-card mt-3">
                                    <div class="class-text-center">
                                        <div style="font-size:15px; !important" class="mt-2 text-center"><b>Take part in the 2021 PCR National Elections</b></div>
                                        <div class="sec-profile-register mt-4 text-center">
                                            <el-button disabled :style="'background-color:#BEBEBE !important;'" class="reg-goto-btn" type="primary" round >PROCEED</el-button>
                                        </div>
                                        <div style="font-size:10px; !important" class="mt-4 text-center">
                                            Note: Eligibility to vote requires good standing membership status
                                        </div>
                                    </div>
                                    </el-card>
                                </div>
                                <div  class="col-md-6">
                                    <el-card class="box-card profile-card mt-3">
                                         <div class="sec-photo text-left mt-3 mb-1">
                                            <!-- <p class="mb-3 font-weight-bold">Deposit Slip</p> -->
                                            <el-upload
                                            class="avatar-uploader ava-icon-square"
                                            action="https://jsonplaceholder.typicode.com/posts/"
                                            :http-request="addAttachment3"
                                            :auto-upload="false"
                                            :show-file-list="false"
                                            :on-success="handleDepositSuccess"
                                            :before-upload="beforeAvatarUpload"
                                            :on-change="handleImageUpload3"
                                            accept="image/png, image/jpeg, image/jpg"
                                            :file-list="attachments3">
                                            <img v-if="imageUrl3" :src="imageUrl3" class="avatar">
                                            <i v-else class="el-icon-camera-solid avatar-uploader-icon"></i>
                                            </el-upload>
                                            <div class="mt-3 font-italic">
                                            Upload your Annual dues deposit slip here.
                                            </div>
                                        </div>

                                    </el-card>
                                </div>
                            </div>


                      </div>
                  </div>


              </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>

<script>
import { required, integer, email, sameAs } from 'vuelidate/lib/validators/'
  export default {
    name: 'Profile',
    created() {
      axios.get('/api/user', {
        headers: { "Authorization": "Bearer " + this.$cookies.get('token') }
      }).then(response => {
        var filepath = response.data.profile_pic
        if(filepath) {
          var fin_filepath = filepath.replace("public", "storage")
          this.profile_pic = fin_filepath
        }
        console.log(response)
				let d = new Date()
				d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
				let expires = "expires=" + d.toUTCString()
				this.$cookies.set('member_id', response.data.userable_id, expires, '/')
        axios.get('/api/pcr/member/' + response.data.userable_id, {
          headers: { "Authorization": "Bearer " + this.$cookies.get('token') }
        }).then(response2 => {
          //response data
          this.full_name = response2.data.first_name + " " + response2.data.last_name;
          this.email = response2.data.email;
          this.phone_num = response2.data.contact_number;
          this.pcr_num = response2.data.prc_number;
          this.mailing_address = response2.data.address;
          this.is_trainee = response2.data.is_trainee;
          this.membership = response2.data.memberships;
          this.prc_chapter = response2.data.chapter_id;
          this.balance = response2.data.balance;
        //   console.log(response2.data.balance);
        //   console.log(response2.data.year_last_paid);
        });
      }).catch(error => {
				console.log(error)
      });
    },
    data() {
      return {
        full_name: null,
        email: null,
        phone_num: null,
        pcr_num: null,
        mailing_address: null,
        is_trainee: null,
        membership: null,
        prc_chapter: null,
        profile_pic: null,
        balance: 0,
        token: this.$cookies.get('token'),
        attachments3: [],
        imageUrl3:'',
        image_types: ["image/png", "image/jpg", "image/jpeg"],
        file_max: 10000000,
        image3: {},
        imageUrl3final: {}
      }
    },
    methods: {
      gotoConvReg () {
        location.href='https://73rdpcrannualconvention.com/registration'
      },
      addAttachment3 ( file, fileList ) {
        this.attachments3.push( file );
      },
      beforeAvatarUpload(file) {
			const isPIC = file.type === 'image/jpeg';
			const isLt2M = file.size / 1024 / 1024 < 2;

			if (!isPIC) {
			this.$message.error('Profile photo must be an image filetype.');
			}
			if (!isLt2M) {
			this.$message.error('Profile photo cannot exceed 2MB.');
            }
      },
      handleDepositSuccess(file) {
            console.log(file)
			this.imageUrl3 = URL.createObjectURL(file.raw);
      },
      handleImageUpload3(f, filelist){ // STORES IMAGE IN FILE INPUT THEN STORES THE NAME OF THE FILE IN THE TEXT INPUT FOR VALIDATION
        let file = f
        this.validateFile(file.raw, "photo", (result) => {
            if(!result){
            file = null
            }

            this.imageUrl3 = file.raw
            if(this.imageUrl3){
            var reader = new FileReader()
            // this.$v.image3.$model = this.imageUrl3
            this.image3 = this.imageUrl3

            reader.onload = e => {
                this.imageUrl3 = e.target.result
            }
            reader.readAsDataURL(this.imageUrl3)
            } else{
            this.image3 = ''
            }
        });
        // this.step3.imageUrl3final = f.raw
        this.imageUrl3final = f.raw
    },
      validateFile(file, type, callback) { // VALIDATE IMAGE FILE
      let valid_types = this.image_types
      if(!file) {
          callback(false)
      }
      else if (file.size > this.file_max) {
        this.$message.error('File is too big!');
        callback(false)
      }
    //   else if(!valid_types.includes(file.type)) {
    //     this.$message.error('Invalid file type');
    //     callback(false)
    //   }
      else {
        callback(true)
      }
    },
    }
  }
</script>

<style>
	.page-site-profile .page-header {
		padding-top:80px;
		margin-top:0;
		margin-bottom:0;
	}
	.page-header .page-site-profile-header {
		background-image:url(/images/layout/pcr-site-reg-bg.png);
		background-repeat:no-repeat;
		background-size: contain;
		width:100%;
		height:0;
		padding-top:26.0417%;
		position:relative;
	}
	.page-site-profile-header-text {
		position:absolute;
		width:100%;
		bottom:0;
		top:42%;
		text-align:center;
		font-size:2.2rem;
		color:#fff;
		font-weight:bold;
	}
	.pcr-page-title {
		font-size:24px;
		padding-top:50px;
	}
	.pcr-page-subtitle {
		font-size:18px;
	}
	.profile-card h1 {
		font-size:24px;
		text-align: center;
	}
	.sec-facebook-info img  {
		height:35px;
		width:35px;
	}
	.reg-goto-btn {
        background-color:#00005c!important;
        color:#fff!important;
        border:none!important;
	}
	.page-sponsors {
		padding:30px;
		margin-right:auto;
		margin-left:auto;
		background-color:#f2f2f2;
	}
	.page-sponsors img {
		max-width:100%;
		max-height:50px;
		display:inline-block;
	}
	.invalid-field{
		color: red;
	}
  .profile-card .el-input.is-disabled .el-input__inner,
  .profile-card .el-textarea.is-disabled .el-textarea__inner {
    background-color:#fff;
    border-color:#C0C4CC;
    color:#606266;

  }
	.sec-profile-photo {
    text-align:center;
    margin-bottom:1.5rem;
  }
  .sec-profile-photo img {
    border-radius:500px;
    max-width:180px;
  }
.page-site-reg .page-header {
		padding-top:80px;
		margin-top:0;
		margin-bottom:0;
	}
	.page-header .page-site-reg-header {
		background-image:url(/images/layout/pcr-site-reg-bg.png);
		background-repeat:no-repeat;
		background-size: contain;
		width:100%;
		height:0;
		padding-top:26.0417%;
		position:relative;
	}
	.page-site-reg-header-text {
		position:absolute;
		width:100%;
		bottom:0;
		top:42%;
		text-align:center;
		font-size:2.2rem;
		color:#fff;
		font-weight:bold;
	}
	.pcr-page-title {
		font-size:24px;
		padding-top:50px;
	}
	.pcr-page-subtitle {
		font-size:18px;
	}
	.registration-card h1 {
		font-size:24px;
		text-align: center;
	}
	.sec-facebook-info img  {
		height:35px;
		width:35px;
	}
	.reg-submit-btn {
		width:100%;
	}
	.invalid-field{
		color: red;
	}
	.sec-photo {
		text-align:center;
	}
	.sec-photo .avatar-uploader .el-upload {
		border-radius: 500px;
		cursor: pointer;
		position: relative;
		overflow: hidden;
	}
	.sec-photo .avatar-uploader .el-upload:hover {
		background: #409EFF;
	}
	.sec-photo .avatar-uploader-icon {
		font-size: 28px;
		color: #8c939d;
		width: 100px;
		height: 100px;
		line-height: 100px;
		text-align: center;
    background:#dddddd;
	}
	.sec-photo .avatar-uploader .el-upload:hover .avatar-uploader-icon {
		color:#ffffff;
	}
	.sec-photo .avatar {
		width: 100px;
		height: 100px;
		display: block;
    margin:0!important;
	}
  .sec-photo .avatar-uploader.ava-icon-square .el-upload {
    border-radius: 0;
  }
	/* @media only screen and (min-width: 960px)  {
		.profile-card {
		width:35%;
		}
	} */

</style>
