import JwtToken from './../../helpers/jwt'
import  * as types from './../mutation-type'
export default { //实时store
    actions : {
        loginRequest({dispatch},formData){
        return axios.post('/api/login', formData).then(response => {
                JwtToken.setToken(response.data.token)
                dispatch('setAuthUser', response.data)
            })
        },
        logoutRequest({dispatch}) {
            return  axios.get('/api/logout').then(response => {
                JwtToken.removeToken()
                dispatch('unsetAuthUser')
            })
        },
        loginSuccess({dispatch}, tokenResponse){
            JwtToken.setToken(tokenResponse.token)
            JwtToken.setAuthId(tokenResponse.auth_id)
            dispatch('setAuthUser')
        },
    }
}