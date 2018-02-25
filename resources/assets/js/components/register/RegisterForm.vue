<template>
    <form class="form-horizontal" @submit.prevent="register">

        <div class="form-group" :class="{'has-error': errors.has('name')}">
            <label for="name" class="col-md-4 control-label">用户名</label>
            <div class="col-md-6">
                <input v-validate
                    data-vv-rules="required|min:6" data-vv-as="用户名"
                    type="text" v-model="name" id="name" class="form-control" name="name" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('name')}}</span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('email')}">
            <label for="name" class="col-md-4 control-label">邮箱</label>
            <div class="col-md-6">
                <input type="text" v-validate
                       data-vv-rules="required|email" data-vv-as="邮箱"
                       v-model="email" id="email" class="form-control" name="email" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('email')}}</span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('password')}">
            <label for="name" class="col-md-4 control-label">密码</label>
            <div class="col-md-6">
                <input type="password" v-validate
                       data-vv-rules="required|min:6" data-vv-as="密码"
                       v-model="password " id="password" class="form-control" name="password" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('password')}}</span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('password-confirm')}">
            <label for="name" class="col-md-4 control-label">确认密码</label>
            <div class="col-md-6">
                <input type="text" v-validate
                       data-vv-rules="required|min:6|confirmed:password" data-vv-as="确认密码"
                       id="password-confirm" class="form-control" name="password-confirm" required>
                <span class="help-block" v-show="errors.has('name')">{{errors.first('password-confirm')}}</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</template>
<style>
</style>
<script>
    export default {
        data(){
            return{
                name:"",
                password:"",
                email:""
            }
        },
       methods:{
           register(){
               let formData = {
                   name : this.name,
                   email : this.email,
                   password : this.password
               }
               axios.post('/api/register', formData).then(response => {
                    console.log('register success')
                   this.$router.push({name:'confirm'})
               })
           }
       }
    }
</script> 