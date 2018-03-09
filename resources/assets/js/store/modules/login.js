import JwtToken from './../../helpers/jwt'
import  * as types from './../mutation-type'
export default { //实时store
    actions : {
        loginRequest({dispatch},formData){
        return axios.post('/api/login', formData).then(response => {
                JwtToken.setToken(response.data.token)
                dispatch('setAuthUser')
            }).catch(error => {
                console.log(error.response.data)
            })
        },
        logoutRequest({dispatch}) {
            return  axios.get('/api/logout').then(response => {
                JwtToken.removeToken()
                dispatch('unsetAuthUser')
            })
        }
    }
}