<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>General Page<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Apps</a></li>
                    <li class="active">General Page</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!--Layout-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic layout</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body" style="min-height:400px;">
                        <h4>Basic usage</h4>
                        <p>Quickly and easily create layouts with the basic 24-column. Create basic grid layout using columns.</p>
                        <p>With <code>row</code> and <code>col</code>, we can easily manipulate the layout using the <code>span</code> attribute.</p>
                        <el-row>
                            <el-col :span="24">
                                <div class="grid-content bg-purple-dark"></div>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="12">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="8">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="8">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="8">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="4">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="4">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="4">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="4">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                            <el-col :span="4">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="4">
                                <div class="grid-content bg-purple-light"></div>
                            </el-col>
                        </el-row>
                        <hr>
                        <h5>Column Spacing</h5>
                        <p>Row provides <code>gutter</code> attribute to specify spacings between columns, and its default value is 0.</p>
                        <el-row :gutter="20">
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                            <el-col :span="6">
                                <div class="grid-content bg-purple"></div>
                            </el-col>
                        </el-row>
                    </div>
                </div>
                <!--End of Layout-->
                <!--Color-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Alert</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <h4>Alert</h4>
                        <p>Alert components are non-overlay elements in the page that does not disappear automatically.</p>
                        <br>
                        <el-alert title="success alert" type="success" show-icon> </el-alert>
                        <br>
                        <el-alert title="info alert" type="info" show-icon> </el-alert>
                        <br>
                        <el-alert title="warning alert" type="warning" show-icon> </el-alert>
                        <br>
                        <el-alert title="error alert" type="error" show-icon> </el-alert>
                        <hr>
                        <h4>Customizable close button</h4>
                        <p>Customize the close button as texts or other symbols.</p>
                        <el-alert title="unclosable alert" type="success" :closable="false"> </el-alert>
                        <br>
                        <el-alert title="customized close-text" type="info" close-text="Gotcha"> </el-alert>
                        <br>
                        <el-alert title="alert with callback" type="warning" @close="hello"> </el-alert>
                        <hr>
                        <h3>With icon and description</h3>
                        <p>Description includes a message with more detailed information.</p>
                        <el-alert title="success alert" type="success" description="more text description" show-icon> </el-alert>
                        <br>
                        <el-alert title="info alert" type="info" description="more text description" show-icon> </el-alert>
                        <br>
                        <el-alert title="warning alert" type="warning" description="more text description" show-icon> </el-alert>
                        <br>
                        <el-alert title="error alert" type="error" description="more text description" show-icon> </el-alert>
                    </div>
                </div>
                <!--end of Color-->
                <!--Typhography-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Typography</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <el-row gutter="20">
                            <el-col :span="6">
                                <h3><strong>Heading</strong>
                                        </h3> </el-col>
                            <el-col :span="18">
                                <h1>h1. This is a very large header.</h1>
                                <h2>h2. This is a large header.</h2>
                                <h3>h3. This is a medium header.</h3>
                                <h4>h4. This is a moderate header.</h4>
                                <h5>h5. This is a small header.</h5>
                                <h6>h6. This is a tiny header.</h6> </el-col>
                        </el-row>
                        <hr>
                        <el-row gutter="20">
                            <el-col :span="6">
                                <p><strong>Blockquote</strong> </p>
                            </el-col>
                            <el-col :span="18">
                                <blockquote>Those people who think they know everything are a great annoyance to those of us who do. <cite>Isaac Asimov</cite> </blockquote>
                            </el-col>
                        </el-row>
                        <hr>
                        <el-row gutter="20">
                            <el-col :span="6">
                                <p><strong>Code</strong> </p>
                            </el-col>
                            <el-col :span="18">
                                <code>Those people who think they know everything are a great annoyance to those of us who do. </code>
                            </el-col>
                        </el-row>
                    </div>
                </div>
                <!--End of Typhography-->
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'GeneralPage'
  }
</script>
<style>
    .el-row {
        margin-bottom: 20px;
        &:last-child {
            margin-bottom: 0;
        }
    }
    
    .el-col {
        border-radius: 0!important;
    }
    
    .bg-purple-dark {
        background: #ddd;
    }
    
    .bg-purple {
        background: #ccc;
    }
    
    .bg-purple-light {
        background: #eee;
    }
    
    .grid-content {
        border-radius: 0;
        min-height: 36px;
    }
    
    .row-bg {
        padding: 15px 0;
        background-color: #ccc;
    }
</style>