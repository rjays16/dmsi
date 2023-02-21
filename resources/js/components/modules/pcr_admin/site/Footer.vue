<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Site / Footer</span>
            </div>            
            <div class="container-fluid pb-5">
                
                <div class="admin-conent my-5 mx-3 p-4">
                    <div class="bg-white p-4">
                        <h1>Site Footer Settings</h1>      
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                <div class="ann-content">
                                    <p class="font-weight-bold mb-2">Footer Copyright Text</p>
                                    <el-input class="mb-4" placeholder="Enter Footer Copyright Text" v-model="footer_text"></el-input>
                                </div>

                                <div class="ann-sidebar">

                                    <el-card class="box-card mb-4" shadow="never">
                                        <div slot="header" class="clearfix">
                                            <span>Logo Image</span>
                                        </div>
                                    <el-upload
                                        class="avatar-uploader logo-image-upload"
                                        action="/"
                                        accept="image/png, image/jpeg, image/jpg"
                                        :auto-upload="false"
                                        :show-file-list="false"
                                        :on-change="onImageChange"
                                    >
                                        <div v-if="footer_file_url">
                                            <div class="msg-img-thumb">
                                                <img
                                                    :src="footer_file_url"
                                                    class="avatar"
                                                />
                                            </div>
                                            <span class="msg-img-change">Click above to change footer logo image.</span>
                                        </div>
                                        <div v-else class="blank-featured-img">
                                            <i class="el-icon-plus avatar-uploader-icon"></i> Set Footer Logo Image
                                        </div>
                                        
                                    </el-upload>                                    
                                    </el-card>
                                </div>                                
                            </div>

                        </div>
                        <el-button v-if="newStatus" @click="saveFooter" class="mb-4" type="success">Save</el-button>
                        <el-button v-else @click="editFooter" class="mb-4" type="success">Update</el-button>                        
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
            image_types: ["image/png", "image/jpg", "image/jpeg"],
            footer_text: "",
            footer_id: "",
			footer_file: null,
			footer_file_url: '',
			footer_file_change: false,
			footer_file_deleted: false,
            newStatus: true,   
            token: ''
        }
    },
    methods: {
        getfooterData() {
            axios.get(`/api/footer`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
                console.log(res.data)
				if(res.data.status_code === 200) {
                    if (res.data.data.length > 0) {
                        //this.$router.push('/admin/home/main-banner/edit')
                        this.footer_text = res.data.data[0].footer_rights_text
                        this.footer_id = res.data.data[0].id
                        if (res.data.data[0].footer_logo_img !== 'null') {
                            this.footer_file_url = window.location.origin + '/' + res.data.data[0].footer_logo_img.replace("public", "storage")
                        }                        
                        this.newStatus = false
                    } else {
                        console.log(res.data.data.length)
                        this.newStatus = true      
                    }
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        saveFooter() {
            if (!this.footer_file) {
                this.$message.error('Please upload a footer logo image.')
            } else { 
                const footerData = new FormData();
                footerData.append("footer_rights_text", this.footer_text)
                footerData.append("footer_logo_img", this.footer_file)
                            
                axios.post(`/api/footer`, footerData,
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    this.$message.success('Footer settings successfully created.')
                    this.getfooterData()
                })
                .catch(error => {
                    console.log(error.data)
                    this.$message.error('Error creating footer settings.')
                })
            }
        },
        editFooter() {
             axios.put(`/api/footer/update/${this.footer_id}`, {
                footer_rights_text: this.footer_text},
                {
                headers: { Authorization: "Bearer " + this.token }
            })            
            .then(response => {
                console.log(response)
                if (this.footer_file) {
                    const footerData = new FormData();
                    footerData.append("id", this.footer_id)
                    footerData.append("footer_logo_img", this.footer_file)
                                
                    axios.post(`/api/footer/upload`, footerData,
                        {
                        headers: { Authorization: "Bearer " + this.token }
                    })
                    .then(response => {
                        console.log(response)
                        this.$message.success('Footer settings successfully updated.')
                        this.getfooterData()
                    })
                    .catch(error => {
                        console.log(error.data)
                        this.$message.error('Error updating footer settings.')
                    })                    
                } else {
                    this.$message.success('Footer settings successfully updated.')
                }
            })
            .catch(error => {
                console.log(error.data)
                this.$message.error('Error updating footer settings.')
            })

        },    
		validateFile(file, type, callback) {

			let valid_types = this.image_types;
			if (!file) {
				callback(false);
			} else if (file.size > this.file_max) {
				this.$message.error("File is too big");
				callback(false);
			} else if (!valid_types.includes(file.type)) {
				this.$message.error("Invalid file type");
				callback(false);
			} else {
				callback(true);
			}
        },
		onImageChange(file) {
			this.validateFile(file.raw, 'photo', (result) => {
				if (result == true) {
					this.footer_file = file.raw;
					this.footer_file_url = URL.createObjectURL(file.raw);
					this.footer_file_change = true;
				}
			})
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
        this.getfooterData()
	}
}
</script>

<style>

.content-wrapper {
    padding-top: 65px;
}

.ann-sidebar button {
    width:100%;
}
.ann-sidebar .el-card__header {
    font-weight:bold;
    color:#174A84;
}
.logo-image-upload,
.logo-image-upload .el-upload {
    width:100%;
}
.logo-image-upload img {
    width:50%;
}
.blank-featured-img {
    border:1px solid #DCDFE6;
    border-radius:4px;
    width:100%;
    padding:8px 10px;
}
.msg-img-thumb {
    border:1px solid #DCDFE6;
    margin-bottom:10px;
    padding:10px;
}
.msg-img-change {
    color:#131313;
    font-style: italic;
}
.el-tiptap-editor__content strong {
    font-weight: bold;
}
.admin-conent .el-tiptap-editor__content h1 {
    font-size:2.5rem!important;
    color:#000;
    margin-top:20px!important;
    margin-bottom:20px!important;
    font-weight: normal;
}
.ann-char-count {
    padding:10px;
    border:1px solid #ebeef5;
}
</style>
