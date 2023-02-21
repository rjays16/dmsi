<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Timepicker<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Timepicker</li>
                </ol>
            </section>
        <!-- Main content -->
        <section class="content">
       <!-- Default box -->
            <div class="box">
                <div class="box-header">
                  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                      <h4>Fixed time picker</h4> <p>Provide a list of fixed time for users to choose</p>
                    <el-time-select
                      v-model="value1"
                      :picker-options="{
                        start: '08:30',
                        step: '00:15',
                        end: '18:30'
                      }"
                      placeholder="Select time">
                    </el-time-select>
                </div>
                <!-- /.box-body -->
            </div>
            
            <div class="box">
                <div class="box-header">
       
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <h4 class="box-title">Arbitrary time picker</h4> 
                    <p>Can pick an arbitrary time.</p>
                     <el-time-picker
                        v-model="value2"
                        :picker-options="{
                          selectableRange: '18:30:00 - 20:30:00'
                        }"
                        placeholder="Arbitrary time">
                      </el-time-picker>
                </div>
                <!-- /.box-body -->
            </div>
            
            <div class="box">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <h4>Fixed time range</h4>
                    <p>f start time is picked at first, then the end time will change accordingly.</p>
                       <el-time-select
                            placeholder="Start time"
                            v-model="startTime"
                            :picker-options="{
                              start: '08:30',
                              step: '00:15',
                              end: '18:30'
                            }">
                          </el-time-select>
                          <el-time-select
                            placeholder="End time"
                            v-model="endTime"
                            :picker-options="{
                              start: '08:30',
                              step: '00:15',
                              end: '18:30',
                              minTime: startTime
                            }">
                          </el-time-select>
                </div>
                <!-- /.box-body -->
            </div>
            
            <div class="box">
                <div class="box-header">
               
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
                         <h4 class="box-title">Arbitrary time range </h4>
                    <p>Can pick an arbitrary time range.</p>
                       <el-time-picker
                        is-range
                        v-model="value3"
                        placeholder="Pick a time range">
                      </el-time-picker>
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
    name: 'FormTimePicker',
    data () {
      return {
        value1: '',
        value2: new Date(2016, 9, 10, 18, 40),
        value3: [new Date(2016, 9, 10, 8, 40), new Date(2016, 9, 10, 9, 40)],
        startTime: '',
        endTime: ''
      }
    }
  }
</script>