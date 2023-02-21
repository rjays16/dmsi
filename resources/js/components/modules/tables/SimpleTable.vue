<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Simple Table<small>It's all start from here <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Table</a></li>
                <li class="active">Simple Table</li>
            </ol>
        </section>
  
            <!-- Main content -->
            <section class="content">
               <!-- Basic Tables-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic Tables</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                          <el-table
                          :data="tableData"
                          style="width: 100%">
                          <el-table-column
                            prop="date"
                            label="Date"
                            width="180">
                          </el-table-column>
                          <el-table-column
                            prop="name"
                            label="Name"
                            width="180">
                          </el-table-column>
                          <el-table-column
                            prop="address"
                            label="Address">
                          </el-table-column>
                        </el-table>
                    </div>
                </div>
                <!-- End of Basic Tables-->
                <!-- Striped Table-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Striped Table</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                              <el-table
                            :data="tableData"
                            stripe
                            style="width: 100%">
                            <el-table-column
                              prop="date"
                              label="Date"
                              width="180">
                            </el-table-column>
                            <el-table-column
                              prop="name"
                              label="Name"
                              width="180">
                            </el-table-column>
                            <el-table-column
                              prop="address"
                              label="Address">
                            </el-table-column>
                          </el-table>
                    </div>
                </div>
                <!-- End of Striped Table-->
                <!-- Striped Table-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table with fixed header</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                          <el-table
                            :data="tableData"
                            height="250"
                            border
                            style="width: 100%">
                            <el-table-column
                              prop="date"
                              label="Date"
                              width="180">
                            </el-table-column>
                            <el-table-column
                              prop="name"
                              label="Name"
                              width="180">
                            </el-table-column>
                            <el-table-column
                              prop="address"
                              label="Address">
                            </el-table-column>
                          </el-table>
                    </div>
                </div>
                <!-- End of Striped Table-->
                
                
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
    export default {
      name: 'SimpleTable',
      data: function () {
        return {
          tableData: [{
            date: '2016-05-03',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }, {
            date: '2016-05-02',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }, {
            date: '2016-05-04',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }, {
            date: '2016-05-04',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }, {
            date: '2016-05-04',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }, {
            date: '2016-05-01',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
          }]
        }
      }
    }
</script>
