export default {
    setToken(token) {
        window.localStorage.setItem('jwt_token', token)
    },
    getToken() {
        window.localStorage.getItem('jwt_token');
    },
    removeToken() {
        window.localStorage.removeItem('jwt_token');
    }
}