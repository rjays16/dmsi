<template>
    <div class="todo-content">
        <div v-show="!isEditing">
            <h2>{{ todo.title }}</h2>
            <p> {{ todo.project }} </p>
            <div class="task-action"> <span v-on:click="showForm">
          <i class='ti-pencil'></i>
        </span> <span v-on:click="deleteTodo(todo)">
          <i class='ti-trash'></i>
        </span> </div>
        </div>
        <div class="content-todo-devin" v-show="isEditing">
            <div>
                <div>
                    <label>Title</label>
                    <p>
                        <el-input placeholder="Please input" v-model="todo.title" type='text'></el-input>
                    </p>
                </div>
                <div class='field'>
                    <label>Project</label>
                    <p>
                        <el-input v-model="todo.project" type='textarea' :rows="4" placeholder="Please input"> </el-input>
                    </p>
                </div>
                <div>
                    <el-button v-on:click="hideForm" type="danger">Close</el-button>
                </div>
            </div>
        </div>
        <div class="todo-completed" v-show="!isEditing &&todo.done" disabled> Completed </div>
        <div class="todo-pending" v-on:click="completeTodo(todo)" v-show="!isEditing && !todo.done"> Pending </div>
    </div>
</template>
<script>
  export default {
    props: ['todo'],
    data: function () {
      return {
        isEditing: false
      }
    },
    methods: {
      completeTodo: function (todo) {
        this.$emit('complete-todo', todo)
      },
      deleteTodo: function (todo) {
        this.$emit('delete-todo', todo)
      },
      showForm: function () {
        this.isEditing = true
      },
      hideForm: function () {
        this.isEditing = false
      }
    }
  }
</script>