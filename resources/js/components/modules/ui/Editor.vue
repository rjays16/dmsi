<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Tinymce Editor<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">UI Element</a></li>
                <li class="active">Tinymce Editor</li>
            </ol>
        </section>
  
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header">
                      
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                       <vue-editor v-model="content"></vue-editor>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
import { VueEditor } from 'vue2-editor'
export default {
  components: {
    VueEditor
  },
  data: function () {
    return {}
  }
}
</script>
