<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Select<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Select</li>
                </ol>
            </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                    <div class="box-header">
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                <div class="box-body">
                    <h4>Basic Usage</h4>
                    <p><code>v-model</code> is the value of <code>el-option</code> that is currently selected.</p>
                      <el-select v-model="value" placeholder="Select">
                        <el-option
                          v-for="item in options"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                        </el-option>
                      </el-select>
                    <hr>
                    <h4>Disable Options</h4>
                    <p>Set the value of <code>disabled</code> in <code>el-option</code> to <code>true</code> to disable this option.</p>
                    <el-select v-model="value2" placeholder="Select Disable Option">
                        <el-option
                          v-for="item in options2"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value"
                          :disabled="item.disabled">
                        </el-option>
                      </el-select>
                    <hr>
                    <h4>Grouping</h4>
                    <p>Use <code>el-option-group</code> to group the options, and its <code>label</code> attribute stands for the name of the group.</p>
                      <el-select v-model="value7" placeholder="Select">
                        <el-option-group
                          v-for="group in options3"
                          :key="group.label"
                          :label="group.label">
                          <el-option
                            v-for="item in group.options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                          </el-option>
                        </el-option-group>
                      </el-select>
                    <hr>
                    <h4>Remote Search</h4>
                    <p>Enter keywords and search data from server.</p>
                    <p>Set the value of <code>filterable</code> and <code>remote</code> with <code>true</code> to enable remote search, and you should pass the <code>remote-method</code>. <code>remote-method</code> is a <code>Function</code> that gets called when the input value changes, and its parameter is the current input value. Note that if <code>el-option</code> is rendered with the <code>v-for</code> directive, you should add the <code>key</code> attribute for <code>el-option</code>. Its value needs to be unique, such as <code>item.value</code> in the following example.</p>
                     <el-select
                        v-model="value9"
                        multiple
                        filterable
                        remote
                        placeholder="Please enter a keyword"
                        :remote-method="remoteMethod"
                        :loading="loading">
                        <el-option
                          v-for="item in options4"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                        </el-option>
                      </el-select>
                </div>
                <!-- /.box-body -->
       
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    </transition>
</template>

<script>
  export default {
    name: 'FormSelect',
    data () {
      return {
        options: [{
          value: 'Option1',
          label: 'Option1'
        }, {
          value: 'Option2',
          label: 'Option2'
        }, {
          value: 'Option3',
          label: 'Option3'
        }, {
          value: 'Option4',
          label: 'Option4'
        }, {
          value: 'Option5',
          label: 'Option5'
        }],
        options2: [{
          value: 'Enable',
          label: 'Enable'
        }, {
          value: 'Disable',
          label: 'Disable',
          disabled: true
        }, {
          value: 'Enable',
          label: 'Enable'
        }, {
          value: 'Enable',
          label: 'Enable'
        }, {
          value: 'Enable',
          label: 'Enable'
        }],
        options3: [{
          label: 'Popular cities',
          options: [{
            value: 'Yogyakarta',
            label: 'Yogyakarta'
          }, {
            value: 'Depok',
            label: 'Depok'
          }]
        }, {
          label: 'City name',
          options: [{
            value: 'Sleman',
            label: 'Sleman'
          }, {
            value: 'Bantul',
            label: 'Bantul'
          }, {
            value: 'Gunung Kidul',
            label: 'Gunung Kidul'
          }, {
            value: 'Jogja',
            label: 'Jogja'
          }]
        }],
        value2: '',
        value: '',
        value7: '',
        options4: [],
        value9: [],
        list: [],
        loading: false,
        states: ['Alabama', 'Alaska', 'Arizona',
          'Arkansas', 'California', 'Colorado',
          'Connecticut', 'Delaware', 'Florida',
          'Georgia', 'Hawaii', 'Idaho', 'Illinois',
          'Indiana', 'Iowa', 'Kansas', 'Kentucky',
          'Louisiana', 'Maine', 'Maryland',
          'Massachusetts', 'Michigan', 'Minnesota',
          'Mississippi', 'Missouri', 'Montana',
          'Nebraska', 'Nevada', 'New Hampshire',
          'New Jersey', 'New Mexico', 'New York',
          'North Carolina', 'North Dakota', 'Ohio',
          'Oklahoma', 'Oregon', 'Pennsylvania',
          'Rhode Island', 'South Carolina',
          'South Dakota', 'Tennessee', 'Texas',
          'Utah', 'Vermont', 'Virginia',
          'Washington', 'West Virginia', 'Wisconsin',
          'Wyoming']
      }
    },
    mounted () {
      this.list = this.states.map(item => {
        return { value: item, label: item }
      })
    },
    methods: {
      remoteMethod (query) {
        if (query !== '') {
          this.loading = true
          setTimeout(() => {
            this.loading = false
            this.options4 = this.list.filter(item => {
              return item.label.toLowerCase()
                .indexOf(query.toLowerCase()) > -1
            })
          }, 200)
        } else {
          this.options4 = []
        }
      }
    }
  }

</script>