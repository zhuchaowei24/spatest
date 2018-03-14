<template>
    <div>
        <top-menu></top-menu>
        <transition name="fade" mode="out-in">
            <router-view style="margin-top: 30px;"></router-view>
        </transition>
    </div>
</template>
<style>
</style>
<script>
    import TopMenu from './common/TopMenu'
    import jwtToken from './../helpers/jwt'
    import Cookie from 'js-cookie'
    export default {
        created(){
          if (jwtToken.getToken()) {
              this.$store.dispatch('setAuthUser')
          } else if(Cookie.get('auth_id')) {
              this.$store.dispatch('refreshToken')
          }
        },
        components:{
            TopMenu
        }
    }
</script> 