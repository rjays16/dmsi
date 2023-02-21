<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Vector Map <small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li>
                    <router-link to="/"> <i class="ti-home"></i></router-link>
                </li>
                <li><a href="#">Map</a></li>
                <li class="active">Vector Map</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <ve-map :data="chartData" :settings="chartSettings"></ve-map>
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
        columns: ['grow', 'GDP']
      }
      this.chartSettings = {
        position: 'world',
        label: false,
        itemStyle: {
          normal: {
            borderColor: '#fff'
          }
        },
        zoom: 0.8
      }
    }
  }
</script>