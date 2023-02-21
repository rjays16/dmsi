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
                        <h5>Click to upload files</h5>
                        <hr>
                       <el-upload
                          class="upload-demo"
                          action="https://jsonplaceholder.typicode.com/posts/"
                          :on-preview="handlePreview"
                          :on-remove="handleRemove"
                          :file-list="fileList">
                          <el-button size="small" type="primary">Click to upload</el-button>
                          <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 500kb</div>
                        </el-upload>
                        <br>
                        <br>
                        <h5>FileList with thumbnail</h5>
                        <hr>
                        
                        <el-upload
                          class="upload-demo"
                          action="https://jsonplaceholder.typicode.com/posts/"
                          :on-preview="handlePreview"
                          :on-remove="handleRemove"
                          :file-list="fileList2"
                          list-type="picture">
                          <el-button size="small" type="primary">Click to upload</el-button>
                          <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 500kb</div>
                        </el-upload>
                        <br>
                        <br>
                        <h5>FileList with thumbnail</h5>
                        <hr>
                        
                        <el-upload
                          action="https://jsonplaceholder.typicode.com/posts/"
                          list-type="picture-card"
                          :on-preview="handlePictureCardPreview"
                          :on-remove="handleRemove">
                          <i class="el-icon-plus"></i>
                        </el-upload>
                        <el-dialog v-model="dialogVisible" size="tiny">
                          <img width="100%" :src="dialogImageUrl" alt="">
                        </el-dialog>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    data: function () {
      return {
        fileList: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}], fileList2: [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
      }
    },
    methods: {
      handleRemove: function (file, fileList) {
        console.log(file, fileList)
      },
      handlePreview: function (file) {
        console.log(file)
      }
    }
  }
</script>
<style lang="scss">
    .el-upload__input{
        display: none!important;
    }
</style>
