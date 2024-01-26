<template>
    <div class="centered-container">
      <form @submit.prevent="addClient" class="client-form">
        <div class="form-group">
          <label for="cin">CIN :</label>
          <input type="text" id="cin" v-model="client.cin" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="age">Âge :</label>
          <input type="number" id="age" v-model="client.age" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="number">Numéro de téléphone :</label>
          <input type="text" id="number" v-model="client.number" class="form-control" required />
        </div>
        <Payment :montant="montant"/>
        <button type="submit" class="btn btn-primary">Soumettre</button>
        <router-link :to="{name: 'Payment'}" > <button class="btn btn-info"> CHECKOUT
        </button> </router-link>
      </form>
      <div class="result">
       <!-- {{ client }}-->
      </div>
    </div>
  </template>

<script setup>
import Payment from "../payement/Payment.vue"
import api from "../config/api.js";
import { ref, onMounted } from "vue";
import { useRouter, useRoute  } from "vue-router";

const router = useRouter();
const route=useRoute();
//const montants = router.query.montant;
const montant  = route.query.montant;
console.log(montant);
//const iduser=ref(0);
const client = ref({
    cin: "",
    age: null,
    number: "",
    id_user:0
});
let email=localStorage.getItem("email");
const getUser = async () => {
    await api
        .get(`/api/findIdUserByEmail/${email}`)
        .then((res) => {
            client.value.id_user = res.data;
       
        })
        .catch((error) => {
            console.log(error);
        });
};
const addClient = async () => {
    //console.log(velo.value);
    try {
        await api.post("/api/client", client.value);
        {
          //  visible.value = false;
        //    getvelos();
        }
    } catch (error) {}
};
onMounted(() => {
    getUser();
});
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
}</style>
