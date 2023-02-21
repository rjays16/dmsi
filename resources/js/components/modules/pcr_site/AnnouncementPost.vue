<template>
    <transition name="el-zoom-in-top">
          <div class="content-wrapper page-site-post">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-site-blog-header">
                <div class="page-site-blog-header-text">Announcement</div>
              </div>
            </section>

            <section class="content width-80 mt-5">
                <div class="row blog-masonry">
                    <div class="col-md-8">
                        <h1>{{ postData.title }}</h1>
                        <img v-if="postData.file_path !== 'null'" :src="showImage(postData.file_path)" class="ann-post-img" />                     
                        <div v-html="postData.body_text" class="announcement-body"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card d-none">
                            <div class="card-body pa-3">
                                <h5 class="card-title font-weight-bold">Search Announcements</h5>
                                <el-input
                                    placeholder="Search"
                                    suffix-icon="el-icon-search"
                                    v-model="input1">
                                </el-input>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body pa-3">
                                <h5 class="card-title font-weight-bold">Latest Posts</h5>
                                <div class="blog-post-list">
                                    <div class="row blog-list" v-for="latest in latestposts" :key="latest.id">
                                        <div class="col-md-4">
                                            <div class="blog-list-img" @click="gotoPost(latest.id)">
                                                <img v-if="latest.file_path !== 'null'" :src="showImage(latest.file_path)" class="blog-list-author-pic" />
                                                <img v-else src="/images/layout/blank_post.png" class="blog-list-author-pic" />
                                            </div>
                                        </div>
                                        <div class="col-md-8 blog-list-txt" @click="gotoPost(latest.id)">
                                            <p class="blog-list-category">{{ latest.updated_at | moment }} | By PCR</p>
                                            <h6 class="blog-list-title">{{ latest.title }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </section>
			<section class="content convention-cta d-none">
				<a href="https://73rdpcrannualconvention.com/registration">
						<img src="/images/layout/convention_cta.png" />
				</a>
			</section>
            <!-- /.content -->
          </div>
    </transition>
</template>

<script>
import moment from 'moment'

  export default {
    name: 'Blog',
    data() {
        return {
          input1: 'search',
          announcements: [],
          postData: [],
          post_id: this.$route.query.id,
          token: this.$cookies.get('token'),
        }
    },
    filters: {
        strippedContent: function(string) {
            return string.replace(/<\/?[^>]+>/ig, " "); 
        },
        moment: function (date) {
            return moment(date).format('MMMM DD YYYY');
        }        
    },
    computed: {
        announcementsSorted() {
            return this.announcements.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
        },
        latestposts() {
            return this.announcements.slice(0, 4).sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
        }     
    },
    methods: {
        gotoPost(id) {
            location.href='/announcement/post?id=' + id
        },
        getAllAnnouncements() {
            axios.get(`/api/pcr/announcement/all`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.announcements = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			})
        },
        showImage (image) {
            var fileurl = image.replace("public", "/storage")
            return fileurl
        },
        getAnnData() {
            axios.get(`/api/pcr/announcement/details/${this.post_id}`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    console.log(res.data)
                    this.postData = res.data
                }
			})
			.catch(err => {
				console.log(err);
			})            
        }         
    },
	mounted() {
        this.getAllAnnouncements()
        this.getAnnData()
	}
  }
</script>

<style>
    .card-title,
    .card-text,
    .card-date {
        color:#131313;
    }
    .card-img-top {

    }
    .page-site-blog .page-header {
        padding-top:80px;
        margin-top:0;
        margin-bottom:0!important
    }
    .page-site-blog h2 {
        font-size:1.5rem;
        font-weight:bold;
        color:#f75202;
        text-align: center;
    }
    .page-header .page-site-blog-header {
        background-image:url(/images/layout/pcr-site-blog-bg.png);
        background-repeat:no-repeat;
        background-size: contain;
        width:100%;
        height:0;
        padding-top:26.0417%;
        position:relative;
    }
    .page-site-blog-header-text {
        position:absolute;
        width:100%;
        bottom:0;
        top:42%;
        text-align:center;
    }

    .page-site-blog-header-text {
        font-size:2.2rem;
        color:#fff;
        font-weight:bold;
    }
    .page-site-blog .card {
        box-shadow:0 2px 12px 0 rgba(0,0,0,.1);
        margin-bottom:2.5rem!important;
    }
    .blog-masonry .card-date {
        font-size:0.8rem;
        color:#979696;
    }
    .blog-masonry .card-category {
        margin-top:20px;
        padding-top:15px;
        border-top:1px solid #dddddd;
        font-size:0.9rem;
        color:#979696;
    }
    .blog-post-list a {
        color:#212529;
    }
    .blog-list-title {
        font-size:0.9rem;
    }
    .blog-list-category {
        color:#979696;
        margin-bottom:5px;
        font-size:0.8rem;
    }
    .ann-post-img {
        width:100%;
        margin:20px 0;
    }
    .blog-list-img img {
        width:100%;
        border-radius: 70px;
        height:70px;
        width:70px;
    }
    .blog-list {
        margin-bottom:20px;
        padding-bottom:20px;
        border-bottom:1px solid #dddddd;
    }
	.convention-cta {
		padding-left:0!important;
		padding-right:0!important;
	}
	.convention-cta img {
		width:100%;
	}    
    @media only screen and (max-width: 1220px)  {
        .page-header .page-site-blog-header {
                background-image:url(/images/layout/pcr-site-home-bg.png);
                background-repeat:no-repeat;
                background-size: cover;
                height:150px;
                padding-top:26.0417%;
                position:relative;
            }
            .page-site-blog-header-text {
                top:30%
        }
    }
	@media only screen and (max-width: 768px)  {
		.page-site-blog-header-text {
			top:40%;
			font-size:1.8rem;
			color:#fff;
			font-weight:bold;
		}		
	}    
    @media (min-width: 576px) {
        .blog-masonry .card-columns {
            column-count: 2
        }
    }
.announcement-body strong {
    font-weight: bold;
}
.announcement-body {
    margin-bottom:150px;
}
.blog-list-img,
.blog-list-txt {
    cursor: pointer;
}
</style>
