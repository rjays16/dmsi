<template>
    <header class="main-header bg-white">
      <el-row class="mb-0 partials-80 d-lg-none">
        <el-col :span="24">
          <el-menu class="pcr-mob-menu pt-2" mode="horizontal" menu-trigger="click">
            <el-submenu index="1" popper-class="pcr-submenu-popup">
              <template slot="title"><span class="material-icons">menu</span></template>
              <el-menu-item class="pcr-mob-submenu" index="1-0">
                <router-link to="/convention/">
                  Home
                </router-link>
              </el-menu-item>              
              <el-menu-item class="pcr-mob-submenu" index="1-1">
                <router-link to="/convention/registration">
                  Register
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="!token" class="pcr-mob-submenu" index="1-2">
                <router-link to="/convention/login">
                  Login
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="token && user_role === 'attendee' || user_role === 'pcr/attendee'" class="pcr-mob-submenu" index="1-3">
                <router-link to="/convention/profile">
                  Profile
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="token && user_role === 'attendee' || user_role === 'pcr/attendee'" class="pcr-mob-submenu" index="1-4">
                <router-link v-on:click.native="logout()" to="/">
                  Logout
                </router-link>
              </el-menu-item>
            </el-submenu>
          </el-menu>
          <div class="grid-content p-3 header-logo-title">
              <div class="mb-1">
                <img src="/images/layout/vme_logo.png" class="mr-2" style="max-height:50px;" />
              </div>
              <span class="font-weight-bold">73rd Annual Convention</span>
          </div>
        </el-col>
      </el-row>      
      <el-row class="mb-0 partials-80 d-none d-lg-block">
        <el-col :span="10">
          <div class="grid-content p-3">
            <router-link to="/convention" class="header-link-home">
              <img src="/images/layout/vme_logo.png" class="mr-2" style="max-height:50px;" />
              <span class="font-weight-bold">73rd Annual Convention</span>
            </router-link>
          </div>
        </el-col>
        <el-col :span="14">
          <div class="grid-content text-right p-3 reg-log-cont">
            <el-button v-if="!token" @click="$router.push('/convention/registration')" type="text" class="link-register mt-2" round>Register</el-button>
            <el-button v-if="!token" @click="$router.push('/convention/login')" class="mt-2" type="primary" round>Login</el-button>
			      <el-button v-if="token && user_role === 'attendee' || user_role === 'pcr/attendee'" @click="$router.push('/convention/profile')" type="text" class="link-register mt-2" round>Profile</el-button>
            <el-button v-if="token && user_role === 'attendee' || user_role === 'pcr/attendee'" @click="logout()" class="mt-2" type="primary" round>Log Out</el-button>
          </div>
        </el-col>
      </el-row>
    </header>
</template>
<script>
  export default {
    name: 'SiteHeader',
    data() {
        return {
          token: this.$cookies.get('token'),
          user_role: this.$cookies.get('user_role')
        }
    },
    methods: {
      logout() {
        axios.post('/api/auth/logout', {
          headers: {
            Authorization: 'Bearer ' + this.token
          }
        }).then(response => {
          console.log(response.data)
          this.$cookies.remove('token')
          this.$cookies.remove('member_id')
          this.$cookies.remove('user_role')
          // this.$router.push('/login')
          location.href='/convention/login'
        }).catch(error => {
          console.log(error.response.data)
          this.$cookies.remove('token')
          this.$cookies.remove('member_id')
          this.$cookies.remove('user_role')
          // this.$router.push('/login')
          location.href='/convention/login'          
        })
      }
    },
    mounted: function () {

    }
  }
</script>

<style scoped>
  .navbar-nav {
      flex-direction: row;
  }
  .link-register.el-button--text {
    color:#000;
  }
  .header-link-home span {
    color:#303133;
  }
  .pcr-mob-menu {
    border:none!important;
    width:50px;
    height:50px;
    overflow:hidden;
    padding-left:0!important;
    padding-right:0!important;
    position:absolute!important;
    top:40px;
    left: -10px;
  }
  .el-submenu.is-active .el-submenu__title {
    border-bottom:none!important;
  }
  .pcr-mob-submenu.el-menu-item a {
    color:#000000!important;
  }
  .el-menu--horizontal.pcr-submenu-popup {
    left:0!important;
    top:95px!important;
  }
  .el-menu--horizontal.pcr-submenu-popup .el-menu--popup {
    border-radius:0px!important;
  }
</style>
