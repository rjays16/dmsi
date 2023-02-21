<template>
  <footer class="main-footer">
    <div class="partials-80">
    <div class="pull-right social-icons text-right">
		<a href="/" class="soc-fb">
			<img :src="footer_logo_img" />
		</a>
		<!--<a href="https://www.facebook.com/PCR1948/" class="soc-fb">
			<img src="/images/layout/social_fb.png" />
		</a>
		<a href="#" class="soc-tw">
			<img src="/images/layout/social_twit.png" />
		</a>
		<a href="#" class="soc-li">
			<img src="/images/layout/social_link.png" />
		</a>
		<a href="#" class="soc-gp">
			<img src="/images/layout/social_gplus.png" />
		</a>
		<a href="#" class="soc-rs">
			<img src="/images/layout/social_rss.png" />
		</a> -->
    </div>
    <span v-html="footer_rights_text"></span>
    <router-link class="foot-page-link" to="/terms-and-conditions">Terms &amp; Conditions</router-link>
    <router-link class="foot-page-link" to="/privacy-policy">Privacy Policy</router-link>    
    </div>
  </footer>
</template>

<script>
  export default {
    name: 'SiteFooter',
    data() {
        return {
          footer_rights_text: "2021 All Rights Reserved &copy; Virtual Media Events",
          footer_logo_img: "/images/layout/vme-logo.png",
        }
    },
    methods: {
      getfooterData() {
        axios.get(`/api/footer`)
        .then(res => {
          console.log(res.data)
          if(res.data.status_code === 200) {
            if (res.data.data.length > 0) {
              this.footer_rights_text = res.data.data[0].footer_rights_text
              this.footer_logo_img = window.location.origin + '/' + res.data.data[0].footer_logo_img.replace("public", "storage")
            }
          }
        })
        .catch(err => {
          console.log(err);
        })
      }
    },
    mounted: function () {
      this.getfooterData()
    }    
  }
</script>

<style>
  .main-footer,
  .main-footer a {
    z-index: 820!important;
    color:#212529!important;
  }
  .foot-page-link {
    border-left:1px solid #8d8d8d!important;
    margin-left:10px;
    padding-lefT:10px;
  }
  .social-icons a {
    height:25px;
    width:25px;
    display:inline-block;
  }
  .social-icons a img {
    height:25px;
  }
</style>

