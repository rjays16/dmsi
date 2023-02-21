<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>EChartBar <small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li>
                    <router-link to="/"> <i class="ti-home"></i></router-link>
                </li>
                <li><a href="#">Charts</a></li>
                <li class="active">EChart Bar</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <ve-bar :data="chartData" :settings="chartSettings"></ve-bar>
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
        columns: ['One', 'Samsung', 'Apple'],
        rows: [
          { 'One': '1', 'Samsung': 123, 'Apple': 300 },
          { 'One': '2', 'Samsung': 1223, 'Apple': 600 },
          { 'One': '3', 'Samsung': 2123, 'Apple': 9000 },
          { 'One': '4', 'Samsung': 4123, 'Apple': 1200 },
          { 'One': '5', 'Samsung': 3123, 'Apple': 1500 },
          { 'One': '6', 'Samsung': 7123, 'Apple': 2000 }
        ]
      }
      this.chartSettings = {
        legendName: {
          'Samsung': 'Samsung'
        }
      }
    }
  }
</script>