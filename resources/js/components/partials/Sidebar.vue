<template>
    <aside class="main-sidebar bg-white">
        <!-- sidebar: style can be found in sidebar.less -->
        <div>
            <section class="sidebar">
                <!-- /.search form -->
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="image"> <img src="/images/img/avatar2.png" class="img-circle" alt="User Image"> </div>
                    <div class="info">
                        <p>Good Job, Matirasa</p>
                        <p><small>You haven,t miss any task this week!</small></p>
                        <div> <a href="#"><i class="ti-panel"></i><small>Settings</small></a> <a href="#"><i class="ti-user"></i><small>Profile</small></a> <a href="#"><i class="ti-power-off"></i><small>Logout</small></a> </div>
                    </div> <img class="bg-user" src="/images/img/avatar-bg.png" alt="User Image"> </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <!-- <li class="header">APPS</li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-desktop"></i> <span>Dashboard</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/dashboard">
                                    <avatar username="Dashaboard One" :size='20' color="#fff"></avatar>Dashboard 1</router-link>
                            </li>
                            <li>
                                <router-link to="/dashboard-second">
                                    <avatar username="Dashaboard Two" :size='20' color="#fff"></avatar>Dashboard 2</router-link>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="header">APPS</li> -->
                    <li class="treeview">
                        <a href="#"> <i class="ti-desktop"></i> <span>Members</span> <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> 
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/admin/members/pending">
                                    <avatar username="Pending Members" :size='20' color="#fff"></avatar>Pending</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/members/approved">
                                    <avatar username="Approved Members" :size='20' color="#fff"></avatar>Approved</router-link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <router-link to="/"> <i class="ti-email"></i> <span>Dashboard</span> </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/vouchercodes"> <i class="ti-comment-alt"></i> <span>Voucher Codes</span> </router-link>
                    </li>
                    <!-- <li>
                        <router-link to="/calendar"> <i class="ti-calendar"></i> <span>Calendar Apps</span> </router-link>
                    </li>
                    <li>
                        <router-link to="/todo"> <i class="ti-write"></i> <span>ToDo Apps</span> </router-link>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-paint-roller"></i> <span>Skin</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="http://devin.ndesaintheme.com">
                                    <avatar username="Gradient" :size='20' color="#fff"></avatar>Gradient Skin</a>
                            </li>
                            <li>
                                <a href="http://devin-dark.ndesaintheme.com">
                                    <avatar username="Dark" :size='20' color="#fff"></avatar>Dark Skin</a>
                            </li>
                            <li>
                                <a href="http://devin-light.ndesaintheme.com">
                                    <avatar username="Light" :size='20' color="#fff"></avatar>Light Skin</a>
                            </li>
                            <li>
                                <a href="http://devin-black.ndesaintheme.com">
                                    <avatar username="Black" :size='20' color="#fff"></avatar>Black Skin</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">PAGES</li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-layout-accordion-list"></i> <span>Blog</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/blog-list">
                                    <avatar username="Blog List" :size='20' color="#fff"></avatar> Blog List </router-link>
                            </li>
                            <li>
                                <router-link to="/blog-mansory">
                                    <avatar username="Blog Mansory" :size='20' color="#fff"></avatar> Blog Mansory </router-link>
                            </li>
                            <li>
                                <router-link to="/blog-details">
                                    <avatar username="Blog Details" :size='20' color="#fff"></avatar> Blog Details </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-shopping-cart-full"></i> <span>E Commerce</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/shop-home">
                                    <avatar username="hop Home Page" :size='20' color="#fff"></avatar> Shop Home </router-link>
                            </li>
                            <li>
                                <router-link to="/shop-item">
                                    <avatar username="Shop Item" :size='20' color="#fff"></avatar> Shop Item</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-layout-media-overlay"></i> <span>Common Page</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/invoice">
                                    <avatar username="Invoice" :size='20' color="#fff"></avatar> Invoice</router-link>
                            </li>
                            <li>
                                <router-link to="/profile">
                                    <avatar username="Profile" :size='20' color="#fff"></avatar> Profile</router-link>
                            </li>
                            <li>
                                <router-link to="/login">
                                    <avatar username="Login" :size='20' color="#fff"></avatar> Login</router-link>
                            </li>
                            <li>
                                <router-link to="/404">
                                    <avatar username="404" :size='20' color="#fff"></avatar> 404 Error</router-link>
                            </li>
                            <li>
                                <router-link to="/500">
                                    <avatar username="500" :size='20' color="#fff"></avatar> 500 Error</router-link>
                            </li>
                            <li class="active">
                                <router-link to="/blank-page">
                                    <avatar username="Blank Page" :size='20' color="#fff"></avatar> Blank Page</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="header">GENERALS</li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-write"></i> <span>Forms</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/form/radio">
                                    <avatar username="Radio" :size='20' color="#fff"></avatar> Radio</router-link>
                            </li>
                            <li>
                                <router-link to="/form/checkbox">
                                    <avatar username="Check Box" :size='20' color="#fff"></avatar> Checkbox</router-link>
                            </li>
                            <li>
                                <router-link to="/form/input">
                                    <avatar username="Input" :size='20' color="#fff"></avatar> Input</router-link>
                            </li>
                            <li>
                                <router-link to="/form/select">
                                    <avatar username="Select" :size='20' color="#fff"></avatar> Select</router-link>
                            </li>
                            <li>
                                <router-link to="/form/cascader">
                                    <avatar username="Cascader" :size='20' color="#fff"></avatar>Cascader</router-link>
                            </li>
                            <li>
                                <router-link to="/form/switch">
                                    <avatar username="Switch" :size='20' color="#fff"></avatar>Switch</router-link>
                            </li>
                            <li>
                                <router-link to="/form/Slider">
                                    <avatar username="Slider" :size='20' color="#fff"></avatar>Slider</router-link>
                            </li>
                            <li>
                                <router-link to="/form/timepicker">
                                    <avatar username="Time Picker" :size='20' color="#fff"></avatar>Time Picker</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-bar-chart"></i> <span>Charts</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                        
                            <li>
                                <router-link to="/chart/chartjs">
                                    <avatar username="Chart Line" :size='20' color="#fff"></avatar>Chart Line</router-link>
                            </li>
                            <li>
                                <router-link to="/chart-bar">
                                    <avatar username="Chart Bar" :size='20' color="#fff"></avatar>Chart Bar</router-link>
                            </li>
                            <li>
                                <router-link to="/chart-pie">
                                    <avatar username="Chart Pie" :size='20' color="#fff"></avatar>Chart Pie</router-link>
                            </li>
                            <li>
                                <router-link to="/chart/vuebar">
                                    <avatar username="Radio" :size='20' color="#fff"></avatar>Vue Bar</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-folder"></i> <span>UI Elements</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/ui/ui-editor">
                                    <avatar username="Editor" :size='20' color="#fff"></avatar> Editor</router-link>
                            </li>
                            <li>
                                <router-link to="/ui/ui-upload">
                                    <avatar username="Upload" :size='20' color="#fff"></avatar> Upload</router-link>
                            </li>
                            <li>
                                <router-link to="/UI/general">
                                    <avatar username="General" :size='20' color="#fff"></avatar> General</router-link>
                            </li>
                            <li>
                                <router-link to="/UI/icons">
                                    <avatar username="Icons" :size='20' color="#fff"></avatar> Icons</router-link>
                            </li>
                            <li>
                                <router-link to="/UI/buttons">
                                    <avatar username="Buttons" :size='20' color="#fff"></avatar> Buttons</router-link>
                            </li>
                            <li>
                                <router-link to="/UI/timeline">
                                    <avatar username="Timeline" :size='20' color="#fff"></avatar> Timeline</router-link>
                            </li>
                            <li>
                                <router-link to="/UI/modals">
                                    <avatar username="Modals" :size='20' color="#fff"></avatar> Modals</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-layout"></i> <span>Tables</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/simple-table">
                                    <avatar username="Simple Table" :size='20' color="#fff"></avatar>Simple Tables</router-link>
                            </li>
                            <li>
                                <router-link to="/select-table">
                                    <avatar username="Select Table" :size='20' color="#fff"></avatar>Select Tables</router-link>
                            </li>
                            <li>
                                <router-link to="/expandable-table">
                                    <avatar username="Expandable Table" :size='20' color="#fff"></avatar>Expandable Tables</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="ti-location-pin"></i> <span>Maps</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/gmap">
                                    <avatar username="GMaps API" :size='20' color="#fff"></avatar> GMaps API</router-link>
                            </li>
                            <li>
                                <router-link to="/open-layer">
                                    <avatar username="O P" :size='20' color="#fff"></avatar>Open Layer</router-link>
                            </li>
                            <li>
                                <router-link to="/chart/chart-map">
                                    <avatar username="Maps Vector" :size='20' color="#fff"></avatar>Maps Vector</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="header palette-Cyan-400 bg">DEVIN VUE 1.2</li>
                    <li> <a href="http://ndesaintheme.com/devin/doc"><span>Documentation</span>
                  <span class="pull-right-container">
                  <i class="fa ti-agenda pull-right version"></i>
                </span>
                    </a></li>
                    <li> <a href="#"><span>About</span>
                  <span class="pull-right-container">
                  <i class="fa ti-info-alt pull-right version"></i>
                </span>
                    </a></li>
                    <li> <a href="#"><span>Feedback</span>
                  <span class="pull-right-container">
                  <i class="version fa ti-package pull-right"></i>
                </span>
                    </a></li>
                    <li>
                        <br>
                        <br>
                        <br>
                    </li> -->
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
  mounted: function () {
    $(document).ready(function ($) {
      $('.main-sidebar > div').slimScroll({
        width: '230px',
        position: 'left',
        size: '5px',
        height: '95vh'
      })
    })
  },
  components: {
    Avatar
  }
}
</script>