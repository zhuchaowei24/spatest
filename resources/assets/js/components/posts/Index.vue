<template>
    <div class="row">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="发布时间">
                <el-col :span="6">
                    <el-date-picker type="datetime" placeholder="选择开始时间" v-model="form.date1" style="width: 100%;"></el-date-picker>
                </el-col>
                <el-col class="line" :span="1" style="text-align: center">至</el-col>
                <el-col :span="6">
                    <el-date-picker type="datetime" placeholder="选择结束时间" v-model="form.date2" style="width: 100%;"></el-date-picker>
                </el-col>
                <el-col class="line" :span="1" style="text-align: center">&nbsp;</el-col>
                <el-col class="line" :span="1" style="font-weight: bold;">发表者</el-col>
                <el-col class="line" :span="4"><el-input v-model="form.name"></el-input></el-col>
                <el-col class="line" :span="4">
                    <el-col class="line" :span="1" style="text-align: center">&nbsp;</el-col>
                    <el-button type="primary" @click="onSubmit">立即搜索</el-button>
                </el-col>
            </el-form-item>
        </el-form>
        <el-table
                :data="tableData"
                :default-sort = "{prop: 'date', order: 'descending'}"
                @sort-change="handleSelectionChange"
                style="width: 100%">
            <el-table-column
                    prop="created_at"
                    label="发表时间"
                    sortable="created_at"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="发表者"
                    width="350">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标题">
            </el-table-column>
            <el-table-column  width="130">
            <template slot-scope="scope">
                <el-button @click="handleClick(scope.row.id)" type="text" size="small">查看</el-button>
            </template>
            </el-table-column>
        </el-table>

        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :page-sizes="[10, 20, 30, 40]"
                :page-size="pagesize"
                layout="total, sizes, prev, pager, next, jumper"
                :total=parseInt(total)>
        </el-pagination>
    </div>
</template>

<script>
    import Posts from './../posts/Index.vue'
    export default {
        methods: {
            handleSizeChange(val) {  //每一页多少条
                this.pagesize = val
                let data = {size:this.pagesize,
                    order:this.order,
                    cloumn:this.cloumn,
                    date_begin:this.form.date1,
                    date_end:this.form.date2,
                    name:this.form.name};
                axios.post('/api/posts?page='+this.page,data).then(response => {
                    this.tableData = response.data.data
                    this.total = response.data.total
                })
            },
            handleCurrentChange(val) {  //当前第几页
                let data = {size:this.pagesize,
                    order:this.order,
                    cloumn:this.cloumn,
                    date_begin:this.form.date1,
                    date_end:this.form.date2,
                    name:this.form.name};
                this.page = val;
                axios.post('/api/posts?page='+this.page,data).then(response => {
                    this.tableData = response.data.data
                    this.total = response.data.total
                })
            },
            handleClick(id) {
                this.$router.push({name:"posts", params: {id:id}})
            },
            handleSelectionChange(val){ //排序时候
                this.cloumn = val.prop;
                this.order = val.order;
                let data = {size:this.pagesize,
                    order:this.order,
                    cloumn:this.cloumn,
                    date_begin:this.form.date1,
                    date_end:this.form.date2,
                    name:this.form.name};
                axios.post('/api/posts?page='+this.page,data).then(response => {
                    this.tableData = response.data.data
                    this.total = response.data.total
                })
            },
            onSubmit(){
                let data = {size:this.pagesize,
                    order:this.order,
                    cloumn:this.cloumn,
                    date_begin:this.form.date1,
                    date_end:this.form.date2,
                    name:this.form.name};
                axios.post('/api/posts?page='+this.page,data).then(response => {
                    this.tableData = response.data.data
                    this.total = response.data.total
                })
            }
        },
        mounted() {
            axios.post('/api/posts').then(response => {
                this.tableData = response.data.data
                this.total = response.data.total
            })
        },
        data() {
            return {
                order:'descending',
                cloumn:'',
                pagesize:10,
                page:1,
                total:0,
                everyPage : 10,
                currentPage1: 5,
                currentPage2: 5,
                currentPage3: 5,
                currentPage4: 4,
                tableData:[],
                form: {
                    name: '',
                    date1: '',
                    date2: '',
                }
            }
        }
    }
</script>
