<template>
 <transition name="el-zoom-in-top">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">
            <h1>Forms Radio<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Radio</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                <div class="box-body">
                    <h5>Basic usage</h5>
                    <p>Radio should not have too many options. Otherwise, use the Select component instead.</p>
                    <hr>
                    <el-radio class="radio" v-model="radio" label="1">optionA</el-radio>
                    <el-radio class="radio" v-model="radio" label="2">optionB</el-radio>
                    <br>
                    <hr>
                    <br>
                    <el-radio-group v-model="radio3">
                        <el-radio-button label="New York"></el-radio-button>
                        <el-radio-button label="Washington"></el-radio-button>
                        <el-radio-button label="Los Angeles"></el-radio-button>
                        <el-radio-button label="Chicago"></el-radio-button>
                    </el-radio-group>
                    <div style="margin: 15px 0;"></div>
                    <hr>
                    <el-radio-group v-model="radio4">
                        <el-radio-button label="New York"></el-radio-button>
                        <el-radio-button label="Washington" :disabled="true"></el-radio-button>
                        <el-radio-button label="Los Angeles"></el-radio-button>
                        <el-radio-button label="Chicago"></el-radio-button>
                    </el-radio-group>
                    <div style="margin: 15px 0;"></div>
                    <hr>
                    <el-radio-group v-model="radio5" :disabled="true">
                        <el-radio-button label="New York"></el-radio-button>
                        <el-radio-button label="Washington"></el-radio-button>
                        <el-radio-button label="Los Angeles"></el-radio-button>
                        <el-radio-button label="Chicago"></el-radio-button>
                    </el-radio-group>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    </transition>
</template>

<script>
  export default {
    name: 'FormRadio',
    data () {
      return {
        radio: '1',
        radio3: 'New York',
        radio4: 'New York',
        radio5: 'New York'
      }
    }
  }
</script>