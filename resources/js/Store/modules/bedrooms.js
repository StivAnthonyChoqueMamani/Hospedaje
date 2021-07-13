const state = () => ({
    bedrooms: [],
    selectedBedroom: '',
})

const getters = {
    bedroomsAll: (state) => {
        return state.bedrooms
    },
    selectBedroom: (state) => {
        return state.selectBedroom
    },
}

const actions = {

}

const mutations = {
    setBedrooms(state, items) {
        state.bedrooms = items
    },
}

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
}