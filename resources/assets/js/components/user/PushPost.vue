<template>
<el-form ref="form"  label-width="80px">
    <el-form-item label="标题">
        <el-input v-model="title" type="text"></el-input>
    </el-form-item>
    <el-form-item label="内容">
        <el-input type="textarea" v-model="content"></el-input>
    </el-form-item>
    <!--<div class="block">-->
        <!--<span class="demonstration">默认不区分颜色</span>-->
        <!--<el-rate v-model="value1"></el-rate>-->
    <!--</div>-->
    <el-form-item>
        <el-button type="button" @click="onSubmit">立即发布</el-button>
    </el-form-item>
</el-form>
</template>
<script>
    import {mapState} from  'vuex'
    import  * as types from './../../store/mutation-type'
    import { Notification } from 'element-ui';
    export default {
        data(){
            return {
                title:'',
                content:'',
                value1:null
            }
        },
        methods: {
            onSubmit() {
                let formDate = {
                    title:this.title,
                    content:this.content
                }
                axios.post('/api/user/post/push', formDate).then(response => {
                    if(response.data.success){
                        Notification({
                            title: '操作成功啦~~！',
                            type: 'success',
                            message: response.data.msg,
                            duration: 5000
                        })
                    } else {
                        Notification({
                            title: '操作失败~~！',
                            type: 'error',
                            message: response.data.msg,
                            duration: 5000
                        })
                    }
                }).catch(error=>{

                })
            }
        }
    }
</script>