export default {
    state: {
        isAuthenticated: false
    },
    mutations: {
        authenticate(state, token) {
            state.isAuthenticated = true;
            localStorage.setItem("accessToken", token);
            window.axios.defaults.headers.common['Authorization'] = "Bearer "+token;
        },
        unauthenticate(state) {
            state.isAuthenticated = false;
            localStorage.removeItem("accessToken");
            delete window.axios.defaults.headers.common['Authorization'];
        }
    }
}
