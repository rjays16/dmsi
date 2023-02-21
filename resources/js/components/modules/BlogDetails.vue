<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
                                            <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Blog Details<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Blog Detail Page</li>
            </ol>
        </section>
            <!-- Main content -->
            <section class="content">
                <div class="box" style="padding:30px;">
                    <div class="row">
                        <!--  BLOG CONTENT -->
                        <div class="col-sm-8">
                            <div class="blog-list-nest">
                               <div class="vendor"> <img class="img-responsive-media" src="https://source.unsplash.com/collection/190727/1600x900" alt=""> </div>
                                <div class="blog-list-content">
                                    <h2>Favright</h2>
                                    <ul class="list-inline blog-devin-tag">
                                        <li>
                                            <a href="#"> <span class="ti-pencil"></span>&nbsp;2 Days Ago</a>
                                        </li>
                                        <li>
                                            <a href="#"> <span class="ti-comment-alt"></span>&nbsp;2 Comments</a>
                                        </li>
                                        <li>
                                            <a href="#"> <span class="ti-rss-alt"></span>&nbsp;14 Shares</a>
                                        </li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam condimentum sollicitudin mi, vitae vehicula justo venenatis at. Morbi tempor fermentum velit non pretium. Phasellus at lacus turpis. Curabitur dapibus pulvinar velit eu rutrum. Nulla adipiscing sapien orci, ac iaculis justo euismod vitae. Fusce tincidunt accumsan erat, a molestie eros auctor a. Suspendisse vel nibh vulputate, porttitor neque in, pellentesque lectus. Pellentesque aliquet diam sed placerat scelerisque. Suspendisse eleifend sem urna, eget viverra nunc interdum quis. Nam porta nunc turpis. Pellentesque ut adipiscing mi, eu facilisis turpis.</p>
                                    <p>Nunc ac erat semper, ultrices lorem eu, pretium urna. Etiam nibh nibh, laoreet id pharetra sit amet, interdum at sapien. Fusce venenatis velit in diam auctor tempus. Duis feugiat consectetur urna vel suscipit. In in lorem placerat, tempus velit ac, aliquam diam. Cras vestibulum velit posuere, elementum enim sed, imperdiet nisl. Etiam scelerisque purus tempus, fringilla dolor at, sodales nibh. Morbi molestie porta nunc, ut tincidunt ante euismod vitae. Mauris vehicula augue augue, ut placerat sapien porta vel. Curabitur laoreet odio et nibh hendrerit consequat. Quisque aliquet orci est, condimentum dignissim felis tempus eget. Morbi ac bibendum velit, eget aliquam nisi. Integer posuere consequat purus non mollis. Integer posuere vitae massa a posuere. Vivamus at lectus at elit aliquam pulvinar porta nec turpis.</p>
                                    <p>Vestibulum eu scelerisque ante, eget molestie tellus. Aenean eget sagittis massa. Fusce et ligula ultricies, venenatis leo et, posuere orci. Aenean euismod augue id orci consequat, eget lobortis ante blandit. Nulla tempus viverra mattis. Maecenas volutpat ut massa pellentesque tristique. Morbi erat enim, dapibus ornare laoreet non, auctor sit amet lorem. Integer nec lorem a risus tristique viverra. Quisque aliquam nisl eu ante pretium, vel volutpat leo tempus. Nam velit arcu, tincidunt eget viverra vitae, auctor ac neque.</p>
                                    <hr>
                                    <p class="pull-left">
                                        <el-tag type="gray">Music</el-tag>
                                        <el-tag type="gray">Video</el-tag>
                                        <el-tag type="gray">Typhography</el-tag>
                                    </p>
                                   
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div class="comment-nest">
                                <h1>Leave a Comment:</h1>
                                <el-input type="textarea" :rows="5" placeholder="Please input" v-model="textarea"> </el-input>
                                <br>
                                <br>
                                <el-button>Submit</el-button>
                                <hr>
                                <ul class="media-list">
                                    <li class="media">
                                        <a class="pull-left" href="#"> <img class="media-object img-circle" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/thumb/women/21.jpg" style="width: 64px; height: 64px;"> </a>
                                        <div class="media-body">
                                            <div class="social-profile">
                                                <h3> <a class="link-comment" href="#">Destya Susilowati</a>
                                            <span><i class="entypo-globe"></i>&nbsp;1 hours ago</span>
                                            <span><a class="link-comment" href="#"><i class="fontawesome-share"></i>&nbsp;Reply</a>
                                            </span>
                                        </h3> </div>
                                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                            <!-- Nested media object --><hr>
                                            <div class="media">
                                                <a class="pull-left" href="#"> <img class="media-object img-circle" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/thumb/men/40.jpg" style="width: 64px; height: 64px;"> </a>
                                                <div class="media-body">
                                                    <div class="social-profile">
                                                        <h3> <a class="link-comment" href="#">Awangizm</a>
                                                    <span><i class="entypo-globe"></i>&nbsp;1 hours ago</span>
                                                    <span><a class="link-comment" href="#"><i class="fontawesome-share"></i>&nbsp;Reply</a>
                                                    </span>
                                                </h3> </div>
                                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                    <!-- Nested media object --><hr>
                                                    <div class="media">
                                                        <a class="pull-left" href="#"> <img class="media-object img-circle" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/thumb/women/21.jpg" style="width: 64px; height: 64px;"> </a>
                                                        <div class="media-body">
                                                            <div class="social-profile">
                                                                <h3> <a class="link-comment" href="#">Symponia</a>
                                                            <span><i class="entypo-globe"></i>&nbsp;1 hours ago</span>
                                                            <span><a class="link-comment" href="#"><i class="fontawesome-share"></i>&nbsp;Reply</a>
                                                            </span>
                                                        </h3> </div>
                                                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Nested media object --><hr>
                                            <div class="media">
                                                <a class="pull-left" href="#"> <img class="media-object img-circle" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/thumb/men/55.jpg" style="width: 64px; height: 64px;"> </a>
                                                <div class="media-body">
                                                    <div class="social-profile">
                                                        <h3> <a class="link-comment" href="#">Agus Berontazk</a>
                                                    <span><i class="entypo-globe"></i>&nbsp;12 minute ago</span>
                                                    <span><a class="link-comment" href="#"><i class="fontawesome-share"></i>&nbsp;Reply</a>
                                                    </span>
                                                </h3> </div>
                                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <ul class="pager success">
                                <li class="previous"><a href="#">← Older</a> </li>
                                <li class="next disabled"><a href="#">Newer →</a> </li>
                            </ul>
                        </div>
                        <!--  END OF BLOG CONTENT -->
                        <!--  BLOG SIDE CONTENT -->
                        <div class="col-sm-4">
                            <div class="panel panel-default"> <img class="media-object img-circle blog-profile" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/thumb/men/10.jpg">
                                <hr style="margin:0;">
                                <div class="panel-body">
                                    <p class="lead text-center">Dave Mattew</p>
                                    <p class="tex-center social-blog-profile">
                                        <a href="#"> <span class="entypo-facebook-circled"></span> </a>
                                        <a class="tweet-link" href="#"> <span class="entypo-twitter-circled"></span> </a>
                                        <a class="gplus-textcolor" href="#"> <span class="entypo-instagrem"></span> </a>
                                    </p>
                                    <p class="social-follower text-center">A graphics designer, a web developer, a boyfriend, a friend, a son</p>
                                </div>
                            </div>
                            <div class="blog-side-nest">
                                <h4 class="text-center">JOIN NEWSLETTER</h4>
                                <p class="text-center">Sign up for our daily Newslatter</p>
                                <form role="form">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                        </div>
                                        <!-- /.col-xs-8 -->
                                        <div class="col-xs-4 col-full-width-left">
                                            <button type="submit" class="btn btn-info btn-block">Sign up</button>
                                        </div>
                                        <!-- /.col-xs-4 -->
                                    </div>
                                    <!-- /.row -->
                                </form>
                            </div>
                            <div class="blog-side-nest">
                                <h4 class="text-left">POPULAR POST</h4>
                                <hr style="margin:0">
                                <div class="media">
                                    <a class="pull-left" href="#"> <img class="media-object img-responsive-media" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/men/17.jpg"> </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">Cras sit amet nibh Lorem ipsum dolor si amet</h5> <a class="link-comment recentpost-link" style="margin:-10px 0 10px" href="#">88 Views</a> </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#"> <img class="media-object img-responsive-media" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/men/21.jpg"> </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">Cras sit amet nibh Lorem ipsum dolor si amet</h5> <a class="link-comment recentpost-link" style="margin:-10px 0 10px" href="#">90 Views</a> </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#"> <img class="media-object img-responsive-media" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/men/20.jpg"> </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">Cras sit amet nibh Lorem ipsum dolor si amet</h5> <a class="link-comment recentpost-link" style="margin:-10px 0 10px" href="#">42 Views</a> </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#"> <img class="media-object img-responsive-media" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/men/19.jpg"> </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">Cras sit amet nibh Lorem ipsum dolor si amet</h5> <a class="link-comment recentpost-link" style="margin:-10px 0 10px" href="#">111 Views</a> </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#"> <img class="media-object img-responsive-media" data-src="holder.js/64x64" alt="64x64" src="http://api.randomuser.me/portraits/men/18.jpg"> </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">Cras sit amet nibh Lorem ipsum dolor si amet</h5> <a class="link-comment recentpost-link" style="margin:-10px 0 10px" href="#">123 Views</a> </div>
                                </div>
                                <br> </div>
                            <div class="blog-side-nest">
                                <h4 class="text-left">TAG</h4>
                                <hr style="margin:0">
                                <el-tag type="gray">Admin</el-tag>
                                <el-tag type="gray">Fleet</el-tag>
                                <el-tag type="gray">Music</el-tag>
                                <el-tag type="gray">Video</el-tag>
                                <el-tag type="gray">Typhography</el-tag>
                                <el-tag type="gray">Computer</el-tag>
                                <el-tag type="gray">Web Design</el-tag>
                                <el-tag type="gray">Movie</el-tag>
                            </div>
                        </div>
                        <!--  END OF BLOG SIDE CONTENT -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'BlogDetails'
  }
</script>