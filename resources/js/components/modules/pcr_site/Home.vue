<template>
    <transition name="el-zoom-in-top">
          <div class="content-wrapper page-site-home">
            <!-- Main content -->
            <section class="page-header">
              <div class="page-site-home-header" :style="'background-image:url(' + banner_main_background + ');'">
                <div class="page-site-home-header-text" v-html="banner_main_text"></div>
              </div>
            </section>

            <section class="content width-80">
				<!-- <h2 class="my-4">Welcome to the Philippine College of Radiology Membership Portal</h2>
				<h2 class="my-4">About Us</h2>
				<p class="font-weight-bold">When the Philippine College of radiology was established in 1948, there was only a handful of Filipino Radiologists.</p>
				<p>This was the period when Manila was being slowly rebuilt from the devastation brought about by World War II. At that time they called the organization the Philippine Radiological Society (PRS).  It was formed by the “Magnificent Seven”. The first PRS Constitution and its by-laws was then drafted.  In 1968 Dr. Federico Principe, together with the remaining members of the Magnificent 7, and other young radiologists, successfully blocked a bill in Congress seeking to liberalize the acquisition of X-ray machines and professionalize x-ray technicians. In August 21, 1970, a new Constitution and by-laws changed the name of the Philippine Radiological Society (PRS) to the present name, Philippine College of Radiology (PCR).</p>
				<p>The decade of the ‘70s saw the major development of the Philippine Radiological Society. Bearing the new name of the organization, the Philippine College of Radiology (PCR) with a new logo for the college. The logo was designed by Drs. Bienvenido Lapuz and Edmundo Villacorta, and was executed by an artist in 1970.  It is interesting to note that the design of the logo was considered a sign of peace, with the theme, “Medical Radiology for the Health of Mankind in Time of Peace.”</p>
				<p>In May 29,1971 the first oral examinations for the certification in Radiology was held at the St. Luke’s Hospital in Quezon City by the newly formed Board of Examiners.    A new Code of Ethics was drafted by Dr. Hilario Zialcita and was included in the constitution in 1974 by Dr. Hilario Zialcita. The creation of the PCR gave way to the admission of more eligible members as Fellows of the society.  By 1971, the PCR membership had grown from seven to about a hundred.</p>
				<p>Several organizations had been formed by members all over the country.  The Northern and Central Luzon Chapter was formed in 1980 with Dr. Roberto Legaspi as president.  The Mindanao-Sulu chapter was formed in 1981 with Dr. Jose Gantioqui as president.  The Constitution and by-laws were corrected by Dr. Ronaldo Asuncion to conform with the requirements of the Security and Exchange Commission (SEC).  The membership has grown to two hundred and thirty nine (239) in 1985. In September 1, 1982, the first PCR foundation day was celebrated and in October 29, 1982, the PCR secretariat Office was inaugurated.</p>
				<p>The growing members initiated more exciting exchanges in notes in radiology as the years go by.  Film reading sessions, difficult cases were discussed and lectures were delivered.  In 1983, a midyear post graduate symposium was started by Dr. Honorato Piedad.  These scientific meetings served as formal venues for exchanging notes and knowledge on trends in the specialties of the society.  It was then that the first Scientific meeting of the section of Radiation Oncology was held.  In 1984 the specialty societies of Ultrasound and of Radiation Oncology were formally organized. In 1991, the PCR constitution underwent amendments to expand the growing membership categories.</p>
				<p>In February 23, 1996, the PCR constitution and by-laws was amended during the annual convention; amendments to the Code of Ethics were also proposed to address the changing needs and practices in Radiology.  The PMA acknowledged PCR as one of the only eight (8) specialty societies.</p>
				<p>In 1997 the PCR Board of Directors approved the Revised Criteria for accreditation of Residency Training in Radiology.  The Residency training council (RTC), a new PCR body composed of all training officers of accredited hospital, was formed.</p>
				<p>In 2012, a new Constitution and a new set of bylaws was approved by the membership and was subsequently approved by the SEC., It was also during this time that the PCR joined the Association of Medical Physicians (AMP).</p>
				<p>In 2013, new committees were added to meet the demands of the membership and of the times: Professional fee, System based specialty, Contrast media, Teleradiology and PHILCAT committees were formed. A PCR Research Foundation Inc was also established.</p>
				<p>In 2014, the total member of the PCR was recorded to be 1,428. During this time, the PCR was composed of only four chapters: The Central- Northern Luzon. Southern Luzon, Cebu Chapter (formerly the Visayas -Northern Mindanao) and Southern Mindanao. The society was still composed of five (5) subspecialty societies. Namely, the Ultrasound Society of the Philippines (USP), the CT-MRI Society of the Philippines (CTMRISP), the Philippine Radiology Oncology Society (PROS), the  Philippine Society of Vascular and Interventional Radiology (PSVIR)  and Diagnostic Breast Imaging Society of the Philippines (DBISP).</p>
				<p>In 2016, the previously known Central-Northern Luzon Chapter separated into the Central Luzon and Northern Luzon Chapter. This year also witnessed the creation of the Panay Islands Chapter and the Negros Chapter.</p>
				<p>In 2017, a Continuing Professional Development (CPD) committee was established in response to the CPD Law (R.A. 10912). A Remedial committee was also created to provide learning support for the applicants of the PBR examinations.</p>
				<p>2018 saw the creation of the New Technology committee and the Artificial Intelligence (AI) subcommittee whose aims are to evaluate and consider the implications of the advances in the emerging new technologies and artificial intelligence. During the 70th annual convention of the PCR, the founding presidents of the different specialty interest groups took their oath. The new special interest groups were the Skeletal Radiology Society of the Philippines, Philippine Society for Pediatric Radiology, Neuroradiology Society of the Philippines, and the Philippine Radiological Society of Nuclear Medicine and Molecular Imaging and the Diagnostic Breast Imaging Society of the Philippines. The following year the Philippine Society for Abdominal Radiology and the Chest and Cardiovascular Society of the Philippines were established.</p>
				<p>To date, the latest addition to the growing members of the society are the NCR and the Mindanao North chapters whose officers took oath last February 27, 2020. At present, there is a total of  2,025 members of the PCR.</p>
				<p>As of this writing, the PCR is still continuously evolving, adding committees, chapters, groups, and more. It is still molding its policies and regulations that would befit the everchanging landscape of the Practice of Radiology here in the Philippines and overseas. But one thing prevails- and that is the Resilience demonstrated by the College and its members during the highest and lowest moments in history.</p>
				<p>In the end, amidst the chaos that has befallen the international and local community, the members of the Philippine College of Radiology are all brothers and sisters at arms, fighting a common enemy,  and fighting for a common cause.</p>-->
            </section>

			<section class="content convention-cta d-none">
				<div class="row">
					<div class="col-xs-12 col-sm 12 col-md-2 mb-5">
						<div class="home-side-banner">
							<!-- <span>Convention Banner</span> -->
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-8 mb-5">
						<a href="https://73rdpcrannualconvention.com/registration">
								<img src="/images/layout/convention_cta.png" />
						</a>						
					</div>
					<div class="col-xs-12 col-sm 12 col-md-2 mb-5">
						<div class="home-side-banner">
							<!-- <span>Convention Banner</span> -->
						</div>
					</div>
				</div>

			</section>

            <el-dialog
            :visible.sync="dialogCookies" center>
            <div class="cookie-pop text-center">
                <h4 class="mb-3">This website uses cookies.</h4>
                <p>We use cookies to improve user experience, and analyze website traffic. For these reasons, we may share your site usage data with our analytics partners. By clicking “Accept”, you consent to store on your device all the technologies described in our Cookie Policy.</p>
                <el-button type="success" @click="cookieAccept">Accept</el-button>
            </div>
            </el-dialog>			

            <!-- /.content -->
          </div>
    </transition>
