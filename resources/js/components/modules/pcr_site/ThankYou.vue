<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-thanks">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-mem-thanks-header">
                  <div class="thanks-content w-100 px-2">
                      <div class="pcr-page-title font-weight-bold">Thank You!</div>
                    <div class="pcr-page-subtitle">Your application is pending for approval.</div>
                  </div>
              </div>
            </section>
            <!-- /.content -->
            <!-- <section class="content width-80 text-center">
                <div class="thank-you-text">
                <p>You may now complete your application for membership payment here:</p>
                <p class="font-weight-bold">Philippine College of Radiology, Inc<br>Bank of the Philippine Islands<br>Account No. 3141074759.</p>
                <p>Submit official payment receipt to <a href="mailto:pcr_secretariat@yahoo.com">pcr_secretariat@yahoo.com</a> for verification and updating of your membership status. Once this is done, you’ll be notified via the email address you provided.</p>
                <p>For settlement of annual dues, please contact The Philippine College of Radiology Secretariat:</p>
                <p class="font-weight-bold">Units 807/809 Future Point Plaza 1<br>
                112 Panay Avenue, South Triangle<br>
                Quezon City, Philippines 1103<br>
                Tel: (+632) 373-8462<br>
                Fax: (+632) 374-3299<br>
                Email: <a href="mailto:pcr_secretariat@yahoo.com">pcr_secretariat@yahoo.com</a><br>
                Website: <a href="https://www.philippinecollegeofradiology.org.ph">www.philippinecollegeofradiology.org.ph</a><br>
                Convention Website: <a href="https://www.73rdpcrannualconvention.com">www.73rdpcrannualconvention.com</a></p>
                </div>
            </section> -->
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
          keep_signed: false
        }
    },
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
