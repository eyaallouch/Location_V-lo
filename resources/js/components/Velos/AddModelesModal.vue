<template>
    <div>
        <div class="card flex justify-content-center">
            <Dialog v-model:visible="visibleModal" @after-hide="cancel">
                <div class="row">
                    <div class="col-md-6">
                        <label for="Nom-modéle" class="form-label"
                            >Nom du modéle</label
                        >
                        <br />
                        <InputText
                            type="text"
                            id="Nom-modéle"
                            v-model="modele.nom_model"
                        />
                    </div>
                </div>
{{ disting }}
                <br />
                <button
                    type="submit"
                    className="btn btn-outline-primary enregcancel"
                    @click="
                        disting == 'Modifier' ? modifiermodel() : addmodel()
                    "
                >
                    <i class="fa-solid fa-floppy-disk"></i>Enregister
                </button>

                <button
                    class="modalbutton"
                    type="button"
                    className="btn btn-outline-primary enregcancel "
                    @click="cancel"
                >
                    <i class="fa-solid fa-floppy-disk"></i>cancel
                </button>
            </Dialog>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../config/api.js";
import Dialog from "primevue/dialog";
//primevue
import Calendar from "primevue/calendar";
import InputText from "primevue/inputtext";

import axios from "axios";
//const visible = ref(true);
const modele = ref({
    nom_model: "",
});

const props = defineProps(["modelprops", "visibleModal", "updatevisibleModal"]); //props
const disting = props.modelprops.nom_model != "" ? "Modifier" : "New";

const addmodel = async () => {
    console.log(modele.value);

    try {
        await api.post("/api/modele", modele.value);
        {
            cancel();
        }
    } catch (error) {}
};
const modifiermodel = () => {
    api.put(`/api/modele/${modele.value.id_model}`, modele.value)
        .then(() => {
            cancel();
        })
        .catch((error) => {
            console.error("There was an error!", error);
        });
};
const loadmodel = () => {
    console.log(props.modelprops);
    modele.value = props.modelprops;
};

onMounted(() => {
    console.log("first");
    //  getModeles();
    loadmodel();
    //api.get("/api/modele");
});
const cancel = () => {
    //modele.value.nom_model="";
    props.visibleModal = false;
    // props.modelprops=false;
    props.updatevisibleModal(false);
    props.modelprops.nom_model="";
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    width: 30%;
    justify-content: center;
    align-items: center;
    height: 20vh; /* Ajustez selon vos besoins */
}
.butt {
    height: 40%;
    width: 70%;
}
.modalbutton {
    max-width: 50%;
    height: 10%;
    width: 10%;
}
#selectModele {
    width: 83%;
    height: 47%;
    border-color: rgb(212, 208, 208);
}

i:hover {
    display: block;
}
.enregcancel {
    margin-right: 5%;
    margin-left: 1%;
}
</style>
