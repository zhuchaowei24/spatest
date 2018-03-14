<template>
<el-form ref="form"  label-width="80px">
    <el-form-item label="密码">
        <el-input v-model="password" type="password"></el-input>
    </el-form-item>
    <el-form-item label="确认密码">
        <el-input v-model="sure_password" type="password"></el-input>
    </el-form-item>
    <el-form-item>
        <el-button type="button" @click="onSubmit">立即更新</el-button>
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
                password:'',
                sure_password:''
            }
        },
        methods: {
            onSubmit() {
                let formDate = {
                    password:this.password,
                    sure_password:this.sure_password
                }
                this.$store.dispatch('updatePasswordRequest', formDate).then(response => {

                }).catch(error=>{

                })
            }
        }
    }
</script>