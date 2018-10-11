import * as types from '../mutation-types'
import router from '../../router'

var select_lang_key = 'mn';
var version_key = 'mn';

// if (localStorage.getItem('lang_key')) {
//     select_lang_key = localStorage.getItem('lang_key');
// }

let fileni = require.context('../../lang', true, /\.js$/)
const modules = {}

fileni.keys().forEach((key) => {

    var neg = key.replace(/(\.\/|\.js)/g, '')

    // console.log(neg.includes('en/'));

    if (neg.includes(select_lang_key+'/')) {
        modules[ neg.replace(select_lang_key+'/', '') ] = fileni(key)
    }
    // if (localStorage.getItem('lang_key')) {
        
    // } else {
        
    // }
})

// console.log(modules)

// state
export const state = {
    lang: modules,
    selected_lang: select_lang_key,
    version_lang: version_key,
}

// mutations
export const mutations = {
}

// actions
export const actions = {
}

// getters
export const getters = {
    lang: state => state.lang,
    selected_lang: state => state.selected_lang,
    version_lang: state => state.version_lang,
}
