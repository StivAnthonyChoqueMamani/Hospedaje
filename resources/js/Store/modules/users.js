const state = () => ({
    users: [],
    selectedUser: '',
})

const getters = {
    usersAll: (state) => {
        return state.users
    },
    selectedUser:(state)=>{
        return state.selectedUser
    },
}

const actions = {
    
}

const mutations = {
    modifySelectedUser(state, item) {
        const index = state.users.findIndex(user => user.id === item.id)
        state.users[index] = item
    },
    setUsers(state, items) {
        state.users = items
    },
    select_a_user_of_users_by_id (state, id){
        state.selectedUser = state.users.find(user => user.id === id)
    },
}

export default {
    namespace: true,
    state,
    getters,
    mutations,
    actions,
}
