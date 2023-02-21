<template>
   <transition name="el-zoom-in-top">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>Forms Checkbox<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Forms </a></li>
                <li class="active">Checkbox</li>
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
                    <p>Checkbox can be used alone to switch between two states. Disabled state for checkbox</p>
                        <el-checkbox v-model="checked">Option</el-checkbox>
                      <el-checkbox v-model="checked1" disabled>Option</el-checkbox>
                        <el-checkbox v-model="checked2" disabled>Option</el-checkbox>
                    <hr>
                     <h5>Checkbox group</h5>
                    <p>It is used for multiple checkboxes which are bound in one group, and indicates whether one option is selected by checking if it is checked.</p>
                    <br>
                      <el-checkbox-group v-model="checkList">
                        <el-checkbox label="Option A"></el-checkbox>
                        <el-checkbox label="Option B"></el-checkbox>
                        <el-checkbox label="Option C"></el-checkbox>
                        <el-checkbox label="disabled" disabled></el-checkbox>
                        <el-checkbox label="selected and disabled" disabled></el-checkbox>
                      </el-checkbox-group>
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
    name: 'FormCheckbox',
    data () {
      return {
        checked: true,
        checked1: false,
        checked2: true
      }
    }
  }
</script>