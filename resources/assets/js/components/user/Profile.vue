<template>
    <div style="width:100%;height: 100%">
        <el-row>
            <el-col :span="4"><i class="el-icon-star-on"></i></el-col>
            <el-col :span="20">
                {{user.name}}
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="4"><i class="el-icon-loading"></i></el-col>
            <el-col :span="20">
                {{user.email}}
            </el-col>
        </el-row>
    </div>
</template>
<style>
</style>
<script>
    import {mapState} from  'vuex'
    export default {
        created(){
            this.$store.dispatch('setAuthUser');
        },
        computed:{
            ...mapState({
                user: state => state.AuthUser
            })
        }
    }
</script> 