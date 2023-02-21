<template>
    <transition name="el-zoom-in-center">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Input<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Input</li>
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
                        <h4>Basic</h4>
                        <el-input placeholder="Please input" v-model="input"></el-input>
                        <hr>
                        <h4>Disabled</h4>
                        <p>Disable the Input with the <code>disabled</code> attribute.</p>
                        <el-input placeholder="Please input" v-model="input1" :disabled="true"></el-input>
                        <hr>
                        <h4>Input with Icon</h4>
                        <p>You can add an icon at the end of Input by setting the <code>icon</code> attribute and use <code>on-icon-click</code> hook to complete some work after clicking the icon.</p>
                        <el-input placeholder="Pick a date" icon="search" v-model="input2" :on-icon-click="handleIconClick"></el-input>
                        <hr>
                        <h4>Text Area</h4>
                        <p>Resizable for entering multiple lines of text information. Add attribute <code>type="textarea"</code> to change <code>input</code> into native <code>textarea</code>.</p>
                        <p>Control the height by setting the <code>rows</code> prop.</p>
                        <el-input type="textarea" :rows="4" placeholder="Please input" v-model="textarea"></el-input>
                        <hr>
                        <h4>Mixed input</h4>
                        <p>Prepend or append an element, generally a label or a button.</p>
                        <div>
                            <el-input placeholder="Please input" v-model="input3">
                                <template slot="prepend">Http://</template>
                            </el-input>
                        </div>
                        <div style="margin-top: 15px;">
                            <el-input placeholder="Please input" v-model="input4">
                                <template slot="append">.com</template>
                            </el-input>
                        </div>
                        <div style="margin-top: 15px;">
                            <el-input placeholder="Please input" v-model="input5">
                                <el-select v-model="select" slot="prepend" placeholder="Select">
                                    <el-option label="Restaurant" value="1"></el-option>
                                    <el-option label="Order No." value="2"></el-option>
                                    <el-option label="Tel" value="3"></el-option>
                                </el-select>
                                <el-button slot="append" icon="search"></el-button>
                            </el-input>
                        </div>
                        <hr> </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <h4>Input Number</h4>
                        <p>
                            <p>Bind a variable to <code>v-model</code> in <code>&lt;el-input-number&gt;</code> element and you are set.</p>
                        </p>
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
    name: 'FormInput',
    data () {
      return {
        input: '',
        num1: 1
      }
    }
  }
</script>