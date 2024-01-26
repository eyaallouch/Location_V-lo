<template>
    <div>
        <div class="row">
            <div class="col-4"> <img :src="props.velo.image"  /></div>
            <div class="col-5 namevelo">
               <h4>{{props.velo.nom_velo}}</h4> 
                <h6>Modéle de ce vélo : {{props.velo.nom_model}}</h6>
                <h6>Année de création : {{props.velo.year}}</h6>
                <h6>Prix par jour : {{ props.velo.price_day }}£</h6>
            </div>
          <div class="col-3">
            <router-link  to="/formulaireReservation" class=" btn btn-info button" @click="envoie(props.velo)">
      Réserver
    </router-link></div>
        </div>
       
        <!-- {{$store.state.Velochoixstore.velo}} -->
    </div>
</template>
 <!-- {{ props.velo.image }} -->
<script setup>
import { ref, onMounted } from "vue";
//import { useRouter } from "vue-router";
import store from '../../store';
 // const router = useRouter();
const props = defineProps(["velo"]); //props

const envoie = (velo) =>  {
    
 //   router.push({
//  name: 'formulaireReservation',
 //params: "props.velo"});
 store.commit("Velochoixstore/addVelo", {velo});
}

onMounted(() => {
    clearstate();
	
    // velochoisit=router.query;
})
const clearstate=()=> {
store.commit("Velochoixstore/clearState");
}
</script>

<style lang="scss" scoped>
.namevelo{
   
    margin-top: 4%;
    margin-bottom: 130px;

}
img{
    width: 90%;
    height:90%;
}
h4 {
        color: #3498db; /* Change the color to your preference */
        font-family: "Roboto", sans-serif; /* Change the font family to your preference */
        font-weight: bold; /* Make the text bold */
       margin-bottom: 2%;
    }
.button{
    margin-top: 100px;
}

</style>
