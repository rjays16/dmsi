<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-platinum page-preview bg-white">

            <div class="admin-page-title bg-white p-3">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="mt-2">
                            <i class="el-icon-s-home"></i>
                            <span> / Sponsors / Preview Booth Changes</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <el-button size="small" type="success" @click="approveBoothConfirmation(sponsor_id)">Approve</el-button>
                        <el-button size="small" type="danger" @click="declineBoothConfirmation(sponsor_id)">Decline</el-button>
                        <el-button size="small" type="primary" @click.native="$router.push('/admin/sponsors/booth')">Back</el-button>
                    </div>
                </div>
            </div>  
            <section class="page-header">
                <div :class="'page-platinum-header booth-' + boothColor">

                    <div class="booth-layer-1">
                        <div class="booth-element platinum-booth-wall-bg" v-if="boothInfo.wall_background !== 'text'">
                            <div class="booth-img">
                                <el-button type="text" @click="showImage(boothInfo.wall_background)">
                                    <img :src="getImageSrc(boothInfo.wall_background)" />
                                </el-button>
                            </diV> 
                        </div>
                    </div>

                    <div class="booth-layer-2"> 

                    <div class="booth-element platinum-booth-banner-top">
                        <div class="booth-info-btn signtop-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.banner_file)">i</el-button>
                        </div>
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.banner_file)">
                                <img :src="getImageSrc(boothInfo.banner_file)" />
                            </el-button>
                        </diV>                           
                    </div>
                    <div class="booth-element platinum-booth-video">
                        <div class="booth-info-btn video-btn">
                            <el-button type="primary" circle @click="showVid(boothInfo.video_url1)">i</el-button>
                        </div>
                        <div class="booth-vid">
                            <iframe :src="boothInfo.video_url1" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-logo">
                        <div class="booth-info-btn logo-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.logo_file)">i</el-button>
                        </div> 
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.logo_file)">
                                <img :src="getImageSrc(boothInfo.logo_file)" />
                            </el-button>
                        </diV>                        
                    </div>
                    <!-- <div class="booth-element platinum-booth-wallpic-left">
                        test
                    </div>
                    <div class="booth-element platinum-booth-wallpicbg-left"></div>
                    <div class="booth-element platinum-booth-wallpic-right">
                        test
                    </div>
                    <div class="booth-element platinum-booth-wallpicbg-right"></div> -->
                    <div class="platinum-booth-banner-left-outer">
                        <div class="booth-info-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.bannerstand1)">i</el-button>
                        </div>
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.bannerstand1)">
                                <img :src="getImageSrc(boothInfo.bannerstand1)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-banner-left-inner">
                        <div class="booth-info-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.bannerstand3)">i</el-button>
                        </div>
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.bannerstand3)">
                                <img :src="getImageSrc(boothInfo.bannerstand3)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-banner-right-outer">
                        <div class="booth-info-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.bannerstand2)">i</el-button>
                        </div>
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.bannerstand2)">
                                <img :src="getImageSrc(boothInfo.bannerstand2)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-banner-right-inner">
                        <div class="booth-info-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.bannerstand4)">i</el-button>
                        </div>
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.bannerstand4)">
                                <img :src="getImageSrc(boothInfo.bannerstand4)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="platinum-booth-mag-left-top">
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand1)">
                                <img :src="getImageSrc(boothInfo.magazinestand1)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-mag-left-mid">
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand1)">
                                <img :src="getImageSrc(boothInfo.magazinestand1)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-mag-left-bottom">
                        <div class="booth-info-btn magleft-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.magazinestand1)">i</el-button>
                        </div>                        
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand1)">
                                <img :src="getImageSrc(boothInfo.magazinestand1)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-mag-right-top">
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand2)">
                                <img :src="getImageSrc(boothInfo.magazinestand2)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-mag-right-mid">
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand2)">
                                <img :src="getImageSrc(boothInfo.magazinestand2)" />
                            </el-button>
                        </diV>
                    </div>
                    <div class="booth-element platinum-booth-mag-right-bottom">
                        <div class="booth-info-btn magright-btn">
                            <el-button type="primary" circle @click="showImage(boothInfo.magazinestand2)">i</el-button>
                        </div>                        
                        <div class="booth-img">
                            <el-button type="text" @click="showImage(boothInfo.magazinestand2)">
                                <img :src="getImageSrc(boothInfo.magazinestand2)" />
                            </el-button>
                        </diV>
                    </div>

                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content content-80">
                <div class="box">
                    <div class="row sec-stamp">
                        <div class="col-md-3 stamp-img">
                            <img :src="getImageSrc(boothInfo.logo_file)" />
                        </div>
                        <div class="col-md-6 stamp-txt">
                            <p>{{ sponsorInfo.description }}</p>
                        </div>
                        <div class="col-md-3 stamp-btns">
                            <el-button disabled class="ml-0 mb-2" type="info" round>Stamp</el-button>
                            <el-button disabled class="ml-0 mb-2" type="primary" round>Send Info</el-button>
                        </div>
                    </div>
                    <div class="row sec-spons-content">
                        <!--  SPONSORS CONTENT -->
                        <div class="col-sm-8">
                            <div class="spons-details">
                                <el-button disabled class="ml-0 mb-4" type="warning" icon="el-icon-chat-dot-round">Chat with Sponsor</el-button>
                                <el-button @click="openWebsite(sponsorInfo.website)" type="primary">Website</el-button>
                                <h2 class="mb-4">PRODUCTS:</h2>
                                <p>{{ boothInfo.product_intro }}</p>
                            </div>
                            <div class="spons-products">
                                <div v-if="productData.length <= 5">
                                    <div class="row spons-product" v-for="product in productData" :key="product.id">
                                        <div class="col-md-3 spons-products-img">
                                            <el-button @click="showImage(product.img_path)">
                                                <img :src="getImageSrc(product.img_path)" />
                                            </el-button>
                                        </div>
                                        <div class="col-md-9 spons-products-txt">
                                            <h5>{{ product.name }}</h5>
                                            <p>{{ product.description }}</p>
                                        </div>                                    
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="row spons-product" v-for="product in firstFiveProds" :key="product.id">
                                        <div class="col-md-3 spons-products-img">
                                            <el-button @click="showImage(product.img_path)">
                                                <img :src="getImageSrc(product.img_path)" />
                                            </el-button>
                                        </div>
                                        <div class="col-md-9 spons-products-txt">
                                            <h5>{{ product.name }}</h5>
                                            <p>{{ product.description }}</p>
                                        </div>                                    
                                    </div>                                    
                                    <el-collapse v-model="activeCollapse">
                                        <el-collapse-item title="Show All Products" name="1">
                                            <div class="row spons-product" v-for="product in remainingProds" :key="product.id">
                                                <div class="col-md-3 spons-products-img">
                                                    <el-button @click="showImage(product.img_path)">
                                                        <img :src="getImageSrc(product.img_path)" />
                                                    </el-button>
                                                </div>
                                                <div class="col-md-9 spons-products-txt">
                                                    <h5>{{ product.name }}</h5>
                                                    <p>{{ product.description }}</p>
                                                </div>                                    
                                            </div>
                                        </el-collapse-item>
                                    </el-collapse>
                                </div>
                              
                            </div>
                            <div class="spons-videos">
                                <h2 class="mb-4">VIDEOS:</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp1">
                                        <iframe
                                            :src="boothInfo.avp1"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp2">
                                        <iframe
                                            :src="boothInfo.avp2"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp3">
                                        <iframe
                                            :src="boothInfo.avp3"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp4">
                                        <iframe
                                            :src="boothInfo.avp4"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp5">
                                        <iframe
                                            :src="boothInfo.avp5"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp6">
                                        <iframe
                                            :src="boothInfo.avp6"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp7">
                                        <iframe
                                            :src="boothInfo.avp7"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp8">
                                        <iframe
                                            :src="boothInfo.avp8"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp9">
                                        <iframe
                                            :src="boothInfo.avp9"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                    <div class="col-md-6 mb-4" v-if="boothInfo.avp10">
                                        <iframe
                                            :src="boothInfo.avp10"
                                            width="100%"
                                            height="100%"
                                            frameborder="0"
                                             webkitallowfullscreen mozallowfullscreen allowfullscreen
							            ></iframe>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="spons-schedule">
                                <h3>CONFERENCE SCHEDULE</h3>
                                <template>
                                    <el-tabs v-model="sponsSchedTabs" class="my-4 spons-sched-tabs">
                                        <el-tab-pane label="January 10" name="first">
                                            <div class="row sched-heading mt-5 font-weight-bold">
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">Time</p>
                                                </div>
                                                <div class="col-md-10 sched-details">
                                                    Agenda
                                                </div>
                                            </div>
                                            <div class="row sched-entry">
                                                <div class="col-md-12 sched-date">
                                                    <div class="sched-date-text">
                                                        <p>8:30</p>
                                                        <p>Sunday, 10th Jan</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">8:30</p>
                                                    <p class="sched-time-text time-to">9:30</p>
                                                </div>
                                                <div class="col-md-10 sched-details">
                                                    <div class="sched-details-heading">
                                                        <div class="sched-details-title mb-2">Morning Lecture</div>
                                                        <div class="sched-details-subtitle mb-2">Channel 1</div>
                                                        <el-button @click="$router.push('/')" type="primary" round>Morning Lecture</el-button>
                                                    </div>
                                                    <div class="sched-details-event">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="/images/booth/speak-img1.png" />
                                                            </div>
                                                            <div class="col-md-10">
                                                                <p class="mt-3">Speaker Name</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p>Brain Vascular Anatomy: What Should We Know?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row sched-entry">
                                                <div class="col-md-12 sched-date">
                                                    <div class="sched-date-text">
                                                        <p>9:30</p>
                                                        <p>Sunday, 10th Jan</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 sched-time">
                                                    <p class="sched-time-text">9:30</p>
                                                    <p class="sched-time-text time-to">9:40</p>
                                                </div>
                                                <div class="col-md-10 sched-details">
                                                    <div class="sched-details-heading">
                                                        <div class="sched-details-title mb-2">Break Time</div>
                                                        <div class="sched-details-subtitle mb-2">Channel 1</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </el-tab-pane>
                                        <el-tab-pane label="January 11" name="second">
                                            January 11
                                        </el-tab-pane>
                                        <el-tab-pane label="January 12" name="third">
                                            January 12
                                        </el-tab-pane>
                                    </el-tabs>
                                </template>
                            </div> -->
                        </div>
                        <!--  END OF SPONSORS CONTENT -->
                        <!--  SPONSORS SIDE CONTENT -->
                        <div class="col-sm-4">
                            <div class="spons-side-contact mb-4">
                                <h5>CONTACT US</h5>
                                <p><strong>Address:</strong> {{ sponsorInfo.address }}</p>
                                <p><strong>Contact Number:</strong> {{ sponsorInfo.contact_number }}</p>
                            </div>
                            <div class="spons-reso-contact mb-4">
                                <h5>BROCHURES</h5>
                                <div class="reso-file" v-for="resource in resourcesData" :key="resource.id">
                                    <a :href="getImageSrc(resource.file_path)" target="_blank">
                                        <span class="material-icons">picture_as_pdf</span>
                                        <span class="reso-txt">{{ resource.file_name }}</span>
                                    </a>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!--  END OF SPONSORS SIDE CONTENT -->
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <el-dialog class="spons-view-image" :visible.sync="dialogImageTab" @close="clearImage()">
                <img :src="currentImageView" />
            </el-dialog>
            <el-dialog class="spons-view-image text-center" :visible.sync="dialogVidTab" @close="clearVid()">
                <iframe :src="currentVidView" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </el-dialog>

            <el-dialog :visible.sync="approvalBoothTab">
                <div class="text-center">Are you sure you want to approve the changes for this booth?</div>
                <div class="text-center mt-3">
                    <el-button :loading="is_approving" :disabled="is_approving" @click="approve()" type="success" icon="el-icon-check">Approve</el-button>
                    <el-button @click="cancelApprove" type="info">Cancel</el-button>
                </div>
            </el-dialog>
            <el-dialog :visible.sync="declineBoothTab">
                <div class="text-center">Enter comments for declining selected booth:</div>
                <div>
                    <el-input
                    class="mt-3"
                    type="textarea"
                    :rows="3"
                    placeholder="Comments"
                    v-model="declineComment">
                    </el-input>            
                </div>
                <div class="text-center mt-3">
                    <el-button :loading="is_approving" :disabled="is_approving" @click="decline()" type="danger" icon="el-icon-delete">Decline</el-button>
                    <el-button @click="cancelDecline" type="info">Cancel</el-button>
                </div>
            </el-dialog>             

        </div>
    </transition>
