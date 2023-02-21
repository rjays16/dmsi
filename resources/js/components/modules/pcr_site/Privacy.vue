<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-convention-privacy" v-loading="loading">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-convention-privacy-header">
                <div class="pcr-page-title font-weight-bold">Privacy Policy</div>
                <div class="pcr-page-subtitle">Philippine College of Radiology</div>
              </div>
            </section>
            <section class="content content-80">
              <div class="justify-content-center">
                    
                <div class="privacy-content">

                  <p>Your privacy is important to us. It is Philippine Radiology College's policy to respect your privacy regarding any information we may collect from you across our website, https://pcrmembership.com, and other sites we own and operate.</p>

                  <p>We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent. We also let you know why we’re collecting it and how it will be used.</p>

                  <p>We only retain collected information for as long as necessary to provide you with your requested service. What data we store, we’ll protect within commercially acceptable means to prevent loss and theft, as well as unauthorized access, disclosure, copying, use or modification.</p>

                  <p>We don’t share any personally identifying information publicly or with third-parties, except when required to by law.</p>

                  <p>Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot accept responsibility or liability for their respective privacy policies.</p>

                  <p>You are free to refuse our request for your personal information, with the understanding that we may be unable to provide you with some of your desired services.</p>

                  <p>Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information. If you have any questions about how we handle user data and personal information, feel free to contact us.</p>

                  <p>This policy is effective as of 10 February 2021.</p>                  

                </div>

              </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>

<script>
  export default {
    name: 'Login',
    data() {
        return {

        }
    },
    methods: {

    },
    created() {
    },
  }
</script>

<style>
  .page-convention-privacy .page-header {
    padding-top:80px;
    margin-top:0;
  }
  .page-header .page-convention-privacy-header {
    background-image:url(/images/layout/page-head-bg-1.png);
    background-repeat:no-repeat;
    background-position: center;
    background-size: cover;
    min-height:160px;
  }
  .pcr-page-title,
  .pcr-page-subtitle {
    width:100%;
    text-align: center;
    color:#fff;
  }
  .pcr-page-title {
    font-size:24px;
    padding-top:50px;
  }
  .pcr-page-subtitle {
    font-size:18px;
  }
  .login-card,
  .contact-card {
    min-height:360px;
  }
  .login-card h1,
  .contact-card h1 {
    font-size:24px;
    text-align: center;
  }
  .login-submit-btn {
    width:100%;
  }
	.pcr-login-error .el-notification__content {
		text-align:left!important;
	}
  @media only screen and (max-width: 1220px)  {
    .page-convention-privacy-header .pcr-page-title,
    .page-convention-privacy-header .pcr-page-subtitle {
      padding-left:20px;
      padding-right:20px;
    }
    .col-sm-6 {
      width:50%!important;
    }
  }
	@media only screen and (max-width: 768px)  {
    .login-card {
      width:100%;
    }
    .page-convention-privacy-header .pcr-page-title {
      padding-top:30px;
    }
	}
  @media only screen and (min-width: 960px)  {
    .login-card {
      width:35%;
    }
  }

  .privacy-content h2 {
    font-size:1.1rem;
    font-weight:bold;
  }

</style>
