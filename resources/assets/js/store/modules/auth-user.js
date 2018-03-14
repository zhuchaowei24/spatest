import  * as types from './../mutation-type'
export default {
    state : {
        authenticated : false, //相当于一个标志，成功返回accesst_token
        name : null,
        email : null
    },
    mutations:{
        [types.SET_AUTH_USER](state,payload){ //更改状态
            state.authenticated = true
            state.name = payload.user.name
            state.email = payload.user.email
        },
        [types.UNSET_AUTH_USER](state,payload){ //更改状态
            state.authenticated = false
            state.name = null
            state.email = null
        },
        [types.UPDATE_PROFILE_NAME](state,payload){ //更改状态
            state.name = payload.value;
        },
        [types.UPDATE_PROFILE_EMAIL](state,payload){ //更改状态
            state.email = payload.value;
        }
    },
    actions:{
       setAuthUser({commit,dispatch}){
           return axios.get('/api/user').then(response => {
               commit({
                   type:types.SET_AUTH_USER,
                   user:response.data
               })
           }).catch(error => {
               dispatch('refreshToken')
           })
       },
        unsetAuthUser({commit}){
            commit({
                type:types.UNSET_AUTH_USER,
            })
        },
        refreshToken({commit,dispatch}){
            return axios.post('/api/token/refresh').then(response => {
                dispatch('loginSuccess', response.data)
            }).catch(error => {
                dispatch('logoutRequest')
            })
        },
    }
}
