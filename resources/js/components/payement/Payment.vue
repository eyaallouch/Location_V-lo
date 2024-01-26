<template>
    <div class="centered-container">
        <Toast />
        <form @submit.prevent="addClientAndPayement" class="client-form">
            <div class="form-group">
                <label for="cin">CIN :</label>
                <input
                    type="text"
                    id="cin"
                    v-model="client.cin"
                    class="form-control"
                    required
                />
            </div>
            <div class="form-group">
                <label for="age">Âge :</label>
                <input
                    type="number"
                    id="age"
                    v-model="client.age"
                    class="form-control"
                    required
                />
            </div>
            <div class="form-group">
                <label for="number">Numéro de téléphone :</label>
                <input
                    type="text"
                    id="number"
                    v-model="client.number"
                    class="form-control"
                    required
                />
            </div>
            
           
                <div class="card" style="width: 50rem">
                    <div class="card-body">
                        <h5 class="card-title">
                            Montant à payer : {{ amount }} TND
                        </h5>
                        <br />
                        <div class="card-text">
                            <div class="form-group">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="email"
                                    v-model="email"
                                />
                            </div>
                            <br />
                        </div>
                        <div id="card-element"></div>
                        <br />
                   
                    </div>
                </div>
           
            <button type="submit" >Envoie</button>
        </form>
        

    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { loadStripe } from "@stripe/stripe-js";
import store from "../../store";
import api from "../config/api";
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";
import { useRoute ,useRouter} from "vue-router";
const toast = useToast();
 const loc=ref({
    id_client:0,
    id_velo:0,
    datedebut:"",
    datefin:""
  } );
const route = useRoute();
const router = useRouter();
const montant = route.query.montant;
loc.value.datedebut=route.query.dateDebut;
loc.value.datefin=route.query.dateFin;

// Format the date as "YYYY-MM-DD"
const yearDebut = new Date(loc.value.datedebut).getFullYear();
const monthDebut = String(new Date(loc.value.datedebut).getMonth() + 1).padStart(2, '0'); // Months are zero-based
const dayDebut = String(new Date(loc.value.datedebut).getDate()).padStart(2, '0');

 loc.value.datedebut = `${yearDebut}-${monthDebut}-${dayDebut}`;
 const yearFin = new Date(loc.value.datefin).getFullYear();
const monthFin = String(new Date(loc.value.datefin).getMonth() + 1).padStart(2, '0'); // Months are zero-based
const dayFin = String(new Date(loc.value.datefin).getDate()).padStart(2, '0');

 loc.value.datefin = `${yearFin}-${monthFin}-${dayFin}`;
console.log(loc.value.datefin); // Output: "2024-01-27"


///

console.log(loc.value.datedebut);
//console.log(dateFin.value);
let client = ref({
    cin: "",
    age: null,
    number: "",
    id_user: 0,
});
const id_v=ref(0);
const v=ref([]);

 const displayMontant = async () => {
    v.value=store.state.Velochoixstore.velo;
       return v.value.map((c) => {
     
        loc.value.id_velo= c.velo.id_velo;
         //return montant.value;
       });
     };
console.log("idv="+id_v.value);
console.log(v.value);
console.log("vel"+store.state.Velochoixstore.velo);
const location=ref({

id_client:"",
//id_velo	:state.Velochoixstore,
//datedebut:	route.query.dateDebut,
//datefin:route.query.dateFin,
})
//
let emaill = localStorage.getItem("email");
const getUser = async () => {
    await api
        .get(`/api/findIdUserByEmail/${emaill}`)
        .then((res) => {
           // alert(res.data);
            client.value.id_user = res.data;
           // alert(client.value.id_user);
        })
        .catch((error) => {
            console.log(error);
        });
};
//alert(client.value.id_user)
const addClientAndPayement = async () => {
    handleSubmit();
    //console.log(velo.value);
    try {
        await api.post("/api/client", client.value).then(
            await api.get(`/api/findIdClientBycin/${client.value.cin}`)
        .then((res) => {
            loc.value.id_client=res.data;
            console.log(loc.value);
           // alert(res.data);
            //client.value.id_user = res.data;
           // alert(client.value.id_user);
        }))
    .catch ((error) => {
        if (error.response && error.response.status === 400 && error.response.data && error.response.data.error) {
            const validationErrors = error.response.data.error;
            
            // Iterate through validation errors and display each message as an alert
            for (const field in validationErrors) {
                const messages = validationErrors[field];
                
                // Display each error message as an alert
                messages.forEach(message => {
                  
                    toast.add({  severity: 'error', summary: 'Error Message', detail: `${message}`, life: 3000 });
                });
            }
            return;
        } 
        
    })
        .then( await api.post("/api/location",loc.value)
        )
        toast.add({ severity: 'success', summary: 'Success Message', detail: 'Paiement et enregistrement sont bien passé', life: 3000 });
        //vider le store
        store.commit("Velochoixstore/clearState");

     // Pause for 3 seconds
     setTimeout(() => {
         router.push({
        path: "/accueil"
    });
     }, 4000); // 4000 milliseconds = 4 seconds
    } catch (error) {
      
    }
};

//

//console.log("moi"+montant.montant)
const stripePromise = loadStripe(
    "pk_test_51OM8WMFCIVRhiDBbn4yqd0sdfJbAF3WFSfBIN0pn7aLIOQPJ8J4IM5crZMo93PoZL4xIbbGEA0zUh6jOmQrC262V00kU5CXKk7"
);
const stripe = ref(null);
let cardElement; // Déclarer cardElement comme variable globale
const amount = ref(); //const il faut un valeur initial et let pas bsoin
let email = ref("");
onMounted(async () => {
    //  amount.value = store.state.Articlestore.cartTotal;
 
    getUser();
  displayMontant();
    amount.value = montant;
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();
    cardElement = elements.create("card"); // Affecter cardElement
    cardElement.mount("#card-element"); //nhoto f balise li andha id card-element
});console.log(client.value.id_user);
const handleSubmit = async () => {
    const { token, error } = await stripe.value.createToken(cardElement);
    if (error) {
        console.error(error);
    } else {
        // Envoie le token au serveur pour traiter le paiement
        const response = await api.post("/api/createpayment", {
            token: token.id,
            amount: amount.value * 100, // Convertir le montant en cents
            email: email.value,
        });
        if (response.data.message) {
            //reponse de back end
            console.log(response.data.message);
            // Le paiement est réussi
           // alert(response.data.message);
            //Vider le cart
            // store.commit("Articlestore/clearCart");
            //Redirection
            // router.push("/shopping");
        } else {
            console.error(response.data.error);
        }
    }
};
</script>
<style lang="scss" scoped>
.centered-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.client-form {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
}

.input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.btn-primary {
    background-color: #3591dc42;
    border-color: #0f1010;
    color: #020202;
}

.result {
    margin-top: 20px;
    font-size: 1.2rem;
    font-weight: bold;
}
</style>
