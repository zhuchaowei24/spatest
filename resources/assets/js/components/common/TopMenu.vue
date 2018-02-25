 <template>
     <nav class="navbar navbar-default navbar-static-top">
     <div class="container">
         <div class="navbar-header">
             <router-link to="/" class="navbar-brand" tag="a">Vue spa</router-link>
         </div>
         <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav navbar-right">
                 <router-link to="/login" tag="li">
                     <a>登录</a>
                 </router-link>
                 <router-link to="/register" tag="li">
                     <a>注册</a>
                 </router-link>
             </ul>
         </div>
     </div>
     </nav>
</template>
<style>
</style>
<script>
    export default  {
    }
</script> 