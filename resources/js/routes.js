import Login from './components/Login'
import Home from './components/Welcome'

export default {
    mode: 'history',

    routes: [
        {
            path:'/',
            component: Home
        },
        {
            path:'/login',
            component: Login
        },
    ]
}
