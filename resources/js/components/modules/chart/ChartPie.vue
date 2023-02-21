<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>EChart Pie <small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li>
                    <router-link to="/"> <i class="ti-home"></i></router-link>
                </li>
                <li><a href="#">Charts</a></li>
                <li class="active">EChart Pie</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <ve-pie :data="chartData" :settings="chartSettings"></ve-pie>
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
        columns: ['Apple', 'Samsung', 'Others'],
        rows: [
          { 'Apple': '1月1号', 'Samsung': 123, 'Others': 3 },
          { 'Apple': '1月2号', 'Samsung': 1223, 'Others': 6 },
          { 'Apple': '1月3号', 'Samsung': 2123, 'Others': 90 },
          { 'Apple': '1月4号', 'Samsung': 4123, 'Others': 12 },
          { 'Apple': '1月5号', 'Samsung': 3123, 'Others': 15 },
          { 'Apple': '1月6号', 'Samsung': 7123, 'Others': 20 }
        ]
      }
      this.chartSettings = {
        dimension: 'Samsung',
        metrics: 'Others'
      }
    }
  }
</script>