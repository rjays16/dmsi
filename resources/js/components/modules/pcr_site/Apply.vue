<template>
	<transition name="el-zoom-in-top">
		<div
			class="content-wrapper page-site-reg"
			v-loading.fullscreen.lock="fullscreenLoading"
		>
			>
			<!-- Main content -->
			<section class="page-header">
				<div class="page-site-reg-header">
					<div class="page-site-reg-header-text">
						Application for Online PCR Membership
					</div>
				</div>
			</section>

			<section class="content">
				<div class="d-flex justify-content-center">
					<el-card class="box-card registration-card my-5">
						<div slot="header" class="clearfix">
							<h1>Application</h1>
						</div>
						<form v-loading="loading">
							<div class="sec-photo">
								<el-upload
									class="avatar-uploader"
									action="https://jsonplaceholder.typicode.com/posts/"
									:http-request="addAttachment"
									:auto-upload="false"
									:show-file-list="false"
									:on-success="handleAvatarSuccess"
									accept="image/png, image/jpeg, image/jpg"
									:before-upload="beforeAvatarUpload"
									:on-change="handleImageUpload"
									:file-list="attachments"
								>
									<img
										v-if="imageUrl"
										:src="imageUrl"
										class="avatar"
									/>
									<i
										v-else
										class="el-icon-camera-solid avatar-uploader-icon"
									></i>
								</el-upload>
								<div class="mt-3 mb-5">
									Click above to provide<br />Profile Photo
								</div>
							</div>
							<div class="sec-personal-info">
								<p class="mb-3 font-weight-bold">
									Personal Information
								</p>
								<div v-if="$v.step1.last_name.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.last_name.required"
									>
										Required
									</div>
								</div>
								<el-input
									class="mb-3 name-uppercase"
									placeholder="Last Name"
									v-model="$v.step1.last_name.$model"
								></el-input>

								<div v-if="$v.step1.first_name.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.first_name.required"
									>
										Required
									</div>
								</div>
								<el-input
									class="mb-3 name-uppercase"
									placeholder="First Name"
									v-model="$v.step1.first_name.$model"
								></el-input>

								<div v-if="$v.step1.middle_name.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.middle_name.required"
									>
										Required
									</div>
								</div>
								<el-input
									class="mb-3 name-uppercase"
									placeholder="Middle Name"
									v-model="$v.step1.middle_name.$model"
								></el-input>

								<div v-if="$v.step1.email.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.email.required"
									>
										Required
									</div>
									<div
										class="invalid-field"
										v-if="!$v.step1.email.email"
									>
										Incorrect email format
									</div>
								</div>
								<el-input
									class="mb-3"
									placeholder="Email Address"
									type="email"
									v-model="$v.step1.email.$model"
								></el-input>

								<div v-if="$v.step1.contact_num.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.contact_num.required"
									>
										Required
									</div>
									<div
										class="invalid-field"
										v-if="!$v.step1.contact_num.integer"
									>
										Incorrect phone format
									</div>
								</div>
								<el-input
									class="mb-3"
									placeholder="Contact Number"
									v-model="$v.step1.contact_num.$model"
								></el-input>

								<div v-if="$v.step1.prc_num.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step1.prc_num.required"
									>
										Required
									</div>
									<div
										class="invalid-field"
										v-if="!$v.step1.prc_num.integer"
									>
										Incorrect PRC format
									</div>
								</div>
								<el-input
									class="mb-3"
									placeholder="PRC Number"
									v-model="$v.step1.prc_num.$model"
								></el-input>
							</div>
							<div>
								<!-- <div class="sec-mailing-info mt-3">
                      <p class="mb-3 font-weight-bold">Mailing Information</p>
                      <div v-if="$v.step2.mailing_info.$dirty">
                        <div class="invalid-field" v-if="!$v.step2.mailing_info.required">Required</div>
                      </div>
                      <el-input
                        class="mb-3"
                        type="textarea"
                        autosize
                        placeholder="Number / Street / Town / City / Municipality / Province / Postal code"
                        v-model="$v.step2.mailing_info.$model">
                      </el-input>
                    </div> -->
								<div class="sec-mailing-info mt-3">
									<p class="mb-3 font-weight-bold">
										Address <span class="required-item">*</span>
									</p>

									<div v-if="$v.address.country.$dirty">
										<div
											class="invalid-field"
											v-if="!$v.address.country.required"
										>
											Required
										</div>
									</div>
									<country-select
										v-model="$v.address.country.$model"
										:country="$v.address.country.$model"
										className="country-select el-input__inner mb-3"
										:countryName="true"
									/>

									<div v-if="$v.address.region.$dirty">
										<div
											class="invalid-field"
											v-if="!$v.address.region.required"
										>
											Required
										</div>
									</div>
									<region-select
										v-model="$v.address.region.$model"
										:country="$v.address.country.$model"
										className="region-select el-input__inner mb-3"
										:countryName="true"
										:regionName="true"
										:region="$v.address.region.$model"
									/>

									<div v-if="$v.address.city.$dirty">
										<div
											class="invalid-field"
											v-if="!$v.address.city.required"
										>
											Required
										</div>
									</div>
									<el-input
										class="mb-3"
										placeholder="City"
										v-model="$v.address.city.$model"
									></el-input>

									<div v-if="$v.address.zip.$dirty">
										<div
											class="invalid-field"
											v-if="!$v.address.zip.required"
										>
											Required
										</div>
									</div>
									<el-input
										class="mb-3"
										placeholder="Zip Code"
										v-model="$v.address.zip.$model"
									></el-input>
								</div>
								<div class="sec-membership-info mt-4">
									<p class="mb-3 font-weight-bold">
										Resident in Training
									</p>
									<el-radio-group
										v-model="trainee_status"
										@input="changeValue"
									>
										<p>
											<el-radio :label="1">Yes</el-radio>
										</p>
										<p>
											<el-radio :label="0">No</el-radio>
										</p>
									</el-radio-group>
								</div>
								<div
									class="sec-membership-info mt-4"
									v-if="trainee_status === 1"
								>
									<p class="mb-3 font-weight-bold">
										Training Institution
									</p>
									<el-input
										class="mb-3"
										placeholder="Name of training institution"
										v-model="training_ins"
									></el-input>
								</div>
								<div
									class="sec-membership-info mt-4"
									v-if="trainee_status !== 1"
								>
									<p class="mb-3 font-weight-bold">Membership</p>
									<!-- <el-radio-group v-model="mem_type_id" @input="changeValue">
                        <p v-for="memtype in memberTypes" :key="memtype.id">
                          <el-radio :label="memtype.id">{{ memtype.type_name}}</el-radio>
                        </p>
                      </el-radio-group> -->
									<el-checkbox-group
										v-model="mem_type_id"
										@change="changeMembershipValue"
									>
										<p
											v-for="memtype in memberTypes"
											:key="memtype.id"
										>
											<el-checkbox :label="memtype.id">{{
												memtype.type_name
											}}</el-checkbox>
										</p>
									</el-checkbox-group>
								</div>
								<div
									class="sec-prc-chapter-info mt-4"
									v-if="trainee_status !== 1"
								>
									<p class="mb-3 font-weight-bold">PCR Chapter</p>
									<el-radio-group
										v-model="chapter_id"
										@input="changeValue"
									>
										<p
											v-for="chaptertype in chapterTypes"
											:key="chaptertype.id"
										>
											<el-radio :label="chaptertype.id">{{
												chaptertype.chapter_name
											}}</el-radio>
										</p>
									</el-radio-group>
								</div>
							</div>
							<!--
                  <div class="sec-photo text-left mt-3 mb-5">
                    <p class="mb-3 font-weight-bold">Deposit Slip</p>
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
                      Please upload a digital copy of your Annual dues deposit slip by clicking above
                    </div>

                  </div> -->
							<div class="sec-login-info mt-4">
								<p class="mb-3 font-weight-bold">Password</p>
								<!-- <div v-if="$v.step3.username.$dirty">
                      <div class="invalid-field" v-if="!$v.step3.username.required">Required</div>
                    </div>
                    <el-input class="mb-3" placeholder="Username" v-model="$v.step3.username.$model"></el-input> -->

								<div v-if="$v.step3.password.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step3.password.required"
									>
										Required
									</div>
								</div>
								<el-input
									class="mb-3"
									placeholder="Password"
									v-model="$v.step3.password.$model"
									show-password
								></el-input>

								<div v-if="$v.step3.password.$dirty">
									<div
										class="invalid-field"
										v-if="!$v.step3.conf_password.required"
									>
										Required
									</div>
									<div
										class="invalid-field"
										v-if="!$v.step3.conf_password.sameAsPassword"
									>
										Should be same with the password
									</div>
								</div>
								<el-input
									class="mb-3"
									placeholder="Confirm Password"
									v-model="$v.step3.conf_password.$model"
									show-password
								></el-input>
							</div>

							<!-- <div class="sec-facebook-info mt-4">
                    <a href="#">
                      <img src="/images/layout/social_fb.png" />
                      <span class="ml-2">Link Facebook Account</span>
                    </a>
                  </div> -->
							<div class="sec-submit mt-4">
								<el-button
									class="reg-submit-btn"
									type="primary"
									round
									@click="submit"
									>SUBMIT</el-button
								>
								<div class="text-center mt-3">
									Already registered? Please
									<el-button
										type="text"
										@click="$router.push('login')"
										class="font-weight-bold"
										>login here</el-button
									>.
								</div>
							</div>
						</form>
					</el-card>
				</div>
			</section>
			<!-- /.content -->
		</div>
	</transition>
