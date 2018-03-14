import JwtToken from './../../helpers/jwt'
import  * as types from './../mutation-type'
export default { //实时store
    actions : {
        updateProfileRequest({dispatch},formData){
        return axios.post('/api/user/profile/update', formData).then(response => {

            }).catch(error=>{

            })
        }
    }
}