<template>
    <aside class="main-sidebar bg-white">
        <!-- sidebar: style can be found in sidebar.less -->
        <div>
            <section class="sidebar">
                <!-- /.search form -->
                <!-- Sidebar user panel -->
                <!-- <div class="user-panel">
                    <div class="image"> <img src="/images/img/avatar2.png" class="img-circle" alt="User Image"> </div>
                    <div class="info">
                        <p>Good Job, Matirasa</p>
                        <p><small>You haven,t miss any task this week!</small></p>
                        <div> <a href="#"><i class="ti-panel"></i><small>Settings</small></a> <a href="#"><i class="ti-user"></i><small>Profile</small></a> <a href="#"><i class="ti-power-off"></i><small>Logout</small></a> </div>
                    </div> <img class="bg-user" src="/images/img/avatar-bg.png" alt="User Image">
                </div> -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li v-if="roleCheck('member')" class="header">MEMBERSHIP</li>
                    <!-- <li>
                        <router-link to="/"> <i class="ti-email"></i> <span>Dashboard</span> </router-link>
                    </li> -->
                    <li v-if="roleCheck('member')">
                        <router-link to="/admin/announcements"> <i class="ti-signal"></i> <span>Announcements</span> </router-link>
                    </li>
                    <li v-if="roleCheck('member')" class="treeview">
                        <a href="#"> <i class="ti-user"></i> <span>Members</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/members/pending">
                                    <avatar username="Pending Members" :size='20' color="#fff"></avatar>Non-Active</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/members/approved">
                                    <avatar username="Approved Members" :size='20' color="#fff"></avatar>Active</router-link>
                            </li>
                        </ul>
                    </li>
                    <li v-if="roleCheck('member')" class="treeview">
                        <a href="#"> <i class="ti-clipboard"></i> <span>Registration</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/registration/pending">
                                    <avatar username="Pending Registration" :size='20' color="#fff"></avatar>Pending</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/registration/approved">
                                    <avatar username="Approved Registration" :size='20' color="#fff"></avatar>Approved</router-link>
                            </li>
                        </ul>
                    </li>
                    <li v-if="roleCheck('member')" class="">
                        <router-link to="/admin/vouchercodes"> <i class="ti-comment-alt"></i> <span>Voucher Codes</span> </router-link>
                    </li>
                    <li v-if="roleCheck('member')" class="treeview">
                        <a href="#"> <i class="ti-clipboard"></i> <span>Election</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/election/active">
                                    <avatar username="Active Period" :size='20' color="#fff"></avatar>Active Period</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/election/history/passed">
                                    <avatar username="Election History" :size='20' color="#fff"></avatar>History</router-link>
                            </li>
                           
                        </ul>
                    </li>
                  
                    <li v-if="roleCheck('member')" class="treeview d-none">
                        <a href="#"> <i class="ti-control-play"></i> <span>Mini-Sessions</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/mini-sessions">
                                    <avatar username="Sessions" :size='20' color="#fff"></avatar>Manage Mini-Sessions</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/mini-sessions-start">
                                    <avatar username="Sessions" :size='20' color="#fff"></avatar>Start Mini-Sessions</router-link>
                            </li>
                            <!--<li>
                                <router-link to="/admin/mini-Sessions/rooms">
                                    <avatar username="Rooms" :size='20' color="#fff"></avatar>Rooms</router-link>
                            </li>-->
                        </ul>
                    </li>                                                      
                    <li v-if="roleCheck('convention')" class="header">CONVENTION</li>
                    <li v-if="roleCheck('convention')" class="treeview">
                        <a href="#"> <i class="ti-layout-sidebar-right"></i> <span>Enroll Sponsors</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/sponsors">
                                    <avatar username="Sponsors" :size='20' color="#fff"></avatar>Sponsors</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/sponsors/add">
                                    <avatar username="Add Sponsor" :size='20' color="#fff"></avatar>Add Sponsor</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/sponsors/booth">
                                    <avatar username="Booth Changes" :size='20' color="#fff"></avatar>Booth Changes</router-link>
                            </li>
                        </ul>

                    </li>
                    <li v-if="roleCheck('convention')" class="">
                        <router-link to="/admin/slider"> <i class="ti-layout-slider"></i> <span>Virtual Exhibitors Slider</span> </router-link>
                    </li>
                    <li v-if="roleCheck('convention')" class="treeview">
                        <a href="#"> <i class="ti-layout-accordion-separated"></i> <span>Site Settings</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/site/header">
                                    <avatar username="Header" :size='20' color="#fff"></avatar>Header</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/site/footer">
                                    <avatar username="Footer" :size='20' color="#fff"></avatar>Footer</router-link>
                            </li>
                        </ul>
                    </li>                     
                    <li v-if="roleCheck('convention')" class="treeview">
                        <a href="#"> <i class="ti-home"></i> <span>Home Page</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/home/main-banner">
                                    <avatar username="Main Banner" :size='20' color="#fff"></avatar>Main Banner</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/home/related-events">
                                    <avatar username="Related Events" :size='20' color="#fff"></avatar>Related Events</router-link>
                            </li>
                        </ul>
                    </li>
                    <li v-if="roleCheck('convention')" class="">
                        <router-link to="/admin/lobby/lobby-settings"> <i class="ti-layout-column2-alt"></i> <span>Lobby</span> </router-link>
                    </li>
                    <li v-if="roleCheck('convention-super')" class="">
                        <router-link to="/admin/plenary/plenary-settings"> <i class="ti-video-camera"></i> <span>Plenary Page</span> </router-link>
                    </li>
                    <li v-if="roleCheck('convention')" class="treeview">
                        <a href="#"> <i class="ti-control-play"></i> <span>Mini-Sessions</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/mini-sessions">
                                    <avatar username="Sessions" :size='20' color="#fff"></avatar>Sessions</router-link>
                            </li>
                            <!--<li>
                                <router-link to="/admin/mini-Sessions/rooms">
                                    <avatar username="Rooms" :size='20' color="#fff"></avatar>Rooms</router-link>
                            </li>-->
                        </ul>
                    </li>
                    <li v-if="roleCheck('convention')" class="treeview">
                        <a href="#"> <i class="ti-medall"></i> <span>Contest</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/contest/poster-research">
                                    <avatar username="Poster Research" :size='20' color="#fff"></avatar>Poster Research</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/contest/oral-research">
                                    <avatar username="Oral Research" :size='20' color="#fff"></avatar>Oral Research</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/contest/photography">
                                    <avatar username="Photography" :size='20' color="#fff"></avatar>Photography</router-link>
                            </li>
                        </ul>
                    </li>
                   

                </ul>
            </section>
            <!-- /.sidebar -->
        </div>
    </aside>
