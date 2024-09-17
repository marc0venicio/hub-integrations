function initialState() {
  return {
    entry: {
      id: null,
      name: '',
      platform: null,
      api_key: '',
      api_secret: '',
      first_route_name: '',
      second_route_name: '',
      access_token: '',
      refresh_token: '',
      expires_at: '',
      created_at: '',
      updated_at: '',
      deleted_at: ''
    },
    lists: {
      platform: []
    },
    loading: false
  }
}

const route = 'shops'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
  storeData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      axios
        .post(route, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      params.set('_method', 'PUT')
      axios
        .post(`${route}/${state.entry.id}`, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  setName({ commit }, value) {
    commit('setName', value)
  },
  setPlatform({ commit }, value) {
    commit('setPlatform', value)
  },
  setApiKey({ commit }, value) {
    commit('setApiKey', value)
  },
  setFirstUrl({ commit }, value) {
    commit('setFirstUrl', value)
  },
  setSecondUrl({ commit }, value) {
    commit('setSecondUrl', value)
  },
  setApiSecret({ commit }, value) {
    commit('setApiSecret', value)
  },
  setAccessToken({ commit }, value) {
    commit('setAccessToken', value)
  },
  setRefreshToken({ commit }, value) {
    commit('setRefreshToken', value)
  },
  setExpiresAt({ commit }, value) {
    commit('setExpiresAt', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setName(state, value) {
    state.entry.name = value
  },
  setPlatform(state, value) {
    state.entry.platform = value
  },
  setApiKey(state, value) {
    state.entry.api_key = value
  },
  setApiSecret(state, value) {
    state.entry.api_secret = value
  },
  setFirstUrl(state, value) {
    state.entry.first_route_name = value
  },
  setSecondUrl(state, value) {
    state.entry.second_route_name = value
  },
  setAccessToken(state, value) {
    state.entry.access_token = value
  },
  setRefreshToken(state, value) {
    state.entry.refresh_token = value
  },
  setExpiresAt(state, value) {
    state.entry.expires_at = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
