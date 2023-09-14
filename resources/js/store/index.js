import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({
state: {
    firstName: 'John',
    lastName: 'Doe',
    role:'',

    authenticated: false,
    user:{}
  },

getters: {
  getRole(state) {
    return state.role;
  },

  authenticated(state){
    return state.authenticated
  },
  user(state){
    return state.user
  }
},

mutations: {
  changeRole(state,payload){
    state.role = payload;
  },

  SET_AUTHENTICATED (state, value){
    state.authenticated = value
  },
  SET_USER(state,value){
    state.user = value
  }
},
actions: {
  changeRole(context,payload){
    context.commit("changeRole",payload);
  },

  login({commit}){
    return axios.get('/api/user').then(({data}) => {
      commit('SET_USER', data)
      commit('SET_AUTHENTICATED', true)
      router.push({name:'dashboard'})
    }).catch(({response:{data}}) =>{
      commit('SET_USER', {})
      commit('SET_AUTHENTICATED', false)
    })

  },

  logout({commit}){
    commit('SET_USER',{})
    commit('SET_AUTHENTICATED', false)
  }

}
})
