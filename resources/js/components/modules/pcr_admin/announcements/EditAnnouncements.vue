<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Announcements / Edit Announcement</span>
            </div>            
            <div class="container-fluid pb-5">
                
                <div class="admin-conent my-5 mx-3 p-4">
                    <el-button size="small" class="mb-4" type="primary" @click.native="$router.push('/admin/announcements')">Back</el-button>
                    <div class="bg-white p-4">
                        <h1>Edit Announcement</h1>      
                        <div class="row">
                            <div class="col-sm-12 col-md-9">
                                <div class="ann-content">
                                    <el-input class="mb-4" placeholder="Announcement Title" v-model="ann_title"></el-input>
                                    <el-tiptap
                                    v-model="ann_content"
                                    :charCounterCount="false"
                                    :extensions="extensions"
                                    placeholder="Announcement Text"
                                    height="500"
                                    />
                                    <div class="ann-char-count text-right">
                                        Characters: {{ ann_content.length }}
                                    </div>
                                </div>           
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="ann-sidebar">
                                    <el-button @click="saveAnn" class="mb-4" type="warning">Update</el-button>
                                    <el-card class="box-card mb-4" shadow="never">
                                        <div slot="header" class="clearfix">
                                            <span>Categories</span>
                                        </div>
                                        <el-radio-group v-model="ann_categ">
                                            <p><el-radio :label="1">Announcements</el-radio></p>
                                            <p><el-radio :label="2">International Meetings</el-radio></p>
                                            <p><el-radio :label="3">Research Committee</el-radio></p>
                                            <p><el-radio :label="4">Local Meetings</el-radio></p>
                                        </el-radio-group>                                        
                                    </el-card>
                                    <el-card class="box-card mb-4" shadow="never">
                                        <div slot="header" class="clearfix">
                                            <span>Featured Image</span>
                                        </div>
                                        <el-upload
                                            class="avatar-uploader ann-featured-upload"
                                            action="/"
                                            accept="image/png, image/jpeg, image/jpg"
                                            :auto-upload="false"
                                            :show-file-list="false"
                                            :on-change="onImageChange"
                                        >
                                            <div v-if="ann_file_url">
                                                <div class="msg-img-thumb">
                                                    <img
                                                        :src="ann_file_url"
                                                        class="avatar"
                                                    />
                                                </div>
                                                <span class="msg-img-change">Click above to change featured image.</span>
                                            </div>
                                            <div v-else class="blank-featured-img">
                                                <i class="el-icon-plus avatar-uploader-icon"></i> Set Featured Image
                                            </div>
                                            
                                        </el-upload>                                      
                                    </el-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { ElementTiptapPlugin } from 'element-tiptap'
import 'element-ui/lib/theme-chalk/index.css'
import 'element-tiptap/lib/index.css'


import {
  // necessary extensions
  Doc,
  Text,
  Paragraph,
  Heading,
  Bold,
  Underline,
  Italic,
  Strike,
  ListItem,
  BulletList,
  OrderedList,
} from 'element-tiptap';

export default {
    data() {
        return {
            extensions: [
                new Doc(),
                new Text(),
                new Paragraph(),
                new Heading({ level: 5 }),
                new Bold({ bubble: false }),
                new Underline({ bubble: false, menubar: false }),
                new Italic(),
                new Strike(),
                new ListItem(),
                new BulletList(),
                new OrderedList(),
            ],
            image_types: ["image/png", "image/jpg", "image/jpeg"],
            ann_id: this.$route.query.id,
            ann_content: '',
            ann_title: '',
            ann_categ: '',
			ann_file: null,
			ann_file_url: null,
			ann_file_change: false,
			ann_file_deleted: false,            
            token: ''
        }
    },
    methods: {
        saveAnn() {
            if (!this.ann_title) {
                this.$message.error('The title of the announcement cannot be empty.')
            } else if (!this.ann_content) {
                this.$message.error('The text of the announcement cannot be empty.')
            } else if (!this.ann_categ) {
                this.$message.error('You must select a category.')
            } else if (this.ann_content.length > 900) {
                this.$message.error('Your announcement text is too long. Please reduce the number of characters')
            } else {
                const annData = new FormData();
                annData.append("file_path", this.ann_file)
                for (var pair of annData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                            
                axios.put(`/api/pcr/announcement/update/${this.ann_id}`, {
                    title: this.ann_title,
                    body_text: this.ann_content,
                    category: this.ann_categ},
                    {
                    headers: { Authorization: "Bearer " + this.token }
                })
                .then(response => {
                    console.log(response)
                    axios.post(`/api/pcr/announcement/updatefile/${this.ann_id}`, annData,
                        {
                        headers: { Authorization: "Bearer " + this.token }
                    })
                    .then(response => {
                        console.log(response)
                        this.$message.success('Announcement successfully editd.')
                        this.$router.push('/admin/announcements')
                    })
                    .catch(error => {
                        console.log(error)
                        this.$message.error('Error adding announcement.')
                    })                    
                })
                .catch(error => {
                    console.log(error)
                    this.$message.error('Error editing announcement.')
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
					this.ann_file = file.raw;
					this.ann_file_url = URL.createObjectURL(file.raw);
					this.ann_file_change = true;
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
            axios.get(`/api/pcr/announcement/details/${this.ann_id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    console.log(res.data)
                    this.ann_content = res.data.body_text
                    this.ann_title = res.data.title
                    this.ann_categ = Number(res.data.category)
                    if (res.data.file_path !== 'null') {
                        this.ann_file_url = window.location.origin + '/' + res.data.file_path.replace("public", "storage")
                    }
                    console.log('file: ' + this.ann_file)
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
.ann-char-count {
    padding:10px;
    border:1px solid #ebeef5;
}
</style>
