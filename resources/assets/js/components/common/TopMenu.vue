 <template>
     <el-container>
         <el-header>
             <el-col :span="6" style="height: 10px;"></el-col>
             <el-col :span="6">
                 <router-link to="/" class="navbar-brand" tag="a">Vue spa</router-link>
             </el-col>
             <el-col :span="6">
                 <ul class="right_ul">
                     <router-link v-if="!user.authenticated" to="/login" tag="li">
                         <a>登录</a>
                     </router-link>
                     <router-link  v-if="!user.authenticated"  to="/register" tag="li">
                         <a>注册</a>
                     </router-link>
                     <router-link  v-if="user.authenticated"  to="/profile" tag="li">
                         <a>{{user.name}}</a>
                     </router-link>
                     <li v-if="user.authenticated"tag="li">
                         <a @click.prevent="logout" href="#">退出</a>
                     </li>
                 </ul>
             </el-col>
             <el-col :span="6" style="height: 10px;"><div class="grid-content bg-purple"></div></el-col>
         </el-header>
     </el-container>
</template>
<style>
    .right_ul li{
        list-style: none;
        float: right;
        padding: 14px 15px;
        font-size: 18px;
        line-height: 22px;
        height: 50px;

    }

</style>
<script>
    import  {mapState} from 'vuex' //检测state数据 ,使用之前配置babelrc
    export default  {
        computed : {
            ...mapState({
                user : state=>state.AuthUser
            }),
        },
        methods:{
            logout(){
                this.$store.dispatch('logoutRequest').then(response => {
                    this.$router.push({name:"home"})
                })
            }
        }
    }
</script> 