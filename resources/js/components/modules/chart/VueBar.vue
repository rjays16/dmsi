<template>
    <div class="content-wrapper">
               <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Vue Bar<small>Input data using mouse or keyboard. <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Charts</a></li>
                <li class="active">Vue Bar</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
     
       
            <div class="row">
                <div class="col-md-6">
                         <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">VueBar Option 1</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
           
                               <bars :data="[1, 2, 5, 9, 5, 10, 3, 5, 2, 5, 1, 8, 2, 9, 0]" :gradient="['#000000', '#000000']">
                    </bars>
                </div>
                <!-- /.box-body -->
            </div>
    
    </div>
                
                 <div class="col-md-6">
                          <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">VueBar Option 2</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                 
                               <bars
                      :data="[4, 2, 5, 9, 5, 10, 3, 5, 2, 5, 9, 8, 2, 9, 4, 5, 6, 9, 5, 9, 6, 4, 9, 6, 9, 5, 4, 6, 5, 4]"
                                     
                      :gradient="['#6fa8dc', '#42b983']">
                    </bars>
                </div>
                <!-- /.box-body -->
            </div>
    
    </div>
    
    
    </div>
        </section>
        <!-- /.content -->
    </div>
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