</template>

<script>
  export default {
    name: 'sponsors-preview-platinum',
    data () {
        return {
            boothInfo: [],
            token: '',
            sponsor_id: this.$route.query.id,
            sponsorStampsDelay: 10,
            disableStamp: true,
            currentImageView: '',
            dialogImageTab: false,
            currentVidView: '',
            dialogVidTab: false,
            thisServerUrl: '',
            approvalBoothTab: false,
            declineBoothTab: false,
            is_approving: false,
            declineComment: '',
            boothColor: 'default',
            sponsorInfo: [],
            productData: [],
            resourcesData: [],
            activeCollapse: []
        }
    },
    computed: {
        firstFiveProds() {
            return this.productData.slice(0, 5);
        },
        remainingProds() {
            return this.productData.slice(5);
        },
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
        getBoothInfo() {
            var id = this.sponsor_id
            axios.get(`/api/sponsors/samplebooth/${id}`, {
                headers: { Authorization: "Bearer " + this.token }
            }).then(response => {
                console.log(response)
                this.boothInfo = response.data
                console.log(this.boothInfo)
            }).catch(error => {
				console.log(error.response)
            })  
        },
        getImageSrc(img) {
            if (img) {
                var image = img.replace('public', 'storage')
                var image_src = this.thisServerUrl + image
                return image_src
            }
        },
        showImage(img) {
            this.dialogImageTab = true
            var fileurl = img.replace("public", "storage")
            this.currentImageView = this.thisServerUrl + fileurl
        },
        clearImage() {
            this.currentImageView = ''
        },
        showVid(vid) {
            this.dialogVidTab = true
            this.currentVidView = vid
        },
        clearVid() {
            this.currentVidView = ''
        },
        getCurrentURL() {
            var currentUrl = window.location.href
            // console.log('go: ' + currentUrl)
            if (currentUrl.includes('127.0.0.1')) {
                this.thisServerUrl = '/'
            } else {
                this.thisServerUrl = process.env.MIX_CONVENTION_LIVE_URL
            }
            console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
        openWebsite(url) {
            var target = '_blank'
            window.open(url, target)
        },
        approveBoothConfirmation(id) {
            this.approvalBoothTab = true
        },
        declineBoothConfirmation(id) {
            this.declineBoothTab = true
        },
        cancelApprove() {
            this.approvalBoothTab = false
            this.forApproveID = ''
        },
        cancelDecline() {
            this.declineBoothTab = false
            this.forDeclineID = ''
        },
        approve() {
            var body = ''
            var id = this.sponsor_id
            this.is_approving = true
            axios.put(`/api/sponsors/approvebooth/${id}`, body, {
                headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.is_approving = false
                    this.approvalBoothTab = false
                    this.$notify({
                        message: 'Booth Changes Successfully Approved.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })
                    this.$router.push('/admin/sponsors/booth')                
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error approving booth changes.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.approvalBoothTab = false
            })
        },
        decline() {
            var id = this.sponsor_id
            this.is_approving = true
            axios.put(`/api/sponsors/declinebooth/${id}`, {
                    comment: this.declineComment},
                    {
                    headers: { Authorization: "Bearer " + this.token }
            })
            .then(res => {
                if(res.data) {
                    this.is_approving = false
                    this.declineBoothTab = false
                    this.$notify({
                        message: 'Booth Changes Successfully Declined.',
                        type: 'success',
                        customClass: 'pcr-login-error',
                        position: 'bottom-right'
                    })
                    this.$router.push('/admin/sponsors/booth')
                }
            })
            .catch(err => {
                console.log(err);
				this.$notify({
					message: 'Error approving booth changes.',
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
                })
                this.is_approving = false
                this.declineBoothTab = false
            })
        },
        getSponsorInfo() {
            var id = this.sponsor_id
            axios.get(`/api/sponsors/${id}`, {
                headers: { Authorization: "Bearer " + this.token }
            }).then(response => {
                console.log(response)
                this.sponsorInfo = response.data
                var theme = response.data.booth_color
                if (theme === '1') {
                    this.boothColor = 'default'
                }
                if (theme === '2') {
                    this.boothColor = 'red'
                }
                if (theme === '3') {
                    this.boothColor = 'orange'
                }
                if (theme === '4') {
                    this.boothColor = 'blue'
                }
                if (theme === '5') {
                    this.boothColor = 'sky_blue'
                }
                if (theme === '6') {
                    this.boothColor = 'green'
                }
                if (theme === '7') {
                    this.boothColor = 'apple_green'
                }
                if (theme === '8') {
                    this.boothColor = 'jungle_green'
                }
                if (theme === '9') {
                    this.boothColor = 'purple'
                }
                if (theme === '10') {
                    this.boothColor = 'teal'
                }
                console.log(this.sponsorInfo)
            }).catch(error => {
				console.log(error.response)
            })  
        },
		getAllProducts() {
            var id = this.sponsor_id
			axios
				.get(`/api/sponsors/product/${id}`, {
					headers: {
						Authorization: "Bearer " + this.token,
					},
				})
				.then((res) => {
					console.log(res);
					this.productData = res.data
				})
				.catch((err) => {
					console.error(err);
				});
        },
		getAllResources() {
            var id = this.sponsor_id
			axios
				.get(`/api/sponsors/resource/${id}`, {
					headers: {
						Authorization: "Bearer " + this.token,
					},
				})
				.then((res) => {
					console.log(res);
					this.resourcesData = res.data;
				})
				.catch((err) => {
					console.error(err);
				});
		}        
    },
	mounted() {
        this.getTokenCookie()
        this.getCurrentURL()
        this.getBoothInfo()
        this.getSponsorInfo()
        this.getAllProducts()
        this.getAllResources()
	}
  }
</script>

<style>
    /* .page-platinum .page-header {
        padding-top:80px;
        margin-top:0;
        margin-bottom:0!important
    } */
    .page-platinum .page-header {
        padding:200px 50px 20px;
        margin-top:0;
        margin-bottom:0!important;
        background-image:url(/images/booth/booth-bg.png);
        background-repeat:no-repeat;
        background-position: center;
        background-size:cover;
    }
    .page-platinum.page-preview .page-header {
        padding:100px 50px 20px;
    }
    .page-header .page-platinum-header.booth-default .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/default.png);
    }
    .page-header .page-platinum-header.booth-apple_green .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/apple_green.png);
    }
    .page-header .page-platinum-header.booth-blue .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/blue.png);
    }
    .page-header .page-platinum-header.booth-green .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/green.png);
    }
    .page-header .page-platinum-header.booth-jungle_green .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/jungle_green.png);
    }
    .page-header .page-platinum-header.booth-orange .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/orange.png);
    }
    .page-header .page-platinum-header.booth-purple .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/purple.png);
    }
    .page-header .page-platinum-header.booth-red .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/red.png);
    }
    .page-header .page-platinum-header.booth-sky_blue .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/sky_blue.png);
    }
    .page-header .page-platinum-header.booth-teal .booth-layer-1 {
        background-image:url(/images/booth/booth-colors/platinum/teal.png);
    }    
    .page-header .page-platinum-header {
        background-repeat:no-repeat;
        background-size: contain;
        width:100%;
        height:0;
        padding-top:49.375%;
        position:relative;
    }
    .page-header .page-platinum-header .booth-layer-1 {
        z-index: 5;
        background-repeat:no-repeat;
        background-size: contain;
        top:0;
        left:0;
        width:100%;
        height:100%;
        position:absolute;
    }
    .page-header .page-platinum-header .booth-layer-2 {
        z-index: 6;
        background-image:url(/images/booth/booth-colors/platinum/front.png);
        background-repeat:no-repeat;
        background-size: contain;
        top:0;
        left:0;
        width:100%;
        height:100%;
        position:absolute;  
    }
    .platinum-booth-wall-bg {
        position:absolute;
        width:26.2%;
        height:39.9%;
        top:36.9%;
        left:36.9%;
        text-align:center;
    }    
    .platinum-booth-banner-top {
        position:absolute;
        width:47.0312%;
        height:13.3966%;
        top:2.1097%;
        left:26.5104%;
        text-align:center;
        
    }
    .platinum-booth-video {
        position:absolute;
        width:20.0521%;
        height:20.0422%;
        top:33.4388%;
        left:40.0521%;
        text-align:center;
               
    }
    .platinum-booth-logo {
        position:absolute;
        width:8.9583%;
        height:12%;
        top:65.0717%;
        left:45.5208%;
        text-align:center;
    }
    .page-platinum-header .platinum-booth-logo img {
        width:auto!important;
        max-width:100%!important;
    }    
    .platinum-booth-wallpic-left {
        position:absolute;
        width:5.2604%;
        height:6.0126%;
        top:56.7510%;
        left:37.5521%;
        text-align:center;
        
    }
    .platinum-booth-wallpicbg-left {
        position:absolute;
        width:5.2604%;
        height:6.0126%;
        top:56.7510%;
        left:37.5614%;
        text-align:center;
        background-image:url(/images/booth/booth-platinum-wallpicbg-left.png);
    }
    .platinum-booth-wallpic-right {
        position:absolute;
        width:5.2604%;
        height:6.0126%;
        top:56.7510%;
        right:37.5521%;
        text-align:center;
        
    }
    .platinum-booth-wallpicbg-right {
        position:absolute;
        width:5.2604%;
        height:6.0126%;
        top:56.7510%;
        right:37.5614%;
        text-align:center;
        background-image:url(/images/booth/booth-platinum-wallpicbg-right.png);
        background-position: right;
    }
    .platinum-booth-banner-left-outer {
        position:absolute;
        width:10.85%;
        height:52.3291%;
        top:37.2%;
        left:7.644%;
        text-align:center;
        
    }
    .platinum-booth-banner-left-inner {
        position:absolute;
        width:8.9583%;
        height:23.5232%;
        top:63.3966%;
        left:20.8854%;
        text-align:center;
        
    }
    .platinum-booth-mag-left-top {
        position:absolute;
        width:4.2%;
        height:8.8%;
        top:56.43%;
        left:32.5%;
        text-align:center;
        
        -webkit-transform: skewY(-3.5deg);
        -moz-transform: skewY(-3.5deg);
        -ms-transform: skewY(-3.5deg);
        -o-transform: skewY(-3.5deg);
        transform: skewY(-3.5deg);
    }
    .platinum-booth-mag-left-mid {
        position:absolute;
        width:4.2%;
        height:9.5%;
        top:66.5%;
        left:32.9%;
        text-align:center;
        
        -webkit-transform: skewY(-4.5deg);
        -moz-transform: skewY(-4.5deg);
        -ms-transform: skewY(-4.5deg);
        -o-transform: skewY(-4.5deg);    
        transform: skewY(-4.5deg);
    }
    .platinum-booth-mag-left-bottom {
        position:absolute;
        width:4.2%;
        height:7.1%;
        top:77.5%;
        left:33.6%;
        text-align:center;
        
        -webkit-transform: skewY(-4.5deg);
        -moz-transform: skewY(-4.5deg);
        -ms-transform: skewY(-4.5deg);
        -o-transform: skewY(-4.5deg);    
        transform: skewY(-4.5deg);
    }
    .platinum-booth-mag-right-top {
        position:absolute;
        width:4.2%;
        height:8.8%;
        top:56.43%;
        right:32.5%;
        text-align:center;
        
        -webkit-transform: skewY(3.5deg);
        -moz-transform: skewY(3.5deg);
        -ms-transform: skewY(3.5deg);
        -o-transform: skewY(3.5deg);        
        transform: skewY(3.5deg);
    }
    .platinum-booth-mag-right-mid {
        position:absolute;
        width:4.2%;
        height:9.5%;
        top:66.5%;
        right:32.9%;
        text-align:center;
        
        -webkit-transform: skewY(4.5deg);
        -moz-transform: skewY(4.5deg);
        -ms-transform: skewY(4.5deg);
        -o-transform: skewY(4.5deg);        
        transform: skewY(4.5deg);
    }
    .platinum-booth-mag-right-bottom {
        position:absolute;
        width:4.2%;
        height:7.1%;
        top:77.5%;
        right:33.6%;
        text-align:center;
        
        -webkit-transform: skewY(4.5deg);
        -moz-transform: skewY(4.5deg);
        -ms-transform: skewY(4.5deg);
        -o-transform: skewY(4.5deg);        
        transform: skewY(4.5deg);
    }
    .platinum-booth-banner-right-outer {
        position:absolute;
        width:10.85%;
        height:52.3291%;
        top:37.2%;
        right:7.644%;
        text-align:center;
        
    }
    .platinum-booth-banner-right-inner {
        position:absolute;
        width:8.9583%;
        height:23.5232%;
        top:63.3966%;
        right:20.8854%;
        text-align:center;
        
    }
    .booth-info-btn {
        position:absolute;
        top:-40px;
        width:100%;
    }
    .booth-info-btn.magleft-btn {
        left:-18%;
        top:1%;
    }
    .booth-info-btn.magright-btn {
        right:-18%;
        top:1%;
    }
    .booth-info-btn.logo-btn {
        top:110%;
    }
    .booth-info-btn.video-btn {
        top:90%;
    }
    .booth-info-btn.signtop-btn {
        left:-7%;
        top:32%;
        width:30px;
    }
    .booth-info-btn button,
    .booth-info-btn button:focus {
        padding:0!important;
        border:2px solid #fff;
        background:#f75202;
    }
    .booth-info-btn button:hover,
    .booth-info-btn button:active,
    .booth-info-btn button:visited {
        border:2px solid #fff;
        background:#0174cc;        
    }
    .booth-info-btn button span {
        display:block;
        font-weight:bold;
        padding:5px 10px;
    }
    .booth-img {
        overflow:hidden;
        height:100%;
        width:100%;
    }
    .booth-img button {
        margin:0;
        padding:0;
        height:100%;
        width:100%;        
    }
    .booth-vid {
        overflow:hidden;
        height:100%;
        width:100%;
        background:#131313;
    }
    .booth-vid button {
        margin:0;
        padding:0;
        height:100%;
        width:100%;        
    }
    .page-platinum-header img {
        width:100%!important;
        height:100%!important;
    }
    .sec-stamp {
        padding-bottom:20px;
        margin-bottom:20px;
        border-bottom:1px solid #d5d5d5;
    }
    .stamp-img {
        text-align:center;
    }
    .stamp-img img {
        display:inline-block;
        max-width:100%;
        max-height:70px;
        margin-top:10px;
    }
    .stamp-btns button {
        width:100%;
    }
    .reso-file {
        display:inline-flex;
        padding:20px 10px;
        border-bottom:1px solid #d5d5d5;
        width:100%;
    }
    .reso-file .material-icons {
        color:#dc1d00;
        margin-right:10px;
    }
    .reso-file .reso-txt {
        font-weight:bold;
        font-size:0.8rem;
    }
    .reso-file a {
        display:inline-flex;
        color:#212529;
    }
    .spons-product {
        margin:20px 0;
    }
    .spons-products-img img {
        width:100%;
        border:none!important;
        padding:0!important;
    }
    .spons-products-img button {
        padding:0!important;
    }    
    .spons-videos {
        margin:50px 0;
    }
    .spons-videos img {
        width:100%;
    }
    .spons-sched-tabs .el-tabs__item {
        border:1px solid #0174cc;
        border-left:none;
    }
    .spons-sched-tabs #first {
        border-left:1px solid #0174cc;
    }
    .spons-sched-tabs .el-tabs__item.is-active,
    .spons-sched-tabs .el-tabs__item:hover {
        background-color:#0174cc;
        color:#fff;
    }
    .spons-sched-tabs .el-tabs__item {
        padding: 0 50px!important;
    }
    .spons-sched-tabs .el-tabs__active-bar,
    .spons-sched-tabs .el-tabs__nav-wrap::after {
        display: none;
    }
    .sched-heading .sched-time {
        border-right:2px solid #8a8a8a;
    }
    .sched-time {
        border-right:2px solid #d5d5d5;
    }
    .sched-date {
        background:#f5f5f5;
        margin:20px 0;
    }
    .sched-date-text {
        padding:10px 20px;
    }
    .sched-date p {
        margin:0 0 5px;
    }
    .sched-time-text {
        margin:0 0 0 20px;
    }
    .sched-time-text.time-to {
        font-weight:bold;
    }
    .sched-details-heading button {
        background:#ff642b;
        border:none;
    }
    .sched-details-title {
        color:#0174cc;
        font-weight:bold;
    }
    .sched-details-event {
        margin:20px 0;
    }
    .sched-details-event img {
        max-width:50px;
        border-radius:50px;
    }


	@media only screen and (max-width: 768px)  {
        .page-platinum .page-header {
            padding:120px 0 0;
            margin-top:0;
            margin-bottom:0!important;
            background-image:url(/images/booth/booth-bg.png);
            background-repeat:no-repeat;
            background-position: center;
        }
        .platinum-booth-mag-left-top,
        .platinum-booth-mag-left-mid,
        .platinum-booth-mag-left-bottom,
        .platinum-booth-mag-right-top,
        .platinum-booth-mag-right-mid,
        .platinum-booth-mag-right-bottom {
            font-size:0;
        }
        .page-platinum .booth-info-btn.video-btn {
            top:-80%!important;
        }          
    }

.spons-view-image img {
    width:100%;
}
.content-80 {
    max-width:80%;
}
.spons-view-image img {
    width:100%;
}
.spons-videos iframe {
    padding:20px;
    background:#eeeeee;
}
.privacy-policy-pop {
    word-break: initial;
}
.spons-products .el-collapse {
    border:none!important;
}
.spons-products .el-collapse-item div[role=tab] {
    width:200px;
}
.spons-products .el-collapse-item div[role=tab] div[role=button] {
    background:#409EFF;
    color:#fff;
    padding:0 20px;
    border-radius:4px;
}
</style>
