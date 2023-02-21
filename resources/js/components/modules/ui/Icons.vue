<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Icons Page<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Apps</a></li>
                    <li class="active">Icons Page</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-body" style="min-height:400px;">
                        <el-tabs v-model="activeName" @tab-click="handleClick">
                            <!--Themify Icons-->
                            <el-tab-pane label="Themify Icons" name="first">
                                <div class="entypo-tooltip">
                                    <p>WEB APP ICONS</p>
                                    <ul>
                                        <li class="ti-wand"></li>
                                        <li class="ti-save "></li>
                                        <li class="ti-save-alt "></li>
                                        <li class="ti-direction "></li>
                                        <li class="ti-direction-alt "></li>
                                        <li class="ti-user "></li>
                                        <li class="ti-link "></li>
                                        <li class="ti-unlink "></li>
                                        <li class="ti-trash "></li>
                                        <li class="ti-target "></li>
                                        <li class="ti-tag "></li>
                                        <li class="ti-desktop "></li>
                                        <li class="ti-tablet "></li>
                                        <li class="ti-mobile "></li>
                                        <li class="ti-email "></li>
                                        <li class="ti-star "></li>
                                        <li class="ti-spray "></li>
                                        <li class="ti-signal "></li>
                                        <li class="ti-shopping-cart "></li>
                                        <li class="ti-shopping-cart-full "></li>
                                        <li class="ti-settings "></li>
                                        <li class="ti-search "></li>
                                        <li class="ti-zoom-in "></li>
                                        <li class="ti-zoom-out "></li>
                                        <li class="ti-cut "></li>
                                        <li class="ti-ruler "></li>
                                        <li class="ti-ruler-alt-2 "></li>
                                        <li class="ti-ruler-pencil "></li>
                                        <li class="ti-ruler-alt "></li>
                                        <li class="ti-bookmark "></li>
                                        <li class="ti-bookmark-alt "></li>
                                        <li class="ti-reload "></li>
                                        <li class="ti-plus "></li>
                                        <li class="ti-minus "></li>
                                        <li class="ti-close "></li>
                                        <li class="ti-pin "></li>
                                        <li class="ti-pencil "></li>
                                        <li class="ti-pencil-alt "></li>
                                        <li class="ti-paint-roller "></li>
                                        <li class="ti-paint-bucket "></li>
                                        <li class="ti-na "></li>
                                        <li class="ti-medall "></li>
                                        <li class="ti-medall-alt "></li>
                                        <li class="ti-marker "></li>
                                        <li class="ti-marker-alt "></li>
                                        <li class="ti-lock "></li>
                                        <li class="ti-unlock "></li>
                                        <li class="ti-location-arrow "></li>
                                        <li class="ti-layout "></li>
                                        <li class="ti-layers "></li>
                                        <li class="ti-layers-alt "></li>
                                        <li class="ti-key "></li>
                                        <li class="ti-image "></li>
                                        <li class="ti-heart "></li>
                                        <li class="ti-heart-broken "></li>
                                        <li class="ti-hand-stop "></li>
                                        <li class="ti-hand-open "></li>
                                        <li class="ti-hand-drag "></li>
                                        <li class="ti-flag "></li>
                                        <li class="ti-flag-alt "></li>
                                        <li class="ti-flag-alt-2 "></li>
                                        <li class="ti-eye "></li>
                                        <li class="ti-import "></li>
                                        <li class="ti-export "></li>
                                        <li class="ti-cup "></li>
                                        <li class="ti-crown "></li>
                                        <li class="ti-comments "></li>
                                        <li class="ti-comment "></li>
                                        <li class="ti-comment-alt "></li>
                                        <li class="ti-thought "></li>
                                        <li class="ti-clip "></li>
                                        <li class="ti-check "></li>
                                        <li class="ti-check-box "></li>
                                        <li class="ti-camera "></li>
                                        <li class="ti-announcement "></li>
                                        <li class="ti-brush "></li>
                                        <li class="ti-brush-alt "></li>
                                        <li class="ti-palette "></li>
                                        <li class="ti-briefcase "></li>
                                        <li class="ti-bolt "></li>
                                        <li class="ti-bolt-alt "></li>
                                        <li class="ti-blackboard "></li>
                                        <li class="ti-bag "></li>
                                        <li class="ti-world "></li>
                                        <li class="ti-wheelchair "></li>
                                        <li class="ti-car "></li>
                                        <li class="ti-truck "></li>
                                        <li class="ti-timer "></li>
                                        <li class="ti-ticket "></li>
                                        <li class="ti-thumb-up "></li>
                                        <li class="ti-thumb-down "></li>
                                        <li class="ti-stats-up "></li>
                                        <li class="ti-stats-down "></li>
                                        <li class="ti-shine "></li>
                                        <li class="ti-shift-right "></li>
                                        <li class="ti-shift-left "></li>
                                        <li class="ti-shift-right-alt "></li>
                                        <li class="ti-shift-left-alt "></li>
                                        <li class="ti-shield "></li>
                                        <li class="ti-notepad "></li>
                                        <li class="ti-server "></li>
                                        <li class="ti-pulse "></li>
                                        <li class="ti-printer "></li>
                                        <li class="ti-power-off "></li>
                                        <li class="ti-plug "></li>
                                        <li class="ti-pie-chart "></li>
                                        <li class="ti-panel "></li>
                                        <li class="ti-package "></li>
                                        <li class="ti-music "></li>
                                        <li class="ti-music-alt "></li>
                                        <li class="ti-mouse "></li>
                                        <li class="ti-mouse-alt "></li>
                                        <li class="ti-money "></li>
                                        <li class="ti-microphone "></li>
                                        <li class="ti-menu "></li>
                                        <li class="ti-menu-alt "></li>
                                        <li class="ti-map "></li>
                                        <li class="ti-map-alt "></li>
                                        <li class="ti-location-pin "></li>
                                        <li class="ti-light-bulb "></li>
                                        <li class="ti-info "></li>
                                        <li class="ti-infinite "></li>
                                        <li class="ti-id-badge "></li>
                                        <li class="ti-hummer "></li>
                                        <li class="ti-home "></li>
                                        <li class="ti-help "></li>
                                        <li class="ti-headphone "></li>
                                        <li class="ti-harddrives "></li>
                                        <li class="ti-harddrive "></li>
                                        <li class="ti-gift "></li>
                                        <li class="ti-game "></li>
                                        <li class="ti-filter "></li>
                                        <li class="ti-files "></li>
                                        <li class="ti-file "></li>
                                        <li class="ti-zip "></li>
                                        <li class="ti-folder "></li>
                                        <li class="ti-envelope "></li>
                                        <li class="ti-dashboard "></li>
                                        <li class="ti-cloud "></li>
                                        <li class="ti-cloud-up "></li>
                                        <li class="ti-cloud-down "></li>
                                        <li class="ti-clipboard "></li>
                                        <li class="ti-calendar "></li>
                                        <li class="ti-book "></li>
                                        <li class="ti-bell "></li>
                                        <li class="ti-basketball "></li>
                                        <li class="ti-bar-chart "></li>
                                        <li class="ti-bar-chart-alt "></li>
                                        <li class="ti-archive "></li>
                                        <li class="ti-anchor "></li>
                                        <li class="ti-alert "></li>
                                        <li class="ti-alarm-clock "></li>
                                        <li class="ti-agenda "></li>
                                        <li class="ti-write "></li>
                                        <li class="ti-wallet "></li>
                                        <li class="ti-video-clapper "></li>
                                        <li class="ti-video-camera "></li>
                                        <li class="ti-vector "></li>
                                        <li class="ti-support "></li>
                                        <li class="ti-stamp "></li>
                                        <li class="ti-slice "></li>
                                        <li class="ti-shortcode "></li>
                                        <li class="ti-receipt "></li>
                                        <li class="ti-pin2 "></li>
                                        <li class="ti-pin-alt "></li>
                                        <li class="ti-pencil-alt2 "></li>
                                        <li class="ti-eraser "></li>
                                        <li class="ti-more "></li>
                                        <li class="ti-more-alt "></li>
                                        <li class="ti-microphone-alt "></li>
                                        <li class="ti-magnet "></li>
                                        <li class="ti-line-double "></li>
                                        <li class="ti-line-dotted "></li>
                                        <li class="ti-line-dashed "></li>
                                        <li class="ti-ink-pen "></li>
                                        <li class="ti-info-alt "></li>
                                        <li class="ti-help-alt "></li>
                                        <li class="ti-headphone-alt "></li>
                                        <li class="ti-gallery "></li>
                                        <li class="ti-face-smile "></li>
                                        <li class="ti-face-sad "></li>
                                        <li class="ti-credit-card "></li>
                                        <li class="ti-comments-smiley "></li>
                                        <li class="ti-time "></li>
                                        <li class="ti-share "></li>
                                        <li class="ti-share-alt "></li>
                                        <li class="ti-rocket "></li>
                                        <li class="ti-new-window "></li>
                                        <li class="ti-rss "></li>
                                        <li class="ti-rss-alt "></li>
                                    </ul>
                                    <hr>
                                    <p>LAYOUT ICONS</p>
                                    <ul>
                                        <li class="ti-layout-width-full "></li>
                                        <li class="ti-layout-width-default "></li>
                                        <li class="ti-layout-width-default-alt "></li>
                                        <li class="ti-layout-tab "></li>
                                        <li class="ti-layout-tab-window "></li>
                                        <li class="ti-layout-tab-v "></li>
                                        <li class="ti-layout-tab-min "></li>
                                        <li class="ti-layout-slider "></li>
                                        <li class="ti-layout-slider-alt "></li>
                                        <li class="ti-layout-sidebar-right "></li>
                                        <li class="ti-layout-sidebar-none "></li>
                                        <li class="ti-layout-sidebar-left "></li>
                                        <li class="ti-layout-placeholder "></li>
                                        <li class="ti-layout-menu "></li>
                                        <li class="ti-layout-menu-v "></li>
                                        <li class="ti-layout-menu-separated "></li>
                                        <li class="ti-layout-menu-full "></li>
                                        <li class="ti-layout-media-right "></li>
                                        <li class="ti-layout-media-right-alt "></li>
                                        <li class="ti-layout-media-overlay "></li>
                                        <li class="ti-layout-media-overlay-alt "></li>
                                        <li class="ti-layout-media-overlay-alt-2 "></li>
                                        <li class="ti-layout-media-left "></li>
                                        <li class="ti-layout-media-left-alt "></li>
                                        <li class="ti-layout-media-center "></li>
                                        <li class="ti-layout-media-center-alt "></li>
                                        <li class="ti-layout-list-thumb "></li>
                                        <li class="ti-layout-list-thumb-alt "></li>
                                        <li class="ti-layout-list-post "></li>
                                        <li class="ti-layout-list-large-image "></li>
                                        <li class="ti-layout-line-solid "></li>
                                        <li class="ti-layout-grid4 "></li>
                                        <li class="ti-layout-grid3 "></li>
                                        <li class="ti-layout-grid2 "></li>
                                        <li class="ti-layout-grid2-thumb "></li>
                                        <li class="ti-layout-cta-right "></li>
                                        <li class="ti-layout-cta-left "></li>
                                        <li class="ti-layout-cta-center "></li>
                                        <li class="ti-layout-cta-btn-right "></li>
                                        <li class="ti-layout-cta-btn-left "></li>
                                        <li class="ti-layout-column4 "></li>
                                        <li class="ti-layout-column3 "></li>
                                        <li class="ti-layout-column2 "></li>
                                        <li class="ti-layout-accordion-separated "></li>
                                        <li class="ti-layout-accordion-merged "></li>
                                        <li class="ti-layout-accordion-list "></li>
                                        <li class="ti-widgetized "></li>
                                        <li class="ti-widget "></li>
                                        <li class="ti-widget-alt "></li>
                                        <li class="ti-view-list "></li>
                                        <li class="ti-view-list-alt "></li>
                                        <li class="ti-view-grid "></li>
                                        <li class="ti-upload "></li>
                                        <li class="ti-download "></li>
                                        <li class="ti-loop "></li>
                                        <li class="ti-layout-sidebar-2 "></li>
                                        <li class="ti-layout-grid4-alt "></li>
                                        <li class="ti-layout-grid3-alt "></li>
                                        <li class="ti-layout-grid2-alt "></li>
                                        <li class="ti-layout-column4-alt "></li>
                                        <li class="ti-layout-column3-alt "></li>
                                        <li class="ti-layout-column2-alt "></li>
                                    </ul>
                                    <hr>
                                    <p>BRAND ICONS</p>
                                    <ul>
                                        <li data-toggle="tooltip" title="ti-flickr" class="ti-flickr"></li>
                                        <li class="ti-flickr-alt "></li>
                                        <li class="ti-instagram "></li>
                                        <li class="ti-google "></li>
                                        <li class="ti-github "></li>
                                        <li class="ti-facebook "></li>
                                        <li class="ti-dropbox "></li>
                                        <li class="ti-dropbox-alt "></li>
                                        <li class="ti-dribbble "></li>
                                        <li class="ti-apple "></li>
                                        <li class="ti-android "></li>
                                        <li class="ti-yahoo "></li>
                                        <li class="ti-trello "></li>
                                        <li class="ti-stack-overflow "></li>
                                        <li class="ti-soundcloud "></li>
                                        <li class="ti-sharethis "></li>
                                        <li class="ti-sharethis-alt "></li>
                                        <li class="ti-reddit "></li>
                                        <li class="ti-microsoft "></li>
                                        <li class="ti-microsoft-alt "></li>
                                        <li class="ti-linux "></li>
                                        <li class="ti-jsfiddle "></li>
                                        <li class="ti-joomla "></li>
                                        <li class="ti-html5 "></li>
                                        <li class="ti-css3 "></li>
                                        <li class="ti-drupal "></li>
                                        <li class="ti-wordpress "></li>
                                        <li class="ti-tumblr "></li>
                                        <li class="ti-tumblr-alt "></li>
                                        <li class="ti-skype "></li>
                                        <li class="ti-youtube "></li>
                                        <li class="ti-vimeo "></li>
                                        <li class="ti-vimeo-alt "></li>
                                        <li class="ti-twitter "></li>
                                        <li class="ti-twitter-alt "></li>
                                        <li class="ti-linkedin "></li>
                                        <li class="ti-pinterest "></li>
                                        <li class="ti-pinterest-alt "></li>
                                        <li class="ti-themify-logo "></li>
                                        <li class="ti-themify-favicon "></li>
                                        <li class="ti-themify-favicon-alt "></li>
                                    </ul>
                                </div>
                            </el-tab-pane>
                            <!--End of Themify Icons-->
                            <el-tab-pane label="Material Icons" name="second">
                                <div class="entypo-tooltip">
                                    <p>A</p>
                                    <ul>
                                        <li><i class="material-icons">3d_rotation</i></li>
                                        <li><i class="material-icons">ac_unit</i></li>
                                        <li><i class="material-icons">access_alarm</i></li>
                                        <li><i class="material-icons">access_alarms</i></li>
                                        <li><i class="material-icons">access_time</i></li>
                                        <li><i class="material-icons">accessibility</i></li>
                                        <li><i class="material-icons">accessible</i></li>
                                        <li><i class="material-icons">account_balance</i></li>
                                        <li><i class="material-icons">account_balance_wallet</i></li>
                                        <li><i class="material-icons">account_box</i></li>
                                        <li><i class="material-icons">account_circle</i></li>
                                        <li><i class="material-icons">adb</i></li>
                                        <li><i class="material-icons">add</i></li>
                                        <li><i class="material-icons">add_a_photo</i></li>
                                        <li><i class="material-icons">add_alarm</i></li>
                                        <li><i class="material-icons">add_alert</i></li>
                                        <li><i class="material-icons">add_box</i></li>
                                        <li><i class="material-icons">add_circle</i></li>
                                        <li><i class="material-icons">add_circle_outline</i></li>
                                        <li><i class="material-icons">add_location</i></li>
                                        <li><i class="material-icons">add_shopping_cart</i></li>
                                        <li><i class="material-icons">add_to_photos</i></li>
                                        <li><i class="material-icons">add_to_queue</i></li>
                                        <li><i class="material-icons">adjust</i></li>
                                        <li><i class="material-icons">airline_seat_flat</i></li>
                                        <li><i class="material-icons">airline_seat_flat_angled</i></li>
                                        <li><i class="material-icons">airline_seat_individual_suite</i></li>
                                        <li><i class="material-icons">airline_seat_legroom_extra</i></li>
                                        <li><i class="material-icons">airline_seat_legroom_normal</i></li>
                                        <li><i class="material-icons">airline_seat_legroom_reduced</i></li>
                                        <li><i class="material-icons">airline_seat_recline_extra</i></li>
                                        <li><i class="material-icons">airline_seat_recline_normal</i></li>
                                        <li><i class="material-icons">airplanemode_active</i></li>
                                        <li><i class="material-icons">airplanemode_inactive</i></li>
                                        <li><i class="material-icons">airplay</i></li>
                                        <li><i class="material-icons">airport_shuttle</i></li>
                                        <li><i class="material-icons">alarm</i></li>
                                        <li><i class="material-icons">alarm_add</i></li>
                                        <li><i class="material-icons">alarm_off</i></li>
                                        <li><i class="material-icons">alarm_on</i></li>
                                        <li><i class="material-icons">album</i></li>
                                        <li><i class="material-icons">all_inclusive</i></li>
                                        <li><i class="material-icons">all_out</i></li>
                                        <li><i class="material-icons">android</i></li>
                                        <li><i class="material-icons">announcement</i></li>
                                        <li><i class="material-icons">apps</i></li>
                                        <li><i class="material-icons">archive</i></li>
                                        <li><i class="material-icons">arrow_back</i></li>
                                        <li><i class="material-icons">arrow_downward</i></li>
                                        <li><i class="material-icons">arrow_drop_down</i></li>
                                        <li><i class="material-icons">arrow_drop_down_circle</i></li>
                                        <li><i class="material-icons">arrow_drop_up</i></li>
                                        <li><i class="material-icons">arrow_forward</i></li>
                                        <li><i class="material-icons">arrow_upward</i></li>
                                        <li><i class="material-icons">art_track</i></li>
                                        <li><i class="material-icons">aspect_ratio</i></li>
                                        <li><i class="material-icons">assessment</i></li>
                                        <li><i class="material-icons">assignment</i></li>
                                        <li><i class="material-icons">assignment_ind</i></li>
                                        <li><i class="material-icons">assignment_late</i></li>
                                        <li><i class="material-icons">assignment_return</i></li>
                                        <li><i class="material-icons">assignment_returned</i></li>
                                        <li><i class="material-icons">assignment_turned_in</i></li>
                                        <li><i class="material-icons">assistant</i></li>
                                        <li><i class="material-icons">assistant_photo</i></li>
                                        <li><i class="material-icons">attach_file</i></li>
                                        <li><i class="material-icons">attach_money</i></li>
                                        <li><i class="material-icons">attachment</i></li>
                                        <li><i class="material-icons">audiotrack</i></li>
                                        <li><i class="material-icons">autorenew</i></li>
                                        <li><i class="material-icons">av_timer</i></li>
                                    </ul>
                                    <hr>
                                    <p>B</p>
                                    <ul>
                                        <li><i class="material-icons">backspace</i></li>
                                        <li><i class="material-icons">backup</i></li>
                                        <li><i class="material-icons">battery_alert</i></li>
                                        <li><i class="material-icons">battery_charging_full</i></li>
                                        <li><i class="material-icons">battery_full</i></li>
                                        <li><i class="material-icons">battery_std</i></li>
                                        <li><i class="material-icons">battery_unknown</i></li>
                                        <li><i class="material-icons">beach_access</i></li>
                                        <li><i class="material-icons">beenhere</i></li>
                                        <li><i class="material-icons">block</i></li>
                                        <li><i class="material-icons">bluetooth</i></li>
                                        <li><i class="material-icons">bluetooth_audio</i></li>
                                        <li><i class="material-icons">bluetooth_connected</i></li>
                                        <li><i class="material-icons">bluetooth_disabled</i></li>
                                        <li><i class="material-icons">bluetooth_searching</i></li>
                                        <li><i class="material-icons">blur_circular</i></li>
                                        <li><i class="material-icons">blur_linear</i></li>
                                        <li><i class="material-icons">blur_off</i></li>
                                        <li><i class="material-icons">blur_on</i></li>
                                        <li><i class="material-icons">book</i></li>
                                        <li><i class="material-icons">bookmark</i></li>
                                        <li><i class="material-icons">bookmark_border</i></li>
                                        <li><i class="material-icons">border_all</i></li>
                                        <li><i class="material-icons">border_bottom</i></li>
                                        <li><i class="material-icons">border_clear</i></li>
                                        <li><i class="material-icons">border_color</i></li>
                                        <li><i class="material-icons">border_horizontal</i></li>
                                        <li><i class="material-icons">border_inner</i></li>
                                        <li><i class="material-icons">border_left</i></li>
                                        <li><i class="material-icons">border_outer</i></li>
                                        <li><i class="material-icons">border_right</i></li>
                                        <li><i class="material-icons">border_style</i></li>
                                        <li><i class="material-icons">border_top</i></li>
                                        <li><i class="material-icons">border_vertical</i></li>
                                        <li><i class="material-icons">branding_watermark</i></li>
                                        <li><i class="material-icons">brightness_1</i></li>
                                        <li><i class="material-icons">brightness_2</i></li>
                                        <li><i class="material-icons">brightness_3</i></li>
                                        <li><i class="material-icons">brightness_4</i></li>
                                        <li><i class="material-icons">brightness_5</i></li>
                                        <li><i class="material-icons">brightness_6</i></li>
                                        <li><i class="material-icons">brightness_7</i></li>
                                        <li><i class="material-icons">brightness_auto</i></li>
                                        <li><i class="material-icons">brightness_high</i></li>
                                        <li><i class="material-icons">brightness_low</i></li>
                                        <li><i class="material-icons">brightness_medium</i></li>
                                        <li><i class="material-icons">broken_image</i></li>
                                        <li><i class="material-icons">brush</i></li>
                                        <li><i class="material-icons">bubble_chart</i></li>
                                        <li><i class="material-icons">bug_report</i></li>
                                        <li><i class="material-icons">build</i></li>
                                        <li><i class="material-icons">burst_mode</i></li>
                                        <li><i class="material-icons">business</i></li>
                                        <li><i class="material-icons">business_center</i></li>
                                    </ul>
                                    <hr>
                                    <p>C</p>
                                    <ul>
                                        <li><i class="material-icons">cached</i></li>
                                        <li><i class="material-icons">cake</i></li>
                                        <li><i class="material-icons">call</i></li>
                                        <li><i class="material-icons">call_end</i></li>
                                        <li><i class="material-icons">call_made</i></li>
                                        <li><i class="material-icons">call_merge</i></li>
                                        <li><i class="material-icons">call_missed</i></li>
                                        <li><i class="material-icons">call_missed_outgoing</i></li>
                                        <li><i class="material-icons">call_received</i></li>
                                        <li><i class="material-icons">call_split</i></li>
                                        <li><i class="material-icons">call_to_action</i></li>
                                        <li><i class="material-icons">camera</i></li>
                                        <li><i class="material-icons">camera_alt</i></li>
                                        <li><i class="material-icons">camera_enhance</i></li>
                                        <li><i class="material-icons">camera_front</i></li>
                                        <li><i class="material-icons">camera_rear</i></li>
                                        <li><i class="material-icons">camera_roll</i></li>
                                        <li><i class="material-icons">cancel</i></li>
                                        <li><i class="material-icons">card_giftcard</i></li>
                                        <li><i class="material-icons">card_membership</i></li>
                                        <li><i class="material-icons">card_travel</i></li>
                                        <li><i class="material-icons">casino</i></li>
                                        <li><i class="material-icons">cast</i></li>
                                        <li><i class="material-icons">cast_connected</i></li>
                                        <li><i class="material-icons">center_focus_strong</i></li>
                                        <li><i class="material-icons">center_focus_weak</i></li>
                                        <li><i class="material-icons">change_history</i></li>
                                        <li><i class="material-icons">chat</i></li>
                                        <li><i class="material-icons">chat_bubble</i></li>
                                        <li><i class="material-icons">chat_bubble_outline</i></li>
                                        <li><i class="material-icons">check</i></li>
                                        <li><i class="material-icons">check_box</i></li>
                                        <li><i class="material-icons">check_box_outline_blank</i></li>
                                        <li><i class="material-icons">check_circle</i></li>
                                        <li><i class="material-icons">chevron_left</i></li>
                                        <li><i class="material-icons">chevron_right</i></li>
                                        <li><i class="material-icons">child_care</i></li>
                                        <li><i class="material-icons">child_friendly</i></li>
                                        <li><i class="material-icons">chrome_reader_mode</i></li>
                                        <li><i class="material-icons">class</i></li>
                                        <li><i class="material-icons">clear</i></li>
                                        <li><i class="material-icons">clear_all</i></li>
                                        <li><i class="material-icons">close</i></li>
                                        <li><i class="material-icons">closed_caption</i></li>
                                        <li><i class="material-icons">cloud</i></li>
                                        <li><i class="material-icons">cloud_circle</i></li>
                                        <li><i class="material-icons">cloud_done</i></li>
                                        <li><i class="material-icons">cloud_download</i></li>
                                        <li><i class="material-icons">cloud_off</i></li>
                                        <li><i class="material-icons">cloud_queue</i></li>
                                        <li><i class="material-icons">cloud_upload</i></li>
                                        <li><i class="material-icons">code</i></li>
                                        <li><i class="material-icons">collections</i></li>
                                        <li><i class="material-icons">collections_bookmark</i></li>
                                        <li><i class="material-icons">color_lens</i></li>
                                        <li><i class="material-icons">colorize</i></li>
                                        <li><i class="material-icons">comment</i></li>
                                        <li><i class="material-icons">compare</i></li>
                                        <li><i class="material-icons">compare_arrows</i></li>
                                        <li><i class="material-icons">computer</i></li>
                                        <li><i class="material-icons">confirmation_number</i></li>
                                        <li><i class="material-icons">contact_mail</i></li>
                                        <li><i class="material-icons">contact_phone</i></li>
                                        <li><i class="material-icons">contacts</i></li>
                                        <li><i class="material-icons">content_copy</i></li>
                                        <li><i class="material-icons">content_cut</i></li>
                                        <li><i class="material-icons">content_paste</i></li>
                                        <li><i class="material-icons">control_point</i></li>
                                        <li><i class="material-icons">control_point_duplicate</i></li>
                                        <li><i class="material-icons">copyright</i></li>
                                        <li><i class="material-icons">create</i></li>
                                        <li><i class="material-icons">create_new_folder</i></li>
                                        <li><i class="material-icons">credit_card</i></li>
                                        <li><i class="material-icons">crop</i></li>
                                        <li><i class="material-icons">crop_16_9</i></li>
                                        <li><i class="material-icons">crop_3_2</i></li>
                                        <li><i class="material-icons">crop_5_4</i></li>
                                        <li><i class="material-icons">crop_7_5</i></li>
                                        <li><i class="material-icons">crop_din</i></li>
                                        <li><i class="material-icons">crop_free</i></li>
                                        <li><i class="material-icons">crop_landscape</i></li>
                                        <li><i class="material-icons">crop_original</i></li>
                                        <li><i class="material-icons">crop_portrait</i></li>
                                        <li><i class="material-icons">crop_rotate</i></li>
                                        <li><i class="material-icons">crop_square</i></li>
                                    </ul>
                                    <hr>
                                    <p>D</p>
                                    <ul>
                                        <li><i class="material-icons">dashboard</i></li>
                                        <li><i class="material-icons">data_usage</i></li>
                                        <li><i class="material-icons">date_range</i></li>
                                        <li><i class="material-icons">dehaze</i></li>
                                        <li><i class="material-icons">delete</i></li>
                                        <li><i class="material-icons">delete_forever</i></li>
                                        <li><i class="material-icons">delete_sweep</i></li>
                                        <li><i class="material-icons">description</i></li>
                                        <li><i class="material-icons">desktop_mac</i></li>
                                        <li><i class="material-icons">desktop_windows</i></li>
                                        <li><i class="material-icons">details</i></li>
                                        <li><i class="material-icons">developer_board</i></li>
                                        <li><i class="material-icons">developer_mode</i></li>
                                        <li><i class="material-icons">device_hub</i></li>
                                        <li><i class="material-icons">devices</i></li>
                                        <li><i class="material-icons">devices_other</i></li>
                                        <li><i class="material-icons">dialer_sip</i></li>
                                        <li><i class="material-icons">dialpad</i></li>
                                        <li><i class="material-icons">directions</i></li>
                                        <li><i class="material-icons">directions_bike</i></li>
                                        <li><i class="material-icons">directions_boat</i></li>
                                        <li><i class="material-icons">directions_bus</i></li>
                                        <li><i class="material-icons">directions_car</i></li>
                                        <li><i class="material-icons">directions_railway</i></li>
                                        <li><i class="material-icons">directions_run</i></li>
                                        <li><i class="material-icons">directions_subway</i></li>
                                        <li><i class="material-icons">directions_transit</i></li>
                                        <li><i class="material-icons">directions_walk</i></li>
                                        <li><i class="material-icons">disc_full</i></li>
                                        <li><i class="material-icons">dns</i></li>
                                        <li><i class="material-icons">do_not_disturb</i></li>
                                        <li><i class="material-icons">do_not_disturb_alt</i></li>
                                        <li><i class="material-icons">do_not_disturb_off</i></li>
                                        <li><i class="material-icons">do_not_disturb_on</i></li>
                                        <li><i class="material-icons">dock</i></li>
                                        <li><i class="material-icons">domain</i></li>
                                        <li><i class="material-icons">done</i></li>
                                        <li><i class="material-icons">done_all</i></li>
                                        <li><i class="material-icons">donut_large</i></li>
                                        <li><i class="material-icons">donut_small</i></li>
                                        <li><i class="material-icons">drafts</i></li>
                                        <li><i class="material-icons">drag_handle</i></li>
                                        <li><i class="material-icons">drive_eta</i></li>
                                        <li><i class="material-icons">dvr</i></li>
                                    </ul>
                                    <hr>
                                    <p>E</p>
                                    <ul>
                                        <li><i class="material-icons">edit</i></li>
                                        <li><i class="material-icons">edit_location</i></li>
                                        <li><i class="material-icons">eject</i></li>
                                        <li><i class="material-icons">email</i></li>
                                        <li><i class="material-icons">enhanced_encryption</i></li>
                                        <li><i class="material-icons">equalizer</i></li>
                                        <li><i class="material-icons">error</i></li>
                                        <li><i class="material-icons">error_outline</i></li>
                                        <li><i class="material-icons">euro_symbol</i></li>
                                        <li><i class="material-icons">ev_station</i></li>
                                        <li><i class="material-icons">event</i></li>
                                        <li><i class="material-icons">event_available</i></li>
                                        <li><i class="material-icons">event_busy</i></li>
                                        <li><i class="material-icons">event_note</i></li>
                                        <li><i class="material-icons">event_seat</i></li>
                                        <li><i class="material-icons">exit_to_app</i></li>
                                        <li><i class="material-icons">expand_less</i></li>
                                        <li><i class="material-icons">expand_more</i></li>
                                        <li><i class="material-icons">explicit</i></li>
                                        <li><i class="material-icons">explore</i></li>
                                        <li><i class="material-icons">exposure</i></li>
                                        <li><i class="material-icons">exposure_neg_1</i></li>
                                        <li><i class="material-icons">exposure_neg_2</i></li>
                                        <li><i class="material-icons">exposure_plus_1</i></li>
                                        <li><i class="material-icons">exposure_plus_2</i></li>
                                        <li><i class="material-icons">exposure_zero</i></li>
                                        <li><i class="material-icons">extension</i></li>
                                    </ul>
                                    <hr>
                                    <p>F</p>
                                    <ul>
                                        <li><i class="material-icons">face</i></li>
                                        <li><i class="material-icons">fast_forward</i></li>
                                        <li><i class="material-icons">fast_rewind</i></li>
                                        <li><i class="material-icons">favorite</i></li>
                                        <li><i class="material-icons">favorite_border</i></li>
                                        <li><i class="material-icons">featured_play_list</i></li>
                                        <li><i class="material-icons">featured_video</i></li>
                                        <li><i class="material-icons">feedback</i></li>
                                        <li><i class="material-icons">fiber_dvr</i></li>
                                        <li><i class="material-icons">fiber_manual_record</i></li>
                                        <li><i class="material-icons">fiber_new</i></li>
                                        <li><i class="material-icons">fiber_pin</i></li>
                                        <li><i class="material-icons">fiber_smart_record</i></li>
                                        <li><i class="material-icons">file_download</i></li>
                                        <li><i class="material-icons">file_upload</i></li>
                                        <li><i class="material-icons">filter</i></li>
                                        <li><i class="material-icons">filter_1</i></li>
                                        <li><i class="material-icons">filter_2</i></li>
                                        <li><i class="material-icons">filter_3</i></li>
                                        <li><i class="material-icons">filter_4</i></li>
                                        <li><i class="material-icons">filter_5</i></li>
                                        <li><i class="material-icons">filter_6</i></li>
                                        <li><i class="material-icons">filter_7</i></li>
                                        <li><i class="material-icons">filter_8</i></li>
                                        <li><i class="material-icons">filter_9</i></li>
                                        <li><i class="material-icons">filter_9_plus</i></li>
                                        <li><i class="material-icons">filter_b_and_w</i></li>
                                        <li><i class="material-icons">filter_center_focus</i></li>
                                        <li><i class="material-icons">filter_drama</i></li>
                                        <li><i class="material-icons">filter_frames</i></li>
                                        <li><i class="material-icons">filter_hdr</i></li>
                                        <li><i class="material-icons">filter_list</i></li>
                                        <li><i class="material-icons">filter_none</i></li>
                                        <li><i class="material-icons">filter_tilt_shift</i></li>
                                        <li><i class="material-icons">filter_vintage</i></li>
                                        <li><i class="material-icons">find_in_page</i></li>
                                        <li><i class="material-icons">find_replace</i></li>
                                        <li><i class="material-icons">fingerprint</i></li>
                                        <li><i class="material-icons">first_page</i></li>
                                        <li><i class="material-icons">fitness_center</i></li>
                                        <li><i class="material-icons">flag</i></li>
                                        <li><i class="material-icons">flare</i></li>
                                        <li><i class="material-icons">flash_auto</i></li>
                                        <li><i class="material-icons">flash_off</i></li>
                                        <li><i class="material-icons">flash_on</i></li>
                                        <li><i class="material-icons">flight</i></li>
                                        <li><i class="material-icons">flight_land</i></li>
                                        <li><i class="material-icons">flight_takeoff</i></li>
                                        <li><i class="material-icons">flip</i></li>
                                        <li><i class="material-icons">flip_to_back</i></li>
                                        <li><i class="material-icons">flip_to_front</i></li>
                                        <li><i class="material-icons">folder</i></li>
                                        <li><i class="material-icons">folder_open</i></li>
                                        <li><i class="material-icons">folder_shared</i></li>
                                        <li><i class="material-icons">folder_special</i></li>
                                        <li><i class="material-icons">font_download</i></li>
                                        <li><i class="material-icons">format_align_center</i></li>
                                        <li><i class="material-icons">format_align_justify</i></li>
                                        <li><i class="material-icons">format_align_left</i></li>
                                        <li><i class="material-icons">format_align_right</i></li>
                                        <li><i class="material-icons">format_bold</i></li>
                                        <li><i class="material-icons">format_clear</i></li>
                                        <li><i class="material-icons">format_color_fill</i></li>
                                        <li><i class="material-icons">format_color_reset</i></li>
                                        <li><i class="material-icons">format_color_text</i></li>
                                        <li><i class="material-icons">format_indent_decrease</i></li>
                                        <li><i class="material-icons">format_indent_increase</i></li>
                                        <li><i class="material-icons">format_italic</i></li>
                                        <li><i class="material-icons">format_line_spacing</i></li>
                                        <li><i class="material-icons">format_list_bulleted</i></li>
                                        <li><i class="material-icons">format_list_numbered</i></li>
                                        <li><i class="material-icons">format_paint</i></li>
                                        <li><i class="material-icons">format_quote</i></li>
                                        <li><i class="material-icons">format_shapes</i></li>
                                        <li><i class="material-icons">format_size</i></li>
                                        <li><i class="material-icons">format_strikethrough</i></li>
                                        <li><i class="material-icons">format_textdirection_l_to_r</i></li>
                                        <li><i class="material-icons">format_textdirection_r_to_l</i></li>
                                        <li><i class="material-icons">format_underlined</i></li>
                                        <li><i class="material-icons">forum</i></li>
                                        <li><i class="material-icons">forward</i></li>
                                        <li><i class="material-icons">forward_10</i></li>
                                        <li><i class="material-icons">forward_30</i></li>
                                        <li><i class="material-icons">forward_5</i></li>
                                        <li><i class="material-icons">free_breakfast</i></li>
                                        <li><i class="material-icons">fullscreen</i></li>
                                        <li><i class="material-icons">fullscreen_exit</i></li>
                                        <li><i class="material-icons">functions</i></li>
                                    </ul>
                                    <hr>
                                    <p>G</p>
                                    <ul>
                                        <li><i class="material-icons">g_translate</i></li>
                                        <li><i class="material-icons">gamepad</i></li>
                                        <li><i class="material-icons">games</i></li>
                                        <li><i class="material-icons">gavel</i></li>
                                        <li><i class="material-icons">gesture</i></li>
                                        <li><i class="material-icons">get_app</i></li>
                                        <li><i class="material-icons">gif</i></li>
                                        <li><i class="material-icons">golf_course</i></li>
                                        <li><i class="material-icons">gps_fixed</i></li>
                                        <li><i class="material-icons">gps_not_fixed</i></li>
                                        <li><i class="material-icons">gps_off</i></li>
                                        <li><i class="material-icons">grade</i></li>
                                        <li><i class="material-icons">gradient</i></li>
                                        <li><i class="material-icons">grain</i></li>
                                        <li><i class="material-icons">graphic_eq</i></li>
                                        <li><i class="material-icons">grid_off</i></li>
                                        <li><i class="material-icons">grid_on</i></li>
                                        <li><i class="material-icons">group</i></li>
                                        <li><i class="material-icons">group_add</i></li>
                                        <li><i class="material-icons">group_work</i></li>
                                    </ul>
                                    <hr>
                                    <p>H</p>
                                    <ul>
                                        <li><i class="material-icons">hd</i></li>
                                        <li><i class="material-icons">hdr_off</i></li>
                                        <li><i class="material-icons">hdr_on</i></li>
                                        <li><i class="material-icons">hdr_strong</i></li>
                                        <li><i class="material-icons">hdr_weak</i></li>
                                        <li><i class="material-icons">headset</i></li>
                                        <li><i class="material-icons">headset_mic</i></li>
                                        <li><i class="material-icons">healing</i></li>
                                        <li><i class="material-icons">hearing</i></li>
                                        <li><i class="material-icons">help</i></li>
                                        <li><i class="material-icons">help_outline</i></li>
                                        <li><i class="material-icons">high_quality</i></li>
                                        <li><i class="material-icons">highlight</i></li>
                                        <li><i class="material-icons">highlight_off</i></li>
                                        <li><i class="material-icons">history</i></li>
                                        <li><i class="material-icons">home</i></li>
                                        <li><i class="material-icons">hot_tub</i></li>
                                        <li><i class="material-icons">hotel</i></li>
                                        <li><i class="material-icons">hourglass_empty</i></li>
                                        <li><i class="material-icons">hourglass_full</i></li>
                                        <li><i class="material-icons">http</i></li>
                                        <li><i class="material-icons">https</i></li>
                                    </ul>
                                    <hr>
                                    <p>I</p>
                                    <ul>
                                        <li><i class="material-icons">image</i></li>
                                        <li><i class="material-icons">image_aspect_ratio</i></li>
                                        <li><i class="material-icons">import_contacts</i></li>
                                        <li><i class="material-icons">import_export</i></li>
                                        <li><i class="material-icons">important_devices</i></li>
                                        <li><i class="material-icons">inbox</i></li>
                                        <li><i class="material-icons">indeterminate_check_box</i></li>
                                        <li><i class="material-icons">info</i></li>
                                        <li><i class="material-icons">info_outline</i></li>
                                        <li><i class="material-icons">input</i></li>
                                        <li><i class="material-icons">insert_chart</i></li>
                                        <li><i class="material-icons">insert_comment</i></li>
                                        <li><i class="material-icons">insert_drive_file</i></li>
                                        <li><i class="material-icons">insert_emoticon</i></li>
                                        <li><i class="material-icons">insert_invitation</i></li>
                                        <li><i class="material-icons">insert_link</i></li>
                                        <li><i class="material-icons">insert_photo</i></li>
                                        <li><i class="material-icons">invert_colors</i></li>
                                        <li><i class="material-icons">invert_colors_off</i></li>
                                        <li><i class="material-icons">iso</i></li>
                                    </ul>
                                    <hr>
                                    <p>K</p>
                                    <ul>
                                        <li><i class="material-icons">keyboard</i></li>
                                        <li><i class="material-icons">keyboard_arrow_down</i></li>
                                        <li><i class="material-icons">keyboard_arrow_left</i></li>
                                        <li><i class="material-icons">keyboard_arrow_right</i></li>
                                        <li><i class="material-icons">keyboard_arrow_up</i></li>
                                        <li><i class="material-icons">keyboard_backspace</i></li>
                                        <li><i class="material-icons">keyboard_capslock</i></li>
                                        <li><i class="material-icons">keyboard_hide</i></li>
                                        <li><i class="material-icons">keyboard_return</i></li>
                                        <li><i class="material-icons">keyboard_tab</i></li>
                                        <li><i class="material-icons">keyboard_voice</i></li>
                                        <li><i class="material-icons">kitchen</i></li>
                                    </ul>
                                    <hr>
                                    <p>L</p>
                                    <ul>
                                        <li><i class="material-icons">label</i></li>
                                        <li><i class="material-icons">label_outline</i></li>
                                        <li><i class="material-icons">landscape</i></li>
                                        <li><i class="material-icons">language</i></li>
                                        <li><i class="material-icons">laptop</i></li>
                                        <li><i class="material-icons">laptop_chromebook</i></li>
                                        <li><i class="material-icons">laptop_mac</i></li>
                                        <li><i class="material-icons">laptop_windows</i></li>
                                        <li><i class="material-icons">last_page</i></li>
                                        <li><i class="material-icons">launch</i></li>
                                        <li><i class="material-icons">layers</i></li>
                                        <li><i class="material-icons">layers_clear</i></li>
                                        <li><i class="material-icons">leak_add</i></li>
                                        <li><i class="material-icons">leak_remove</i></li>
                                        <li><i class="material-icons">lens</i></li>
                                        <li><i class="material-icons">library_add</i></li>
                                        <li><i class="material-icons">library_books</i></li>
                                        <li><i class="material-icons">library_music</i></li>
                                        <li><i class="material-icons">lightbulb_outline</i></li>
                                        <li><i class="material-icons">line_style</i></li>
                                        <li><i class="material-icons">line_weight</i></li>
                                        <li><i class="material-icons">linear_scale</i></li>
                                        <li><i class="material-icons">link</i></li>
                                        <li><i class="material-icons">linked_camera</i></li>
                                        <li><i class="material-icons">list</i></li>
                                        <li><i class="material-icons">live_help</i></li>
                                        <li><i class="material-icons">live_tv</i></li>
                                        <li><i class="material-icons">local_activity</i></li>
                                        <li><i class="material-icons">local_airport</i></li>
                                        <li><i class="material-icons">local_atm</i></li>
                                        <li><i class="material-icons">local_bar</i></li>
                                        <li><i class="material-icons">local_cafe</i></li>
                                        <li><i class="material-icons">local_car_wash</i></li>
                                        <li><i class="material-icons">local_convenience_store</i></li>
                                        <li><i class="material-icons">local_dining</i></li>
                                        <li><i class="material-icons">local_drink</i></li>
                                        <li><i class="material-icons">local_florist</i></li>
                                        <li><i class="material-icons">local_gas_station</i></li>
                                        <li><i class="material-icons">local_grocery_store</i></li>
                                        <li><i class="material-icons">local_hospital</i></li>
                                        <li><i class="material-icons">local_hotel</i></li>
                                        <li><i class="material-icons">local_laundry_service</i></li>
                                        <li><i class="material-icons">local_library</i></li>
                                        <li><i class="material-icons">local_mall</i></li>
                                        <li><i class="material-icons">local_movies</i></li>
                                        <li><i class="material-icons">local_offer</i></li>
                                        <li><i class="material-icons">local_parking</i></li>
                                        <li><i class="material-icons">local_pharmacy</i></li>
                                        <li><i class="material-icons">local_phone</i></li>
                                        <li><i class="material-icons">local_pizza</i></li>
                                        <li><i class="material-icons">local_play</i></li>
                                        <li><i class="material-icons">local_post_office</i></li>
                                        <li><i class="material-icons">local_printshop</i></li>
                                        <li><i class="material-icons">local_see</i></li>
                                        <li><i class="material-icons">local_shipping</i></li>
                                        <li><i class="material-icons">local_taxi</i></li>
                                        <li><i class="material-icons">location_city</i></li>
                                        <li><i class="material-icons">location_disabled</i></li>
                                        <li><i class="material-icons">location_off</i></li>
                                        <li><i class="material-icons">location_on</i></li>
                                        <li><i class="material-icons">location_searching</i></li>
                                        <li><i class="material-icons">lock</i></li> >
                                        <li><i class="material-icons">lock_open</i></li>
                                        <li><i class="material-icons">lock_outline</i></li>
                                        <li><i class="material-icons">looks</i></li>
                                        <li><i class="material-icons">looks_3</i></li>
                                        <li><i class="material-icons">looks_4</i></li>
                                        <li><i class="material-icons">looks_5</i></li>
                                        <li><i class="material-icons">looks_6</i></li>
                                        <li><i class="material-icons">looks_one</i></li>
                                        <li><i class="material-icons">looks_two</i></li>
                                        <li><i class="material-icons">loop</i></li>
                                        <li><i class="material-icons">loupe</i></li>
                                        <li><i class="material-icons">low_priority</i></li>
                                        <li><i class="material-icons">loyalty</i></li>
                                    </ul>
                                    <hr>
                                    <p>M</p>
                                    <ul>
                                        <li><i class="material-icons">mail</i></li>
                                        <li><i class="material-icons">mail_outline</i></li>
                                        <li><i class="material-icons">map</i></li>
                                        <li><i class="material-icons">markunread</i></li>
                                        <li><i class="material-icons">markunread_mailbox</i></li>
                                        <li><i class="material-icons">memory</i></li>
                                        <li><i class="material-icons">menu</i></li>
                                        <li><i class="material-icons">merge_type</i></li>
                                        <li><i class="material-icons">message</i></li>
                                        <li><i class="material-icons">mic</i></li>
                                        <li><i class="material-icons">mic_none</i></li>
                                        <li><i class="material-icons">mic_off</i></li>
                                        <li><i class="material-icons">mms</i></li>
                                        <li><i class="material-icons">mode_comment</i></li>
                                        <li><i class="material-icons">mode_edit</i></li>
                                        <li><i class="material-icons">monetization_on</i></li>
                                        <li><i class="material-icons">money_off</i></li>
                                        <li><i class="material-icons">monochrome_photos</i></li>
                                        <li><i class="material-icons">mood</i></li>
                                        <li><i class="material-icons">mood_bad</i></li>
                                        <li><i class="material-icons">more</i></li>
                                        <li><i class="material-icons">more_horiz</i></li>
                                        <li><i class="material-icons">more_vert</i></li>
                                        <li><i class="material-icons">motorcycle</i></li>
                                        <li><i class="material-icons">mouse</i></li>
                                        <li><i class="material-icons">move_to_inbox</i></li>
                                        <li><i class="material-icons">movie</i></li>
                                        <li><i class="material-icons">movie_creation</i></li>
                                        <li><i class="material-icons">movie_filter</i></li>
                                        <li><i class="material-icons">multiline_chart</i></li>
                                        <li><i class="material-icons">music_note</i></li>
                                        <li><i class="material-icons">music_video</i></li>
                                        <li><i class="material-icons">my_location</i></li>
                                    </ul>
                                    <hr>
                                    <p>N</p>
                                    <ul>
                                        <li><i class="material-icons">nature</i></li>
                                        <li><i class="material-icons">nature_people</i></li>
                                        <li><i class="material-icons">navigate_before</i></li>
                                        <li><i class="material-icons">navigate_next</i></li>
                                        <li><i class="material-icons">navigation</i></li>
                                        <li><i class="material-icons">near_me</i></li>
                                        <li><i class="material-icons">network_cell</i></li>
                                        <li><i class="material-icons">network_check</i></li>
                                        <li><i class="material-icons">network_locked</i></li>
                                        <li><i class="material-icons">network_wifi</i></li>
                                        <li><i class="material-icons">new_releases</i></li>
                                        <li><i class="material-icons">next_week</i></li>
                                        <li><i class="material-icons">nfc</i></li>
                                        <li><i class="material-icons">no_encryption</i></li>
                                        <li><i class="material-icons">no_sim</i></li>
                                        <li><i class="material-icons">not_interested</i></li>
                                        <li><i class="material-icons">note</i></li>
                                        <li><i class="material-icons">note_add</i></li>
                                        <li><i class="material-icons">notifications</i></li>
                                        <li><i class="material-icons">notifications_active</i></li>
                                        <li><i class="material-icons">notifications_none</i></li>
                                        <li><i class="material-icons">notifications_off</i></li>
                                        <li><i class="material-icons">notifications_paused</i></li>
                                    </ul>
                                    <hr>
                                    <p>o</p>
                                    <ul>
                                        <li><i class="material-icons">offline_pin</i></li>
                                        <li><i class="material-icons">ondemand_video</i></li>
                                        <li><i class="material-icons">opacity</i></li>
                                        <li><i class="material-icons">open_in_browser</i></li>
                                        <li><i class="material-icons">open_in_new</i></li>
                                        <li><i class="material-icons">open_with</i></li>
                                    </ul>
                                    <hr>
                                    <p>P</p>
                                    <ul>
                                        <li><i class="material-icons">pages</i></li>
                                        <li><i class="material-icons">pageview</i></li>
                                        <li><i class="material-icons">palette</i></li>
                                        <li><i class="material-icons">pan_tool</i></li>
                                        <li><i class="material-icons">panorama</i></li>
                                        <li><i class="material-icons">panorama_fish_eye</i></li>
                                        <li><i class="material-icons">panorama_horizontal</i></li>
                                        <li><i class="material-icons">panorama_vertical</i></li>
                                        <li><i class="material-icons">panorama_wide_angle</i></li>
                                        <li><i class="material-icons">party_mode</i></li>
                                        <li><i class="material-icons">pause</i></li>
                                        <li><i class="material-icons">pause_circle_filled</i></li>
                                        <li><i class="material-icons">pause_circle_outline</i></li>
                                        <li><i class="material-icons">payment</i></li>
                                        <li><i class="material-icons">people</i></li>
                                        <li><i class="material-icons">people_outline</i></li>
                                        <li><i class="material-icons">perm_camera_mic</i></li>
                                        <li><i class="material-icons">perm_contact_calendar</i></li>
                                        <li><i class="material-icons">perm_data_setting</i></li>
                                        <li><i class="material-icons">perm_device_information</i></li>
                                        <li><i class="material-icons">perm_identity</i></li>
                                        <li><i class="material-icons">perm_media</i></li>
                                        <li><i class="material-icons">perm_phone_msg</i></li>
                                        <li><i class="material-icons">perm_scan_wifi</i></li>
                                        <li><i class="material-icons">person</i></li>
                                        <li><i class="material-icons">person_add</i></li>
                                        <li><i class="material-icons">person_outline</i></li>
                                        <li><i class="material-icons">person_pin</i></li>
                                        <li><i class="material-icons">person_pin_circle</i></li>
                                        <li><i class="material-icons">personal_video</i></li>
                                        <li><i class="material-icons">pets</i></li>
                                        <li><i class="material-icons">phone</i></li>
                                        <li><i class="material-icons">phone_android</i></li>
                                        <li><i class="material-icons">phone_bluetooth_speaker</i></li>
                                        <li><i class="material-icons">phone_forwarded</i></li>
                                        <li><i class="material-icons">phone_in_talk</i></li>
                                        <li><i class="material-icons">phone_iphone</i></li>
                                        <li><i class="material-icons">phone_locked</i></li>
                                        <li><i class="material-icons">phone_missed</i></li>
                                        <li><i class="material-icons">phone_paused</i></li>
                                        <li><i class="material-icons">phonelink</i></li>
                                        <li><i class="material-icons">phonelink_erase</i></li>
                                        <li><i class="material-icons">phonelink_lock</i></li>
                                        <li><i class="material-icons">phonelink_off</i></li>
                                        <li><i class="material-icons">phonelink_ring</i></li>
                                        <li><i class="material-icons">phonelink_setup</i></li>
                                        <li><i class="material-icons">photo</i></li>
                                        <li><i class="material-icons">photo_album</i></li>
                                        <li><i class="material-icons">photo_camera</i></li>
                                        <li><i class="material-icons">photo_filter</i></li>
                                        <li><i class="material-icons">photo_library</i></li>
                                        <li><i class="material-icons">photo_size_select_actual</i></li>
                                        <li><i class="material-icons">photo_size_select_large</i></li>
                                        <li><i class="material-icons">photo_size_select_small</i></li>
                                        <li><i class="material-icons">picture_as_pdf</i></li>
                                        <li><i class="material-icons">picture_in_picture</i></li>
                                        <li><i class="material-icons">picture_in_picture_alt</i></li>
                                        <li><i class="material-icons">pie_chart</i></li>
                                        <li><i class="material-icons">pie_chart_outlined</i></li>
                                        <li><i class="material-icons">pin_drop</i></li>
                                        <li><i class="material-icons">place</i></li>
                                        <li><i class="material-icons">play_arrow</i></li>
                                        <li><i class="material-icons">play_circle_filled</i></li>
                                        <li><i class="material-icons">play_circle_outline</i></li>
                                        <li><i class="material-icons">play_for_work</i></li>
                                        <li><i class="material-icons">playlist_add</i></li>
                                        <li><i class="material-icons">playlist_add_check</i></li>
                                        <li><i class="material-icons">playlist_play</i></li>
                                        <li><i class="material-icons">plus_one</i></li>
                                        <li><i class="material-icons">poll</i></li>
                                        <li><i class="material-icons">polymer</i></li>
                                        <li><i class="material-icons">pool</i></li>
                                        <li><i class="material-icons">portable_wifi_off</i></li>
                                        <li><i class="material-icons">portrait</i></li>
                                        <li><i class="material-icons">power</i></li>
                                        <li><i class="material-icons">power_input</i></li>
                                        <li><i class="material-icons">power_settings_new</i></li>
                                        <li><i class="material-icons">pregnant_woman</i></li>
                                        <li><i class="material-icons">present_to_all</i></li>
                                        <li><i class="material-icons">print</i></li>
                                        <li><i class="material-icons">priority_high</i></li>
                                        <li><i class="material-icons">public</i></li>
                                        <li><i class="material-icons">publish</i></li>
                                    </ul>
                                    <hr>
                                    <p>Q -R</p>
                                    <ul>
                                        <li><i class="material-icons">query_builder</i></li>
                                        <li><i class="material-icons">question_answer</i></li>
                                        <li><i class="material-icons">queue</i></li>
                                        <li><i class="material-icons">queue_music</i></li>
                                        <li><i class="material-icons">queue_play_next</i></li>
                                        <li><i class="material-icons">radio</i></li>
                                        <li><i class="material-icons">radio_button_checked</i></li>
                                        <li><i class="material-icons">radio_button_unchecked</i></li>
                                        <li><i class="material-icons">rate_review</i></li>
                                        <li><i class="material-icons">receipt</i></li>
                                        <li><i class="material-icons">recent_actors</i></li>
                                        <li><i class="material-icons">record_voice_over</i></li>
                                        <li><i class="material-icons">redeem</i></li>
                                        <li><i class="material-icons">redo</i></li>
                                        <li><i class="material-icons">refresh</i></li>
                                        <li><i class="material-icons">remove</i></li>
                                        <li><i class="material-icons">remove_circle</i></li>
                                        <li><i class="material-icons">remove_circle_outline</i></li>
                                        <li><i class="material-icons">remove_from_queue</i></li>
                                        <li><i class="material-icons">remove_red_eye</i></li>
                                        <li><i class="material-icons">remove_shopping_cart</i></li>
                                        <li><i class="material-icons">reorder</i></li>
                                        <li><i class="material-icons">repeat</i></li>
                                        <li><i class="material-icons">repeat_one</i></li>
                                        <li><i class="material-icons">replay</i></li>
                                        <li><i class="material-icons">replay_10</i></li>
                                        <li><i class="material-icons">replay_30</i></li>
                                        <li><i class="material-icons">replay_5</i></li>
                                        <li><i class="material-icons">reply</i></li>
                                        <li><i class="material-icons">reply_all</i></li>
                                        <li><i class="material-icons">report</i></li>
                                        <li><i class="material-icons">report_problem</i></li>
                                        <li><i class="material-icons">restaurant</i></li>
                                        <li><i class="material-icons">restaurant_menu</i></li>
                                        <li><i class="material-icons">restore</i></li>
                                        <li><i class="material-icons">restore_page</i></li>
                                        <li><i class="material-icons">ring_volume</i></li>
                                        <li><i class="material-icons">room</i></li>
                                        <li><i class="material-icons">room_service</i></li>
                                        <li><i class="material-icons">rotate_90_degrees_ccw</i></li>
                                        <li><i class="material-icons">rotate_left</i></li>
                                        <li><i class="material-icons">rotate_right</i></li>
                                        <li><i class="material-icons">rounded_corner</i></li>
                                        <li><i class="material-icons">router</i></li>
                                        <li><i class="material-icons">rowing</i></li>
                                        <li><i class="material-icons">rss_feed</i></li>
                                        <li><i class="material-icons">rv_hookup</i></li>
                                    </ul>
                                    <hr>
                                    <p>S </p>
                                    <ul>
                                        <li><i class="material-icons">satellite</i></li>
                                        <li><i class="material-icons">save</i></li>
                                        <li><i class="material-icons">scanner</i></li>
                                        <li><i class="material-icons">schedule</i></li>
                                        <li><i class="material-icons">school</i></li>
                                        <li><i class="material-icons">screen_lock_landscape</i></li>
                                        <li><i class="material-icons">screen_lock_portrait</i></li>
                                        <li><i class="material-icons">screen_lock_rotation</i></li>
                                        <li><i class="material-icons">screen_rotation</i></li>
                                        <li><i class="material-icons">screen_share</i></li>
                                        <li><i class="material-icons">sd_card</i></li>
                                        <li><i class="material-icons">sd_storage</i></li>
                                        <li><i class="material-icons">search</i></li>
                                        <li><i class="material-icons">security</i></li>
                                        <li><i class="material-icons">select_all</i></li>
                                        <li><i class="material-icons">send</i></li>
                                        <li><i class="material-icons">sentiment_dissatisfied</i></li>
                                        <li><i class="material-icons">sentiment_neutral</i></li>
                                        <li><i class="material-icons">sentiment_satisfied</i></li>
                                        <li><i class="material-icons">sentiment_very_dissatisfied</i></li>
                                        <li><i class="material-icons">sentiment_very_satisfied</i></li>
                                        <li><i class="material-icons">settings</i></li>
                                        <li><i class="material-icons">settings_applications</i></li>
                                        <li><i class="material-icons">settings_backup_restore</i></li>
                                        <li><i class="material-icons">settings_bluetooth</i></li>
                                        <li><i class="material-icons">settings_brightness</i></li>
                                        <li><i class="material-icons">settings_cell</i></li>
                                        <li><i class="material-icons">settings_ethernet</i></li>
                                        <li><i class="material-icons">settings_input_antenna</i></li>
                                        <li><i class="material-icons">settings_input_component</i></li>
                                        <li><i class="material-icons">settings_input_composite</i></li>
                                        <li><i class="material-icons">settings_input_hdmi</i></li>
                                        <li><i class="material-icons">settings_input_svideo</i></li>
                                        <li><i class="material-icons">settings_overscan</i></li>
                                        <li><i class="material-icons">settings_phone</i></li>
                                        <li><i class="material-icons">settings_power</i></li>
                                        <li><i class="material-icons">settings_remote</i></li>
                                        <li><i class="material-icons">settings_system_daydream</i></li>
                                        <li><i class="material-icons">settings_voice</i></li>
                                        <li><i class="material-icons">share</i></li>
                                        <li><i class="material-icons">shop</i></li>
                                        <li><i class="material-icons">shop_two</i></li>
                                        <li><i class="material-icons">shopping_basket</i></li>
                                        <li><i class="material-icons">shopping_cart</i></li>
                                        <li><i class="material-icons">short_text</i></li>
                                        <li><i class="material-icons">show_chart</i></li>
                                        <li><i class="material-icons">shuffle</i></li>
                                        <li><i class="material-icons">signal_cellular_4_bar</i></li>
                                        <li><i class="material-icons">signal_cellular_connected_no_internet_4_bar</i></li>
                                        <li><i class="material-icons">signal_cellular_no_sim</i></li>
                                        <li><i class="material-icons">signal_cellular_null</i></li>
                                        <li><i class="material-icons">signal_cellular_off</i></li>
                                        <li><i class="material-icons">signal_wifi_4_bar</i></li>
                                        <li><i class="material-icons">signal_wifi_4_bar_lock</i></li>
                                        <li><i class="material-icons">signal_wifi_off</i></li>
                                        <li><i class="material-icons">sim_card</i></li>
                                        <li><i class="material-icons">sim_card_alert</i></li>
                                        <li><i class="material-icons">skip_next</i></li>
                                        <li><i class="material-icons">skip_previous</i></li>
                                        <li><i class="material-icons">slideshow</i></li>
                                        <li><i class="material-icons">slow_motion_video</i></li>
                                        <li><i class="material-icons">smartphone</i></li>
                                        <li><i class="material-icons">smoke_free</i></li>
                                        <li><i class="material-icons">smoking_rooms</i></li>
                                        <li><i class="material-icons">sms</i></li>
                                        <li><i class="material-icons">sms_failed</i></li>
                                        <li><i class="material-icons">snooze</i></li>
                                        <li><i class="material-icons">sort</i></li>
                                        <li><i class="material-icons">sort_by_alpha</i></li>
                                        <li><i class="material-icons">spa</i></li>
                                        <li><i class="material-icons">space_bar</i></li>
                                        <li><i class="material-icons">speaker</i></li>
                                        <li><i class="material-icons">speaker_group</i></li>
                                        <li><i class="material-icons">speaker_notes</i></li>
                                        <li><i class="material-icons">speaker_notes_off</i></li>
                                        <li><i class="material-icons">speaker_phone</i></li>
                                        <li><i class="material-icons">spellcheck</i></li>
                                        <li><i class="material-icons">star</i></li>
                                        <li><i class="material-icons">star_border</i></li>
                                        <li><i class="material-icons">star_half</i></li>
                                        <li><i class="material-icons">stars</i></li>
                                        <li><i class="material-icons">stay_current_landscape</i></li>
                                        <li><i class="material-icons">stay_current_portrait</i></li>
                                        <li><i class="material-icons">stay_primary_landscape</i></li>
                                        <li><i class="material-icons">stay_primary_portrait</i></li>
                                        <li><i class="material-icons">stop</i></li>
                                        <li><i class="material-icons">stop_screen_share</i></li>
                                        <li><i class="material-icons">storage</i></li>
                                        <li><i class="material-icons">store</i></li>
                                        <li><i class="material-icons">store_mall_directory</i></li>
                                        <li><i class="material-icons">straighten</i></li>
                                        <li><i class="material-icons">streetview</i></li>
                                        <li><i class="material-icons">strikethrough_s</i></li>
                                        <li><i class="material-icons">style</i></li>
                                        <li><i class="material-icons">subdirectory_arrow_left</i></li>
                                        <li><i class="material-icons">subdirectory_arrow_right</i></li>
                                        <li><i class="material-icons">subject</i></li>
                                        <li><i class="material-icons">subscriptions</i></li>
                                        <li><i class="material-icons">subtitles</i></li>
                                        <li><i class="material-icons">subway</i></li>
                                        <li><i class="material-icons">supervisor_account</i></li>
                                        <li><i class="material-icons">surround_sound</i></li>
                                        <li><i class="material-icons">swap_calls</i></li>
                                        <li><i class="material-icons">swap_horiz</i></li>
                                        <li><i class="material-icons">swap_vert</i></li>
                                        <li><i class="material-icons">swap_vertical_circle</i></li>
                                        <li><i class="material-icons">switch_camera</i></li>
                                        <li><i class="material-icons">switch_video</i></li>
                                        <li><i class="material-icons">sync</i></li>
                                        <li><i class="material-icons">sync_disabled</i></li>
                                        <li><i class="material-icons">sync_problem</i></li>
                                        <li><i class="material-icons">system_update</i></li>
                                        <li><i class="material-icons">system_update_alt</i></li>
                                    </ul>
                                    <hr>
                                    <p>T - Z</p>
                                    <ul>
                                        <li><i class="material-icons">tab</i></li>
                                        <li><i class="material-icons">tab_unselected</i></li>
                                        <li><i class="material-icons">tablet</i></li>
                                        <li><i class="material-icons">tablet_android</i></li>
                                        <li><i class="material-icons">tablet_mac</i></li>
                                        <li><i class="material-icons">tag_faces</i></li>
                                        <li><i class="material-icons">tap_and_play</i></li>
                                        <li><i class="material-icons">terrain</i></li>
                                        <li><i class="material-icons">text_fields</i></li>
                                        <li><i class="material-icons">text_format</i></li>
                                        <li><i class="material-icons">textsms</i></li>
                                        <li><i class="material-icons">texture</i></li>
                                        <li><i class="material-icons">theaters</i></li>
                                        <li><i class="material-icons">thumb_down</i></li>
                                        <li><i class="material-icons">thumb_up</i></li>
                                        <li><i class="material-icons">thumbs_up_down</i></li>
                                        <li><i class="material-icons">time_to_leave</i></li>
                                        <li><i class="material-icons">timelapse</i></li>
                                        <li><i class="material-icons">timeline</i></li>
                                        <li><i class="material-icons">timer</i></li>
                                        <li><i class="material-icons">timer_10</i></li>
                                        <li><i class="material-icons">timer_3</i></li>
                                        <li><i class="material-icons">timer_off</i></li>
                                        <li><i class="material-icons">title</i></li>
                                        <li><i class="material-icons">toc</i></li>
                                        <li><i class="material-icons">today</i></li>
                                        <li><i class="material-icons">toll</i></li>
                                        <li><i class="material-icons">tonality</i></li>
                                        <li><i class="material-icons">touch_app</i></li>
                                        <li><i class="material-icons">toys</i></li>
                                        <li><i class="material-icons">track_changes</i></li>
                                        <li><i class="material-icons">traffic</i></li>
                                        <li><i class="material-icons">train</i></li>
                                        <li><i class="material-icons">tram</i></li>
                                        <li><i class="material-icons">transfer_within_a_station</i></li>
                                        <li><i class="material-icons">transform</i></li>
                                        <li><i class="material-icons">translate</i></li>
                                        <li><i class="material-icons">trending_down</i></li>
                                        <li><i class="material-icons">trending_flat</i></li>
                                        <li><i class="material-icons">trending_up</i></li>
                                        <li><i class="material-icons">tune</i></li>
                                        <li><i class="material-icons">turned_in</i></li>
                                        <li><i class="material-icons">turned_in_not</i></li>
                                        <li><i class="material-icons">tv</i></li>
                                        <li><i class="material-icons">unarchive</i></li>
                                        <li><i class="material-icons">undo</i></li>
                                        <li><i class="material-icons">unfold_less</i></li>
                                        <li><i class="material-icons">unfold_more</i></li>
                                        <li><i class="material-icons">update</i></li>
                                        <li><i class="material-icons">usb</i></li>
                                        <li><i class="material-icons">verified_user</i></li>
                                        <li><i class="material-icons">vertical_align_bottom</i></li>
                                        <li><i class="material-icons">vertical_align_center</i></li>
                                        <li><i class="material-icons">vertical_align_top</i></li>
                                        <li><i class="material-icons">vibration</i></li>
                                        <li><i class="material-icons">video_call</i></li>
                                        <li><i class="material-icons">video_label</i></li>
                                        <li><i class="material-icons">video_library</i></li>
                                        <li><i class="material-icons">videocam</i></li>
                                        <li><i class="material-icons">videocam_off</i></li>
                                        <li><i class="material-icons">videogame_asset</i></li>
                                        <li><i class="material-icons">view_agenda</i></li>
                                        <li><i class="material-icons">view_array</i></li>
                                        <li><i class="material-icons">view_carousel</i></li>
                                        <li><i class="material-icons">view_column</i></li>
                                        <li><i class="material-icons">view_comfy</i></li>
                                        <li><i class="material-icons">view_compact</i></li>
                                        <li><i class="material-icons">view_day</i></li>
                                        <li><i class="material-icons">view_headline</i></li>
                                        <li><i class="material-icons">view_list</i></li>
                                        <li><i class="material-icons">view_module</i></li>
                                        <li><i class="material-icons">view_quilt</i></li>
                                        <li><i class="material-icons">view_stream</i></li>
                                        <li><i class="material-icons">view_week</i></li>
                                        <li><i class="material-icons">vignette</i></li>
                                        <li><i class="material-icons">visibility</i></li>
                                        <li><i class="material-icons">visibility_off</i></li>
                                        <li><i class="material-icons">voice_chat</i></li>
                                        <li><i class="material-icons">voicemail</i></li>
                                        <li><i class="material-icons">volume_down</i></li>
                                        <li><i class="material-icons">volume_mute</i></li>
                                        <li><i class="material-icons">volume_off</i></li>
                                        <li><i class="material-icons">volume_up</i></li>
                                        <li><i class="material-icons">vpn_key</i></li>
                                        <li><i class="material-icons">vpn_lock</i></li>
                                        <li><i class="material-icons">wallpaper</i></li>
                                        <li><i class="material-icons">warning</i></li>
                                        <li><i class="material-icons">watch</i></li>
                                        <li><i class="material-icons">watch_later</i></li>
                                        <li><i class="material-icons">wb_auto</i></li>
                                        <li><i class="material-icons">wb_cloudy</i></li>
                                        <li><i class="material-icons">wb_incandescent</i></li>
                                        <li><i class="material-icons">wb_iridescent</i></li>
                                        <li><i class="material-icons">wb_sunny</i></li>
                                        <li><i class="material-icons">wc</i></li>
                                        <li><i class="material-icons">web</i></li>
                                        <li><i class="material-icons">web_asset</i></li>
                                        <li><i class="material-icons">weekend</i></li>
                                        <li><i class="material-icons">whatshot</i></li>
                                        <li><i class="material-icons">widgets</i></li>
                                        <li><i class="material-icons">wifi</i></li>
                                        <li><i class="material-icons">wifi_lock</i></li>
                                        <li><i class="material-icons">wifi_tethering</i></li>
                                        <li><i class="material-icons">work</i></li>
                                        <li><i class="material-icons">wrap_text</i></li>
                                        <li><i class="material-icons">youtube_searched_for</i></li>
                                        <li><i class="material-icons">zoom_in</i></li>
                                        <li><i class="material-icons">zoom_out</i></li>
                                        <li><i class="material-icons">zoom_out_map</i></li>
                                    </ul>
                                </div>
                            </el-tab-pane>
                            <el-tab-pane label="Drip Icons 2.0" name="third">
                                <div class="entypo-tooltip">
                                    <p>WEB APP ICONS</p>
                                    <ul>
    <li class="dripicons-alarm" v-tooltip.top="'alarm'"> </li>
    <li class="dripicons-align-center" v-tooltip.top="'align-center'"> </li>
    <li class="dripicons-align-justify" v-tooltip.top="'align-justify'"> </li>
    <li class="dripicons-align-left" v-tooltip.top="'align-left'"> </li>
    <li class="dripicons-align-right" v-tooltip.top="'align-right'"> </li>
    <li class="dripicons-anchor" v-tooltip.top="'anchor'"> </li>
    <li class="dripicons-archive" v-tooltip.top="'archive'"> </li>
    <li class="dripicons-arrow-down" v-tooltip.top="'arrow-down'"> </li>
    <li class="dripicons-arrow-left" v-tooltip.top="'arrow-left'"> </li>
    <li class="dripicons-arrow-right" v-tooltip.top="'arrow-right'"> </li>
    <li class="dripicons-arrow-thin-down" v-tooltip.top="'arrow-thin-down'"> </li>
    <li class="dripicons-arrow-thin-left" v-tooltip.top="'arrow-thin-left'"> </li>
    <li class="dripicons-arrow-thin-right" v-tooltip.top="'arrow-thin-right'"> </li>
    <li class="dripicons-arrow-thin-up" v-tooltip.top="'arrow-thin-up'"> </li>
    <li class="dripicons-arrow-up" v-tooltip.top="'arrow-up'"> </li>
    <li class="dripicons-article" v-tooltip.top="'article'"> </li>
    <li class="dripicons-backspace" v-tooltip.top="'backspace'"> </li>
    <li class="dripicons-basket" v-tooltip.top="'basket'"> </li>
    <li class="dripicons-basketball" v-tooltip.top="'basketball'"> </li>
    <li class="dripicons-battery-empty" v-tooltip.top="'battery-empty'"> </li>
    <li class="dripicons-battery-full" v-tooltip.top="'battery-full'"> </li>
    <li class="dripicons-battery-low" v-tooltip.top="'battery-low'"> </li>
    <li class="dripicons-battery-medium" v-tooltip.top="'battery-medium'"> </li>
    <li class="dripicons-bell" v-tooltip.top="'bell'"> </li>
    <li class="dripicons-blog" v-tooltip.top="'blog'"> </li>
    <li class="dripicons-bluetooth" v-tooltip.top="'bluetooth'"> </li>
    <li class="dripicons-bold" v-tooltip.top="'bold'"> </li>
    <li class="dripicons-bookmark" v-tooltip.top="'bookmark'"> </li>
    <li class="dripicons-bookmarks" v-tooltip.top="'bookmarks'"> </li>
    <li class="dripicons-box" v-tooltip.top="'box'"> </li>
    <li class="dripicons-briefcase" v-tooltip.top="'briefcase'"> </li>
    <li class="dripicons-brightness-low" v-tooltip.top="'brightness-low'"> </li>
    <li class="dripicons-brightness-max" v-tooltip.top="'brightness-max'"> </li>
    <li class="dripicons-brightness-medium" v-tooltip.top="'brightness-medium'"> </li>
    <li class="dripicons-broadcast" v-tooltip.top="'broadcast'"> </li>
    <li class="dripicons-browser" v-tooltip.top="'browser'"> </li>
    <li class="dripicons-browser-upload" v-tooltip.top="'browser-upload'"> </li>
    <li class="dripicons-brush" v-tooltip.top="'brush'"> </li>
    <li class="dripicons-calendar" v-tooltip.top="'calendar'"> </li>
    <li class="dripicons-camcorder" v-tooltip.top="'camcorder'"> </li>
    <li class="dripicons-camera" v-tooltip.top="'camera'"> </li>
    <li class="dripicons-card" v-tooltip.top="'card'"> </li>
    <li class="dripicons-cart" v-tooltip.top="'cart'"> </li>
    <li class="dripicons-checklist" v-tooltip.top="'checklist'"> </li>
    <li class="dripicons-checkmark" v-tooltip.top="'checkmark'"> </li>
    <li class="dripicons-chevron-down" v-tooltip.top="'chevron-down'"> </li>
    <li class="dripicons-chevron-left" v-tooltip.top="'chevron-left'"> </li>
    <li class="dripicons-chevron-right" v-tooltip.top="'chevron-right'"> </li>
    <li class="dripicons-chevron-up" v-tooltip.top="'chevron-up'"> </li>
    <li class="dripicons-clipboard" v-tooltip.top="'clipboard'"> </li>
    <li class="dripicons-clock" v-tooltip.top="'clock'"> </li>
    <li class="dripicons-clockwise" v-tooltip.top="'clockwise'"> </li>
    <li class="dripicons-cloud" v-tooltip.top="'cloud'"> </li>
    <li class="dripicons-cloud-download" v-tooltip.top="'cloud-download'"> </li>
    <li class="dripicons-cloud-upload" v-tooltip.top="'cloud-upload'"> </li>
    <li class="dripicons-code" v-tooltip.top="'code'"> </li>
    <li class="dripicons-contract" v-tooltip.top="'contract'"> </li>
    <li class="dripicons-contract-2" v-tooltip.top="'contract-2'"> </li>
    <li class="dripicons-conversation" v-tooltip.top="'conversation'"> </li>
    <li class="dripicons-copy" v-tooltip.top="'copy'"> </li>
    <li class="dripicons-crop" v-tooltip.top="'crop'"> </li>
    <li class="dripicons-cross" v-tooltip.top="'cross'"> </li>
    <li class="dripicons-crosshair" v-tooltip.top="'crosshair'"> </li>
    <li class="dripicons-cutlery" v-tooltip.top="'cutlery'"> </li>
    <li class="dripicons-device-desktop" v-tooltip.top="'device-desktop'"> </li>
    <li class="dripicons-device-mobile" v-tooltip.top="'device-mobile'"> </li>
    <li class="dripicons-device-tablet" v-tooltip.top="'device-tablet'"> </li>
    <li class="dripicons-direction" v-tooltip.top="'direction'"> </li>
    <li class="dripicons-disc" v-tooltip.top="'disc'"> </li>
    <li class="dripicons-document" v-tooltip.top="'document'"> </li>
    <li class="dripicons-document-delete" v-tooltip.top="'document-delete'"> </li>
    <li class="dripicons-document-edit" v-tooltip.top="'document-edit'"> </li>
    <li class="dripicons-document-new" v-tooltip.top="'document-new'"> </li>
    <li class="dripicons-document-remove" v-tooltip.top="'document-remove'"> </li>
    <li class="dripicons-dot" v-tooltip.top="'dot'"> </li>
    <li class="dripicons-dots-2" v-tooltip.top="'dots-2'"> </li>
    <li class="dripicons-dots-3" v-tooltip.top="'dots-3'"> </li>
    <li class="dripicons-download" v-tooltip.top="'download'"> </li>
    <li class="dripicons-duplicate" v-tooltip.top="'duplicate'"> </li>
    <li class="dripicons-enter" v-tooltip.top="'enter'"> </li>
    <li class="dripicons-exit" v-tooltip.top="'exit'"> </li>
    <li class="dripicons-expand" v-tooltip.top="'expand'"> </li>
    <li class="dripicons-expand-2" v-tooltip.top="'expand-2'"> </li>
    <li class="dripicons-experiment" v-tooltip.top="'experiment'"> </li>
    <li class="dripicons-export" v-tooltip.top="'export'"> </li>
    <li class="dripicons-feed" v-tooltip.top="'feed'"> </li>
    <li class="dripicons-flag" v-tooltip.top="'flag'"> </li>
    <li class="dripicons-flashlight" v-tooltip.top="'flashlight'"> </li>
    <li class="dripicons-folder" v-tooltip.top="'folder'"> </li>
    <li class="dripicons-folder-open" v-tooltip.top="'folder-open'"> </li>
    <li class="dripicons-forward" v-tooltip.top="'forward'"> </li>
    <li class="dripicons-gaming" v-tooltip.top="'gaming'"> </li>
    <li class="dripicons-gear" v-tooltip.top="'gear'"> </li>
    <li class="dripicons-graduation" v-tooltip.top="'graduation'"> </li>
    <li class="dripicons-graph-bar" v-tooltip.top="'graph-bar'"> </li>
    <li class="dripicons-graph-line" v-tooltip.top="'graph-line'"> </li>
    <li class="dripicons-graph-pie" v-tooltip.top="'graph-pie'"> </li>
    <li class="dripicons-headset" v-tooltip.top="'headset'"> </li>
    <li class="dripicons-heart" v-tooltip.top="'heart'"> </li>
    <li class="dripicons-help" v-tooltip.top="'help'"> </li>
    <li class="dripicons-home" v-tooltip.top="'home'"> </li>
    <li class="dripicons-hourglass" v-tooltip.top="'hourglass'"> </li>
    <li class="dripicons-inbox" v-tooltip.top="'inbox'"> </li>
    <li class="dripicons-information" v-tooltip.top="'information'"> </li>
    <li class="dripicons-italic" v-tooltip.top="'italic'"> </li>
    <li class="dripicons-jewel" v-tooltip.top="'jewel'"> </li>
    <li class="dripicons-lifting" v-tooltip.top="'lifting'"> </li>
    <li class="dripicons-lightbulb" v-tooltip.top="'lightbulb'"> </li>
    <li class="dripicons-link" v-tooltip.top="'link'"> </li>
    <li class="dripicons-link-broken" v-tooltip.top="'link-broken'"> </li>
    <li class="dripicons-list" v-tooltip.top="'list'"> </li>
    <li class="dripicons-loading" v-tooltip.top="'loading'"> </li>
    <li class="dripicons-location" v-tooltip.top="'location'"> </li>
    <li class="dripicons-lock" v-tooltip.top="'lock'"> </li>
    <li class="dripicons-lock-open" v-tooltip.top="'lock-open'"> </li>
    <li class="dripicons-mail" v-tooltip.top="'mail'"> </li>
    <li class="dripicons-map" v-tooltip.top="'map'"> </li>
    <li class="dripicons-media-loop" v-tooltip.top="'media-loop'"> </li>
    <li class="dripicons-media-next" v-tooltip.top="'media-next'"> </li>
    <li class="dripicons-media-pause" v-tooltip.top="'media-pause'"> </li>
    <li class="dripicons-media-play" v-tooltip.top="'media-play'"> </li>
    <li class="dripicons-media-previous" v-tooltip.top="'media-previous'"> </li>
    <li class="dripicons-media-record" v-tooltip.top="'media-record'"> </li>
    <li class="dripicons-media-shuffle" v-tooltip.top="'media-shuffle'"> </li>
    <li class="dripicons-media-stop" v-tooltip.top="'media-stop'"> </li>
    <li class="dripicons-medical" v-tooltip.top="'medical'"> </li>
    <li class="dripicons-menu" v-tooltip.top="'menu'"> </li>
    <li class="dripicons-message" v-tooltip.top="'message'"> </li>
    <li class="dripicons-meter" v-tooltip.top="'meter'"> </li>
    <li class="dripicons-microphone" v-tooltip.top="'microphone'"> </li>
    <li class="dripicons-minus" v-tooltip.top="'minus'"> </li>
    <li class="dripicons-monitor" v-tooltip.top="'monitor'"> </li>
    <li class="dripicons-move" v-tooltip.top="'move'"> </li>
    <li class="dripicons-music" v-tooltip.top="'music'"> </li>
    <li class="dripicons-network-1" v-tooltip.top="'network-1'"> </li>
    <li class="dripicons-network-2" v-tooltip.top="'network-2'"> </li>
    <li class="dripicons-network-3" v-tooltip.top="'network-3'"> </li>
    <li class="dripicons-network-4" v-tooltip.top="'network-4'"> </li>
    <li class="dripicons-network-5" v-tooltip.top="'network-5'"> </li>
    <li class="dripicons-pamphlet" v-tooltip.top="'pamphlet'"> </li>
    <li class="dripicons-paperclip" v-tooltip.top="'paperclip'"> </li>
    <li class="dripicons-pencil" v-tooltip.top="'pencil'"> </li>
    <li class="dripicons-phone" v-tooltip.top="'phone'"> </li>
    <li class="dripicons-photo" v-tooltip.top="'photo'"> </li>
    <li class="dripicons-photo-group" v-tooltip.top="'photo-group'"> </li>
    <li class="dripicons-pill" v-tooltip.top="'pill'"> </li>
    <li class="dripicons-pin" v-tooltip.top="'pin'"> </li>
    <li class="dripicons-plus" v-tooltip.top="'plus'"> </li>
    <li class="dripicons-power" v-tooltip.top="'power'"> </li>
    <li class="dripicons-preview" v-tooltip.top="'preview'"> </li>
    <li class="dripicons-print" v-tooltip.top="'print'"> </li>
    <li class="dripicons-pulse" v-tooltip.top="'pulse'"> </li>
    <li class="dripicons-question" v-tooltip.top="'question'"> </li>
    <li class="dripicons-reply" v-tooltip.top="'reply'"> </li>
    <li class="dripicons-reply-all" v-tooltip.top="'reply-all'"> </li>
    <li class="dripicons-return" v-tooltip.top="'return'"> </li>
    <li class="dripicons-retweet" v-tooltip.top="'retweet'"> </li>
    <li class="dripicons-rocket" v-tooltip.top="'rocket'"> </li>
    <li class="dripicons-scale" v-tooltip.top="'scale'"> </li>
    <li class="dripicons-search" v-tooltip.top="'search'"> </li>
    <li class="dripicons-shopping-bag" v-tooltip.top="'shopping-bag'"> </li>
    <li class="dripicons-skip" v-tooltip.top="'skip'"> </li>
    <li class="dripicons-stack" v-tooltip.top="'stack'"> </li>
    <li class="dripicons-star" v-tooltip.top="'star'"> </li>
    <li class="dripicons-stopwatch" v-tooltip.top="'stopwatch'"> </li>
    <li class="dripicons-store" v-tooltip.top="'store'"> </li>
    <li class="dripicons-suitcase" v-tooltip.top="'suitcase'"> </li>
    <li class="dripicons-swap" v-tooltip.top="'swap'"> </li>
    <li class="dripicons-tag" v-tooltip.top="'tag'"> </li>
    <li class="dripicons-tag-delete" v-tooltip.top="'tag-delete'"> </li>
    <li class="dripicons-tags" v-tooltip.top="'tags'"> </li>
    <li class="dripicons-thumbs-down" v-tooltip.top="'thumbs-down'"> </li>
    <li class="dripicons-thumbs-up" v-tooltip.top="'thumbs-up'"> </li>
    <li class="dripicons-ticket" v-tooltip.top="'ticket'"> </li>
    <li class="dripicons-time-reverse" v-tooltip.top="'time-reverse'"> </li>
    <li class="dripicons-to-do" v-tooltip.top="'to-do'"> </li>
    <li class="dripicons-toggles" v-tooltip.top="'toggles'"> </li>
    <li class="dripicons-trash" v-tooltip.top="'trash'"> </li>
    <li class="dripicons-trophy" v-tooltip.top="'trophy'"> </li>
    <li class="dripicons-upload" v-tooltip.top="'upload'"> </li>
    <li class="dripicons-user" v-tooltip.top="'user'"> </li>
    <li class="dripicons-user-group" v-tooltip.top="'user-group'"> </li>
    <li class="dripicons-user-id" v-tooltip.top="'user-id'"> </li>
    <li class="dripicons-vibrate" v-tooltip.top="'vibrate'"> </li>
    <li class="dripicons-view-apps" v-tooltip.top="'view-apps'"> </li>
    <li class="dripicons-view-list" v-tooltip.top="'view-list'"> </li>
    <li class="dripicons-view-list-large" v-tooltip.top="'view-list-large'"> </li>
    <li class="dripicons-view-thumb" v-tooltip.top="'view-thumb'"> </li>
    <li class="dripicons-volume-full" v-tooltip.top="'volume-full'"> </li>
    <li class="dripicons-volume-low" v-tooltip.top="'volume-low'"> </li>
    <li class="dripicons-volume-medium" v-tooltip.top="'volume-medium'"> </li>
    <li class="dripicons-volume-off" v-tooltip.top="'volume-off'"> </li>
    <li class="dripicons-wallet" v-tooltip.top="'wallet'"> </li>
    <li class="dripicons-warning" v-tooltip.top="'warning'"> </li>
    <li class="dripicons-web" v-tooltip.top="'web'"> </li>
    <li class="dripicons-weight" v-tooltip.top="'weight'"> </li>
    <li class="dripicons-wifi" v-tooltip.top="'wifi'"> </li>
    <li class="dripicons-wrong" v-tooltip.top="'wrong'"> </li>
    <li class="dripicons-zoom-in" v-tooltip.top="'zoom-in'"> </li>
    <li class="dripicons-zoom-out" v-tooltip.top="'zoom-out'"> </li>
</ul>
                                </div>
                            </el-tab-pane>
                            <!--<el-tab-pane label="Task" name="fourth">Task</el-tab-pane>-->
                        </el-tabs>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'Icons',
    data: function () {
      return {
        activeName: 'first'
      }
    },
    methods: {
      handleClick: function (tab, event) {
        console.log(tab, event)
      }
    }
  }
</script>
<style lang="scss">
    .entypo ul,
    .entypo-tooltip ul {
        margin: 0 0 40px 0;
        padding: 0;
    }
    
    .entypo li,
    .entypo-tooltip li {
        display: inline-block;
        height: 50px;
        padding: 0.5em;
        position: relative;
        text-align: center;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        transition: all 0.5s ease;
        width: 50px;
        list-style: none;
        font-size: 20px;
        color: #363E49;
    }
</style>