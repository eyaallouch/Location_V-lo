<template>
    <div>
        <br />
        <h3>
            Paiement avec carte bancaire ou bien dans le magasin
            <strong>Chèques / Espèces</strong>
          
        </h3> 
        <infoVelo v-for="velo in velos" :velo="velo" />
    </div>
</template>

<script setup>
import infoVelo from "./infoVelo.vue";
import api from "../config/api.js";
import { ref, onMounted } from "vue";
const velos = ref([]);
onMounted(() => {
    getvelos();
});

const getvelos = async () => {
    await api
        .get("/api/velo")
        .then((res) => {
            velos.value = res.data;
          //  isLoading.value = false;
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<style lang="scss" scoped>
h3 {
    margin-top: 10%;
    text-align: center;
     font: bold 28px/60px "Roboto Condensed", Helvetica, Arial, Verdana, sans-serif;
}
strong {
    font-weight: 900;
}
</style>
