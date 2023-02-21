<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Mail Page<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Mail Page</li>
            </ol>
        </section>
            <section class="content">
                <!-- Default box -->
                <!-- /.box -->
                <!-- Default box -->
                <div class="box">
                  
                        <div class="row">
                            <div class="col-md-3">

   
                                <div class="compose"> 
                                    <ul>
                                        <li><i class="ti-pencil-alt"></i><span>Compose</span>
                                            <li><i class="ti-import"></i>Inbox <span>(2,343)</span> </li>
                                            <li><i class="ti-new-window"></i>Sent Mail</li>
                                            <li><i class="ti-pin-alt"></i>Important</li>
                                            <li><i class="ti-zip"></i>Draft</li>
                                            <li><i class="ti-trash"></i>Trash</li>
                                    </ul>
                                    <br>
                                    <ul>
                                        <li class="text-orange"><i class="ti-control-record"></i><a href="#">Family</a> </li>
                                        <li class="text-red"><i class="ti-control-record"></i><a href="#">Friend</a> </li>
                                        <li class="text-blue"><i class="ti-control-record"></i><a href="#">Office</a> </li>
                                        <li class="text-aqua"><i class="ti-control-record"></i><a href="#">Social</a> </li>
                                        <li class="text-dark-blue"><i class="ti-control-record"></i><a href="#">Unknown</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="inbox-nest">
                                    <ul>
                                        <li>
                                            <div class="inbox-header">
                                                <ul>
                                                    <li><span class="ti-reload"></span> Refresh </li>
                                                    <li><span class="ti-export"></span> Reply </li>
                                                    <li><span class="ti-share"></span> Reply All </li>
                                                    <li><span class="ti-trash"></span> Trash </li>
                                          
                                                    <li class="right"><a href="#">1-50 of 10,976</a> </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li> <img alt="" class="img-circle star" src="http://api.randomuser.me/portraits/thumb/men/22.jpg"> <b>David L. Moore</b><i class="icon-attachment"></i><i class="text-orange fontello-record"></i><small>Today, 09:21 PM</small>
                                            <h5>Will You Be Our Valentine?</h5>
                                            <p>Hi, John i just want to know about my email that i,ve sending yesterday. Dou you read it? ... </p>
                                        </li>
                                        <li> <img alt="" class="img-circle star" src="http://api.randomuser.me/portraits/thumb/women/23.jpg"> <b>Helen D. Murray</b><i class="text-blue fontello-record"></i><small>20 Minute ago</small>
                                            <h5>World Recod</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat nunc, vestibulum eu venenatis ut, feugiat sit amet elit. Donec convallis ornare odio. Donec ac est eget lacus molestie imperdiet vitae ac nunc. Suspendisse odio justo ... </p>
                                        </li>
                                        <li>
                                            <a class="star bg-red" href="#"> <span class="fa  fa-google-plus"></span> </a> <b>Google+ (DesignByHuman)</b><i class="text-aqua fontello-record"></i><small>1 Hour Ago</small>
                                            <h5>Berbagi pos - "This #DOTD by Viviana González makes us ..</h5>
                                            <p>Donec sed mi sem. Maecenas posuere justo dapibus fermentum porttitor. Phasellus ornare lectus a neque molestie sodales. Pellentesque consectetur sed nisl vitae tempor. Duis et odio ut ligula accumsan interdum. ... </p>
                                        </li>
                                        <li> <img alt="" class="img-circle star" src="http://api.randomuser.me/portraits/thumb/women/25.jpg"> <b>Deanna G. Rumph</b><i class=" icon-attachment"></i><i class="text-red fontello-record"></i><small>Yesterday, 09:21 PM</small>
                                            <h5>A new rating has been received for Aurelo Resume</h5>
                                            <p>Etiam cursus feugiat nibh eu efficitur. Praesent lobortis imperdiet neque in tempor. Praesent eu molestie urna, nec dapibus mi. Etiam blandit convallis ligula, sodales sodales nulla scelerisque ac ... </p>
                                        </li>
                                        <li>
                                            <a class="star bg-blue" href="#"> <span class="fa  fa-twitter"></span> </a> <b>Twitter (@Themesmile)</b><i class="text-aqua fontello-record"></i><small>11 November</small>
                                            <h5>Latest tweet from Beyonce</h5>
                                            <p>Suspendisse cursus purus eget magna molestie, a finibus odio malesuada. Maecenas sodales quam a egestas maximus. Donec ultricies nibh eros, non sagittis odio convallis posuere. Nam dolor velit, tincidunt in libero vel ... </p>
                                        </li>
                                        <li>
                                            <a class="star bg-dark-blue" href="#"> <span class="fa  fa-facebook"></span> </a> <b>Facebook ( Gifta Kamilia Putri)</b><i class="text-aqua fontello-record"></i><small>10 November</small>
                                            <h5>People that may you know!</h5>
                                            <p>Fusce eros lectus, hendrerit sit amet nibh et, accumsan sollicitudin urna. Maecenas ac ex id velit imperdiet tincidunt consectetur vel neque. Morbi ornare nibh sapien, sit amet tempus risus dapibus vitae. Donec volutpat, libero sit amet faucibus placerat ... </p>
                                        </li>
                                        <li> <img alt="" class="img-circle star" src="http://api.randomuser.me/portraits/thumb/men/40.jpg"> <b>James B. Miller</b><i class="icon-attachment"></i><i class="text-orange fontello-record"></i><small>10 November</small>
                                            <h5>Will You Be Our Valentine?</h5>
                                            <p>Hi, John i just want to know about my email that i,ve sending yesterday. Dou you read it? ... </p>
                                        </li>
                                        <li> <img alt="" class="img-circle star" src="http://api.randomuser.me/portraits/thumb/men/41.jpg"> <b>John P. McCarthy</b><i class="text-blue fontello-record"></i><small>09 November</small>
                                            <h5>World Recod</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat nunc, vestibulum eu venenatis ut, feugiat sit amet elit. Donec convallis ornare odio. Donec ac est eget lacus molestie imperdiet vitae ac nunc. Suspendisse odio justo ... </p>
                                        </li>
                                        <li>
                                            <a class="star bg-yellow" href="#"> <span class="fa  fa-dribbble"></span> </a> <b>Dribbble (Matt Wulleang)</b><i class="text-aqua fontello-record"></i><small>09 November</small>
                                            <h5>Berbagi pos - "This #DOTD by Viviana González makes us ..</h5>
                                            <p>Donec sed mi sem. Maecenas posuere justo dapibus fermentum porttitor. Phasellus ornare lectus a neque molestie sodales. Pellentesque consectetur sed nisl vitae tempor. Duis et odio ut ligula accumsan interdum. ... </p>
                                        </li>
                                        <li>
                                            <div class="inbox-header">
                                                <ul>
                                                         <li><span class="ti-reload"></span> Refresh </li>
                                                    <li><span class="ti-export"></span> Reply </li>
                                                    <li><span class="ti-share"></span> Reply All </li>
                                                    <li><span class="ti-trash"></span> Trash </li>
                                          
                                                    <li class="right"><a href="#">1-50 of 10,976</a> </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
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
    name: 'Mail',
    data () {
      return {
        input: '',
        num1: 1
      }
    }
  }
</script>