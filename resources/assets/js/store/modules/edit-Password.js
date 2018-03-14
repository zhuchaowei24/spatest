import JwtToken from './../../helpers/jwt'
import  * as types from './../mutation-type'
import { Notification } from 'element-ui';
export default { //实时store
    actions : {
        updatePasswordRequest({dispatch},formData){
        return axios.post('/api/user/password/update', formData).then(response => {
                if(response.data.status){
                    Notification({
                        title: '密码修改成功啦~~！',
                        type: 'success',
                        message: '密码修改成功啦',
                        duration: 5000
                    })
                } else {
                    Notification({
                        title: '密码修改失败~~！',
                        type: 'error',
                        message: '密码修改成功啦，两个密码不一致',
                        duration: 5000
                    })
                }
            }).catch(error=>{

            })
        }
    }
}