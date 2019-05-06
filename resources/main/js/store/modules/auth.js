import axios from 'axios'
import * as types from '../mutation-types'



// state
export const state = {
    pageloader: false,
    menu: false,
};

// mutations
export const mutations = {
    changepageloader (state, n) {
        state.pageloader = n
    },
    [types.SAVE_MENU] (state, { menu }) {
        state.menu = menu;
    },



};

// actions
export const actions = {
   async loadMenu ({ commit }) {
       const r = await axios.get('/menu/0');
       commit(types.SAVE_MENU, { menu: r.data.success })
    },


};


// getters
export const getters = {
    pageloader: state => state.pageloader,
    menu: state => state.menu,
}

