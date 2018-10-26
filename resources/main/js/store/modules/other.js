
import * as types from '../mutation-types'
import router from '../../router'

// state
export const state = {
    drawer: localStorage.getItem('drawer'),
    breadcrumb_title: '',
    navgroup: localStorage.getItem('navgroup'),
    navgroup_sub: localStorage.getItem('navgroup_sub'),
    baseUrl : '',
    planStep: localStorage.getItem('planStep'),
    basePath: window.surl,
    imagePath: window.surl+"/img/",
    assetsPath: window.surl+"/resources/assets/",
    /*basePath: "http://www.ipadaspos.com/iRestaurant_v4",
    imagePath: "http://www.ipadaspos.com/iRestaurant_v4/uploads/",
    assetsPath: "http://www.ipadaspos.com/iRestaurant_v4/assets/",*/
    auser_org_id: 2,
    auser_id: 2,
}

// mutations
export const mutations = {
  	changedrawerstore (state, n) {
      	state.drawer = n;
        if (n) {
            localStorage.setItem('drawer', n);
        } else {
            localStorage.removeItem('drawer');
        }
  	},
    changenavgroup (state, n) {
        state.navgroup = n;
        if (n) {
            localStorage.setItem('navgroup', n);
        } else {
            localStorage.removeItem('navgroup');
        }
    },
    changenavgroup_sub (state, n) {
        state.navgroup_sub = n;
        if (n) {
            localStorage.setItem('navgroup_sub', n);
        } else {
            localStorage.removeItem('navgroup_sub');
        }
    },
    change_breadcrumb_title (state, n) {
        state.breadcrumb_title = n;
    },
    changeplanStep (state, n) {
        state.planStep = n;
        if (n) {
            localStorage.setItem('planStep', n);
        } else {
            localStorage.removeItem('planStep');
        }
    },
}

// actions
export const actions = {
}

// getters
export const getters = {
    drawer: state => state.drawer,
    navgroup: state => state.navgroup,
    navgroup_sub: state => state.navgroup_sub,
    breadcrumb_title: state => state.breadcrumb_title,
    baseUrl : state => state.baseUrl,
    auser_org_id : state => state.auser_org_id,
    auser_id : state => state.auser_id,
    imagePath : state => state.imagePath,
    assetsPath : state => state.assetsPath,
    planStep: state => state.planStep,
    basePath : state => state.basePath,
}
