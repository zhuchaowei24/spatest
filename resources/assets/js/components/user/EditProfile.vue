<template>
<el-form ref="form"  label-width="80px">
    <el-form-item label="用户名">
        <el-input v-model="name"></el-input>
    </el-form-item>
    <el-form-item label="邮箱">
        <el-input v-model="email"></el-input>
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
        created(){
            this.$store.dispatch('setAuthUser');
        },
        computed:{
           name:{
               get(){
                   return this.$store.state.AuthUser.name;
               },
               set(value){
                   this.$store.commit({
                       type:types.UPDATE_PROFILE_NAME,
                       value:value
                   })
               }
           },
            email:{
                get(){
                    return this.$store.state.AuthUser.email;
                },
                set(value){
                    this.$store.commit({
                        type:types.UPDATE_PROFILE_EMAIL,
                        value:value
                    })
                }
            }
        },
      methods: {
          onSubmit() {
              const  formDate = {
                  name:this.name,
                  email:this.email
              }
              this.$store.dispatch('updateProfileRequest', formDate).then(response => {
                  Notification({
                      title: '资料修改成功啦~~！',
                      type: 'success',
                      message: '资料修改成功啦',
                      duration: 5000
                  })
//                  this.$router.push({name:'profile'})
              }).catch(error=>{

              })
          }
      }
    }
</script>