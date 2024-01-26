<template>
    <br /><br /><br /><br /><br />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Remplir la date</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="wrapper c">
                    <div class="row no-gutters">
                        <div class="col-5 d-flex align-items-stretch">
                            <div class="info-wrap bg-info p-md-5">
                                <h3>Let's get in touch</h3>

                                <p class="mb-4">
                                    We're open for any suggestion or just to
                                    have a chat
                                </p>
                                <div
                                    class="dbox w-100 d-flex align-items-start"
                                >
                                    <div
                                        class="icon d-flex align-items-center justify-content-center"
                                    >
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p>
                                            <span>Address:</span> 198 West 21th
                                            Street, Suite 721 New York, NY 10016
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="dbox w-100 d-flex align-items-center"
                                >
                                    <div
                                        class="icon d-flex align-items-center justify-content-center"
                                    >
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p>
                                            <span>Phone:</span>
                                            <a href="tel://1234567920"
                                                >+ 1235 2355 98</a
                                            >
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="dbox w-100 d-flex align-items-center"
                                >
                                    <div
                                        class="icon d-flex align-items-center justify-content-center"
                                    >
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p>
                                            <span>Email:</span>
                                            <a href="mailto:info@yoursite.com"
                                                >info@yoursite.com</a
                                            >
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="dbox w-100 d-flex align-items-center"
                                >
                                    <div
                                        class="icon d-flex align-items-center justify-content-center"
                                    >
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p>
                                            <span>Website</span>
                                            <a href="#">yoursite.com</a>
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-lg-7 order-lg-last d-flex align-items-stretch"
                        >
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <!-- <h3 class="mb-4">Get in touch</h3> -->
                               <div v-for="c of velochoisit" :key="c.velo" >
                                  
                          <!--j'ai besoin de l'ID de vélo choisit dans le state de store-->
                                    {{ setIdve(c.velo.id_velo) }}
                                
                               <!--aze   {{ nbjour }}-->
                           
                                </div> 
                               <!-- {{ velochoisit }}  -->

                                <div id="form-message-success" class="mb-4">
                                    Your message was sent, thank you!
                                </div> 
                            
                                <!-- <form
                                   
                                    id="contactForm"
                                    name="contactForm"
                                    class="contactForm"
                                > -->
                              
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!-- <label
                                                    for="selectModele"
                                                    class="form-label"
                                                    >vélo</label 
                                                >-->
                                                <div
                                                    v-for="c of velochoisit"
                                                    :key="c.velo"
                                                >
                                                    <!-- {{ c.velo.id_velo }} -->
                                                    <select
                                                    disabled placeholder="Disabled"
                                                        class="form-select"
                                                        v-model="
                                                            c.velo.nom_velo"
                                                        
                                                        id="selectModele"
                                                    >
                                                        <option
                                                            v-for="v in velos"
                                                            :key="v.id_velo"
                                                            :value="v.nom_velo"
                                                        >
                                                            {{ v.nom_velo }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- date: {{ dateDebut<new Date(2023, 5, 15)}} 
							
										{{new Date().getMonth()}}-->
										<!-- h:{{ new Date()}}  -->
                                        <!-- {{ dateDebut }}
                                    {{ dateFin< dateDebut }} -->
                                    <!-- {{ dateDebut }} -->
                                     <!-- @input="handleInputChange" -->
                                        <!-- @onChange="handleDateChange()" -->
                                        <Calendar
                                            class="p-2"
                                            v-model="choix.dateDebut"
                                   
                                        />
                                        
                                        <Calendar
                                            class="p-2"
                                            v-model="choix.dateFin"
                                        />
                                        <div class="row">
                                            <div class="col-10">
                                                <h6 class="p-2">
                                                    Cliquer pour vérifier la
                                                    disponibilité
                                                    <i
                                                        class="fa-solid fa-person-walking-arrow-right fa-lg"
                                                        style="color: #5a964c"
                                                    ></i>
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <!--Toast pour les alerts-->
                                                <Toast /> <button class="verifbutton" severity="danger" @click="verifierDisponibilite" >
                                                    <i
                                                        class="fa-solid fa-arrows-spin"
                                                    ></i>
                                                </button>
                                          
                                            </div>
                                    
                
                                               <input  v-if="visible" type="text" :value="'Montant total: '+total+'£'" id="montant" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button v-if="visible" type="button" class="btn btn-success" @click="confirm()">Confirmer</button>
                                            </div>
                                        </div>
                                    </div>
                          
                                <!-- </form> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--updatevalide change la visibleModal  ca depend de la fermeture ou bien l'ouverture de dialogue -->

    <Dialog v-model:visible="visibleModal" v-if="!token" style="width: 30%">
<Login :modal="true" :valide="updatevalide"/>
    </Dialog>
    <Dialog>

    </Dialog>
  

</template>

<script setup>

import Login from "../authentification/login.vue";
import { ref, onMounted } from "vue";
import api from "../config/api.js";
import { useRouter } from "vue-router";
import store from "../../store";
import Calendar from "primevue/calendar";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";
import axios from "../config/api.js";
let token = ref(localStorage.getItem('token'));
console.log(token.value);
const toast = useToast();
let montant=ref(0);
const total=ref(0);
const router = useRouter();
let nbjour=ref(0);
//console.log(l);
const velos = ref([]);
const idVe=ref();
const visible=ref(false);//le montant et le boutton confirmer soient visible que si la vérification est passée
const valide=ref(false)
//const props = defineProps(["monParametre"]); //props
const velochoisit = ref([]);
const visibleModal=ref(false)

const datecontrole=ref({
    dateDebut:"",
    dateFin:""
})

//idve c'est la id de vélo choisit
const setIdve = (id) => {
  idVe.value = id;
};

const choix = ref({
    idVelo: idVe,
    dateDebut:"",
    dateFin:""
});
// const fermerDialogue=async() =>{
//  if(localStorage.getItem('token')!="")
//       {visibleModal.value=false;
//  }
//}
const updatevalide = (newVal) => {
    console.log(newVal)
    console.log(localStorage.getItem('token'))
    token.value = localStorage.getItem('token');
   // console.log("tok="+token.value)
    visibleModal.value=newVal;
  
};
const getVelos = async () => {
    await api
        .get("/api/velo")
        .then((response) => {
            velos.value = response.data;
        }) //response fiha barcha hajet o5ra w ahna nhbo kn l res.data
        .catch((error) => {
            console.log(error);
            //console.error('Error fetching categories:', error);
        });
};
const loadVeloChoisit = async () => {
    velochoisit.value = store.state.Velochoixstore.velo;
   
};
console.log("velochoisit="+montant.value);
const displayMontant = async () => {
      return velochoisit.value.map((c) => {
     
         montant.value = c.velo.price_day;
        //return montant.value;
      });
    };
onMounted(() => {
    getVelos();
    loadVeloChoisit();
    displayMontant();
   // fermerDialogue();
    // velochoisit=router.query;
});
const verifierDisponibilite = async () => {
   
  if((choix.value.dateDebut=="")||(choix.value.dateFin==""))
 { toast.add({ severity: 'info', summary: 'Info Message', detail: 'Remplir la date désirée', life: 3000 });
  return;}
  
   if(choix.value.dateDebut>=choix.value.dateFin)
   {toast.add({ severity: 'warn', summary: 'Warn Message', detail: 'la date debut doit etre inférieur a date fin', life: 3000 });
   return;}
   const today = new Date();
 //  const todayform=new Date(today.getFullYear(),String(today.getMonth()).padStart(2, '0'), String(today.getDate()))
   console.log(today);
  if(choix.value.dateDebut< today)
   
   {toast.add({ severity: 'warn', summary: 'Warn Message', detail: "la date debut doit etre supérieur a aujourd'hui", life: 3000 });
   return;}
  try {
    // Appeler l'API Laravel pour vérifier la disponibilité du vélo
    const response = await api.post('/api/verifierDisponibiliteVelo',  choix.value);
     //  visible.value=true;
    // Si la réponse est positive, le vélo est disponible
    console.log(response.data);
  
    toast.add({ severity: 'success', summary: 'Success Message', detail: 'Cette vélo est a votre disposition', life: 3000 });
   // valide.value=true;
   //Data de controle si ilya une modification du période
    datecontrole.value.dateDebut=choix.value.dateDebut;
    datecontrole.value.dateFin=choix.value.dateFin;
    visible.value=true;
    //const l=choix.value.dateFin-choix.value.dateDebut ;
 //   montant.value=30*3;
   nbjour.value=(choix.value.dateFin-choix.value.dateDebut)/(1000 * 60 * 60 * 24);
    total.value=montant.value*nbjour.value;
   // montant.value=montant.value*nbjour.value;
   //montant=30*nbjour.value;
    console.log("montant nv"+montant.value)
 
    
  } catch (error) {

    // Gérer les erreurs, par exemple afficher un message à l'utilisateur
    console.error(error.response.data.error);
  
    toast.add({  severity: 'error', summary: 'Error Message', detail: 'Vélo est non disponible ', life: 3000 });
  }
};
const confirm=async() =>{
  
    if((choix.value.dateDebut!=datecontrole.value.dateDebut)||(choix.value.dateFin!=datecontrole.value.dateFin))
    {
        
        visible.value=false;//n'est pas affichier le montant et le butt confirmer
        visibleModal.value=false;//recalculer le montant avant que le dialogue s'ouvre
        total.value=0;
       // valide.value=false
        verifierDisponibilite();
        
    }
    else { visibleModal.value=true;//si ca marche le visibleModal sera true 
      

    }
//console.log("oh tok"+token.)
    if(token.value!=null & visible.value==true)
    {
        router.push({
           path: "/Payment",
           //total
           query: { montant: JSON.stringify(total.value),dateDebut: datecontrole.value.dateDebut,dateFin: datecontrole.value.dateFin }
       });
    }
}
</script>

<style lang="scss" scoped>
// .contact-wrap {
//   background-color: #ffffff; /* Set background color */
//   border: 1px solid #e5e5e5; /* Add a border */
//   border-radius: 10px; /* Add rounded corners */
//   box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
//   padding: 40px; /* Add padding inside the frame */
//   margin-bottom: 20px; /* Add some space at the bottom */
// }

.contact-wrap h3 {
    color: #333333; /* Set the heading color */
}
.c {
    border: 1px solid #e5e5e5; /* Add a border */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}
.verifbutton {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #3498db; /* Couleur de fond du bouton */
    color: #ffffff; /* Couleur du texte (blanc) */
    border: none;
    cursor: pointer;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3); /* Ombre légère */
    transition: background-color 0.3s, transform 0.3s; /* Transition pour une animation fluide */
}

.verifbutton:hover {
    background-color: #2980b9; /* Couleur de fond lors du survol */
}

.verifbutton i {
    font-size: 20px;
    transition: transform 0.3s; /* Animation de rotation pour l'icône */
}

.verifbutton:hover i {
    transform: rotate(360deg); /* Rotation de l'icône lors du survol */
}
</style>
