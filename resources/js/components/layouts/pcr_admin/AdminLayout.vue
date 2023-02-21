<template>
  <div>
    <app-header></app-header>

    <!-- Left side column. contains the sidebar -->
    <app-sidebar></app-sidebar>

    <!-- Content Wrapper. Contains page content -->
    <router-view></router-view>
    <!-- /.content-wrapper -->

    <app-footer></app-footer>

    <control-sidebar></control-sidebar>
  </div>
</template>

<script>
  import Sidebar from '../../partials/pcr_admin/Sidebar.vue'
  import Header from '../../partials/pcr_admin/Header.vue'
  import Footer from '../../partials/pcr_admin/Footer.vue'
  import ControlSidebar from '../../partials/pcr_admin/ControlSidebar.vue'

  export default {
    name: 'Dashboard',
    components: {
      'app-sidebar': Sidebar,
      'app-header': Header,
      'app-footer': Footer,
      'control-sidebar': ControlSidebar
    }
  }
</script>

<style>

.admin-main {
  background:#eee;
}
.admin-main .control-sidebar {
  display:none;
}
</style>
