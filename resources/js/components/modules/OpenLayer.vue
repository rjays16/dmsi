<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Blank Page<small>It's all start from here <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Apps</a></li>
                    <li class="active">Blank Page</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body" style="min-height:400px;">
                        <vl-map :load-tiles-while-animating="true" :load-tiles-while-interacting="true">
                            <vl-view :zoom="12" :center="[110.3712312, -7.8007611]" :rotation="0"></vl-view>
                            <vl-geoloc>
                                <template slot-scope="ctx">
                                    <vl-feature v-if="ctx.position" id="geoloc-feature">
                                        <vl-geom-point :coordinates="ctx.position"></vl-geom-point>
                                    </vl-feature>
                                </template>
                            </vl-geoloc>
                            <vl-layer-tile id="osm">
                                <vl-source-osm></vl-source-osm>
                            </vl-layer-tile>
                        </vl-map>
                     </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
export default {
  data () {
    return {
      msg: 'Search places and address using Google Maps API',
      vm: {
        searchPlace: '',
        location: {}
      }
    }
  }
}
</script>