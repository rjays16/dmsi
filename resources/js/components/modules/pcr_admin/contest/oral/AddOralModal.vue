<template>
    <div
		class="modal fade"
		id="addEntryModal"
		tabindex="-1"
		role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5>Add an Entry</h5>
                    <div class="box-tools pull-right">
                        <button type="button" data-dismiss="modal" data-toggle="tooltip" title="Close" class="btn btn-box-tool"><i class="ti-close"></i></button>
                    </div>
				</div>
				<div class="modal-body modal-body-padding mt-2">
					<div class="form-group form-input-spacing">
                        <label>Title of Entry</label>
                        <input type="text" class="form-control" v-model="data.contest_title">
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
							>Select File</el-button
						>
						<!-- <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">upload to server</el-button> -->
						<div class="el-upload__tip" slot="tip">
							PDF files with a size less than 10mb
						</div>
					</el-upload>
                    </div>
				</div>
				<div class="modal-footer d-block border-0 text-center">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" @click="update" :disabled="!validate" v-if="is_edit">Update</button>
					<!-- <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" @click="submitUpload()">SUBMIT</button> -->
                <el-button type="primary" @click="submitUpload()" size="small">SUBMIT</el-button>
                </div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        item_data: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            data: {
                contest_title: null,
                contest_author: null,
                contest_institution: null,
                contest_pdf: null,
            }
        }
    },
    computed: {
        validate() {
            if(
                this.data.contest_title &&
                this.data.contest_author &&
                this.data.contest_institution &&
                this.data.contest_pdf
            ) {
                return true;
            } else {
                return false;
            }
        },
        is_edit() {
            return this.item_data ? true : false;
        }
    },
    mounted() {
        this.getTokenCookie()
        this.initData();
        $("#addEntryModal").modal();
        $("#addEntryModal").on("hidden.bs.modal", () => {
            this.$emit('closeModal');
        });
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
        submitUpload() {
            var arr = [];
            arr = this.$refs.upload.uploadFiles;
            if (arr.length > 0) {
                var file = this.$refs.upload.uploadFiles[0].raw;
                const isLt1MB = file.size / 1024 / 1024 < 11;
                const isPDF = file.type === "application/pdf";
                if (!isPDF) {
                    this.$message.error("File must be PDF format!");
                } else {
                    if (!isLt1MB) {
                        this.$message.error("File size can not exceed 11MB!");
                    } else {
                        this.createOralResearch(file);
                    }
                }
            } else {
                this.$message.error("Please select file and enter file name.");
            }
        },
        createOralResearch(file) {
                let formBody = new FormData();
                formBody.append("contest_title", this.data.contest_title);
                formBody.append("contest_author", this.data.contest_author);
                formBody.append("contest_institution", this.data.contest_institution);
				formBody.append("contest_pdf", file);
                axios
					.post(`/api/contest/item/create/oral`, formBody, {
						headers: {
							Authorization: "Bearer " + this.token,
						},
					})
					.then((res) => {
						console.log(res);
						this.data.contest_title = null;
						this.data.contest_author = null;
						this.data.contest_institution = null;
						this.data.contest_pdf = null;
                        this.$refs.upload.uploadFiles = [];
                        window.location.href = '/admin/contest/oral-research'
						this.$message.success("Successfully Added.");
					})
					.catch((err) => {
						console.error(err);
						this.$message.error("Something went wrong.");
					});
        },
        initData() {
            if(this.item_data) {
                this.data.contest_id = this.item_data.contest_id;
                this.data.contest_title = this.item_data.contest_title;
                this.data.contest_author = this.item_data.contest_author;
                this.data.contest_institution = this.item_data.contest_institution;
                this.data.contest_pdf = this.item_data.contest_pdf;
            }
        },
        create() {
            this.$emit('create', this.data);
        },
        update() {
            this.$emit('update', this.data);
        },
    }
}
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
