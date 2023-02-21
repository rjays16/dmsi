<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Buttons<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Buttons</li>
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
                    <div class="box-body">
                        <h4>Basic usage</h4>
                        <hr>
                        <el-button>Default Button</el-button>
                        <el-button type="primary">Primary Button</el-button>
                        <el-button type="text">Text Button</el-button>
                        <br>
                         <hr>
                         <h4>Disabled Button</h4>
                       
                        <p>The disableds attribute determines if the button is disabled.</p>
                        <el-button :plain="true" :disabled="true">Default Button</el-button>
                        <el-button type="primary" disabled>Primary Button</el-button>
                        <el-button type="text" disabled>Text Button</el-button>
                           <br>
                         <hr>
                         <h4>Color Indication</h4>
                       
                        <p>Different colors represent different meanings.</p>

    <el-button type="success">Success</el-button>
    <el-button type="warning">Warning</el-button>
    <el-button type="danger">Danger</el-button>
    <el-button type="info">Info</el-button>
<br>
<br>


    <el-button :plain="true" type="success">Success</el-button>
    <el-button :plain="true" type="warning">Warning</el-button>
    <el-button :plain="true" type="danger">Danger</el-button>
    <el-button :plain="true" type="info">Info</el-button>
                               <br>
                         <hr>
                         <h4>Icon Button</h4>
                       
                        <p>Use icons to add more meaning to Button. You can use icon alone to save some space, or with text together.</p>
                        
                        <el-button type="primary" icon="edit"></el-button>
<el-button class="btn-rounded" type="primary" icon="share"></el-button>
<el-button type="primary" icon="delete"></el-button>
<el-button type="primary" icon="search">Search</el-button>
<el-button type="primary">Upload <i class="el-icon-upload el-icon-right"></i></el-button>


                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'UIButtons'
  }
</script>
<style lang="scss">
    .btn-rounded{
        border-radius: 25px;
    }
</style>
