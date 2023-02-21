<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper page-login">
            <section class="content content-80">
              <div class="d-flex justify-content-center">
                <el-card class="box-card login-card">
                  <div slot="header" class="clearfix text-center">
					<img src="/images/layout/vme-logo.png" class="mb-3" style="max-height:100px;" />
                    <h1>ADMIN LOGIN</h1>
                  </div>
                  <form>
                    <div class="sec-login-info">
                      <el-input class="mb-3" placeholder="Username" v-model="email"></el-input>
                      <el-input class="mb-3" placeholder="Password" v-model="password" show-password @keyup.enter.native="submit"></el-input>
                    </div>
                    <div class="sec-submit mt-3">
                      <el-button  class="login-submit-btn mb-2" :loading="signing_in" type="primary" round @click="submit">SUBMIT</el-button>
                    </div> 
                  </form>
                </el-card>                 
              </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>

<script>
  export default {
    name: 'Admin-Login',
    data() {
        return {
          username: '',
          password: '',
          email: '',
		  keep_signed: false,
		  signing_in: false
		//   test: this.$cookies.get('token')
        }
	},
	methods: {
		submit() {
			this.signing_in = true
			let data = {
				email: this.email,
				password: this.password
			}
			axios.post('/api/auth/admin/login', data)
			.then(response => {
				console.log(response.data.role)
				if (response.data.role === 'admin' || response.data.role === 'super_admin') {
					let d = new Date()
					d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
					let expires = "expires=" + d.toUTCString()
					console.log(response.data.token)
					this.$cookies.set('token', response.data.token, expires, '/')
					this.$cookies.set('user_role', response.data.role, expires, '/')
					// this.$router.push('/registration/profile')
					location.href='/admin/members/pending'					
				} else if (response.data.role === 'admin_pcr') {
					let d = new Date()
					d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
					let expires = "expires=" + d.toUTCString()
					console.log(response.data.token)
					this.$cookies.set('token', response.data.token, expires, '/')
					this.$cookies.set('user_role', response.data.role, expires, '/')
					// this.$router.push('/registration/profile')
					location.href='/admin/members/pending'					
				} else if (response.data.role === 'admin_convention') {
					let d = new Date()
					d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
					let expires = "expires=" + d.toUTCString()
					console.log(response.data.token)
					this.$cookies.set('token', response.data.token, expires, '/')
					this.$cookies.set('user_role', response.data.role, expires, '/')
					// this.$router.push('/registration/profile')
					location.href='/admin/sponsors'
				} else {
					this.$notify({
						message: 'The email address and password that you provided does not have administrator privileges',
						type: 'error',
						customClass: 'pcr-login-error',
						position: 'bottom-right'
					})
					this.signing_in = false
				}
			}).catch(error => {
				console.log(error)
				this.$notify({
					message: error.response.data.message,
					type: 'error',
					customClass: 'pcr-login-error',
					position: 'bottom-right'
				})
				this.signing_in = false
			})
		}		
	}
  }
</script>

<style>
	.admin-login .main-header,
	.admin-login .main-sidebar,
	.admin-login .main-footer {
		display:none!important;
	}
	.admin-login .content-wrapper,
	.admin-login .right-side,
	.admin-login .main-footer {
			margin-left:0px!important;
	}	
	.page-site-reg .page-header {
		padding-top:80px;
		margin-top:0;
		margin-bottom:0;
	}
	.page-header .page-site-login-header {
		background-image:url(/images/layout/pcr-site-reg-bg.png);
		background-repeat:no-repeat;
		background-size: contain;
		width:100%;
		height:0;
		padding-top:26.0417%;
		position:relative;
	}
	.page-site-login-header-text {
		position:absolute;
		width:100%;
		bottom:0;
		top:42%;
		text-align:center;
		font-size:2.2rem;
		color:#fff;
		font-weight:bold;		
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
	.admin-login .login-card {
		min-height:0!important;
	}
	.pcr-login-error .el-notification__content {
		text-align:left!important;
	}	
  @media only screen and (min-width: 960px)  {
    .login-card {
      width:35%;
    }    
  }

</style>
