import { createStore } from 'vuex';
import Velochoixstore from './modules/veloFeatures'
import createPersistedState from 'vuex-persistedstate';
export default createStore({
modules: {
    Velochoixstore
},
plugins: [createPersistedState()],
})