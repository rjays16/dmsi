<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
                                 <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>ToDo Apps<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">To Do</li>
            </ol>
        </section>
            <!-- Main content -->
            <section class="content">
                <div class="todo-devin">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="side-todo">
                            <ul>
                                <li class="clearfix"><img src="http://api.randomuser.me/portraits/men/22.jpg" alt="avatar"> <div class="about"><div class="name">Vincent Porter</div> <div class="status"><i class="fa fa-circle online"></i> online </div></div></li>
                                <li class="completed">Complete task <b>{{todos.filter(todo => {return todo.done === true}).length}}</b></li>
                                <li class="pending">Pending task <b>{{todos.filter(todo => {return todo.done === false}).length}}</b></li>
</ul>

                            <create-todo v-on:create-todo="createTodo"></create-todo>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <todo-list v-bind:todos="todos"></todo-list>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
import sweetalert from 'sweetalert'
import TodoList from './todo/TodoList.vue'
import CreateTodo from './todo/CreateTodo.vue'
export default {
  name: 'ToDo',
  components: {
    TodoList,
    CreateTodo
  },
  data: function () {
    return {
      todos: [{
        title: 'Bug Fixed V 1.0.4',
        project: 'Are we meeting today? Project has been already finished and I have results to show you.',
        done: true
      }, {
        title: 'Udate Notification',
        project: 'Used to show feedback after an activity. The difference with Notification is that the latter is often used to show a system level passive notification',
        done: true
      }, {
        title: 'Radio Function',
        project: 'Radio should not have too many options. Otherwise, use the Select component instead',
        done: false
      }, {
        title: 'Table fix',
        project: 'Display multiple data with similar format. You can sort, filter, compare your data in a table.',
        done: false
      }]
    }
  },
  methods: {
    createTodo: function (newTodo) {
      this.todos.push(newTodo)
      sweetalert('Success!', 'To-Do created!', 'success')
    }
  }
}
</script>