<template>
    <header class="main-header bg-white">
      <el-row class="mb-0 partials-80 d-lg-none">
        <el-col :span="24">
          <el-menu class="pcr-mob-menu pt-2" mode="horizontal" menu-trigger="click">
            <el-submenu index="1" popper-class="pcr-submenu-popup">
              <template slot="title"><span class="material-icons">menu</span></template>
              <el-menu-item class="pcr-mob-submenu" index="1-1">
                <router-link to="/">
                  Home
                </router-link>
              </el-menu-item>
              <el-menu-item class="pcr-mob-submenu" index="1-2">
                <router-link to="/announcement">
                  Announcement
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="!member_login_status" class="pcr-mob-submenu" index="1-3">
                <router-link to="/apply">
                  Online Registration
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="!member_login_status" class="pcr-mob-submenu" index="1-4">
                <router-link to="/login">
                  Login
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="member_login_status" class="pcr-mob-submenu" index="1-5">
                <router-link to="/mini-sessions">
                  Mini Sessions
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="member_login_status" class="pcr-mob-submenu" index="1-5">
                <router-link to="/profile">
                  Profile
                </router-link>
              </el-menu-item>
              <el-menu-item v-if="member_login_status" class="pcr-mob-submenu" index="1-6">
                <router-link v-on:click.native="logout()" to="/">
                  Logout
                </router-link>
              </el-menu-item>
            </el-submenu>
          </el-menu>
          <div class="grid-content p-3 header-logo-title text-center">
              <div class="mb-1">
                <img :src="header_logo_img" class="mr-2" style="max-height:50px;" />
              </div>
              <span class="font-weight-bold" v-html="header_company_name"></span>
          </div>
        </el-col>
      </el-row>
      <el-row class="mb-0 w-100 d-none d-lg-block">
        <el-col :span="10">
          <div class="grid-content p-3 header-logo-title">
            <router-link to="/" class="header-link-home">
              <img :src="header_logo_img" class="mr-2" style="max-height:50px;" />
              <span class="font-weight-bold" v-html="header_company_name"></span>
            </router-link>
          </div>
        </el-col>
        <el-col :span="14" :class="d-none">
          <div class="grid-content text-right p-3 reg-log-cont">
            <el-button @click="$router.push('/')" type="text" class="link-register mt-2" round>Home</el-button>
            <el-button @click="$router.push('/announcement')" type="text" class="link-register mt-2" round>Announcement</el-button>
            <el-button v-if="!member_login_status" @click="$router.push('/apply')" type="primary" round class="link-register mt-2">Online Registration</el-button>
            <el-button v-if="!member_login_status" @click="$router.push('/login')" class="mt-2" type="primary" round>Login</el-button>
            <el-button v-if="member_login_status" @click="$router.push('/mini-sessions')" type="text" class="link-register mt-2" round>Mini Sessions</el-button>
            <el-button v-if="member_login_status" @click="$router.push('/profile')" type="text" class="link-register mt-2" round>Profile</el-button>
            <el-button v-if="member_login_status && user_role === 'pcr' || user_role === 'pcr/attendee'" @click="logout()" class="mt-2" type="primary" round>Log Out</el-button>
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
          header_logo_img: "/images/layout/vme-logo.png",
          header_company_name: "Virtual Media Events",
          token: this.$cookies.get('token'),
          user_role: this.$cookies.get('user_role'),
          member_login_status: false
        }
    },
    computed: {
        currentRouteName() {
            return this.$router.history.current.path
        }
    },
    methods: {
      logout() {
        axios.delete('/api/auth/logout', {
          headers: {
            Authorization: 'Bearer ' + this.token
          }
        }).then(response => {
          console.log(response.data)
          this.$cookies.remove('token')
          this.$cookies.remove('member_id')
          this.$cookies.remove('user_role')
          // this.$router.push('/login')
          location.href='/login'
        }).catch(error => {
          console.log(error.response.data)
          this.$cookies.remove('token')
          this.$cookies.remove('member_id')
          this.$cookies.remove('user_role')
          // this.$router.push('/login')
          location.href='/login'          
        })
      },
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      },
      checkMemberLoginStatus() {
        if (this.user_role === 'pcr') {
          this.member_login_status = true
        } else if (this.user_role === 'pcr/attendee') {
          this.member_login_status = true
        } else if (this.user_role === 'attendee') {
          this.member_login_status = false
        } else if (this.user_role === 'attendee') {
          this.member_login_status = false
        }
      },
      getheaderData() {
        axios.get(`/api/headerlogo`)
        .then(res => {
          console.log(res.data)
          if(res.data.status_code === 200) {
            if (res.data.data.length > 0) {
              this.header_company_name = res.data.data[0].header_company_name
              this.header_logo_img = window.location.origin + '/' + res.data.data[0].header_logo_img.replace("public", "storage")
            }
          }
        })
        .catch(err => {
          console.log(err);
        })
      },      
    },
    mounted: function () {
      this.checkMemberLoginStatus()
      this.getheaderData()
    }
  }
</script>

<style>
  .navbar-nav {
      flex-direction: row;
  }
  .link-register.el-button--text {
    color:#000;
  }
  .header-link-home span {
    color:#303133;
  }
  .header-logo-title {
    white-space: nowrap;
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
  .page-header {
    padding-top:80px!important;
    margin:0!important;
  }
</style>