</template>

<script>
	import { required, integer, email, sameAs } from "vuelidate/lib/validators/";
	export default {
		name: "Apply",
		data() {
			return {
				regTypes: [],
				memberTypes: [],
				nonmemberTypes: [],
				chapterTypes: [],
				step1: {
					last_name: "",
					first_name: "",
					middle_name: "",
					email: "",
					contact_num: "",
					prc_num: "",
				},
				step2: {
					mailing_info: "",
				},
				step3: {
					// username: '',
					password: "",
					conf_password: "",
				},
				image: null,
				reg_type_id: null,
				mem_type_id: [],
				mem_type_id_string: [],
				non_type_id: null,
				chapter_id: 1,
				training_ins: null,

				step: 1,
				showsubmit: false,
				loading: false,
				trainee_status: null,
				imageUrl: "",
				imageUrlfinal: "",
				imageUrl3: "",
				imageUrl3final: "",
				attachments: [],
				attachments3: [],

				image_types: ["image/png", "image/jpg", "image/jpeg"],
				file_max: 10000000,
				address: {
					country: "",
					region: "",
					city: "",
					zip: "",
				},
				fullscreenLoading: false,
				populated: false,
			};
		},
		validations: {
			step1: {
				last_name: { required },
				first_name: { required },
				email: { required, email },
				middle_name: { required },
				contact_num: { required, integer },
				prc_num: { required, integer },
			},
			// step2: {
			//   mailing_info: { required },
			// },
			step3: {
				// username: { required },
				password: { required },
				conf_password: { required, sameAsPassword: sameAs("password") },
				imageUrl3final: {},
			},
			image: {},
			image3: {},
			address: {
				country: { required },
				region: { required },
				city: { required },
				zip: { required },
			},
		},
		methods: {
			handleImageUpload(f, filelist) {
				// STORES IMAGE IN FILE INPUT THEN STORES THE NAME OF THE FILE IN THE TEXT INPUT FOR VALIDATION
				let file = f;
				this.validateFile(file.raw, "photo", (result) => {
					if (!result) {
						file = null;
					}

					this.imageUrl = file.raw;
					if (this.imageUrl) {
						var reader = new FileReader();
						this.$v.image.$model = this.imageUrl;

						reader.onload = (e) => {
							this.imageUrl = e.target.result;
						};
						reader.readAsDataURL(this.imageUrl);
					} else {
						this.image = "";
					}
				});
				this.imageUrlfinal = f.raw;
			},
			handleImageUpload3(f, filelist) {
				// STORES IMAGE IN FILE INPUT THEN STORES THE NAME OF THE FILE IN THE TEXT INPUT FOR VALIDATION
				let file = f;
				this.validateFile(file.raw, "photo", (result) => {
					if (!result) {
						file = null;
					}

					this.imageUrl3 = file.raw;
					if (this.imageUrl3) {
						var reader = new FileReader();
						this.$v.image3.$model = this.imageUrl3;

						reader.onload = (e) => {
							this.imageUrl3 = e.target.result;
						};
						reader.readAsDataURL(this.imageUrl3);
					} else {
						this.image3 = "";
					}
				});
				this.imageUrl3final = f.raw;
			},
			checkuser() {
				axios
					.get(
						"/api/checkuser?email=" +
							this.email +
							"&prc_number=" +
							this.prc_num
					)
					.then((res) => {
						if (
							res.data.message === "User exists in master list" &&
							res.data.is_trainee === 0
						) {
							console.log("member");
							this.reg_type_id = 1;
						} else if (
							res.data.message === "User exists in master list" &&
							res.data.is_trainee === 1
						) {
							console.log("trainee");
							this.reg_type_id = 2;
						} else if (res.data.message === "User is a non member") {
							console.log("non member");
							this.reg_type_id = 3;
						}
					})
					.catch((err) => {
						console.log(err);
					});
			},
			getRegTypes() {},
			validateFile(file, type, callback) {
				// VALIDATE IMAGE FILE
				let valid_types = this.image_types;
				if (!file) {
					callback(false);
				} else if (file.size > this.file_max) {
					this.$message.error("File is too big!");
					callback(false);
				} else if (!valid_types.includes(file.type)) {
					this.$message.error("Invalid file type");
					callback(false);
				} else {
					callback(true);
				}
			},
			submit() {
				this.$v.$touch();

				if (!this.$v.$invalid) {
					var fname = this.step1.first_name.toUpperCase()
					var mname = this.step1.middle_name.toUpperCase()
					var lname = this.step1.last_name.toUpperCase()
					console.log(fname + mname + lname)
					this.loading = true;
					const memData = new FormData();
					memData.append("email", this.step1.email);
					memData.append("password", this.step3.password);
					memData.append("first_name", fname);
					memData.append("middle_name", mname);
					memData.append("last_name", lname);
					memData.append("prc_number", this.step1.prc_num);
					memData.append("contact_number", this.step1.contact_num);
					// memData.append('address', this.step2.mailing_info)
					let addresss =
						this.address.city +
						", " +
						this.address.region +
						", " +
						this.address.country +
						", " +
						this.address.zip;
					memData.append("address", addresss);
					memData.append("mem_type_id", 1);
					memData.append("chapter_id", this.chapter_id);
					memData.append("is_trainee", this.trainee_status);
					// memData.append('prc_id', null)
					memData.append("memberships", this.mem_type_id_string);
					memData.append("profile_pic", this.imageUrlfinal);
					memData.append("training_ins", this.training_ins);

					axios
						.post("/api/members", memData, {
							headers: {
								"Content-Type": "multipart/form-data",
							},
						})
						.then((response) => {
							this.loading = false;
							this.$notify({
								message: "Successfully registered user",
								type: "success",
								position: "bottom-right",
							});
							this.$router.push("/apply/thank-you");
						})
						.catch((error) => {
							console.log(error);
							// if (error === 'Error: Request failed with status code 400') {
							//  var message = "The email address you provided is already in use."
							// } else {
							//  var message = error
							// }
							this.$notify({
								message:
									"There was an error saving your application. Please make sure that all required fields are filled in and that your email address has not been used to register before.",
								type: "error",
								position: "bottom-right",
							});
							this.loading = false;
						});
				} else {
					this.$notify({
						message:
							"Missing or incorrect fields, please fill in all fields properly",
						type: "error",
						position: "bottom-right",
					});
				}
			},
			back() {
				if (this.step > 1) {
					this.step -= 1;
					if (this.step < 3) {
						this.showsubmit = false;
					}
				} else {
					this.step = 1;
				}
			},
			next() {
				if (this.step < 3) {
					this.$v[`step${this.step}`].$touch();

					if (!this.$v[`step${this.step}`].$invalid) {
						this.step += 1;

						if (this.step == 2) {
							this.checkuser();
						}

						if (this.step == 3) {
							this.showsubmit = true;
						}
					} else {
						this.$notify({
							message:
								"Missing or incorrect fields, please fill in all fields properly",
							type: "error",
							position: "bottom-right",
						});
					}
				}

				// if((this.step < 3) && (this.email) && (this.prc_num)){
				// 	this.step += 1
				// 	if(this.step === 2){
				// 		this.checkuser()
				// 	// submit email and pcr number
				// 	// get results
				// 	// show / hide relevant fields
				// 	}
				// 	if(this.step === 3){
				// 		this.showsubmit = true
				// 	}
				// }
				// else{
				// 	this.$notify({
				// 	message: 'Please provide a valid email address and PCR number.',
				// 	type: 'error',
				// 	position: 'bottom-right'
				// 	});
				// }
			},
			stepOneValidate() {},
			getRegTypes() {
				axios
					.get("/api/registrationtype")
					.then((res) => {
						// console.log(res.data)
						this.regTypes = res.data;
					})
					.catch((err) => {
						console.log(err);
					});
			},
			getMemberTypes() {
				axios
					.get("/api/membershiptype")
					.then((res) => {
						console.log(res.data);
						this.memberTypes = res.data;
					})
					.catch((err) => {
						console.log(err);
					});
			},
			getNonMemberTypes() {
				axios
					.get("/api/nonMembertypes")
					.then((res) => {
						// console.log(res.data)
						this.nonmemberTypes = res.data;
					})
					.catch((err) => {
						console.log(err);
					});
			},
			getChapterTypes() {
				axios
					.get("/api/chaptertypes")
					.then((res) => {
						// console.log(res.data)
						this.chapterTypes = res.data;
					})
					.catch((err) => {
						console.log(err);
					});
			},
			changeValue(data) {
				console.log(data);
			},
			changeMembershipValue(data) {
				// console.log(data.join('-'))
				this.mem_type_id_string = data.join("-");
				console.log(this.mem_type_id_string);
			},
			handleAvatarSuccess(file) {
				console.log(file);
				this.imageUrl = URL.createObjectURL(file.raw);
			},
			handleDepositSuccess(file) {
				console.log(file);
				this.imageUrl3 = URL.createObjectURL(file.raw);
			},
			beforeAvatarUpload(file) {
				const isPIC = file.type === "image/jpeg";
				const isLt2M = file.size / 1024 / 1024 < 2;

				if (!isPIC) {
					this.$message.error("Profile photo must be an image filetype.");
				}
				if (!isLt2M) {
					this.$message.error("Profile photo cannot exceed 2MB.");
				}
				return isPIC && isLt2M;
			},
			addAttachment(file, fileList) {
				this.attachments.push(file);
			},
			addAttachment3(file, fileList) {
				this.attachments3.push(file);
			},
			getConventionData(id) {
				axios
					.get(`api/convention/profile/forregistration/${id}`)
					.then((res) => {
						this.populate(res.data);
					})
					.catch((error) => {
						console.log(error);
						this.fullscreenLoading = false;
					});
			},
			populate(data) {
				this.$v.step1.first_name.$model = data.first_name;
				this.$v.step1.middle_name.$model = data.middle_name;
				this.$v.step1.last_name.$model = data.last_name;
				this.$v.step1.email.$model = data.email;
				this.$v.step1.contact_num.$model = data.contact_number;
				this.step1.prc_num = data.prc_number;
				if (data.reg_type_id == 1) {
					this.trainee_status = 0;
					this.chapter_id = data.chapter_id;
					let string = data.memberships;
					string = string.split("-");
                    this.mem_type_id = string.map((x) => parseInt(x));
                    this.mem_type_id_string = data.memberships;
				} else if (data.reg_type_id == 2) {
					this.trainee_status = 1;
					this.training_ins = data.training_ins;
				} else {
				}
				// if (data.is_trainee == 1) {
				// 	this.$v.step2.reg_category.$model = "2";
				// 	this.step2.prc_num = data.prc_number;
				// 	this.$v.step2.training_inst.$model = data.training_ins;
				// } else {
				// 	this.$v.step2.reg_category.$model = "1";
				// 	this.step2.prc_num = data.prc_number;
				// 	this.chapter_id = data.chapter_id;
				// 	let string = data.memberships;
				// 	string = string.split("-");
				// 	this.mem_type_id = string.map((x) => parseInt(x));
				// }
				this.address.country = data.country;
				this.address.region = data.state;
				this.address.city = data.city;
				this.address.zip = data.zip_code;
				this.populated = true;
				this.fullscreenLoading = false;
			},
		},
		mounted() {
			if (this.$route.query.id) {
				this.fullscreenLoading = true;
				this.getConventionData(this.$route.query.id);
			}
			this.getRegTypes();
			this.getMemberTypes();
			this.getNonMemberTypes();
			this.getChapterTypes();
		},
	};
</script>

<style>
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
	@media only screen and (max-width: 1220px) {
		.page-header .page-site-reg-header {
			background-image: url(/images/layout/pcr-site-reg-bg.png);
			background-repeat: no-repeat;
			background-size: cover;
			height: 150px;
			padding-top: 26.0417%;
			position: relative;
		}
		.page-site-reg-header-text {
			top: 30%;
		}
	}
	@media only screen and (max-width: 768px) {
		.page-site-reg-header-text {
			top: 30%;
			font-size: 1.6rem;
			color: #fff;
			font-weight: bold;
		}
	}
	@media only screen and (min-width: 960px) {
		.registration-card {
			width: 35%;
		}
	}

.name-uppercase input {
	text-transform :uppercase!important;
}
</style>
