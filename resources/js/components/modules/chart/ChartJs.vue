<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Vue Chart Js<small>Input data using mouse or keyboard. <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li>
                    <router-link to="/"> <i class="ti-home"></i></router-link>
                </li>
                <li><a href="#">Charts</a></li>
                <li class="active">Vue Chart Line</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header"> </div>
                        <div class="box-body">
                            <ve-line style="width:100%" :data="chartData" :settings="chartSettings"></ve-line>
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
  module.exports = {
    created: function () {
      this.chartData = {
        columns: ['One', 'Two', 'three', 'four', 'five'],
        rows: [
          { 'One': '1月1日', 'Two': 1523, 'three': 1523, 'four': 0.12, 'five': 100 },
          { 'One': '1月2日', 'Two': 1223, 'three': 1523, 'four': 0.345, 'five': 100 },
          { 'One': '1月3日', 'Two': 2123, 'three': 1523, 'four': 0.7, 'five': 100 },
          { 'One': '1月4日', 'Two': 4123, 'three': 1523, 'four': 0.31, 'five': 100 },
          { 'One': '1月5日', 'Two': 3123, 'three': 1523, 'four': 0.12, 'five': 100 },
          { 'One': '1月6日', 'Two': 7123, 'three': 1523, 'four': 0.65, 'five': 100 }
        ]
      }
      this.chartSettings = {
        stack: { '售价': ['Two', 'three'] },
        area: true
      }
    }
  }
</script>
