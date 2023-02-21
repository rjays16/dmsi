
<template>
    <div
		class="modal fade"
		id="editResearchModal"
		tabindex="-1"
		role="dialog"
        v-loading.fullscreen.lock="fullscreenLoading"
        >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5>Edit Entry</h5>
                    <div class="box-tools pull-right">
                        <button type="button" data-dismiss="modal" data-toggle="tooltip" title="Close" class="btn btn-box-tool"><i class="ti-close"></i></button>
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
                            v-model="data.contest_title">
                        </el-input>
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="data.contest_author">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Institute</label>
                        <input type="text" class="form-control" v-model="data.contest_institution">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>PDF</label>
                        <el-upload
						class="upload-demo"
						ref="upload"
						action=""
						:auto-upload="false"
						:limit="1"
					>
						<el-button slot="trigger" size="small" type="primary"
							>Change and Select File</el-button
						>
						<!-- <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">upload to server</el-button> -->
						<div class="el-upload__tip" slot="tip">
							PDF files with a size less than 10mb
						</div>
					</el-upload>
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Video URL</label>
                        <input type="text" class="form-control" v-model="data.contest_video">
                    </div>
				</div>
				<div class="modal-footer d-block border-0 text-center">
					<el-button type="primary" @click="submitUpload()" size="small">UPDATE</el-button>
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
                contest_institution: null,
                contest_pdf: null,
                contest_video: null
            }
        }
    },
    methods: {
        showEditModal(data){
              this.data.id = data.id;
              this.data.contest_title = data.contest_title;
              this.data.contest_author = data.contest_author;
              this.data.contest_institution = data.contest_institution;
              this.data.contest_video = data.contest_video;
              $("#editResearchModal").modal('show');
        },

        submitUpload() {
                var arr = [];
                arr = this.$refs.upload.uploadFiles;
				if (arr.length > 0 ) {
					var file = this.$refs.upload.uploadFiles[0].raw;
					const isLt1MB = file.size / 1024 / 1024 < 11;
					const isPDF = file.type === "application/pdf";
					if (!isPDF) {
						this.$message.error("File must be PDF format!");
					} else {
						if (!isLt1MB) {
							this.$message.error("File size can not exceed 10MB!");
						} else {
							this.submit(file, 'pdf changed');
						}
					}
				} else {
					// this.$message.error("Please select file and enter file name.");
                    this.submit(file, 'pdf not changed');
				}
		},


        submit(file = null, pdf_status){
            this.fullscreenLoading = true;
            let formBody = new FormData();
            formBody.append("id", this.data.id);
            // formBody.append("id", 123123);
            formBody.append("contest_title", this.data.contest_title);
            formBody.append("contest_author", this.data.contest_author);
            formBody.append("contest_institution", this.data.contest_institution);
            formBody.append("contest_video", this.data.contest_video);
            if(pdf_status == "pdf changed"){
                 formBody.append("contest_pdf", file);
            }


            axios.post('/api/contest/editResearchPosterEntry', formBody, {
					headers: {
						Authorization: "Bearer " + this.$cookies.get("token"),
					},
				})
				.then((res) => {
					this.$message.success("Successfully updated.");
                    this.$refs.upload.uploadFiles = [];
					this.fullscreenLoading = false;
                    this.$parent.getAllEntries();
                      $("#editResearchModal").modal('hide');
				})
				.catch((err) => {
					console.log(err);
					this.$message.error(
						"Something went wrong. Please contact support. " + err
					);
					this.fullscreenLoading = false;
				});


        }
    }
}
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
