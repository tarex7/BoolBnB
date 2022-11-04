<template>
    <div class="offset-2">
        <div id="flat-detail-page">
            <AppLoader v-if="isLoading" />
            <div v-else-if="!isLoading && flat" :flat="flat">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="mt-3 mb-2">{{ flat.title }}</h3>
                        </div>

                        <div class="col-5">
                            <img
                                class="rounded-4 my-3"
                                :src="`/storage/${flat.image}`"
                                :alt="flat.title"
                            />

                            <div class="d-flex justify-content-between">
                                <h3>
                                    Appartamento in affitto a {{ flat.address }}
                                </h3>
                                <h3>{{ flat.price_per_day }}€ notte</h3>
                            </div>
                            
                            <p class="d-flex">
                                {{ flat.square_mt }}mq -
                                {{ flat.room_number }} Camere -
                                {{ flat.bathroom_number }} Bagni -
                                {{ flat.bed_number }} Letti
                            </p>
                            <hr class="my-3" />
                            <p>{{ flat.description }}</p>
                            <div>
                                <hr class="my-3" />

                                <h4>Servizi</h4>
                                <div class="row row-cols-3">
                                    <div
                                        class="d-flex"
                                        v-for="(
                                            service, index
                                        ) in flat.services"
                                        :key="index"
                                    >
                                        <div class="mb-2">
                                            <i
                                                :class="service.icon"
                                                class=""
                                            ></i>
                                            <span class="">{{
                                                service.label
                                            }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mt-4">
                            <!-- FORM MESSAGGIO -->
                            <div
                                id="message-form"
                                class="col-12 col-md-8 rounded-3 p-3"
                            >
                                <h4 class="my-2">
                                    Invia un messaggio al proprietario
                                </h4>
                                <!-- Componente loader -->
                                <AppLoader v-if="isLoading" />
                                <div v-else>
                                    <AppAlert
                                        v-if="alertMessage || hasErrors"
                                        :type="hasErrors ? 'danger' : 'success'"
                                        :dismissible="true"
                                        @close="resetErrorsAndMessage"
                                    >
                                        <!-- Se c'è alert message metto il messaggio -->
                                        <div v-if="alertMessage">
                                            {{ alertMessage }}
                                        </div>
                                        <!-- gestisco gli errori -->
                                        <ul v-if="hasErrors">
                                            <!-- per ogni elemento dell'oggetto prendimi la chiava e prendimi il messaggio -->
                                            <li
                                                v-for="(error, key) in errors"
                                                :key="key"
                                            >
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </AppAlert>
                                    <!-- intercetto vue sumbit.prevent per non ricaricare la pagina -->
                                    <form
                                        class="contact - form"
                                        @submit.prevent="submitForm"
                                        novalidate
                                    >
                                        <!-- utente -->
                                        <div class="form-group">
                                            <label
                                                for="sender_name"
                                                class="form-label m-0"
                                                >Nome</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control mb-2"
                                                :class="{
                                                    'is-invalid':
                                                        errors.sender_name,
                                                }"
                                                id="sender_name"
                                                v-model.trim="form.sender_name"
                                            />
                                            <!-- STAMPO GLI ERRORI -->
                                            <div
                                                v-if="errors.sender_name"
                                                class="invalid-feedback"
                                            >
                                                {{ errors.sender_name }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="sender_email"
                                                class="form-label m-0"
                                                >Email</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control mb-2"
                                                :class="{
                                                    'is-invalid':
                                                        errors.sender_email,
                                                }"
                                                id="sender_email"
                                                v-model.trim="form.sender_email"
                                            />
                                            <!-- STAMPO GLI ERRORI -->
                                            <div
                                                v-if="errors.sender_email"
                                                class="invalid-feedback"
                                            >
                                                {{ errors.sender_email }}
                                            </div>
                                        </div>
                                        <!-- Text-Area -->
                                        <div class="mb-3">
                                            <label
                                                for="text"
                                                class="form-label m-0"
                                                >Messaggio</label
                                            >
                                            <textarea
                                                class="form-control mb-2"
                                                :class="{
                                                    'is-invalid': errors.text,
                                                }"
                                                id="text"
                                                rows="10"
                                                v-model.trim="form.text"
                                            ></textarea>
                                            <!-- STAMPO GLI ERRORI -->
                                            <div
                                                v-if="errors.text"
                                                class="invalid-feedback"
                                            >
                                                {{ errors.text }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                            >
                                                Invia
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- FINE FORM MESSAGGIO -->
                        </div>

                        <div class="col-9">
                            <FlatMap :flat="flat" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppAlert from "../AppAlert.vue";
import FlatCard from "../flats/FlatCard.vue";
import AppLoader from "../AppLoader.vue";
import FlatMap from "../FlatMap.vue";
export default {
    name: "FlatDetail",
    components: { AppLoader, FlatCard, AppAlert, FlatMap },
    data() {
        return {
            flat: null,
            isLoading: false,
            services: [],
            form: {
                sender_name: "",
                sender_email: "",
                text: "",
                flat_id: this.$route.params.id,
            },

            alertMessage: null,
            errors: {},
        };
    },
    computed: {
        hasErrors() {
            //Objeykey  restiusce le chiavi dell'oggetto in cui è dentro
            //con  lenght quantità di chiavi dell'oggetto
            return Object.keys(this.errors).length;
        },
    },

    methods: {
        fetchFlat() {
            this.isLoading = true;
            axios
                .get("http://localhost:8000/api/flats/" + this.$route.params.id)
                .then((res) => {
                    this.flat = res.data;
                })
                .catch((err) => {
                    console.err(err);
                })
                .then(() => {
                    this.isLoading = false;
                });
        },

        //funziione di validazione lato frontend per nn fare ricaricare la paginae e bloccare il form
        validateForm() {
            //oggetto vuoto
            const errors = {};

            //controllo se c'è un nome
            if (!this.form.sender_name)
                errors.sender_name = "Il nome è obbligatorio";

            //controllo se  c'è un oggetto
            // if (!this.form.object) errors.object = "L'oggetto è obbligatorio";

            //controllo se c'è un messaggio
            if (!this.form.text) errors.text = "Il messaggio è obbligatorio";

            //controllo se c'è un email
            if (!this.form.sender_email)
                errors.sender_email = "L'email è obbligatoria";

            //controllo se una email è valida
            if (
                this.form.sender_email &&
                !this.form.sender_email.match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                )
            )
                errors.sender_email = "L'email inserita non è valida";

            //metto tutto nel data
            this.errors = errors;
        },
        submitForm() {
            //Svuto gli errori
            this.errors = {};

            //Lanciamo la validazione lato vue
            this.validateForm();

            //Se non ho errori mando il form
            if (!this.hasErrors) this.sendMessage();
        },

        // metodo per chiudere  tutti gli  errori  dentro al div
        resetErrorsAndMessage() {
            this.errors = {};
            this.alertMessage = null;
        },

        sendMessage() {
            //quando parte la chiamata il caricamento
            this.isLoading = true;
            //faccio la chiamata alla mia rotta contact con un oggetto cn tutti i campi del form che voglio passare
            axios
                .post("http://localhost:8000/api/contact-message", this.form)
                .then((res) => {
                    //verifico se ci sn errorri
                    if (res.data.errors) {
                        //creo un oggetto nuovo
                        const errors = {};

                        const { sender_email, text, sender_name } =
                            res.data.errors;

                        //se mi arriva un errore cn la chiave mail // message
                        if (sender_email) errors.sender_email = sender_email[0];
                        if (text) errors.text = text[0];
                        if (sender_name) errors.sender_name = sender_name[0];
                        // if (object) errors.object = object[0];

                        //prendo l'oggetto che ho creato e lo metto nei data
                        this.errors = errors;
                    }
                    //Svuoto i campi
                    else {
                        this.form.sender_email = "";
                        this.form.text = "";
                        this.form.sender_name = "";

                        this.alertMessage = "Messaggio inviato";
                    }
                    this.isLoading = false;
                });
        },
    },
    mounted() {},
    created() {
        this.fetchFlat();
    },
};
</script>

<style lang="scss" scoped>
.container {
    margin-top: 80px;
    margin-bottom: 20px;
    img {
        max-width: 100%;
        object-fit: contain;
        padding: 0;
    }
    i {
        font-size: 1.3rem;
    }
    span {
        font-size: 1.2rem;
    }
    #message-form {
        border: 1px solid lightgray;
        box-shadow: 0 0 5px lightgray;
    }
}
</style>
