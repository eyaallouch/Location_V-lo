<template>
  <br><br><br>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label for="prenom" class="form-label">Prénom</label>
                  <input
                    id="prenom"
                    type="text"
                    class="form-control"
                    v-model="user.firstname"
                    required
                    autocomplete="off"
                  />
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Nom</label>
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    v-model="user.lastname"
                    required
                    autocomplete="off"
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">E-Mail Address</label>
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="user.email"
                    required
                    autocomplete="off"
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="user.password"
                    required
                    autocomplete="off"
                  />
                </div>
     
                <div class="d-grid">
                  <button type="button" class="btn btn-primary" @click="handleSubmit">
                    Register
                  </button>
                  <router-link to="/login">login</router-link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import api from "../config/api.js";
  import axios from "axios";
  import { useRouter } from "vue-router";
  const router = useRouter();
  
  const user = ref({
    firstname: "",
    lastname: "",
    email: "",
    password: ""
    
  });
  
  const handleSubmit = async () => {
    try {
        axios
      await api.post("/api/register", user.value)
        .then((response) => {
          console.log("aaaaa");
          console.log(response);
          router.replace({ name: "login" });
        })
        .catch((err) => {
          console.log(err);
          alert(err);
        });
    } catch (error) {}
  };
  </script>
  
  <style scoped>
  

  
  .card-header {
    background-color: #007bff;
    color: #fff;
  }
  </style>
  