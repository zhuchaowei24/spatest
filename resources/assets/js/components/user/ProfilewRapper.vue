<template>
    <div class="container">
        <el-container>
            <el-aside width="200px">
                <el-menu default-active="1-1" class="el-menu-vertical-demo">
                    <router-link :to="{name:'profile'}" exact>
                        <el-menu-item index="1-1">
                            <i class="el-icon-location"></i>
                            <span slot="title">
                                 个人资料
                            </span>
                        </el-menu-item>
                    </router-link>
                    <router-link :to="{name:'profile.editProfile'}">
                        <el-menu-item index="2">
                            <i class="el-icon-menu"></i>
                            <span slot="title">
                               修改资料
                            </span>
                        </el-menu-item>
                    </router-link>
                    <router-link :to="{name:'profile.editPassword'}">
                        <el-menu-item index="4">
                            <i class="el-icon-setting"></i>
                            修改密码
                        </el-menu-item>
                    </router-link>
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-news"></i>
                            <span slot="title">文章</span>
                        </template>
                    <el-menu-item-group>
                        <router-link :to="{name:'profile.pushPost'}">
                            <el-menu-item index="4-1">发布文章</el-menu-item>
                        </router-link>
                    </el-menu-item-group>
                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </div>
</template>
<style>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }
    .el-main {
        margin-left: 20px;
        background-color:white
    }
    .el-aside a:hover{
        text-decoration: none;
    }
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 600px;
    }
    .el-main{
        height:600px;
    }

</style>

<script>
    export default {
        data() {
            return {
                isCollapse: false
            };
        },
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>