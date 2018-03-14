<template>
    <form class="form-horizontal" @submit.prevent="login">
        <div class="form-group" :class="{'has-error': errors.has('email')}">
            <label for="email" class="col-md-4 control-label">邮箱</label>
            <div class="col-md-6">
                <input type="text" v-validate
                       data-vv-rules="required|email" data-vv-as="邮箱"
                       v-model="email" id="email" class="form-control" name="email" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('email')}}</span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('password')}">
            <label for="password" class="col-md-4 control-label">密码</label>
            <div class="col-md-6">
                <input type="password" v-validate
                       data-vv-rules="required|min:6" data-vv-as="密码"
                       v-model="password " id="password" class="form-control" name="password" required>
                <span class="help-block" v-show="errors.has('password')">{{errors.first('password')}}</span>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    登录
                </button>
            </div>
        </div>
    </form>
</template>
<style>
</style>
<script>
    import JwtToken from './../../helpers/jwt'
    import { Notification } from 'element-ui';
    export default {
        data(){
            return{
                password:"",
                email:""
            }
        },
        methods:{
            login(){
                this.$validator.validateAll().then(result => {
                    if (result) {
                        let formData = {
                            email : this.email,
                            password : this.password
                        }
                        this.$store.dispatch('loginRequest',formData).then(response => {
                            Notification({
                                title: '登录成功啦~~！',
                                type: 'success',
                                message: '恭喜您登录成功啦',
                                duration: 5000
                            })
                            this.$router.push({name:"profile"})
                        }).catch(error => {
                            this.$message({
                                showClose: true,
                                message: '错了哦，密码有误',
                                type: 'error'
                            });
                        })
                    }
                })
            }
        }
    }
</script> 