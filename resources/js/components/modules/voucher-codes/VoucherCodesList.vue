<template>
    <div>
        <div class="content-wrapper">
            <div class="container-fluid bg-white my-3 p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <th>Codes</th>
                            <th>Description</th>
                            <th>Discount Amount</th>
                            <th>Max Usage</th>
                            <th>Note</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="item in voucher_codes" :key="item.id">
                                <td>
                                    <span v-if="item.is_new || item.is_edited">
                                        <input type="text" class="form-control form-control-sm">
                                    </span>
                                    <span>{{item.voucher_code}}</span>
                                </td>
                                <td>
                                    <span v-if="item.is_new || item.is_edited">
                                        <input type="text" class="form-control form-control-sm">
                                    </span>
                                    <span v-else>{{item.description}}</span>
                                </td>
                                <td>
                                    <span v-if="item.is_new || item.is_edited">
                                        <input type="number" class="form-control form-control-sm">
                                    </span>
                                    <span v-else>{{item.discount_amt}}</span>
                                </td>
                                <td>
                                    <span v-if="item.is_new || item.is_edited">
                                        <input type="text" class="form-control form-control-sm">
                                    </span>
                                    <span v-else>{{item.max_usage}}</span>
                                </td>
                                <td>
                                    <span v-if="item.is_new || item.is_edited">
                                        <input type="text" class="form-control form-control-sm">
                                    </span>
                                    <span v-else>{{item.note}}</span>
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-link" v-if="!item.is_new" @click="editVoucherCode(item)">Edit</button>
                                    <button class="btn btn-link text-danger" @click="deleteVoucherCode(item.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <a href="#" @click="showVoucherCodeForm">
                                        <div class="add-content-box" @mouseover="add_voucher_code_btn_hover = true" @mouseleave="add_voucher_code_btn_hover = false">
                                            <div class="rounded-add-btn m-auto" :class="[{'add-btn-default': !add_voucher_code_btn_hover}, {'add-btn-hovered': add_voucher_code_btn_hover}]">
                                                <i class="fas fa-plus fa-icon-custom"></i>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <form-modal v-if="open_voucher_code_form"
        :item_data="voucher_code"
        @closeModal="closeVoucherCodeForm"
        @create="createVoucherCode"
        @update="updateVoucherCode">
        </form-modal>
    </div>
</template>

<script>
import formModal from './VoucherCodeFormModal';
export default {
    components: {
        'form-modal': formModal
    },
    data() {
        return {
            open_voucher_code_form: false,
            voucher_codes: [],
            voucher_code: null,
            add_voucher_code_btn_hover: false
        }
    },
    created() {
        this.getAll();
    },
    methods: {
        showVoucherCodeForm() {
            this.open_voucher_code_form = true;
        },
        closeVoucherCodeForm() {
            this.open_voucher_code_form = false;
            this.voucher_code = null;
        },
        getAll() {
            axios.get(`/admin/vouchercodes/get`)
			.then(res => {
				if(res.data) {
                    this.voucher_codes = res.data;
                }
			})
			.catch(err => {
				console.log(err);
			});			
        },
        createVoucherCode(data) {
            axios.post(`/admin/vouchercodes/create`, {data: data})
			.then(res => {
				if(res.data) {
                    this.getAll();
                }
			})
			.catch(err => {
				console.log(err);
			});	
        },
        editVoucherCode(data) {
            this.voucher_code = data;
            this.showVoucherCodeForm();
        },
        updateVoucherCode(data) {
            axios.post(`/admin/vouchercodes/update`, {data: data})
			.then(res => {
				if(res.data) {
                    this.getAll();
                }
			})
			.catch(err => {
				console.log(err);
			});	
        },
        deleteVoucherCode(id) {
            let res = confirm('Are you sure you want to delete this voucher code?');
            if(res) {
                axios.delete(`/admin/vouchercodes/${id}/delete`)
                .then(res => {
                    if(res.data) {
                        this.getAll();
                    }
                })
                .catch(err => {
                    console.log(err);
                });	
            }
        },
        saveChanges() {
            let data = {
                data: this.voucher_codes
            }
            axios.post(`/admin/vouchercodes/save`, data)
			.then(res => {
				if(res.data) {
                    this.voucher_codes = res.data;
                }
			})
			.catch(err => {
				console.log(err);
			});	
        }
    }
}
</script>

<style scoped>

.content-wrapper {
    padding-top: 65px;
}

.add-content-box {
     height: 70px;
     width: 100%;
     border: 3px dashed #ccc;
}

.rounded-add-btn {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    border: 3px dashed #ccc;
}

.add-btn-default {
    color: #ccc;
    transition: all 0.20s;
}

.add-btn-hovered {
    background-color: #ccc;
    color: #fff;
    transition: all 0.20s;
}

.fa-icon-custom {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.5em;
}
.paper-container {
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
	padding: 20px 25px 35px 25px;
	background-color: #fff;
	margin-top: 30px;
}
</style>
