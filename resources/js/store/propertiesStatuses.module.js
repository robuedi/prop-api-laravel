export default {
    namespaced: true,

    state: {
        statuses: [],
    },

    getters: {
        statuses (state) {
            return state.statuses
        }
    },

    mutations: {
        SET_STATUSES (state, value) {
            state.statuses = value
        }
    },

    actions: {
        async getStatuses ({ dispatch, commit }) {
            if(this.state.statuses)
            {
                return
            }

            await axios.get('/api/v1/property-statuses?fields=id,label').then((response) => {
                commit('SET_STATUSES', response.data.data)
            }).catch(() => {
                commit('SET_STATUSES', [])
            })
        },
    }
}
