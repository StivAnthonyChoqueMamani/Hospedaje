import { createStore } from 'vuex'
import users from './modules/users'
import bedrooms from './modules/bedrooms'

export const store = createStore({
    modules: {
        users,
        bedrooms,
    },
})