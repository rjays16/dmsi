<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Profile Page<small>It's all start from here <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Apps</a></li>
                    <li class="active">Profile</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body" style="min-height:400px;">
             
                        <div class="movie-card">
                            <div class="container-movie">
                                <a href="#"><img src="http://api.randomuser.me/portraits/men/32.jpg" alt="cover" class="cover-profile" /></a>
                                <div class="hero">
                                    <div class="details-profile">
                                        <div class="title1">Dave Mattew <span>Web Designer</span></div>
                                        <div class="title2">The Battle of the Five Armies</div>
                                    </div>
                               
                                    <!-- end details -->
                                </div>
                                <!-- end hero -->
                                <div class="description-profile">
                                    <div class="column1 text-center"> <span class="tag">html5</span> <span class="tag">php</span> <span class="tag">javascript</span><span class="tag">css</span><span class="tag">photoshop</span> </div>
                                    <!-- end column1 -->
                                    <div class="column2">
                                        <p>Bilbo Baggins is swept into a quest to reclaim the lost Dwarf Kingdom of Erebor from the fearsome dragon Smaug. Approached out of the blue by the wizard Gandalf the Grey, Bilbo finds himself joining a company </p>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 emphasis">
                                                <h2>
                                        <strong>20,7K</strong>
                                    </h2>
                                                <p> <small>Followers</small> </p>
                                                <button class="btn btn-success "> <span class="fa fa-plus-circle"></span>&nbsp;&nbsp;Follow</button>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 emphasis">
                                                <h2>
                                        <strong>245</strong>
                                    </h2>
                                                <p> <small>Following</small> </p>
                                                <button class="btn btn-info "> <span class="fa fa-user"></span>&nbsp;&nbsp;View Profile</button>
                                            </div>
                                            <div class="col-sm-4 emphasis">
                                                <h2>
                                        <strong>43</strong>
                                    </h2>
                                                <p> <small>Likes</small> </p>
                                                <button class="btn btn-default"> <span class="fa fa-user"></span>&nbsp;&nbsp;Likes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end column2 -->
                                </div>
                                <!-- end description -->
                            </div>
                            <!-- end container -->
                        </div>
                        <!-- end movie-card -->
                        <div class="col-sm-12">
                            <br>
                            <br>
                            <br>
                            <div class="col-xs-12 col-sm-12 text-center">
                                <ul class="list-group">
                                    <li class="list-group-item text-center"> <span class="pull-left">
                                                <strong>Ratings</strong>
                                            </span>
                                        <div class="ratings">
                                            <a href="#"> <span class="fa fa-star"></span> </a>
                                            <a href="#"> <span class="fa fa-star"></span> </a>
                                            <a href="#"> <span class="fa fa-star"></span> </a>
                                            <a href="#"> <span class="fa fa-star"></span> </a>
                                            <a href="#"> <span class="fa fa-star-o"></span> </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item text-right"> <span class="pull-left">
                                                <strong>Joined</strong>
                                            </span>2.13.2014</li>
                                    <li class="list-group-item text-right"> <span class="pull-left">
                                                <strong>Last seen</strong>
                                            </span>Yesterday</li>
                                    <li class="list-group-item text-right"> <span class="pull-left">
                                                <strong>Nickname</strong>
                                            </span>themesmile</li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 profile-name">
                                <h2>Dave Mattew
                                        <span class="pull-right social-profile">
                                            <i class="entypo-facebook-circled"></i>  <i class="entypo-twitter-circled"></i>  <i class="entypo-linkedin-circled"></i>  <i class="entypo-github-circled"></i>  <i class="entypo-gplus-circled"></i>
                                        </span>
                                    </h2>
                                <hr>
                                <dl class="dl-horizontal-profile"> <dt>User Id</dt>
                                    <dd>eko.sulis</dd> <dt>Name</dt>
                                    <dd>Eko Sulistyo</dd> <dt>Email</dt>
                                    <dd>eko.sulistyo@yahoo.com</dd> <dt>Phone</dt>
                                    <dd>081 725 xxx</dd> <dt>Active Periode</dt>
                                    <dd>02 Dec 2014</dd> <dt>Last Update</dt>
                                    <dd>02 Apr 2014</dd> <dt>About</dt>
                                    <dd>Web Designer / UI</dd> <dt>Hobbies</dt>
                                    <dd>Read, out with friends, listen to music, draw and learn new things</dd> <dt>Skills</dt>
                                    <dd> <span class="tags">html5</span> <span class="tags">css3</span> <span class="tags">jquery</span> <span class="tags">bootstrap3</span> </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'Profile'
  }
</script>