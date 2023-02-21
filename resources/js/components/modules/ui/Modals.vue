<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Blank Page<small>It's all start from here <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Blank Page</li>
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
                    <div class="box-body" style="min-height:400px;">
                       <!-- Table -->
                        <el-button :plain="true" @click="dialogTableVisible = true">opens a Table nested Dialog</el-button>

                        <el-dialog title="Shipping address" :visible.sync="dialogTableVisible">
                          <el-table :data="gridData">
                            <el-table-column property="date" label="Date" width="150"></el-table-column>
                            <el-table-column property="name" label="Name" width="200"></el-table-column>
                            <el-table-column property="address" label="Address"></el-table-column>
                          </el-table>
                        </el-dialog>
<br>
<br>
                        <!-- Form -->
                        <el-button :plain="true" @click="dialogFormVisible = true">open a Form nested Dialog</el-button>

                        <el-dialog title="Shipping address" :visible.sync="dialogFormVisible">
                          <el-form :model="form">
                            <el-form-item label="Promotion name" :label-width="formLabelWidth">
                              <el-input v-model="form.name" auto-complete="off"></el-input>
                            </el-form-item>
                            <el-form-item label="Zones" :label-width="formLabelWidth">
                              <el-select v-model="form.region" placeholder="Please select a zone">
                                <el-option label="Zone No.1" value="shanghai"></el-option>
                                <el-option label="Zone No.2" value="beijing"></el-option>
                              </el-select>
                            </el-form-item>
                          </el-form>
                          <span slot="footer" class="dialog-footer">
                            <el-button @click="dialogFormVisible = false">Cancel</el-button>
                            <el-button type="primary" @click="dialogFormVisible = false">Confirm</el-button>
                          </span>
                        </el-dialog>
                        <br><br>
                            <hr>
                        <h5>Message</h5>
<p>Used to show feedback after an activity. The difference with Notification<br> is that the latter is often used to show a system level passive notification.</p>
                         
                        <el-button :plain="true" @click="open5">message</el-button>
                          <el-button :plain="true" @click="open6">success</el-button>
                          <el-button :plain="true" @click="open7">warning</el-button>
                          <el-button :plain="true" @click="open8">error</el-button>
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
        gridData: [{
          date: '2016-05-02',
          name: 'John Smith',
          address: 'No.1518,  Jinshajiang Road, Putuo District'
        }, {
          date: '2016-05-04',
          name: 'John Smith',
          address: 'No.1518,  Jinshajiang Road, Putuo District'
        }, {
          date: '2016-05-01',
          name: 'John Smith',
          address: 'No.1518,  Jinshajiang Road, Putuo District'
        }, {
          date: '2016-05-03',
          name: 'John Smith',
          address: 'No.1518,  Jinshajiang Road, Putuo District'
        }],
        dialogTableVisible: false,
        dialogFormVisible: false,
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        },
        formLabelWidth: '120px'
      }
    }
  }
</script>