<template>
    <transition name="el-zoom-in-top">
          <div class="content-wrapper page-site-blog">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-site-blog-header">
                <div class="page-site-blog-header-text">Announcement</div>
              </div>
            </section>

            <section class="content width-80 mt-5">
                <div class="row blog-masonry">
                    <div class="col-md-8">
                        <div class="card-columns">
                            <div class="card" v-for="ann in announcementsSorted" :key="ann.id">
                                <img v-if="ann.file_path !== 'null'" class="card-img-top" :src="showImage(ann.file_path)" style="padding:10px 20px;">
                                <img v-else src="/images/layout/blank_post.png" class="card-img-top" style="padding:10px 20px;" />
                                <div class="card-body">
                                <p class="card-date">{{ ann.updated_at | moment }} | By PCR</p>
                                <h5 class="card-title">{{ ann.title }}</h5>
                                <p class="card-text">{{ ann.body_text | strippedContent }}</p>
                                <router-link :to="'/announcement/post?id=' + ann.id" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    <span v-if="ann.category === '1'">Announcements</span>
                                    <span v-if="ann.category === '2'">International Meetings</span>
                                    <span v-if="ann.category === '3'">Research Committee</span>
                                    <span v-if="ann.category === '4'">Local Meetings</span>
                                </div>
                                </div>
                            </div>
                            <div class="card d-none">
                                <img class="card-img-top" src="/images/blog/img2.png">
                                <div class="card-body">
                                <p class="card-date">November 19, 2020 | By PCR</p>
                                <h5 class="card-title">The 19th AOCR is going HYBRID!</h5>
                                
                                <router-link to="" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    INTERNATIONAL MEETINGS
                                </div>
                                </div>
                            </div>
                            <div class="card d-none">
                                <img class="card-img-top" src="/images/blog/img3.png">
                                <div class="card-body">
                                <p class="card-date">November 19, 2020 | By PCR</p>
                                <h5 class="card-title">Research Papers for Revision &amp; Research Papers Without Revisions</h5>
                                
                                <router-link to="" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    RESEARCH COMMITTEE
                                </div>
                                </div>
                            </div>
                            <div class="card d-none">
                                <img class="card-img-top" src="/images/blog/img4.png">
                                <div class="card-body">
                                <p class="card-date">November 15, 2020 | By PCR</p>
                                <h5 class="card-title">The Rising Tide Economics: Impact of COVID-19 on Hospitals (Free Online Forum) 19 Nov 2020, 1-3PM, via Zoom and FB</h5>
                                
                                <router-link to="" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    LOCAL MEETINGS
                                </div>
                                </div>
                            </div>
                            <div class="card d-none">
                                <img class="card-img-top" src="/images/blog/img5.png">
                                <div class="card-body">
                                <p class="card-date">October 23 2020 | By PCR</p>
                                <h5 class="card-title">End TB News for the Philippines</h5>
                                
                                <router-link to="" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    PHILCAT
                                </div>
                                </div>
                            </div>
                            <div class="card d-none">
                                <img class="card-img-top" src="/images/blog/img6.png">
                                <div class="card-body">
                                <p class="card-date">October 23, 2020 | By PCR</p>
                                <h5 class="card-title">AOS 2020 MANILA - 1st International Conference (Virtual)</h5>
                                
                                <router-link to="" class="font-weight-bold">Read More</router-link>
                                <div class="card-category">
                                    INTERNATIONAL MEETINGS
                                </div>
                                </div>
                            </div>

                        </div>                        
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
                                    <!--<div class="row blog-list">
                                        <div class="col-md-4 blog-list-img">
                                            <router-link to="" >
                                                <img src="/images/blog/speak-img2.png" class="blog-list-author-pic" />
                                            </router-link>
                                        </div>
                                        <div class="col-md-8 blog-list-txt">
                                            <router-link to="">
                                                <p class="blog-list-category">October 23, 2020 | By PCR</p>
                                                <h6 class="blog-list-title">End TB News for the Philippines</h6>
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row blog-list">
                                        <div class="col-md-4 blog-list-img">
                                            <router-link to="" >
                                                <img src="/images/blog/speak-img3.png" class="blog-list-author-pic" />
                                            </router-link>
                                        </div>
                                        <div class="col-md-8 blog-list-txt">
                                            <router-link to="">
                                                <p class="blog-list-category">October 23, 2020 | By PCR</p>
                                                <h6 class="blog-list-title">AOS 2020 MANILA - 1st International Conference (Virtual)</h6>
                                            </router-link>
                                        </div>
                                    </div>-->
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
        checkMemberLoginStatus() {
            if (this.token) {
                console.log('logged in')
            } else {
                location.href='/login'
            }
        }
    },
	mounted() {
        this.checkMemberLoginStatus()
		this.getAllAnnouncements()
	}
  }
</script>

<style>
    .page-site-blog .card-title,
    .page-site-blog .card-text,
    .page-site-blog .card-date {
        color:#131313;
    }
    .page-site-blog .card-text {
        height:40px;
        overflow:hidden;
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
    .blog-list-img {

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

.blog-list-img,
.blog-list-txt {
    cursor: pointer;
}
</style>
