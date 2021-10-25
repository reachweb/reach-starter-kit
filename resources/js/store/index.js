import { createStore, createLogger } from 'vuex'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
    // initial state
    state() { 
        return {
            isLarge: '',
            isMedium: '',
            width: '',
            height: '',
            trans: '',
            menu: false,
            collapse: false
        }
    },

    // getters
    getters: {
        isLarge(state) {
            return state.isLarge
        },
        isMedium(state) {
            return state.isMedium
        },
        width(state) {
            return state.width
        },
        height(state) {
            return state.height
        },
        trans(state, key) {
            return _.get(state.trans, key, key);
        },
        getMenu(state) {
            return state.menu
        },
    },

    // mutations
    mutations: {
        setLarge(state, payload) {
            state.isLarge = payload
        },
        setMedium(state, payload) {
            state.isMedium = payload
        },
        setWidth(state, payload) {
            state.width = payload
        },
        setHeight(state, payload) {
            state.height = payload
        },
        setTrans(state, payload) {
            state.trans = payload
        },
        toggleMenu(state) {
            state.menu = !state.menu
        },
    },

    actions: {
        breakpoint(context) {
            context.commit('setMedium', window.matchMedia('(min-width: 45em)').matches)
            context.commit('setLarge', window.matchMedia('(min-width: 80em)').matches)
            context.commit('setWidth', window.innerWidth)
            context.commit('setHeight', window.innerHeight)
        }
    },

    plugins: debug ? [createLogger()] : [],
})