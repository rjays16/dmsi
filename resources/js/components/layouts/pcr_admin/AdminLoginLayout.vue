<template>
  <div>
    <app-header></app-header>

    <!-- Content Wrapper. Contains page content -->
    <div class="main-page-content"><router-view></router-view></div>
    <!-- /.content-wrapper -->

    <app-footer></app-footer>

  </div>
</template>

<script>
  import Header from '../../partials/pcr_site/Header.vue'
  import Footer from '../../partials/pcr_site/Footer.vue'

  export default {
    name: 'Exhibition',
    components: {
      'app-header': Header,
      'app-footer': Footer,
    }
  }
</script>

<style>
  /* This hides the sidebar */
  .pcr-admin-login-layout .content-wrapper,
  .pcr-admin-login-layout .right-side,
  .pcr-admin-login-layout .main-footer {
    	margin-left:0px!important;
  }
  .content {
    	min-height:10px!important;
  }
  .content-80, .width-80 {
    	max-width:80%;
  }
  .inner-80 {
		max-width:80%;
		margin-right:auto;
		margin-left:auto;
		padding-right:30px;
		padding-left:30px;
		padding-bottom:30px;
  }
  .virtual-exhibitors-page .reg-log-cont {
    	display:none;
  }
  .partials-80 {
    max-width:80%;
    margin-right:auto;
    margin-left:auto;
    padding-right:30px;
    padding-left:30px;     
  } 
  button {
    outline: 0!important;
  }
  .pcr-admin-login-layout .main-page-content {
    padding-bottom:60px;
  }
  .pcr-admin-login-layout .main-footer {
    position:fixed!important;
    width:100%;
    background:#fff;
  }
	@media only screen and (max-width: 1382px)  {
    .partials-80 {
      max-width:100%!important;
    } 
	}
	@media only screen and (max-width: 768px)  {
    .partials-80 {
      padding-right:0!important;
      padding-left:0!important;
    } 
    .content-80, .width-80 {
        max-width:100%!important;
    }    
	}

</style>
