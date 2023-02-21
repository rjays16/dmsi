<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
           <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Switch<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Switch</li>
                </ol>
            </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <!-- /.box -->
            <!-- Default box -->
            <div class="box">
                <div class="box-header ">
                    <h3 class="box-title">Basic usage <small>Switch is used for switching between two opposing states.</small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
        
                    <el-switch v-model="value1" on-text="" off-text=""> </el-switch>
                    <hr>
                    <el-switch v-model="value2" on-color="#13ce66" off-color="#ff4949"> </el-switch>
                    
                 
                </div>
                <!-- /.box-body -->
            </div>
            
                  <div class="box">
                <div class="box-header ">
                    <h3 class="box-title">Extended value types</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <p>You can set <code>on-value</code> and <code>off-value</code> attributes. They both receive a <code>Boolean</code>, <code>String</code> or <code>Number</code> typed value.</p>
                    <br>
                    <el-tooltip :content="'Switch value: ' + value5" placement="right">
                        <el-switch v-model="value5" on-color="#13ce66" off-color="#ff4949" on-value="100" off-value="0"> </el-switch>
                    </el-tooltip>
               
                </div>
                <!-- /.box-body -->
            </div>
            
                  <div class="box">
                <div class="box-header ">
                    <h3 class="box-title">Disabled</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
     
                    <el-switch v-model="value4" on-text="" off-text="" disabled> </el-switch>
                    <el-switch v-model="value4" disabled> </el-switch>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    </transition>
</template>
<script>
  export default {
    name: 'FormSwitch',
    data () {
      return {
        value1: true,
        value2: true,
        value3: false,
        value4: false,
        value5: '100'
      }
    }
  }
</script>