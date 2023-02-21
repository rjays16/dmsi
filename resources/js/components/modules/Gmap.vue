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
                   <!--   npm install vue2-google-maps-->
                     
                        <h5>{{ msg }}</h5>
                        <br>
                        <input style="padding:5px 10px;border-radius:4px;border:1px solid #ddd;" placeholder="Manchester" v-model=vm.searchPlace v-gmaps-searchbox:location=vm>
                        <br>
                        <br> <pre>{{ vm | json }}</pre> </div>
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