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
        }
    },
    actions:{
       setAuthUser({commit,dispatch}){
           return axios.get('/api/user').then(response => {
               console.log(response.data[0])
               commit({
                   type:types.SET_AUTH_USER,
                   user:response.data
               })

           })
       },
        unsetAuthUser({commit}){
            commit({
                type:types.UNSET_AUTH_USER,
            })
        }
    }
}