</template>

<script>
  export default {
    name: 'Home',
    data() {
        return {
			test_url: "/",
			dialogCookies: false,
			banner_main_background: "/images/layout/page-head-bg-3.png",
			banner_main_text: "Welcome to Virtual Media Events"
        }
	},
    methods: {
      cookieAccept() {
        var cook_acc = 'true'
        let d = new Date()
        d.setTime(d.getTime() + 365 * 48 * 60 * 60 * 1000)
        let expires = "expires=" + d.toUTCString()
        this.$cookies.set('cook_acc', cook_acc, expires, '/')   
        this.dialogCookies = false
      },
      checkIfCookieAcc() {
        var cookie_status = this.$cookies.get('cook_acc')
        if (cookie_status === 'true') {
          this.dialogCookies = false
        } else {
          this.dialogCookies = true
        }
      },
      dispurl() {
        this.test_url = process.env.MIX_MEMBER_LIVE_URL
      },  
    },
  	mounted() {
      this.checkIfCookieAcc()
	  this.dispurl()
  	}	
  }
</script>

<style>
	.page-site-home .page-header {
		padding-top:80px;
		margin-top:0;
		margin-bottom:0!important
	}
	.page-site-home h2 {
		font-size:1.5rem;
		font-weight:bold;
		color:#f75202;
		text-align: center;
	}
	.page-header .page-site-home-header {
		background-repeat:no-repeat;
		/*background-size: contain;*/
		width:100%;
		height:0;
		padding-top:26.0417%;
		position:relative;
	}
	.page-site-home-header-text {
		position:absolute;
		width:100%;
		bottom:0;
		top:42%;
		text-align:center;
	}

	.page-site-home-header-text {
		font-size:2.2rem;
		color:#fff;
		font-weight:bold;
	}
	.convention-cta {
		padding-left:0!important;
		padding-right:0!important;
	}
	.convention-cta img {
		width:100%;
	}
	.home-side-banner {
		text-align:center;
		background:#dddddd;
		height:100%;
	}
	.home-side-banner span {
		padding-top:25%;
		display:block;
	}
	@media only screen and (max-width: 1220px)  {
		.page-header .page-site-home-header {
			background-image:url(/images/layout/pcr-site-home-bg.png);
			background-repeat:no-repeat;
			background-size: cover;
			height:250px;
			padding-top:26.0417%;
			position:relative;
		}
		.page-site-home-header-text {
			top:30%
		}
	}
	@media only screen and (max-width: 768px)  {
		.page-site-home-header-text {
			top:25%;
			font-size:1.8rem;
			color:#fff;
			font-weight:bold;
		}		
	}

    .banner-reg-btn {
        background-color:#00005c!important;
        color:#fff!important;
    }	
.cookie-pop {
    word-break: initial;
}
</style>
