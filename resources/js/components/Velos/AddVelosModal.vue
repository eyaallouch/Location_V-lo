<template>
    <br /><br /><br />
    <div class="container">
        <button
            type="button"
            class="btn btn-warning rounded- circle butt"
            @click="visible = true"
        >
            {{ disting }}
        </button>
    </div>

    <form>
        <div class="card flex justify-content-center">
            <Dialog v-model:visible="visible">
                <div class="row">
                    <div class="col-md-6">
                        <label for="Nom-vélo" class="form-label"
                            >Nom du vélo</label
                        >
                        <br />
                        <InputText
                            type="text"
                            id="Nom-vélo"
                            v-model="velo.nom_velo"
                        />
                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="price_day" class="form-label"
                            >Prix par jour</label
                        >

                        <InputText
                            type="text"
                            placeholder="ex:10DT"
                            id="price_day"
                            v-model="velo.price_day"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <br />
                        <label for="year" class="form-label">Année</label>
                        <br />
                        <InputText type="text" id="year" v-model="velo.year" />
                        <!--    <div>
                            <Calendar v-model="velo.year" view="year" dateFormat="yy" />
                            />
                        </div>
                      <input
                            type="text"
                            class="form-control"
                            id="year"
                            v-model="velo.year"
                        />-->
                    </div>
                    <div class="col-md-6 ms-auto">
                        <br />
                        <label for="selectModele" class="form-label"
                            >Modéle</label
                        >

                        <select
                            class="form-select"
                            v-model="velo.id_model"
                            id="selectModele"
                        >
                            <option
                                v-for="sc in modéles"
                                :key="sc.id_model"
                                :value="sc.id_model"
                            >
                                {{ sc.nom_model }}
                            </option>
                        </select>
                    </div>
                </div>
               
                    <br>
                    <label for="disponibiliteCheckbox">Disponibilité:</label>
                    <input
                        type="checkbox"
                        id="disponibiliteCheckbox"
                        v-model="velo.disponibilité"
                  
                    />
                   
             

                <div>
                    <br />

                    <label class="form-label">Image</label>
                    <div>
                        <!-- <Input 
                            type="file"
                           
                            id="image"
                            v-model="velo.image"
                        /> -->
                        <file-pond
                            name="test"
                            ref="pond"
                            class-name="my-pond"
                            label-idle="Drop files here..."
                            allow-multiple="false"
                            accepted-file-types="image/jpeg, image/png"
                            v-bind:files="myFiles"
                            v-on:init="handleFilePondInit"
                            :server="
                                disting != 'Edit'
                                    ? serverOptionsAdd()
                                    : serverOptionsEdit()
                            "
                        />
                    </div>
                </div>
                <br />
                <button
                    type="submit"
                    className="btn btn-outline-primary enregcancel"
                    @click="disting == 'Edit' ? modifiervelo() : addVelo()"
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
    </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../config/api.js";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";

import axios from "axios";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);

const visible = ref(false);
const velo = ref({
    nom_velo: "",
    year: 2024,
    price_day: 0,
    disponibilité: 0,
    image: "",
    id_model: 0,
});

const updateDisponibilite = () => {
    if(velo.value.disponibilité==0)
    {
        velo.value.disponibilité=1;
    }
    else 
    velo.value.disponibilité = 0;
};
const disting = props.veloprops.nom_velo != "" ? "Edit" : "New"; //element vide donc New
const modéles = ref([]);
const props = defineProps(["veloprops"]); //props
const addVelo = async () => {
    console.log(velo.value);
    try {
        await api.post("/api/velo", velo.value);
        {
            visible.value = false;
            getvelos();
        }
    } catch (error) {}
};
const getvelos = async () => {
    await api
        .get("/api/velo")
        .then((res) => {
            //velos.value = res.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

const modifiervelo = () => {
    console.log(velo.value);
    api.put(`/api/velo/${velo.value.id_velo}`, velo.value)
        .then(() => {
            visible.value = false;
        })
        .catch((error) => {
            console.error("There was an error!", error);
        });
};
const loadvelo = () => {
    // console.log(props.veloprops);
    velo.value = props.veloprops;
};
const getModeles = async () => {
    await api
        .get("/api/modele")
        .then((response) => {
            modéles.value = response.data;
        }) //response fiha barcha hajet o5ra w ahna nhbo kn l res.data
        .catch((error) => {
            console.log(error);
            //console.error('Error fetching categories:', error);
        });
};
onMounted(() => {
    getModeles();
    loadvelo();
    api.get("/api/velo");
});
const cancel = () => {
    visible.value = false;
};
const handleFilePondInit = async () => {
    if (velo.value.image) {
        myFiles.value = [
            {
                source: velo.value.image,
                options: { type: "local" },
            },
        ];
    }
};
const serverOptionsEdit = () => {
    console.log("server pond");
    return {
        load: (source, load, error, progress, abort, headers) => {
            var myRequest = new Request(source);
            fetch(myRequest).then(function (response) {
                response.blob().then(function (myBlob) {
                    load(myBlob);
                });
            });
        },

        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append("file", file);
            data.append("upload_preset", "velos-location");
            data.append("cloud_name", "dpv7jv3e9");
            data.append("public_id", file.name);
            axios
                .post("https://api.cloudinary.com/v1_1/dpv7jv3e9/upload", data)
                .then((response) => response.data)
                .then((data) => {
                    console.log(data);
                    velo.value.image = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error("Error uploading file:", error);
                    error("Upload failed");
                    abort();
                });
        },
    };
};
const serverOptionsAdd = () => {
    console.log("server pond");
    return {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append("file", file);
            data.append("upload_preset", "velos-location");
            data.append("cloud_name", "dpv7jv3e9");
            data.append("public_id", file.name);
            axios
                .post("https://api.cloudinary.com/v1_1/dpv7jv3e9/upload", data)
                .then((response) => response.data)
                .then((data) => {
                    console.log(data);
                    velo.value.image = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error("Error uploading file:", error);
                    error("Upload failed");
                    abort();
                });
        },
    };
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    width: 50%;
    justify-content: center;
    align-items: center;
    height: 20vh; /* Ajustez selon vos besoins */
}
.butt {
    height: 40%;
    width: 75%;
}
.modalbutton {
    max-width: 60%;
    height: 10%;
    width: 20%;
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