</template>
<script>
import Avatar from 'vue-avatar/dist/Avatar.vue'
export default {
    name: 'DashboardSidebar',
    data() {
        return {
            token: '',
            user_role: ''
        }
	},  
    mounted: function () {
        $(document).ready(function ($) {
            $('.main-sidebar > div').slimScroll({
                width: '230px',
                position: 'left',
                size: '5px',
                height: '95vh'
            })
        })
        this.getTokenCookie()
        this.getUserRoleCookie()
    },
    methods: {
        roleCheck(type) {
            if (type === 'member') {
                if (this.user_role === 'admin' || this.user_role === 'super_admin') {
                    return true
                } else if (this.user_role === 'admin_pcr') {
                    return true
                } else if (this.user_role === 'admin_convention') {
                    return false
                } else {
                    return false
                }
            }
            if (type === 'convention') {
                if (this.user_role === 'admin' || this.user_role === 'super_admin') {
                    return true
                } else if (this.user_role === 'admin_pcr') {
                    return false
                } else if (this.user_role === 'admin_convention') {
                    return true
                } else {
                    return false
                }
            }
            if (type === 'convention-super') {
                if (this.user_role === 'super_admin') {
                    return true
                } else {
                    return false
                }
            }
        },
        getTokenCookie() {
            var token = 'token'
            var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
            if (match) {
                this.token = match[2]
            }
            else{
                console.log('No token found');
            }
        },
        getUserRoleCookie() {
            var token = 'user_role'
            var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
            if (match) {
                this.user_role = match[2]
            }
            else{
                console.log('No token found');
            }
        },
    },
    components: {
        Avatar
    }
}
</script>