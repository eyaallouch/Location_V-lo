<template>
  <br>  <br>  <br><br><br>
        <div class="row justify-content-center" id="allpage" style="margin-bottom: 10%">
            <div style="width: 500px">
                <div class="card">
                    <div class="card-header">
                        Login <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label"
                                    >E-Mail Address</label
                                >
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    v-model="user.email"
                                    required
                                    autofocus
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"
                                    >Password</label
                                >
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control"
                                    v-model="user.password"
                                    required
                                    autocomplete="off"
                                />
                            </div>
                            <!-- {{ modal }} -->
                            <div class="d-grid">
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    @click="handleLogin"
                                >
                                    Login
                                </button>
                                <router-link to="/register"
                                    >register</router-link
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>

import api from "../config/api.js";
import { useRouter } from "vue-router";
const propmodal = defineProps(["modal","valide"]);;
const router = useRouter();
let user = {};
const handleLogin = async () => {
   // alert(modal.modal)
    try {
        const response = await api.post(
            "/api/login/",
            user
        );
   
           
        localStorage.setItem("firstname", response.data.user.firstname);
        localStorage.setItem("lastname", response.data.user.lastname);
        localStorage.setItem("token", response.data.token);
        localStorage.setItem("email", response.data.user.email);
        localStorage.setItem("role", response.data.user.role);
         if  (propmodal.modal==undefined) 
        router.push("/accueil"); 
        propmodal.valide(false);//si je fait le login correctement le dialogue sera fermer c'est pourquoi val de prop sera false (ferme)
       
    } catch (error) {
        if (error.response && error.response.status === 422) {
            // 422 status code indicates validation error, i.e., incorrect credentials
            alert("Invalid email or password. Please try again.");
        } else {
            // Handle other types of errors, e.g., network issues
            console.error(error);
            alert("An error occurred while trying to log in. Please try again later.");
        }
    }
};
</script>

<style scoped>

.container {
    height: 100vh;
   
}

.card {
    margin-top: 20px;
}

.card-header {
    background-color: #28a745; /* Vert */
    color: #fff;
}

.btn-success {
    background-color: #28a745; /* Vert */
    border-color: #28a745; /* Vert */
}
</style>
