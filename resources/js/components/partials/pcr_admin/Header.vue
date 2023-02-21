<template>
    <header class="main-header">
        <!-- Logo -->
        <router-link to="/admin/members/approved" class="admin-logo logo">
            <!--<span class="logo-mini"><b> <img src="/images/layout/pcr-logo-circle.png" alt="User Image"></b></span>-->
            <span class="admin-pcr-logo-lg logo-lg text-center">
                <img src="/images/layout/vme-logo-white.png" style="margin-right:0!important;" alt="User Image">
                <!--<b>Admin</b>-->
            </span>
        </router-link>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
            <el-button @click="logout()" class="pull-right">Log Out</el-button>


        </nav>
    </header>
</template>
<script>
  export default {
    name: 'DashboardHeader',
    data() {
        return {
          token: '',
          user_role: ''
        }
    },
    methods: {
      logout() {
        axios.delete('/api/auth/logout').then(response => {
            console.log(response.data)
            let d = new Date()
			d.setTime(d.getTime() + 2 * 24 * 60 * 60 * 1000)
			let expires = "expires=" + d.toUTCString()          
            document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;'
            document.cookie = 'user_role=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;'
            location.href='/admin'
        }).catch(error => {
            console.log(error.response.data)
            document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;'
            document.cookie = 'user_role=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;'
            location.href='/admin'
        })
      },
      getTokenCookie () {
        var token = 'token'
        var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
        if (match) {
            this.token = match[2]
        }
        else{
            console.log('No token found');
        }
      },
      getUserRoleCookie () {
        var token = 'user_role'
        var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
        if (match) {
            this.user_role = match[2]
        }
        else{
            console.log('No token found');
        }
      },
      adminUserCheck() {
          if (this.user_role === 'admin') {
              console.log('This User is an admin.')
          } else if (this.user_role === 'super_admin') {
              console.log('This User is a super admin.')
          } else if (this.user_role === 'admin_pcr') {
              console.log('This User is a pcr admin.')
          } else if (this.user_role === 'admin_convention') {
              console.log('This User is a convention admin.')
          } else {
              location.href='/admin'
          }
          
      }
    },    
    mounted: function () {
        this.getTokenCookie()
        this.getUserRoleCookie()
        this.adminUserCheck()
    }
  }
</script>

<style>
    .admin-main .main-header .sidebar-toggle {
        padding:0!important;
        margin:0!important;
        border:none;
    }
    .admin-pcr-logo-lg img {
        height:50px!important;
    }
</style>