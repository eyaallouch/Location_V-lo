<script setup>
import Menu from "./components/Menu.vue";
// import { onMounted } from 'vue';
// import { useRouter } from 'vue-router';
// const router = useRouter();
// onMounted(() => {
//     console.log(localStorage.getItem('token'))
//     console.log(localStorage.getItem('role'))
//     if(!localStorage.getItem('token'))
//   {  console.log(localStorage.getItem('role'))
//       router.push('/login');}
//     });

</script>


<template>
<Menu/>
<router-view></router-view>
</template>
<style lang="scss" scoped>

</style>