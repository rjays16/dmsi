<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-thanks">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-mem-thanks-header">
                  <div class="thanks-content w-100 px-2">
                      <div class="pcr-page-title font-weight-bold"><h1>Thank you for your votes!</h1></div>
                    <el-button
													
													class="mt-5"
													type="primary"
													@click="backtoprofile()"
													round
													>GO BACK TO PROFILE</el-button>
                  </div>
              </div>
            </section>
           </div>
    </transition>
</template>

<script>
  export default {
    name: 'Thank-You',
    data() {
        return {
          username: '',
          password: '',
          email: '',
          keep_signed: false,
          subdomain: ''
        }
    },
    methods:{
        backtoprofile() {
            let subdomain = location.hostname.split(".").shift();
			this.subdomain = subdomain;
				
				if (this.subdomain == "beta2") {
                     this.$router.push('/profile');
					
				} else {
                    this.$router.push('/profile');
				}
			},
    }
  }
</script>
<style scoped>

    .page-header .page-mem-thanks-header {
        background-image:url(/images/layout/page-head-bg-2.png);
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;
        min-height:unset !important;
        height: 100%;
    }
    .page-thanks .page-header {
        height: 85vh;
    }
    .pcr-page-title h1{
        font-size: 3rem;
    }
    .thanks-content {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
</style>


<style>
    .page-thanks .page-header {
        padding-top:80px;
        margin-top:0;
    }
    .page-header .page-mem-thanks-header {
        background-image:url(/images/layout/page-head-bg-2.png);
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;
        min-height:160px;
    }
    .mem-thanks-header-text {
        position:absolute;
        width:100%;
        top:25%;
        left:0;
        text-align:center;
        color:#fff;
    }
    .thanks-title {
        font-size:3rem;
    }
    .thanks-subtitle {
        font-size:1rem;
    }
    .thanks-back-lobby {
        color:#fff;
        font-size:1rem;
    }
    .thank-you-text {
        font-size:1rem;
    }
    .page-mem-thanks-header {
        text-align:center;
    }
    .page-mem-thanks-header .pcr-page-title,
    .page-mem-thanks-header .pcr-page-subtitle {
        width:100%;
        color:#fff;
    }

</style>
