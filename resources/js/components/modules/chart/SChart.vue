<template>
    <div class="content-wrapper">
               <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Vue Chart Js<small>Input data using mouse or keyboard. <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Charts</a></li>
                <li class="active">Vue Chart Js</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
     
       
            <div class="row">
                <div class="col-md-12">
                         <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ring chart</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa ti-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa ti-close"></i></button>
                    </div>
                </div>
                <div class="box-body">
               <div>
                    <schart class="chart-devin" :canvasId="canvasId"
                    :type="type"
                    :width="width"
                    :height="height"
                    :data="data"
                    :options="options"
                    ></schart>
                    </div>
                 
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
import Schart from 'vue-schart'

export default {
  name: 'hello',
  components: {
    Schart
  },
  data () {
    return {
      canvasId: 'myCanvas',
      type: 'ring',
      width: 500,
      height: 300,
      data: [
        {name: '1999', value: 109},
        {name: '2000 ', value: 102},
        {name: '2001 ', value: 102},
        {name: '2002 ', value: 98},
        {name: '2003 ', value: 85},
        {name: '2004 ', value: 95}
      ],
      options: {
        padding: 60,
        bgColor: '#ffffff', // the background color of chart. Default is '#ffffff'.
        fillColor: '#42f4df',    // the color of bar chart or line chart.
        titleColor: '#000000', // Title Color. Default is '#000000'.
        titlePosition: 'top', // String.Title position. Default is 'top'.
        legendColor: '#000000', // color of the legend text
        legendTop: 40, // Legend position of top. Default is 40.
        yEqual: 6  // The number of points on the Y axis.
      }
    }
  }
}
</script>
<style lang="scss">
    .chart-devin{
        canvas{
            width: 50%;
            margin: 0 auto;
        }
    }

</style>