<template>
	<transition name="el-zoom-in-top">
		<div
			class="content-wrapper page-site-profile"
			v-loading.fullscreen.lock="fullscreenLoading"
		>
			<!-- Main content -->
			<section class="page-header">
				<div class="page-site-profile-header">
					<div class="page-site-profile-header-text">Profile</div>
				</div>
			</section>
			<section class="content">
				<div class="container">
					<div class="meeting-cont d-none">
						<h6><b>Dear PCR Radiologist member:</b></h6>
						<p class="mt-4">You are invited to a Zoom meeting. </p>
						<p><b>When:</b> Feb 25, 2021 06:00 PM Singapore</p>
						<p><b>Topic:</b> PCR Business Meeting 2021/General Assembly</p>
						<p class="mt-5">Note:</p>
						<p><b>PLEASE CHANGE YOUR ZOOM ACCOUNT USING YOUR FULL NAME AND IF POSSIBLE PUT DPBR OR FPCR TO FACILITATE IDENTIFICATION BY HOSTS.</b></p>
						<p class="mt-5">Register in advance for this meeting:</p>
						<el-button @click="goToMeeting()" icon="el-icon-right" type="primary">Please Click Here</el-button>
						<p class="mt-5">After registering, you will receive a confirmation email containing information about joining the meeting.</p>
						<p></p>
						<p></p>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<el-card class="box-card profile-card my-5">
								<!-- <div class="sec-profile-photo">
									<img :src="profile_pic" />
								</div> -->
								<el-upload
									class="sec-profile-photo"
									action="https://jsonplaceholder.typicode.com/posts/"
									:http-request="addAttachment4"
									:auto-upload="false"
									:show-file-list="false"
									:on-success="handleDepositSuccess2"
									:before-upload="beforeAvatarUpload2"
									:on-change="handleImageUpload4"
									accept="image/png, image/jpeg, image/jpg"
									:file-list="attachments4"
								>
									<img v-if="profile_pic" :src="profile_pic" @error="replaceByDefault" />
									<i
										v-else
										class="el-icon-camera-solid avatar-uploader-icon"
										style="
											background: #dddddd;
											font-size: 50px;
											padding: 20px;
										"
									></i>
								</el-upload>
								<div class="sec-profile-register mt-4 text-center">
									<el-button
										class="reg-goto-btn"
										:style="
											profile_pic_change == true
												? 'background-color:#409EFF !important;'
												: 'background-color:#BEBEBE !important;'
										"
										type="primary"
										round
										@click="uploadProfilePic()"
										:disabled="!profile_pic_change"
										>Save</el-button
									>
								</div>
								<hr />
								<div class="sec-personal-info">
									<p class="mb-3 font-weight-bold">
										Personal Information
									</p>
									<p class="mb-1 font-weight-bold">Name</p>
									<el-input
										class="mb-3"
										:disabled="true"
										v-model="full_name"
									></el-input>
									<p class="mb-1 font-weight-bold">Email</p>
									<el-input
										class="mb-3"
										:disabled="true"
										v-model="email"
									></el-input>
									<p class="mb-1 font-weight-bold">Contact Number</p>
									<el-input
										class="mb-3"
										:disabled="true"
										v-model="phone_num"
									></el-input>
									<p class="mb-1 font-weight-bold">PRC Number</p>
									<el-input
										class="mb-3"
										:disabled="true"
										v-model="pcr_num"
									></el-input>
								</div>
								<div>
									<!-- <div class="sec-mailing-info mt-3">
										<p class="mb-3 font-weight-bold">
											Mailing Information
										</p>
										<el-input
											class="mb-3"
											type="textarea"
											autosize
											v-model="mailing_address"
											placeholder="Number / Street / Town / City / Municipality / Province / Postal code"
										>
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
									<!-- Membership Chapter -->
									<div
										class="sec-membership-info mt-4"
										v-if="trainee_status == 1"
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
										v-if="trainee_status == 1"
										class="sec-membership-info mt-4"
									>
										<p class="mb-3 font-weight-bold">Membership</p>
										<span><i>Not Applicable</i></span>
									</div>
									<div
										v-if="trainee_status == 0"
										class="sec-membership-info mt-4"
									>
										<p class="mb-2 font-weight-bold">Membership</p>
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
									<!-- PRC Chapter -->
									<div
										v-if="trainee_status == 1"
										class="sec-prc-chapter-info mt-4"
									>
										<p class="mb-2 font-weight-bold">PRC Chapter</p>
										<span><i>Not Applicable</i></span>
									</div>
									<div
										v-if="trainee_status == 0"
										class="sec-prc-chapter-info mt-4"
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

								<div class="sec-profile-register mt-4 text-center">
									<el-button
										@click="updateMembersProfile()"
										class="reg-goto-btn"
										:style="'background-color:#409EFF !important;'"
										type="primary"
										round
										>Update</el-button
									>
								</div>

								<!-- <hr>  -->

								<!-- <div class="sec-profile-register mt-4 text-center">
                                <div class="mb-3"><el-button type="text" @click="$router.push('login')" class="font-weight-bold">Forgot Password?</el-button>.</div>
                                <el-button  class="reg-goto-btn" type="primary" round  @click="gotoConvReg()">Register to Convention</el-button>
                            </div> -->
							</el-card>
						</div>
						<div class="col-lg-7">
							<div class="row">
								<div class="col">
									<el-card class="box-card profile-card w-100 mt-5">
										<div class="class-text-center mt-4">
											<div
												class="text-center"
												style="font-size: 30px"
											>
												Your Annual Dues
											</div>
											<hr />
											<div
												class="p-3 my-2"
												style="
													border-style: dashed;
													border-color: #afafaf;
												"
											>
												<div style="font-size: 22px">
													₱{{ balance.toFixed(2) }}
												</div>
												<!-- <p style="font-size:12px;">or contactsecretarist for dues ABOVE ₱{{balance.toFixed(2)}}</p> -->
											</div>
											<!-- <p style="font-size:12px;">Deposite your dues to __________ and send your deposit slip to pcr_secretariat@yahoo.com</p> -->
										</div>
									</el-card>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<el-card class="box-card profile-card mt-3">
										<div class="class-text-center">
											<div
												style="font-size:15px; !important"
												class="mt-2 text-center"
											>
												<b
													>Take part in the 2021 PCR National
													Elections</b
												>
											</div>
											<div
												class="sec-profile-register mt-4 text-center"
											>
												<div v-if="activeperiod === 1">
													<el-button
														v-if="checkVoted === 0"
														:disabled="balance > 0"
														class="elec-goto-btn"
														style="
															background-color: ##409eff !important;
														"
														type="primary"
														@click="gotoElection()"
														round
														>PROCEED</el-button
													>
													<el-button
														v-else
														disabled
														class="reg-goto-btn"
														style="
															background-color: #bebebe !important;
														"
														type="primary"
														round
														>VOTE SUBMITTED</el-button
													>
												</div>
												<div
													v-else
													style="font-size:10px; !important"
													class="mt-4 mb-5 text-center"
												>
													There's no active election in progress.
												</div>
											</div>
											<div
												style="font-size:10px; !important"
												class="mt-4 mb-5 text-center"
											>
												Note: Eligibility to vote requires good
												standing membership status
											</div>
										</div>
									</el-card>
								</div>
								<div class="col-md-6">
									<el-card class="box-card profile-card mt-3">
										<div class="sec-photo text-left mt-2 mb-1">
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
												:file-list="attachments3"
											>
												<img
													v-if="imageUrl3"
													:src="imageUrl3"
													class="avatar"
												/>
												<i
													v-else
													class="el-icon-camera-solid avatar-uploader-icon"
												></i>
											</el-upload>
											<div
												class="mt-3 font-italic"
												style="font-size:10px; !important"
											>
												Upload your Annual dues deposit slip here.
											</div>
											<div
												class="sec-profile-register mt-4 text-center"
											>
												<el-button
													class="reg-goto-btn"
													:style="
														image3_change == true
															? 'background-color:#409EFF !important;'
															: 'background-color:#BEBEBE !important;'
													"
													type="primary"
													round
													@click="uploadDepositSlip()"
													:disabled="!image3_change"
													>Save</el-button
												>
											</div>
										</div>
									</el-card>
								</div>
								<div class="col-md-6">
									<el-card class="box-card profile-card mt-3">
										<div class="class-text-center">
											<div
												class="sec-profile-register mt-4 mb-4 text-center"
											>
												<el-button
													class="reg-goto-btn"
													type="primary"
													round
													@click="gotoConvReg()"
													>Register to Convention</el-button
												>
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
	import { required, integer, email, sameAs } from "vuelidate/lib/validators/";
	export default {
		name: "Profile",
		created() {
			this.getMemberTypes();
			this.getChapterTypes();

			axios
				.get("/api/user", {
					headers: { Authorization: "Bearer " + this.$cookies.get("token") },
				})
				.then((response) => {
					// var filepath = response.data.profile_pic;
					// if (filepath) {
					// 	var fin_filepath = filepath.replace("public", "storage");
					// 	this.profile_pic = fin_filepath;
					// }
					this.userable_type = response.data.userable_type;
					this.user_id = response.data.id;

					console.log(response);
					let d = new Date();
					d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000);
					let expires = "expires=" + d.toUTCString();
					// this.$cookies.set(
					// 	"member_id",
					// 	response.data.userable_id,
					// 	expires,
					// 	"/"
					// );
					axios
						// .get("/api/pcr/member/" + response.data.userable_id, {
						.get(`/api/pcr/memberemail?email=${response.data.email}`, {
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
						})
						.then((response2) => {
							this.$cookies.set(
								"member_id",
								response2.data.id,
								expires,
								"/"
							);
							this.member_id = response2.data.id;
							this.conv_url = response2.data.conv_url;
							//response data
							this.full_name =
								response2.data.first_name + " " + response2.data.last_name;
							this.email = response2.data.email;
							this.phone_num = response2.data.contact_number;
							this.pcr_num = response2.data.prc_number;

							// this.mailing_address = response2.data.address;
							let arr = [];
							let addressStr = response2.data.address;
							if (addressStr) {
								arr = addressStr.split(",");
								this.address.country = arr[2].trim();
								this.address.region = arr[1].trim();
								this.address.city = arr[0].trim();
								this.address.zip = arr[3].trim();
							}
							this.is_trainee = response2.data.is_trainee;
							this.membership = response2.data.memberships;
							this.prc_chapter = response2.data.chapter_id;
							this.balance = response2.data.balance;
							this.training_ins = response2.data.training_ins;
							this.trainee_status = response2.data.is_trainee;
							if (this.trainee_status != 1) {
								this.chapter_id = response2.data.chapter_id;
								let string = response2.data.memberships;
								if (string) {
									string = string.split("-");
									this.mem_type_id = string.map((x) => parseInt(x));
								}
							}
							// this.member_id = response.data.userable_id;
							this.member_id = response2.data.id;
							this.getActiveElectionPeriod(this.member_id);
							if (response2.data.deposit_slip) {
								// console.log(response2.data.deposit_slip);
								this.imageUrl3 =
									"/" +
									response2.data.deposit_slip.replace(
										"public",
										"storage"
									);
							}

							var filepath = response2.data.profile_pic;
							if (filepath) {
								this.profile_pic = filepath;
							}

							//   console.log(response2.data.balance);
							//   console.log(response2.data.year_last_paid);
						});
				})
				.catch((error) => {
					console.log(error);
				});
			let subdomain = location.hostname.split(".").shift();
			this.subdomain = subdomain;
		},

		data() {
			return {
				subdomain: "",
				memberTypes: [],
				mem_type_id: [],
				mem_type_id_string: [],
				chapterTypes: [],
				chapter_id: 1,
				trainee_status: 1,
				fullscreenLoading: false,
				member_id: null,

				full_name: null,
				email: null,
				phone_num: null,
				pcr_num: null,
				mailing_address: null,
				is_trainee: null,
				membership: null,
				prc_chapter: null,
				profile_pic: null,
				profile_pic_change: false,
				profile_pic_final: {},
				balance: 0,
				token: this.$cookies.get("token"),
				attachments3: [],
				attachments4: [],
				imageUrl3: "",
				image_types: ["image/png", "image/jpg", "image/jpeg"],
				file_max: 10000000,
				image3: {},
				image4: {},
				imageUrl3final: {},
				image3_change: false,
				training_ins: "",
				address: {
					country: "",
					region: "",
					city: "",
					zip: "",
				},
				activeElectionPeriod: [],
				voted: [],
				userable_type: null,
				user_id: null,
                conv_url:null,
				good_standing: null
			};
		},
		validations: {
			address: {
				country: { required },
				region: { required },
				city: { required },
				zip: { required },
			},
		},
		computed: {
			activeperiod() {
				return this.activeElectionPeriod.length;
			},
			checkVoted() {
				return this.voted.length;
			},
		},
		methods: {
            replaceByDefault(e) {
                var img = "/images/noprofile.png";
                e.target.src = img;
            },
			uploadDepositSlip() {
				this.fullscreenLoading = true;
				let formBody = new FormData();
				formBody.append("deposit_slip", this.imageUrl3final);
				axios
					.post(`/api/pcr/upload/deposit/${this.member_id}`, formBody, {
						headers: {
							Authorization: "Bearer " + this.$cookies.get("token"),
						},
					})
					.then((res) => {
						this.$message.success("Successfully uploaded.");
						this.fullscreenLoading = false;
						this.image3_change = false;
					})
					.catch((err) => {
						console.log(err);
						this.$message.error(
							"Something went wrong. Please contact support. " + err
						);
						this.fullscreenLoading = false;
					});
			},
			uploadProfilePic() {
				this.fullscreenLoading = true;
				let formBody = new FormData();
                formBody.append("profile_pic", this.profile_pic_final);
				formBody.append("user_id", this.user_id);
				if (this.userable_type === "App\\Models\\PCRMember") {
					axios
						.post(`/api/changeProfilePic`, formBody, {
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
						})
						.then((res) => {
							this.$message.success("Successfully uploaded.");
							this.fullscreenLoading = false;
							this.profile_pic_change = false;
						})
						.catch((err) => {
							console.log(err);
							this.$message.error(
								"Something went wrong. Please contact support. " + err
							);
							this.fullscreenLoading = false;
						});
				}else {
                   	// this.$message.success(this.conv_url);
					// this.fullscreenLoading = false;
                    axios
						.post(this.conv_url+'api/changeProfilePic', formBody, {
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
						})
						.then((res) => {
							this.$message.success("Successfully uploaded.");
							this.fullscreenLoading = false;
							this.profile_pic_change = false;
						})
						.catch((err) => {
							console.log(err);
							this.$message.error(
								"Something went wrong. Please contact support. " + err
							);
							this.fullscreenLoading = false;
						});
                }
			},
			isEmptyOrSpaces(str) {
				return str === null || str.match(/^ *$/) !== null;
			},
			updateMembersProfile() {
				this.fullscreenLoading = true;
				this.$v.$touch();

				if (!this.$v.$invalid) {
					// if (this.isEmptyOrSpaces(this.mailing_address)) {
					// 	this.$message.error("Mailing Address is required");
					// 	this.fullscreenLoading = false;
					// } else {
					let newAddress =
						this.address.city +
						", " +
						this.address.region +
						", " +
						this.address.country +
						", " +
						this.address.zip;

					let data = {
						address: newAddress,
						is_trainee: this.trainee_status,
						chapter_id: this.chapter_id,
						memberships: this.mem_type_id_string,
					};
					axios
						.put(`/api/pcr/member/${this.member_id}`, data, {
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
						})
						.then((res) => {
							// this.$message.success(
							// 	"Member`s Profile successfully updated."
							// );
							this.$notify({
								message: "Member`s Profile successfully updated.",
								type: "success",
								position: "bottom-right",
							});
							this.fullscreenLoading = false;
						})
						.catch((err) => {
							console.log(err);
							this.$message.error(
								"Something went wrong. Please contact support. " + err
							);
							this.fullscreenLoading = false;
						});
					// }
				} else {
					this.fullscreenLoading = false;
					this.$notify({
						message:
							"Missing or incorrect fields, please fill in all fields properly",
						type: "error",
						position: "bottom-right",
					});
				}
			},
			gotoConvReg() {
				// let conventionUrl = process.env.MIX_URL_CONV+'registration?id='+this.member_id;
				// window.open(conventionUrl);
				if (this.subdomain == "beta2") {
					// location.href =
					// 	"https://beta2.73rdpcrannualconvention.com/registration?id=" +
					//     this.member_id;
					window.open(
						"https://beta2.73rdpcrannualconvention.com/registration?id=" +
							this.member_id
					);
				} else {
					// location.href =
					// 	"https://73rdpcrannualconvention.com/registration?id=" +
					// 	this.member_id;
					window.open(
						"https://73rdpcrannualconvention.com/registration?id=" +
							this.member_id
					);
				}
			},
			addAttachment3(file, fileList) {
				this.attachments3.push(file);
			},
			addAttachment4(file, fileList) {
				this.attachments4.push(file);
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
			},
			beforeAvatarUpload2(file) {
				const isPIC = file.type === "image/jpeg";
				const isLt2M = file.size / 1024 / 1024 < 2;

				if (!isPIC) {
					this.$message.error("Profile photo must be an image filetype.");
				}
				if (!isLt2M) {
					this.$message.error("Profile photo cannot exceed 2MB.");
				}
			},
			handleDepositSuccess(file) {
				console.log(file);
				this.imageUrl3 = URL.createObjectURL(file.raw);
			},
			handleDepositSuccess2(file) {
				console.log(file);
				this.profile_pic = URL.createObjectURL(file.raw);
			},
			handleImageUpload3(f, filelist) {
				this.fullscreenLoading = true;
				// STORES IMAGE IN FILE INPUT THEN STORES THE NAME OF THE FILE IN THE TEXT INPUT FOR VALIDATION
				let file = f;
				this.validateFile(file.raw, "photo", (result) => {
					this.fullscreenLoading = false;
					if (!result) {
						file = null;
					}

					this.imageUrl3 = file.raw;
					this.image3_change = true;
					if (this.imageUrl3) {
						var reader = new FileReader();
						// this.$v.image3.$model = this.imageUrl3
						this.image3 = this.imageUrl3;

						reader.onload = (e) => {
							this.imageUrl3 = e.target.result;
						};
						reader.readAsDataURL(this.imageUrl3);
					} else {
						this.image3 = "";
					}
				});
				// this.step3.imageUrl3final = f.raw
				this.imageUrl3final = f.raw;
			},
			handleImageUpload4(f, filelist) {
				this.fullscreenLoading = true;
				// STORES IMAGE IN FILE INPUT THEN STORES THE NAME OF THE FILE IN THE TEXT INPUT FOR VALIDATION
				let file = f;
				this.validateFile(file.raw, "photo", (result) => {
					this.fullscreenLoading = false;
					if (!result) {
						file = null;
					}

					this.profile_pic = file.raw;
					this.profile_pic_change = true;
					if (this.profile_pic) {
						var reader = new FileReader();
						// this.$v.image3.$model = this.imageUrl3
						this.image4 = this.profile_pic;

						reader.onload = (e) => {
							this.profile_pic = e.target.result;
						};
						reader.readAsDataURL(this.profile_pic);
					} else {
						this.image4 = "";
					}
				});
				// this.step3.imageUrl3final = f.raw
				this.profile_pic_final = f.raw;
			},
			validateFile(file, type, callback) {
				// VALIDATE IMAGE FILE
				let valid_types = this.image_types;
				if (!file) {
					callback(false);
				} else if (file.size > this.file_max) {
					this.$message.error("File is too big!");
					callback(false);
				}
				//   else if(!valid_types.includes(file.type)) {
				//     this.$message.error('Invalid file type');
				//     callback(false)
				//   }
				else {
					callback(true);
				}
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
			gotoElection() {
				this.$router.push("election?id=" + this.member_id);
			},
			getActiveElectionPeriod(memberID) {
				this.checkActiveElection()
				axios.get('/api/election/active/profile', {
					headers: { Authorization: "Bearer " + this.$cookies.get("token"), }
				})
				.then(res => {
					if(res.data) {
						this.activeElectionPeriod = res.data;
						if(res.data.length >= 1){
                        	this.checkVoteStatus(this.activeElectionPeriod[0].id,memberID)
                   		 }
						//console.log(this.$cookies.get("token"));
					} 
				})
				.catch(err => {
					console.log(err);
				})
			
			},
			checkActiveElection(){
				axios.get('/api/election/checkActive', {
					headers: { Authorization: "Bearer " + this.token }
				})
				.then(res => {
					if(res.data) {
						//console.log(res.data);
					} 
				})
				.catch(err => {
					console.log(err);
				})
        	},
			goToMeeting() {
				var url = 'https://us02web.zoom.us/meeting/register/tZ0kdOuppzgsHdeVG3qfT0Za_muxRBmy9YwS'
				var target = '_blank'
				window.open(url, target)
			},

			checkVoteStatus(election,member) {
				//console.log(election+" "+member);
				axios.get('/api/election/checkVoteStatus/'+member+'/'+election, {
					headers: { Authorization: "Bearer " + this.$cookies.get("token"), }
					})
					.then((res) => {
						if (res.data) {
							this.voted = res.data;
						}
					})
					.catch((err) => {
						console.log(err);
					});
			},
		},
	};
</script>

<style>
	button.el-button.reg-goto-btn.is-disabled {
		background-color: rgb(190, 190, 190) !important;
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
	.page-site-profile-header-text {
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
	/* @media only screen and (min-width: 960px)  {
	.profile-card {
	width:35%;
	}
} */
	.meeting-cont {
		margin-top:20px;
		font-size:1.1rem;
		padding:20px;
		background:#f8f8f8;
	}
	.meeting-cont b {
		font-weight:bold;
	}
</style>
