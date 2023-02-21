<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Virtual Exhibitor Slider / Add Slide</span>
            </div>            
            <div class="container-fluid pb-5">
                
                <div class="admin-conent my-5 mx-3 p-4">
                    <el-button size="small" class="mb-4" type="primary" @click.native="$router.push('/admin/slider')">Back</el-button>
                    <div class="bg-white p-4">
                        <h1>Edit Slide</h1>      
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <p class="mb-2 font-weight-bold">Slide Name</p>
                                <el-input class="mb-3" placeholder="Slide Name" v-model="ad_title"></el-input>
                                <p class="mb-2 font-weight-bold">Slide Description</p>
                                <el-input class="mb-3" placeholder="Slide Name" v-model="ad_content"></el-input>
                                <p class="mb-2 font-weight-bold">Slide Order Number</p>
                                <el-input-number class="mb-3" v-model="ad_order" :min="1" :max="1000"></el-input-number>

                                <p class="mb-2 font-weight-bold">Upload Slide Image</p>
                                <p><em>Recommended dimensions: 1900px by 500px</em></p>
                                <el-upload
                                    class="avatar-uploader ad-featured-upload"
                                    style="max-width:320px;"
                                    action="/"
                                    accept="image/png, image/jpeg, image/jpg, image/gif"
                                    :auto-upload="false"
                                    :show-file-list="false"
                                    :on-change="onImageChange">
                                            
                                    <div v-if="ad_file_url">
                                        <div class="msg-img-thumb">
                                            <img
                                                :src="ad_file_url"
                                                class="avatar"
                                            />
                                        </div>
                                        <span class="msg-img-change">Click above to change featured image.</span>
                                    </div>
                                    <div v-else class="blank-featured-img">
                                        <i class="el-icon-plus avatar-uploader-icon"></i> Set Featured Image
                                    </div>
                                            
                                </el-upload>                                
                            </div>

                        </div>
                        <el-button @click="saveSlide" class="my-4" type="success">Save Slide</el-button>
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
            image_types: ["image/png", "image/jpg", "image/jpeg", "image/gif"],
            file_max: 10000000,
            slide: this.$route.query.id,
            ad_content: '',
            ad_title: '',
            ad_order: '',
			ad_file: null,
			ad_file_url: null,
			ad_file_change: false,
			ad_file_deleted: false,            
            token: ''
        }
    },
    methods: {
        saveSlide() {
            if (!this.ad_title) {
                this.$message.error('The name of the slide cannot be empty.')
            } else if (!this.ad_content) {
                this.$message.error('The description of the slide cannot be empty.')
            } else if (!this.ad_order) {
                this.$message.error('You must specify a number to order this slide by.')
            } else {
                const slideData = new FormData();
                slideData.append("file_path", this.ad_file)
                for (var pair of slideData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                            
                axios.put(`/api/pcr/ads/update/${this.slide}`, {
                    title: this.ad_title,
                    body_text: this.ad_content,
                    order: this.ad_order},

                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    axios.post(`/api/pcr/ads/updatefile/${this.slide}`, slideData,
                        {
                        headers: { Authorization: "Bearer " + this.token }
                    })
                    .then(response => {
                        console.log(response)
                        this.$message.success('Slide successfully edited.')
                        this.$router.push('/admin/slider')
                    })
                    .catch(error => {
                        console.log(error)
                        this.$message.error('Error adding slide.')
                    })                    
                })
                .catch(error => {
                    console.log(error)
                    this.$message.error('Error editing slide.')
                })
            }

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
					this.ad_file = file.raw;
					this.ad_file_url = URL.createObjectURL(file.raw);
					this.ad_file_change = true;
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
        showImage(filepath) {
            var fileurl = filepath.replace("public", "storage")
            return fileurl
        },        
        getAnnData() {
            axios.get(`/api/pcr/ads/details/${this.slide}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    console.log(res.data)
                    this.ad_content = res.data.body_text
                    this.ad_title = res.data.title
                    this.ad_order = Number(res.data.order)
                    if (res.data.file_path !== 'null') {
                        this.ad_file_url = window.location.origin + '/' + res.data.file_path.replace("public", "storage")
                    }
                }
			})
			.catch(err => {
				console.log(err);
			})            
        }    
    },
	mounted() {
        this.getTokenCookie()
        this.getAnnData()
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
.ann-featured-upload,
.ann-featured-upload .el-upload,
.ann-featured-upload img {
    width:100%;
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
</style>
