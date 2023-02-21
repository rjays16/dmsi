<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
                     <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Calendar Page<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Calendar Page</li>
            </ol>
        </section>
            <!-- Main content -->
            <section class="content">
                
                    <vue-event-calendar :events="demoEvents"></vue-event-calendar>
              
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
export default {
  name: 'Calendar',
  data () {
    return {
      demoEvents: [{
        date: '2017/12/15',
        title: 'FooFighter',
        desc: 'Conser Music'
      }, {
        date: '2017/11/12',
        desc: 'Conser Music',
        title: 'Bar'
      }, {
        date: '2017/10/3',
        desc: 'Conser Music',
        title: 'Bar'
      }]
    }
  }
}
</script>
