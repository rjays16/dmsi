<template>
  <footer class="main-footer">
    <!-- <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div> -->
    2021 All Rights Reserved &copy; Virtual Media Events
  </footer>
</template>

<script>
  export default {
    name: 'DashboardFooter'
  }
</script>

<style>

.admin-main .main-footer {
  position:fixed!important;
  width:100%;
  background:#fff;
  left:230px;
  margin:0;
  z-index:2;
}

.admin-main.sidebar-collapse .main-footer {
  left:50px;
}

@media only screen and (max-width: 768px)  {
  .admin-main .main-footer,
  .admin-main.sidebar-open .main-footer {
    left:0px;
    max-width: 100vh;
  }
}

</style>


