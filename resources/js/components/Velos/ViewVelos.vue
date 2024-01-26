<template>
    <div>
        <AddVelosModal :veloprops="velo" />
        <h1 class="title">Listes des vélos</h1>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <DataTable
                        class="table"
                        :rowsPerPageOptions="[5, 10, 20, 50]"
                        :value="velos"
                        stripedRows
                        paginator
                        showGridlines
                        :rows="5"
                        dataKey="id"
                        :loading="isLoading"
                    >
                        <Column class="colu" header="Image">
                            <template #body="{ data }">
                                <img
                                    :src="data.image"
                                    class="shadow-4"
                                    width="65"
                                />
                            </template>
                        </Column>
                        <Column field="nom_velo" header="Nom vélos"></Column>
                        <Column
                            field="nom_model"
                            header="Modéle"
                            sortable
                        ></Column>

                        <Column
                            field="price_day"
                            header="Prix par jour"
                            sortable
                        ></Column>
                        <Column field="year" header="Année" sortable></Column>

                        <Column
                            field="disponibilité"
                            header="disponibilité"
                            sortable
                        ></Column>
                        <Column
                            field="id"
                            header="Actions"
                            style="min-width: 12rem"
                        >
                            <template #body="val">
                                <div class="d-flex">
                                    <AddVelosModal :veloprops="val.data" />

                                    <div
                                        class="btn-group container"
                                        role="group"
                                    >
                                        <button
                                            class="btn btn-danger rounded- circle delete-btn"
                                            @click="
                                                deletevelo(val.data.id_velo)
                                            "
                                        >
                                       <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AddVelosModal from "./AddVelosModal.vue";
import api from "../config/api.js";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, onMounted } from "vue";

let token=""
token=localStorage.getItem('token')

const config = {

headers: { Authorization: `Bearer ${token}` }
};



const velos = ref([]);
const velo = ref({
    nom_velo: "",
    year: 0,
    price_heure: 0,
    disponibilité: 1,
    image: "",
    id_model: 0,
});
const isLoading = ref(true);
const getvelos = async () => {
    await api
        .get("/api/velo",config)
        .then((res) => {
            velos.value = res.data;
            isLoading.value = false;
        })
        .catch((error) => {
            console.log(error);
        });
};

onMounted(() => {
    getvelos();
});

const deletevelo = async (id) => {
    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
        try {
            await api.delete(`/api/velo/${id}`);

            getarticles();
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    width: 35%;
    justify-content: center;
    align-items: center;
    height: 20vh; /* Ajustez selon vos besoins */
}
.title {
    display: flex;

    justify-content: center;
    align-items: center;
    height: 10vh; /* Ajustez selon vos besoins */
}
button {
    height: 40%;
    width: 10%;
}
.colu {
    height: 1%;
}
.delete-btn {
    font-size: 27px; /* ou ajustez la taille de police selon vos besoins */
    /* ou */
    padding: 10px 20px; /* ou ajustez la marge interne selon vos besoins */
}
</style>
