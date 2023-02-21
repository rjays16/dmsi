<template>
  <div class="todo-list">
   <!-- <p >Completed Tasks: {{todos.filter(todo => {return todo.done === true}).length}}</p>
    <p >Pending Tasks: {{todos.filter(todo => {return todo.done === false}).length}}</p>-->
    <todo 
    :delete-todo="deleteTodo" 
    :complete-todo="completeTodo" 
    v-for="todo in todos" 
    :key="todo"
    :todo.sync="todo"></todo>
  </div>
</template>

<script>
import sweetalert from 'sweetalert'
import Todo from './Todo.vue'

export default {
  props: ['todos'],
  components: {
    todo: Todo
  },
  methods: {
    deleteTodo: function (todo) {
      sweetalert({
        title: 'Are you sure?',
        text: 'This To-Do will be permanently deleted!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false
      },
      () => {
        const todoIndex = this.todos.indexOf(todo)
        this.todos.splice(todoIndex, 1)
        sweetalert('Deleted!', 'Your To-Do has been deleted.', 'success')
      })
    },
    completeTodo: function (todo) {
      const todoIndex = this.todos.indexOf(todo)
      this.todos[todoIndex].done = true
      sweetalert('Success!', 'To-Do completed!', 'success')
    }
  }
}
</script>



