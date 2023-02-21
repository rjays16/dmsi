<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Expandable Table<small>It's all start from here <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Table</a></li>
                <li class="active">Expandable Table</li>
            </ol>
        </section>
  
            <!-- Main content -->
            <section class="content">
               <!-- Expandable Table-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Expandable Table</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <el-table
                        :data="tableData3"
                        style="width: 100%">
                        <el-table-column type="expand">
                          <template slot-scope="props">
                            <p>State: {{ props.row.state }}</p>
                            <p>City: {{ props.row.city }}</p>
                            <p>Address: {{ props.row.address }}</p>
                            <p>Zip: {{ props.row.zip }}</p>
                          </template>
                        </el-table-column>
                        <el-table-column
                          label="Date"
                          prop="date">
                        </el-table-column>
                        <el-table-column
                          label="Name"
                          prop="name">
                        </el-table-column>
                      </el-table>
                    </div>
                </div>
                <!-- End of Expandable Table-->
                <!-- Expandable Table-->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sorting Table</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <el-table
                        :data="tableData"
                        border
                        :default-sort = "{prop: 'date', order: 'descending'}"
                        style="width: 100%">
                        <el-table-column
                          prop="date"
                          label="Date"
                          sortable
                          width="180">
                        </el-table-column>
                        <el-table-column
                          prop="name"
                          label="Name"
                          width="180">
                        </el-table-column>
                        <el-table-column
                          prop="address"
                          label="Address"
                          :formatter="formatter">
                        </el-table-column>
                      </el-table>
                    </div>
                </div>
                <!-- End of Expandable Table-->   
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
    export default {
      name: 'SelectTable',
      data: function () {
        return {
          tableData3: [{
            date: '2016-05-03',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-02',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-04',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-01',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-08',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-06',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }, {
            date: '2016-05-07',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
          }],
          tableData: [{
            date: '2016-05-03',
            name: 'Agus',
            address: 'Los Angeles'
          }, {
            date: '2016-05-02',
            name: 'Yudha',
            address: 'New York'
          }, {
            date: '2016-05-04',
            name: 'Ucil',
            address: 'Texas'
          }, {
            date: '2016-05-01',
            name: 'Jhonny',
            address: 'Alaska'
          }]
        }
      }
    }
</script>
