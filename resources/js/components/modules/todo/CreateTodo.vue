<template>
    <div class="create-todo">
        <el-button type="info" v-on:click="openForm" v-show="!isCreating"><i class='ti-pencil-alt'></i>&nbsp;&nbsp;Add New Task</el-button>
        <div v-show="isCreating">
            <div class='content-todo-devin'>
                <div>
                    <label>Title</label>
                    <p>
                        <el-input placeholder="Please input" v-model="titleText" type='text'></el-input>
                    </p>
                </div>
                <div>
                    <label>Project</label>
                    <p>
                        <el-input v-model="projectText" type='textarea' :rows="4" placeholder="Please input"> </el-input>
                    </p>
                </div>
                <div>
                    <el-button v-on:click="sendForm()" type="info">Create</el-button>
                    <el-button v-on:click="closeForm" type="info">Cancel</el-button>
                  
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data: function () {
    return {
      titleText: '',
      projectText: '',
      isCreating: false
    }
  },
  methods: {
    openForm: function () {
      this.isCreating = true
    },
    closeForm: function () {
      this.isCreating = false
    },
    sendForm: function () {
      if (this.titleText.length > 0 && this.projectText.length > 0) {
        const title = this.titleText
        const project = this.projectText
        this.$emit('create-todo', {
          title,
          project,
          done: false
        })
        this.titleText = ''
        this.projectText = ''
        this.isCreating = false
      }
    }
  }
}
</script>
