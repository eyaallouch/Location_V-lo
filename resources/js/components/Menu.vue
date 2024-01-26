<template>

        <header>
            <input type="checkbox" name="" id="chk1" />
            <div class="logo"><h1>Location Vélos</h1></div>
            <div class="search-box">
                <form>
                    <input
                        type="text"
                        name="search"
                        id="srch"
                        placeholder="Search"
                    />
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <ul>
                <li>
                    <router-link class="nav-link active" to="/accueil"
                        >Home</router-link
                    >
                </li>
                <!-- <li>
                    <router-link class="nav-link active" to="/ViewVelos"
                        >Velos</router-link
                    >
                </li>
                <li>
                    <router-link class="nav-link active" to="/ViewModeles"
                        >modéles</router-link
                    >
                </li> -->
                <li>
                    <router-link class="nav-link active" to="/consulterVelos"
                        >reservation</router-link
                    >
                </li>
                <li>
                    <router-link class="nav-link active" to="/login"
                        >Login</router-link
                    >
                </li>
                <li>

                 
                      <a  class="nav-link active" @click.prevent="logout">logout</a>
                     
                    
                    
                </li>
                
                <li>
                    <i class="fa-brands fa-facebook fa-xl" style="color: #05388a;"></i>
                    <i class="fa-brands fa-square-instagram fa-xl" style="color: #a4190a;"></i>
                    <i class="fa-brands fa-twitter fa-xl" style="color: #78a5f2;"></i>
                    <i class="fa-solid fa-phone fa-xl" style="color: #27c456;"></i>
                
                </li>
            </ul>
            <div class="menu">
                <label for="chk1">
                    <i class="fa fa-bars"></i>
                </label>
            </div>
        </header>

</template>

<script setup>

import axios from "axios";
import api from "../components/config/api.js";
import { useRouter } from "vue-router";
import { ref, onMounted, watchEffect } from 'vue';
const router = useRouter();
const  token = ref("");
onMounted(() => {
     token.value = localStorage.getItem('token');
    // alert(token.value)
//       // Utilisez watchEffect pour réagir aux changements de token
//       watchEffect(() => {
//         token.value = localStorage.getItem('token');
//         if (token=="") {
//           // Si le token est vide, vous pouvez rediriger l'utilisateur vers la page de connexion, par exemple
//           router.push('/login');
//           console.log(token)
//         }
//         else  {router.push('/menu')};
//       });
    });

//watch(token, (newToken) => {
    //  if (!newToken) {
        // Si le token est vide, vous pouvez rediriger l'utilisateur vers la page de connexion, par exemple
       // router.push('/login');
     // }
let tok = localStorage.getItem('token');
     watchEffect(() => {
      window.addEventListener('storage', (event) => {
        if (event.key === 'token') {
          // Mettez à jour la variable tok en fonction des changements dans le stockage local
          tok = event.newValue || '';
        }
      });
    });

console.log(tok)
const logout = async () => {
    let token = "";

    token = localStorage.getItem("token");
    console.log(token);
    axios
        api.post("/api/logout", null, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })

        .then((response) => {
            console.log(response);
            localStorage.removeItem("token");
            localStorage.removeItem("firstname");
            localStorage.removeItem("lastname");
            localStorage.removeItem("email");
            localStorage.removeItem("role");
            router.push("/login");
        })
        .catch((err) => {
            console.log(err);
         //  alert(err);
        });
};
</script>

<style lang="scss" scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial;
}
template {
    //background:url("https://cdn.shoplightspeed.com/shops/640899/files/33270120/montagne-marshall-2021.jpg");
    background-size: cover;
    height: 100vh;
    background-position: center;
}
header {
    width: 100%;
    height: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    z-index: 99;
    box-shadow: 0 0 10px #000;
    background: rgba(0, 0, 0, 0.5);
}
#chk1 {
    display: none;
}
i {
    color: #fff;
    cursor: pointer;
}
header .logo {
    flex: 1;
    color: #fff;

    margin-left: 50px;
    text-transform: uppercase;
    font-size: 15px;
}
header .search-box {
    flex: 1;
    position: relative;
}
.search-box input {
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    background: #f2f2f2;
    border-radius: 30px;
    color: gray;
    font-size: 16px;
    padding-left: 5px;
    padding-right: 40px;
    text-align: center;
}
.search-box button {
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 30px;
    border: none;
    position: absolute;
    top: 0;
    right: 0;
    transform: scale(0.9);
    background: green;
    color: #fff;
}
header ul {
    flex: 2;
    display: flex;
    justify-content: space-evenly;
}
header ul li {
    list-style: none;
}
header ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    padding: 10px 15px;
}
header ul li a:hover {
    border-bottom: 2px solid cadetblue;
}
header .menu {
    font-size: 2.5em;
    display: none;
}
@media (max-width: 1000px) {
    .search-box button {
        position: absolute;
    }
    header ul {
        position: fixed;
        top: 100px;
        right: -100%;
        background: rgba(0, 0, 0, 0.5);
        height: calc(100vh - 100px);
        width: 50%;
        flex-direction: column;
        align-items: center;
        transition: right 0.5s linear;
    }

    header .menu {
        display: block;
        width: 100px;
        text-align: center;
    }
    #chk1:checked ~ ul {
        right: 0;
    }
}
li i{
    margin: 5px;
    margin-top: 20px;
}
</style>
