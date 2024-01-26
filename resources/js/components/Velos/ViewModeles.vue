<template>
    <AddModelesModal
        v-if="visibleModal"
        :visibleModal="visibleModal"
        :modelprops="modele"
        :updatevisibleModal="updatevisibleModal"
    />
    <br /><br /><br />
    <div>
        <div class="container">
            <button
                type="button"
                class="btn btn-warning rounded- circle butt"
                style="height: 60px; width: 160px;margin-top: 30px;"
                @click="visibleModal = true"
            >
                New 
            </button>
        </div>
       
        <h1 class="title">Listes des Modéles</h1>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <DataTable
                        class="table"
                        :rowsPerPageOptions="[5, 10, 20, 50]"
                        :value="modeles"
                        stripedRows
                        paginator
                        showGridlines
                        :rows="5"
                        dataKey="id"
                        :loading="isLoading"
                    >
                        <Column
                            field="nom_model"
                            header="Nom modéle"
                            sortable
                        ></Column>

                        <Column
                            field="id"
                            header="Actions"
                            style="min-width: 1rem"
                        >
                            <template #body="val">
                                <div class="d-flex">
                                    <div class="mt-3 mb-3">
                                        <button
                                            type="button"
                                            class="btn btn-warning rounded- circle butt"
                                            style="height: 60px; width: 160px;margin-top: 30px;"
                                            @click="
                                                visibleModal = true;
                                                modele = val.data;
                                            "
                                        >
                                            Edit
                                        </button>
                                        <!-- <AddModelesModal :modelprops="val.data" /> -->
                                    </div>
                                    <div
                                        class="btn-group container"
                                        role="group"
                                    >
                                        <button
                                            class="btn btn-danger rounded- circle"
                                            @click="
                                                deletemodele(val.data.id_model)
                                            "
                                        >
                                            Delete
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
import AddModelesModal from "./AddModelesModal.vue";
import api from "../config/api.js";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import axios from "axios";
const modeles = ref([]);
const modele = ref({
    nom_model: "",
});
const isLoading = ref(true);
const visibleModal = ref(false);

const updatevisibleModal = (newVal) => {
    console.log(newVal);
    visibleModal.value = newVal;
    getModeles();
};

const getModeles = async () => {
    await api
        .get("/api/modele")
        .then((res) => {
            modeles.value = res.data;
            isLoading.value = false;
        })
        .catch((error) => {
            console.log(error);
        });
};
const storedUser = localStorage.getItem("firstname");

// Récupérer la valeur stockée sous la clé 'token'
const storedToken = localStorage.getItem("token");

// Afficher les valeurs dans la console
console.log("First Name:", storedUser);
console.log("Token:", storedToken);
onMounted(() => {
    getModeles();
});

const deletemodele = async (id) => {
    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
        try {
            await api.delete(`/api/modele/${id}`);

            getModeles();
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    width: 25%;
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
</style>
