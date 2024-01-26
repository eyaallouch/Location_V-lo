const state = {
//     cart:[],
// cartTotal:0,
    velo: [],
};
const mutations = ({
    clearState(state) {
        state.velo = [];

        return true;
    },
    addVelo(state, payload) {
        const productInCartIndex = state.velo.findIndex(
            (item) => item.id_velo === payload.id_velo
        );
        if (productInCartIndex < 0) {
            state.velo.push(payload);
            //calculating the total
            // state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
            //     return (
            //         parseFloat(cartTotal) +
            //         parseFloat(cartItem.product.prix * cartItem.qty)
            //     );
            // }, 0);
        }
    },

   // removeFromVelo(state,payload){

        //state.velo = state.velo.filter(function( cartItem ) {
       // return cartItem.id_velo !== payload.id_velo;
       // });
        //calculating the total
        // state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
        // return parseFloat(cartTotal) +
        // parseFloat(cartItem.product.prix*cartItem.qty);
        // }, 0);
       // },
});
export default {
    namespaced: true,
    state,
    mutations
    }
