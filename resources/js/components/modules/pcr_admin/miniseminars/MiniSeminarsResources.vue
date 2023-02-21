<template>
	<div v-loading.fullscreen.lock="fullscreenLoading">
		<div class="booth-products p-3">
			<div class="row">
				<div class="col-sm-12 col-md-12 pt-1">
					<template>
						<el-table
							:data="resourcesData"
							stripe
							border
							style="width: 100%"
						>
							<el-table-column prop="name" label="Resources/Brochures">
								<template slot-scope="scope">
									<span style="margin-left: 10px">{{
										scope.row.file_name
									}}</span>
								</template>
							</el-table-column>
							<el-table-column prop="name" label="File Path">
								<template slot-scope="scope">
									<span style="margin-left: 10px">{{
										scope.row.file_path.replace("public", "storage")
									}}</span>
								</template>
							</el-table-column>
							<!-- <el-table-column label="">
								<template slot-scope="scope">
									<span style="margin-left: 10px">{{
										descriptionSubString(scope.row)
									}}</span>
								</template>
							</el-table-column> -->
							<el-table-column align="right" width="180">
								<template slot-scope="scope">
									<!-- <el-button
										class="btn-product-edit mx-2"
										@click="showEditModal(scope.row)"
										icon="el-icon-edit"
										type="text"
									></el-button> -->
									<el-button
										class="btn-product-delete mx-2"
										@click="showDeleteModal(scope.row)"
										icon="el-icon-delete"
										type="text"
									></el-button>
								</template>
							</el-table-column>
						</el-table>
					</template>
				</div>
			</div>
			<div class="text-center">
				<el-button
					:disabled="resourcesData.length >= 10"
					@click="addProductDialogVisibile = true"
					class="mt-4 mb-5"
					type="warning"
					>ADD NEW RESOURCES/BROCHURES</el-button
				>
			</div>
		</div>
		<!-- <el-button type="primary" size="small">Save Products</el-button> -->

		<div>
			<el-dialog
				title="Add New Resource/Brochure"
				:visible.sync="addProductDialogVisibile"
				:close-on-click-modal="false"
			>
				<div class="mb-2">
					<p class="mb-3 font-weight-bold">File Name</p>
					<el-input v-model="resource.file_name" class="mb-3"></el-input>
				</div>
				<div class="mb-2">
					<el-upload
						class="upload-demo"
						ref="upload"
                        accept="application/pdf"
						action=""
						:auto-upload="false"
						:limit="1"
					>
						<el-button slot="trigger" size="small" type="primary"
							>Select File</el-button
						>
						<!-- <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">upload to server</el-button> -->
						<div class="el-upload__tip" slot="tip">
							PDF files with a size less than 5mb
						</div>
					</el-upload>
				</div>
				<div class="text-center">
					<el-button type="primary" @click="submitUpload()" size="small"
						>Add Resource/Brochure</el-button
					>
				</div>
			</el-dialog>

			<el-dialog
				:title="`Are you sure you want to delete this brochure? <br> ( ${productDeleteName} )`"
				:visible.sync="deleteProductDialogVisibile"
				:close-on-click-modal="false"
			>
				<div class="text-center">
					<el-button type="primary" size="small" @click="deleteProduct()"
						>Yes, delete this brochure</el-button
					>
				</div>
			</el-dialog>
		</div>
	</div>
</template>

