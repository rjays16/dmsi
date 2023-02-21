<template>
    <div
		class="modal fade"
		id="voucherCodeForm"
		tabindex="-1"
		role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5>Create</h5>
				</div>
				<div class="modal-body modal-body-padding mt-2">
					<div class="form-group form-input-spacing">
                        <label>Voucher Code</label>
                        <input type="text" class="form-control" v-model="data.voucher_code">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="data.description">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Discount Amount</label>
                        <input type="number" class="form-control" v-model="data.discount_amt">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Max Usage</label>
                        <input type="number" class="form-control" v-model="data.max_usage">
                    </div>
                    <div class="form-group form-input-spacing">
                        <label>Note</label>
                        <input type="text" class="form-control" v-model="data.note">
                    </div>
				</div>
				<div class="modal-footer d-block border-0 text-center">
					<button type="button" class="btn btn-outline-success btn-sm font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm font-weight-bold" data-dismiss="modal" @click="update" :disabled="!validate" v-if="is_edit">Update</button>
					<button type="button" class="btn btn-success btn-sm font-weight-bold" data-dismiss="modal" @click="create" :disabled="!validate" v-else>Create</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        item_data: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            data: {
                voucher_code: null,
                description: null,
                max_usage: null,
                discount_amt: null,
                note: null
            }
        }
    },
    computed: {
        validate() {
            if(
                this.data.voucher_code &&
                this.data.description &&
                this.data.max_usage &&
                this.data.discount_amt
            ) {
                return true;
            } else {
                return false;
            }
        },
        is_edit() {
            return this.item_data ? true : false;
        }
    },
    mounted() {
        this.initData();
        $("#voucherCodeForm").modal();
        $("#voucherCodeForm").on("hidden.bs.modal", () => {
            this.$emit('closeModal');
        });
    },
    methods: {
        initData() {
            if(this.item_data) {
                this.data.id = this.item_data.id;
                this.data.voucher_code = this.item_data.voucher_code;
                this.data.description = this.item_data.description;
                this.data.max_usage = this.item_data.max_usage;
                this.data.discount_amt = this.item_data.discount_amt;
                this.data.note = this.item_data.note;
            }
        },
        create() {
            this.$emit('create', this.data);
        },
        update() {
            this.$emit('update', this.data);
        }
    }
}
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
