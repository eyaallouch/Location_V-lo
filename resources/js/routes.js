//import Home from './components/Home.vue';
import Menu from "./components/Menu.vue";
import MenuUser from "./components/MenuUser.vue";
import Accueil from "./components/accueil.vue";
import ViewVelos from "./components/Velos/Viewvelos.vue";
import ViewModeles from "./components/Velos/ViewModeles.vue";
import AddVelosModal from "./components/Velos/AddVelosModal.vue";
import AddModelesModal from "./components/Velos/AddModelesModal.vue";
import Login from "./components/authentification/login.vue";
import Register from "./components/authentification/register.vue";
import ConsulterVelos from "./components/reservation/consulterVelos.vue";
import FormulaireReservation from "./components/reservation/formulaireReservation.vue";
import FormulaireConfirmation from "./components/reservation/formulaireConfirmation.vue";
import Payment from "./components/payement/Payment.vue";
export const routes = [
       
    {
        name: "formulaireReservation",
        path: "/formulaireReservation",
        component: FormulaireReservation
        
    },
    {
        name: "login",
        path: "/login",
        component: Login,
    },
    {
        name: "register",
        path: "/register",
        component: Register,
    },

    {
        name: "menu",
        path: "/menu",
        component: Menu,
      //  meta:{isAuth:true}
    },
    {
        name: "menuUser",
        path: "/menuUser",
        component: MenuUser,
    },
    {
        name: "addVelosModal",
        path: "/AddVelosModal",
        component: AddVelosModal,
    },
    {
        name: "viewvelos",
        path: "/ViewVelos",
        component: ViewVelos,
     //   meta:{isAuth:true}
    },
    {
        name: "viewModeles",
        path: "/ViewModeles",
        component: ViewModeles,
       // meta:{isAuth:true}
    },

    {
        name: "addModelesModal",
        path: "/AddModelesModal",
        component: AddModelesModal,
    },
    {
        name: "accueil",
        path: "/accueil",
        component: Accueil,
    },
    {
        name: "consulter",
        path: "/consulterVelos",
        component: ConsulterVelos,
    },
    {
        name: "formulaireConfirmation",
        path: "/formulaireConfirmation",
        component: FormulaireConfirmation,
    },
    {
        path:'/payment',
        name:'Payment',
        component:Payment
        },
];
