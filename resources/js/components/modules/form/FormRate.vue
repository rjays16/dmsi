<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
        Form Rate
        <small>Input data using mouse or keyboard.</small>
      </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->

            <!-- /.box -->

       <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Number</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <h4>Basic usage</h4>
                    <p><p>Bind a variable to <code>v-model</code> in <code>&lt;el-input-number&gt;</code> element and you are set.</p></p>
                    <el-input-number v-model="num1" @change="handleChange" :min="1" :max="10"></el-input-number>
                    <el-input-number v-model="num3" :step="2"></el-input-number>
       
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
    name: 'FormRate',
    data () {
      return {
        input: '',
        num1: 1
      }
    }
  }
</script>