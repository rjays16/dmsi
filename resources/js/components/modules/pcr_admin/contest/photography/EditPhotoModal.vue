
<template>
	<div
		class="modal fade"
		id="editPhotoModal"
		tabindex="-1"
		role="dialog"
		v-loading.fullscreen.lock="fullscreenLoading"
	>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Edit Entry</h5>
					<div class="box-tools pull-right">
						<button
							type="button"
							data-dismiss="modal"
							data-toggle="tooltip"
							title="Close"
							class="btn btn-box-tool"
						>
							<i class="ti-close"></i>
						</button>
					</div>
				</div>
				<div class="modal-body modal-body-padding mt-2">
					<div class="form-group form-input-spacing">
						<label>Title of Entry</label>
						<!-- <input type="text" class="form-control" v-model="data.contest_title"> -->
						<el-input
							type="textarea"
							:rows="3"
							placeholder="Please input"
							v-model="data.contest_title"
						>
						</el-input>
					</div>
					<div class="form-group form-input-spacing">
						<label>Author</label>
						<input
							type="text"
							class="form-control"
							v-model="data.contest_author"
						/>
					</div>
					<div class="form-group form-input-spacing sec-photo">
						<label>Image</label>
						<el-upload
							class="avatar-uploader ava-icon-square"
							action="https://jsonplaceholder.typicode.com/posts/"
							:http-request="addAttachment3"
							:auto-upload="false"
							:show-file-list="false"
							:on-success="handleDepositSuccess"
							:on-change="handleImageUpload3"
							accept="image/png, image/jpeg, image/jpg"
							:file-list="attachments3"
						>
							<img v-if="imageUrl3" :src="imageUrl3" class="avatar" />
							<i
								v-else
								class="el-icon-camera-solid avatar-uploader-icon"
							></i>
						</el-upload>
                        <span><i>Note: Just Click the Picture to Change</i></span>
					</div>
				</div>
				<div class="modal-footer d-block border-0 text-center">
					<el-button type="primary" @click="submit()" size="small"
						>UPDATE</el-button
					>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				fullscreenLoading: false,
				token: this.$cookies.get("token"),
				data: {
					id: null,
					contest_title: null,
					contest_author: null,
					contest_image: null,
					contest_image_link: null,
				},
                attachments3: [],
                imageUrl3: "",
                image3_change: false,
                image3:{},
                imageUrl3final: {},

                image_types: ["image/png", "image/jpg", "image/jpeg"],
				file_max: 200000000,
			};
		},
		methods: {
			showModal(data) {
				this.data.id = data.id;
				this.data.contest_title = data.contest_title;
				this.data.contest_author = data.contest_author;
				this.data.contest_image = data.contest_image;
				this.data.contest_image_link = data.contest_image_link;
                this.imageUrl3 = this.data.contest_image_link;
				//   this.data.contest_institution = data.contest_institution;
				//   this.data.contest_pdf = data.contest_pdf;
				$("#editPhotoModal").modal("show");
			},

			submit() {
				this.fullscreenLoading = true;
				let formBody = new FormData();
				formBody.append("id", this.data.id);
				// formBody.append("id", 123123);
				formBody.append("contest_title", this.data.contest_title);
				formBody.append("contest_author", this.data.contest_author);
				if (this.image3_change) {
					formBody.append("contest_image", this.imageUrl3final);
				}

				axios
					.post("/api/contest/editPhotoContestEntry", formBody, {
						headers: {
							Authorization: "Bearer " + this.$cookies.get("token"),
						},
					})
					.then((res) => {
						this.$message.success("Successfully updated.");
						this.fullscreenLoading = false;
						this.$parent.getAllEntries();
						$("#editPhotoModal").modal("hide");
					})
					.catch((err) => {
						console.log(err);
						this.$message.error(
							"Something went wrong. Please contact support. " + err
						);
						this.fullscreenLoading = false;
					});
			},

            addAttachment3(file, fileList) {
				this.attachments3.push(file);
			},
            	handleDepositSuccess(file) {
				console.log(file);
				this.imageUrl3 = URL.createObjectURL(file.raw);
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
		},
	};
</script>

<style scoped>
	input[type="number"]::-webkit-inner-spin-button,
	input[type="number"]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
</style>

<style>

	.sec-photo {
		text-align: left;
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
		text-align: left;
		background: #dddddd;
	}
	.sec-photo .avatar-uploader .el-upload:hover .avatar-uploader-icon {
		color: #ffffff;
	}
	.sec-photo .avatar {
		width: 300px;
		height: 250px;
		display: block;
		margin: 0 !important;
        object-fit:contain;
	}
	.sec-photo .avatar-uploader.ava-icon-square .el-upload {
		border-radius: 0;
	}

</style>
