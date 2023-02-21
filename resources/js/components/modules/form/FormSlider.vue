<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Slider<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Slider</li>
                </ol>
            </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                 
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="block"> <span class="demonstration">Default value</span>
                        <el-slider v-model="value1"></el-slider>
                    </div>
                    <div class="block"> <span class="demonstration">Customized initial value</span>
                        <el-slider v-model="value2"></el-slider>
                    </div>
                    <div class="block"> <span class="demonstration">Hide Tooltip</span>
                        <el-slider v-model="value3" :show-tooltip="false"></el-slider>
                    </div>
                    <div class="block"> <span class="demonstration">Format Tooltip</span>
                        <el-slider v-model="value4" :format-tooltip="formatTooltip"></el-slider>
                    </div>
                    <div class="block"> <span class="demonstration">Disabled</span>
                        <el-slider v-model="value5" disabled></el-slider>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                   
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="block"> <span class="demonstration">Breakpoints not displayed</span>
                        <el-slider v-model="value6" :step="10"> </el-slider>
                    </div>
                    <div class="block"> <span class="demonstration">Breakpoints displayed</span>
                        <el-slider v-model="value7" :step="10" show-stops> </el-slider>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="block">
                        <el-slider v-model="value8" show-input> </el-slider>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- Default box -->
            <div class="box">
                <div class="box-header">

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="block">
                        <el-slider v-model="value9" range show-stops :max="10"> </el-slider>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                   
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="block">
                        <el-slider v-model="value10" vertical height="200px"> </el-slider>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
    </div>
    </transition>
</template>
<script>
  export default {
    name: 'FormSlider',
    data () {
      return {
        value1: 0,
        value2: 50,
        value3: 36,
        value4: 48,
        value5: 42,
        value6: 0,
        value7: 0,
        value8: 0,
        value9: [4, 8],
        value10: 0
      }
    },
    methods: {
      formatTooltip (val) {
        return val / 100
      }
    }
  }
</script>