import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'
import router from '../../router'

// state
export const state = {
    pageloader: false,
    user: null,
    org: null,
    token: Cookies.get('token'),
    register_msg : null,
    user_branch: false,
    domain: false,
}

// mutations
export const mutations = {
    changepageloader (state, n) {
        state.pageloader = n
    },

    [types.SAVE_TOKEN] (state, { token, remember }) {
        state.token = token
        Cookies.set('token', token, { expires: remember ? 365 : null })
    },

    [types.SAVE_DOMAIN] (state, { domain }) {
        state.domain = domain;
    },

    [types.FETCH_USER_SUCCESS] (state, { user }) {
        state.user = user;
        if(state.domain===false){
            state.domain=user.site;
        }

    },

    [types.FETCH_USER_FAILURE] (state) {
        state.token = null
        Cookies.remove('token')
    },

    [types.LOGOUT] (state) {
        state.user = null
        state.token = null
        state.domain= false
        Cookies.remove('token')
    },

    [types.UPDATE_USER] (state, { user }) {
        state.user = user
    },



    [types.REGISTER_USER_MSG] (state, {msg}){
        state.register_msg = msg
    }
}

// actions
export const actions = {
    saveToken ({ commit, dispatch }, payload) {
        commit(types.SAVE_TOKEN, payload)
    },

    saveDomain ({ commit }, payload) {
        commit(types.SAVE_DOMAIN, payload)
    },

    async fetchUser ({ commit }) {
        try {
            const data = await axios.get('/user');
            commit(types.FETCH_USER_SUCCESS, { user: data.data.user })
        } catch (e) {
            commit(types.FETCH_USER_FAILURE)
            router.push({name:'login'});
        }
    },

    async fetchUserNew ({ commit }) {
        try {
            const { data } = await axios.get('/user');
            commit(types.FETCH_USER_SUCCESS, { user: data.data.user })
        } catch (e) {
            commit(types.FETCH_USER_FAILURE)
            router.push({name:'login'});
        }
    },

    async refreshToken({commit}){
        try {
            await axios.get('/api/admin').then((response) =>{
                let auth = response.headers.authorization;
                let exp = auth.split(" ");
                commit(types.SAVE_TOKEN, { token: exp[1] })
            }).catch(function (error) {
                commit(types.FETCH_USER_FAILURE)
                router.push({name:'login'});
            });

        }catch (e) {
            commit(types.FETCH_USER_FAILURE)
            router.push({name:'login'});
        }
    },

    updateUser ({ commit }, payload) {
        commit(types.UPDATE_USER, payload)
    },

    async logout ({ commit }) {
        try {
            await axios.post('/logout_employee')
        } catch (e) { }
        commit(types.LOGOUT)
    },

    register({commit}, payload){
        commit(types.REGISTER_USER_MSG, payload);
    },


}

// getters
export const getters = {
    pageloader: state => state.pageloader,
    authUser: state => state.user,
    authToken: state => state.token,
    authCheck: state => state.user !== null,
    domain: state=>  state.domain,
    registerMsg: state => state.register_msg,
}