<script>
	export default {
		props: ["sponsor"],
		data() {
			return {
				image_types: ["image/png", "image/jpg", "image/jpeg"],
				file_max: 1000000,

                session_id: this.$route.query.id,

				//Products
				productsSectionIntro: "",
				resource: {
					sponsor_id: null,
					file_path: null,
					file_name: null,
				},
				productEdit: {
					id: null,
					name: "",
					desc: "",
					image: "",
					image_url: "",
					image_change: false,
				},
				productDeleteId: null,
				productDeleteName: "",

				resourcesData: [],

				addProductDialogVisibile: false,
				editProductDialogVisibile: false,
				deleteProductDialogVisibile: false,

				fullscreenLoading: false,
				attachments: [],

                token: ''
			};
		},
		created() {
			// this.getAllProducts();
		},
		methods: {
			submitUpload() {
                var arr = [];
                arr = this.$refs.upload.uploadFiles;
				if (arr.length > 0 && this.resource.file_name) {
					var file = this.$refs.upload.uploadFiles[0].raw;
					const isLt1MB = file.size / 1024 / 1024 < 6;
					const isPDF = file.type === "application/pdf";
					if (!isPDF) {
						this.$message.error("File must be PDF format!");
					} else {
						if (!isLt1MB) {
							this.$message.error("File size can not exceed 5MB!");
						} else {
							this.addProduct(file);
						}
					}
				} else {
					this.$message.error("Please select file and enter file name.");
				}
			},
			showEditModal(data) {
				console.log(data);
				this.productEdit.id = data.id;
				this.productEdit.name = data.name;
				this.productEdit.desc = data.description;
				this.productEdit.image_url =
					"/" + data.img_path.replace("public", "storage");
				this.productEdit.image_change = false;
				this.editProductDialogVisibile = true;
			},
			showDeleteModal(data) {
				console.log(data);
				this.productDeleteId = data.id;
				this.productDeleteName = data.file_path;
				this.deleteProductDialogVisibile = true;
			},
			getAllResources() {
                axios.get(`/api/minisession/materials/session/${this.session_id}`, {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(res => {
                    if(res.data) {
                        this.resourcesData = res.data;
                    }
                })
                .catch(err => {
                    console.log(err);
                });	
			},
			addProduct(file) {
				this.fullscreenLoading = true;
				let formBody = new FormData();
				//formBody.append("sponsor_id", this.sponsor.id);
				formBody.append("file_path", file);
				formBody.append("file_name", this.resource.file_name);
				axios

                axios.post(`/api/minisession/upload/session/${this.session_id}`, formBody, {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(res => {
						console.log(res);
						this.resource.file_path = null;
						this.resource.file_name = null;
						this.getAllResources();
						this.fullscreenLoading = false;
						this.$message.success("Successfully Added.");
						this.addProductDialogVisibile = false;
						this.$refs.upload.uploadFiles = [];
                })
                .catch(err => {
						console.error(err);
						this.fullscreenLoading = false;
						this.$message.error("Something went wrong.");
                });	


			},
			editProduct() {
				this.fullscreenLoading = true;
				let formBody = new FormData();
				formBody.append("name", this.productEdit.name);
				formBody.append("description", this.productEdit.desc);
				if (this.productEdit.image_change) {
					formBody.append("img_path", this.productEdit.image);
				}
				axios
					.post(
						`/api/sponsors/productupdate/${this.productEdit.id}`,
						formBody,
						{
							headers: {
								Authorization: "Bearer " + this.$cookies.get("token"),
							},
						}
					)
					.then((res) => {
						console.log(res);
						this.productEdit.id = null;
						this.productEdit.name = "";
						this.productEdit.desc = "";
						this.productEdit.image = "";
						this.productEdit.image_url = "";
						this.productEdit.image_change = false;
						this.getAllResources(this.sponsor.id);
						this.fullscreenLoading = false;
						this.$message.success("Successfully Updated.");
						this.editProductDialogVisibile = false;
					})
					.catch((err) => {
						console.error(err);
						console.log(res);
						this.productDeleteId = null;
						this.productDeleteName = "";
						this.fullscreenLoading = false;
						this.$message.error("Something went wrong.");
					});
			},
			deleteProduct() {
				this.fullscreenLoading = true;
				axios
					.delete(`/api/minisession/materials/${this.productDeleteId}`, {
						headers: {
							Authorization: "Bearer " + this.token,
						},
					})
					.then((res) => {
						this.fullscreenLoading = false;
						this.$message.success("Successfully Deleted.");
						this.deleteProductDialogVisibile = false;
						this.getAllResources();
					})
					.catch((err) => {
						console.error(err);
						this.fullscreenLoading = false;
						this.$message.error("Something went wrong.");
					});
			},

			validateFile(file, type, callback) {
				// VALIDATE IMAGE FILE
				// console.log(file.type);
				// callback(true);
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
		},
        mounted() {
            this.getTokenCookie()
            this.getAllResources()
        }        
	};
</script>
