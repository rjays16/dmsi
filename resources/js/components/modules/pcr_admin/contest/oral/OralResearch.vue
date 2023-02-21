<template>
    <div>
        <div class="content-wrapper">
            <div class="admin-page-title bg-white p-3">
                <i class="el-icon-s-home"></i>
                <span> / Contest / Oral Research Entries</span>
            </div>
            <div class="container-fluid pb-5">
                <div class="admin-conent bg-white my-5 mx-3 p-4">
                    <span class="table-title">Oral Research Entries</span>
                    <el-button @click="showAddModal" type="primary" size="mini" class="sponsors-add-btn ml-3">Add Entry</el-button>
                        <el-table
                            stripe
                            :data="oralResearchs"
                            class="enrolled-sponsors-table mt-2"
                            :default-sort = "{prop: 'updated_at', order: 'descending'}"
                            style="width: 100%">
                            <el-table-column
                                prop="contest_title"
                                label="Title">
                            </el-table-column>
                            <el-table-column
                                prop="contest_author"
                                label="Author"
                                 width="120"
                                >
                            </el-table-column>
                            <el-table-column
                                prop="contest_institution"
                                label="Institution"
                                 width="120"
                                >
                            </el-table-column>
                            <el-table-column
                                prop="contest_pdf"
                                label="PDF File"
                                 align="center"
                                width="100"
                                >
                                <template slot-scope="scope">
                                    <a :href="getPDFSrc(scope.row.contest_pdf)" target="_blank"><span class="material-icons">picture_as_pdf</span></a>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="rank_number"
                                label="Ranking"
                                 align="center"
                                 width="110"
                                >
                                 <template slot-scope="scope">
                                    <h5>
                                    <span class="badge" :class="rankBadgeColor(scope.row.rank_number)">
                                         {{rankDetail(scope.row.rank_number)}}
                                    </span>
                                    </h5>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="actions"
                                label="Actions"
                                align="right"
                                width="150">
                                <template slot-scope="scope">
									<el-button
										class="btn-product-edit mx-2"
										@click="showEditModal(scope.row)"
										icon="el-icon-edit"
										type="text"
									></el-button>
									<el-button
										class="btn-product-delete mx-2"
										@click="showDeleteModal(scope.row)"
										icon="el-icon-delete"
										type="text"
									></el-button>
                                     <el-button
										class="btn-product-edit mx-2"
										@click="showRankModal(scope.row)"
										icon="el-icon-medal"
										type="text"
									></el-button>
								</template>
                            </el-table-column>
                        </el-table>
                </div>
            </div>
        </div>
        <add-oral-modal v-if="openModal"
        @closeModal="closeAddModal">
        </add-oral-modal>

        <EditOralModal ref="editOralModalRefs"></EditOralModal>
        <SetOralRank ref="setRankModalRef"></SetOralRank>

        <el-dialog
            :title="`Are you sure you want to delete an Entry?`"
            :visible.sync="deletePDFDialogVisibile"
            :close-on-click-modal="false"
            align="center"
        >
            <div class="text-center">
                <el-button type="primary" size="small" @click="deleteEntry()"
                    >Confirm</el-button
                >
            </div>
        </el-dialog>
    </div>
</template>

<script>
import addOral from './AddOralModal';
import EditOralModal from './EditOralModal';
import SetOralRank from './SetOralRank';
import { required, integer } from 'vuelidate/lib/validators/'
export default {
    components: {
        'add-oral-modal': addOral,
        EditOralModal,
        SetOralRank,
    },
    data() {
        return {
            openModal: false,
            oralResearchs: [],
            oralResearch: null,
            token: '',
            currentURL: window.location.origin + '/',
            deletePDFDialogVisibile: false,
            entrytDeleteId: null,
			entryDeleteName: "",
        }
    },
    methods: {
         rankDetail(data){
            if(data == 0){
                return ''
            }else{
                return 'Rank no. '+data;
            }
        },

        rankBadgeColor(data){
            if(data == 0){
                return ''
            }else{
                if(data == 1){
                    return 'badge-1st';
                }else if ( data == 2){
                    // return 'badge-2nd';
                    return 'badge-secondary';
                }else if ( data == 3){
                    return 'badge-3rd';
                }else{
                    return 'badge-light';
                }
            }
        },
        showEditModal(data){
            this.$refs.editOralModalRefs.showModal(data);
        },
         showRankModal(data){
            this.$refs.setRankModalRef.showModal(data);
        },
        getTokenCookie() {
            var token = 'token'
            var match = document.cookie.match(new RegExp('(^| )' + token + '=([^;]+)'))
            if (match) {
                this.token = match[2].replace('%7C', '|')
                console.log(this.token)
            }
            else{
                console.log('No token found');
            }
        },
        getAllEntries() {
            axios.get(`/api/contest/item/getOralResearch`, {
                headers: { Authorization: "Bearer " + this.token }
            })
			.then(res => {
				if(res.data) {
                    this.oralResearchs = res.data;
                    console.log(res.data)
                }
			})
			.catch(err => {
				console.log(err);
			});
        },
        getCurrentURL() {
            var currentUrl = window.location.href
            // console.log('go: ' + currentUrl)
            if (currentUrl.includes('127.0.0.1')) {
                this.thisServerUrl = '/'
            } else if (currentUrl.includes('beta2')) {
                this.thisServerUrl = 'https://beta2.pcrmembership.com/'
            } else {
                this.thisServerUrl = 'https://pcrmembership.com/'
            }
            // console.log(this.thisServerUrl)
            // this.thisServerUrl = 'https://73rdpcrannualconvention.com/'
        },
        getPDFSrc(pdf) {
            if (pdf) {
                var image = pdf.replace('public', 'storage')
                var image_src = this.currentURL + image
                return image_src
            }
        },
        showDeleteModal(data) {
            console.log(data);
            this.entrytDeleteId = data.id;
            this.entryDeleteName = data.contest_pdf;
            this.deletePDFDialogVisibile = true;
        },
        deleteEntry() {
            axios
                .delete(`/api/contest/item/oral/${this.entrytDeleteId}`, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .then((res) => {
                    this.deletePDFDialogVisibile = false;
                    window.location.href = '/admin/contest/oral-research'
                    this.$message.success("Successfully Deleted.");
                })
                .catch((err) => {
                    console.error(err);
                    this.$message.error("Something went wrong.");
                });
        },
        showAddModal() {
            this.openModal = true;
        },
        closeAddModal() {
            this.openModal = false;
            this.oralResearch = null;
        },
    },
	mounted() {
        this.getTokenCookie()
        this.getAllEntries()
	}
}
</script>

<style scoped>
    .badge-1st {
            color: black;
            background-color: #FFD700;
    }
    .badge-2nd {
            color: #fff;
            background-color: #C0C0C0;
    }
    .badge-3rd {
            color: #fff;
            background-color: #cd7f32;
    }

</style>

<style>

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
.admin-conent .table-title {
    color:#174A84;
    font-size:1rem;
    font-weight:bold;
    margin-bottom:20px;
}
.enrolled-sponsors-table th .cell {
    color:#131313;
}
.sponsors-add-btn {
    background:#0c015d!important;
    border-color:#0c015d!important;
}
.edit-sponsor-dialog .el-dialog {
    margin-top:5vh!important;
}
.edit-sponsor-dialog .el-dialog__body {
    padding-top:10px;
}
.edit-sponsor-dialog .el-dialog__title {
    font-weight:bold;
    color:#174A84;
}
.material-icons {
    color:#dc1d00;
}
</style>
