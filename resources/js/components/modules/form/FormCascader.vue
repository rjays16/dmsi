<template>
<transition name="el-zoom-in-center">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Forms Cascader<small> <i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
                <ol class="breadcrumb">
                    <li>
                        <router-link to="/"> <i class="ti-home"></i></router-link>
                    </li>
                    <li><a href="#">Forms </a></li>
                    <li class="active">Cascader</li>
                </ol>
            </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <!-- /.box -->
            <!-- Default box -->
            <div class="box">
                     <div class="box-header">
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                <div class="box-body">
                    <h4>Basic usage</h4>
              <p>If the options have a clear hierarchical structure, Cascader can be used to view and select them.</p>
<p>There are two ways to expand child option items</p>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="block"> <span class="demonstration">Child options expand when clicked</span>
                                <el-cascader placeholder="Select" :options="options" v-model="selectedOptions" @change="handleChange"> </el-cascader>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="block"> <span class="demonstration">Child options expand when hovered</span>
                                <el-cascader placeholder="Select" expand-trigger="hover" :options="options" v-model="selectedOptions2" @change="handleChange"> </el-cascader>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <p>Assigning the <code>options</code> attribute to an array of options renders a Cascader. The <code>expand-trigger</code> attribute defines how child options are expanded. This example also demonstrates the <code>change</code> event, whose parameter is the value of Cascader, an array made up of the values of each selected level.</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
                     <div class="box">
 
                    <div class="box-header">
                          <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-widget="collapse" data-toggle="tooltip" title="Collapse" class="btn btn-box-tool"><i class="ti-minus"></i></button>
                            <button type="button" data-widget="remove" data-toggle="tooltip" title="Remove" class="btn btn-box-tool"><i class="ti-close"></i></button>
                        </div>
                    </div>
                <div class="box-body">
                    <h5>With default value</h5>
             <p>If the options have a clear hierarchical structure, Cascader can be used to view and select them.</p>
                    <p>There are two ways to expand child option items</p>
                    <div class="row">
                        <div class="col-lg-8">
                           <el-cascader
  :options="options"
  v-model="selectedOptions3"
></el-cascader>
                        </div>
                     
                        <div class="col-lg-4">
                            <p>Assigning the <code>options</code> attribute to an array of options renders a Cascader. The <code>expand-trigger</code> attribute defines how child options are expanded. This example also demonstrates the <code>change</code> event, whose parameter is the value of Cascader, an array made up of the values of each selected level.</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    </transition>
</template>

<script>
  export default {
    name: 'FormInput',
    data () {
      return {
        options: [{
          value: 'guide',
          label: 'Guide',
          children: [{
            value: 'disciplines',
            label: 'Disciplines',
            children: [{
              value: 'consistency',
              label: 'Consistency'
            }, {
              value: 'feedback',
              label: 'Feedback'
            }, {
              value: 'efficiency',
              label: 'Efficiency'
            }, {
              value: 'controllability',
              label: 'Controllability'
            }]
          }, {
            value: 'navigation',
            label: 'Navigation',
            children: [{
              value: 'side nav',
              label: 'Side Navigation'
            }, {
              value: 'top nav',
              label: 'Top Navigation'
            }]
          }]
        }, {
          value: 'component',
          label: 'Component',
          children: [{
            value: 'basic',
            label: 'Basic',
            children: [{
              value: 'layout',
              label: 'Layout'
            }, {
              value: 'color',
              label: 'Color'
            }, {
              value: 'typography',
              label: 'Typography'
            }, {
              value: 'icon',
              label: 'Icon'
            }, {
              value: 'button',
              label: 'Button'
            }]
          }, {
            value: 'form',
            label: 'Form',
            children: [{
              value: 'radio',
              label: 'Radio'
            }, {
              value: 'checkbox',
              label: 'Checkbox'
            }, {
              value: 'input',
              label: 'Input'
            }, {
              value: 'input-number',
              label: 'InputNumber'
            }, {
              value: 'select',
              label: 'Select'
            }, {
              value: 'cascader',
              label: 'Cascader'
            }, {
              value: 'switch',
              label: 'Switch'
            }, {
              value: 'slider',
              label: 'Slider'
            }, {
              value: 'time-picker',
              label: 'TimePicker'
            }, {
              value: 'date-picker',
              label: 'DatePicker'
            }, {
              value: 'datetime-picker',
              label: 'DateTimePicker'
            }, {
              value: 'upload',
              label: 'Upload'
            }, {
              value: 'rate',
              label: 'Rate'
            }, {
              value: 'form',
              label: 'Form'
            }]
          }, {
            value: 'data',
            label: 'Data',
            children: [{
              value: 'table',
              label: 'Table'
            }, {
              value: 'tag',
              label: 'Tag'
            }, {
              value: 'progress',
              label: 'Progress'
            }, {
              value: 'tree',
              label: 'Tree'
            }, {
              value: 'pagination',
              label: 'Pagination'
            }, {
              value: 'badge',
              label: 'Badge'
            }]
          }, {
            value: 'notice',
            label: 'Notice',
            children: [{
              value: 'alert',
              label: 'Alert'
            }, {
              value: 'loading',
              label: 'Loading'
            }, {
              value: 'message',
              label: 'Message'
            }, {
              value: 'message-box',
              label: 'MessageBox'
            }, {
              value: 'notification',
              label: 'Notification'
            }]
          }, {
            value: 'navigation',
            label: 'Navigation',
            children: [{
              value: 'menu',
              label: 'NavMenu'
            }, {
              value: 'tabs',
              label: 'Tabs'
            }, {
              value: 'breadcrumb',
              label: 'Breadcrumb'
            }, {
              value: 'dropdown',
              label: 'Dropdown'
            }, {
              value: 'steps',
              label: 'Steps'
            }]
          }, {
            value: 'others',
            label: 'Others',
            children: [{
              value: 'dialog',
              label: 'Dialog'
            }, {
              value: 'tooltip',
              label: 'Tooltip'
            }, {
              value: 'popover',
              label: 'Popover'
            }, {
              value: 'card',
              label: 'Card'
            }, {
              value: 'carousel',
              label: 'Carousel'
            }, {
              value: 'collapse',
              label: 'Collapse'
            }]
          }]
        }, {
          value: 'resource',
          label: 'Resource',
          children: [{
            value: 'axure',
            label: 'Axure Components'
          }, {
            value: 'sketch',
            label: 'Sketch Templates'
          }, {
            value: 'docs',
            label: 'Design Documentation'
          }]
        }],
        selectedOptions: [],
        selectedOptions3: ['component', 'data', 'tag'],
        selectedOptions2: []
      }
    },
    methods: {
      handleChange (value) {
        console.log(value)
      }
    }
  }

</script>


