
<template>
    <div
		class="modal fade"
		id="setRankOralModal"
		tabindex="-1"
		role="dialog"
        v-loading.fullscreen.lock="fullscreenLoading"
        >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5>Set Rank</h5>
                    <div class="box-tools pull-right">
                        <button type="button" data-dismiss="modal" data-toggle="tooltip" title="Close" class="btn btn-box-tool"><i class="ti-close"></i></button>
                    </div>
				</div>
				<div class="modal-body modal-body-padding mt-2">
                    <div class="form-group form-input-spacing">
                        <label>Rank No.</label>
                        <input type="text" class="form-control" v-model="data.rank_number" @keypress="onlyNumber">
                        <div>Note: Rank number <i>0</i> is not belong in the winners list.</div>
                    </div>
				</div>
				<div class="modal-footer d-block border-0 text-center">
					<el-button type="primary" @click="setRank()" size="small">Set Rank</el-button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    data() {
        return {
            fullscreenLoading: false,
            token: this.$cookies.get("token"),
            data: {
                id: null,
                rank_number: 0,
            }
        }
    },
    methods: {
        showModal(data){
              this.data.id = data.id;
              this.data.rank_number = data.rank_number;
              $("#setRankOralModal").modal('show');
        },
        setRank(){
            this.fullscreenLoading = true;
            let formBody = new FormData();
            formBody.append("id", this.data.id);
            formBody.append("rank_number", this.data.rank_number);
            axios.post('/api/contest/setRank', formBody, {
					headers: {
						Authorization: "Bearer " + this.$cookies.get("token"),
					},
				})
				.then((res) => {
					this.$message.success("Successfully Set Rank.");
					this.fullscreenLoading = false;
                    this.data.id = null;
                    this.data.rank_number = 0;
                     this.$parent.getAllEntries();
                    $("#setRankOralModal").modal('hide');
				})
				.catch((err) => {
					console.log(err);
					this.$message.error(
						"Something went wrong. Please contact support. " + err
					);
					this.fullscreenLoading = false;
				});


        },
        onlyNumber($event) {
				//console.log($event.keyCode); //keyCodes value
				let keyCode = $event.keyCode ? $event.keyCode : $event.which;
				if (keyCode < 48 || keyCode > 57) {
					// 46 is dot
					$event.preventDefault();
				}
			},
    }
}
</script>

<style scoped>
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
