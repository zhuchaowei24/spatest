<template>
    <form class="form-horizontal" @submit.prevent="register">


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
                <span class="help-block" v-show="errors.has('name')">{{errors.first('password')}}</span>
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
    export default {
        data(){
            return{
                password:"",
                email:""
            }
        },
        methods:{
            register(){
                let formData = {
                    client_id : '2',
                    client_secret : 'ddxd3wZLuVuEQe8k0anRmxDWmjE1pfVFvW4LOJVh',
                    grant_type : 'password',
                    scope : '',
                    username : this.email,
                    password : this.password
                }
                axios.post('/oauth/token', formData).then(response => {
                    JwtToken.setToken(response.data.access_token)
                    console.log(response.data)
                })
            }
        }
    }
</script> 