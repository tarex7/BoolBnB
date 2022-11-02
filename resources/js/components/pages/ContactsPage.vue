<template>
  <section id="contact-page">
    <h1>Contacts</h1>
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
        <div v-if="alertMessage">{{ alertMessage }}</div>
        <!-- gestisco gli errori -->
        <ul v-if="hasErrors">
          <!-- per ogni elemento dell'oggetto prendimi la chiava e prendimi il messaggio -->
          <li v-for="(error, key) in errors" :key="key">
            {{ error }}
          </li>
        </ul>
      </AppAlert>
      <!-- intercetto vue sumbit.prevent per non ricaricare la pagina -->
      <form class="contact - form" @submit.prevent="submitForm" novalidate>
        <!-- utente -->
        <div class="form-group">
          <label for="sender_name" class="form-label">Nome</label>
          <input
            type="text"
            class="form-control"
            :class="{ 'is-invalid': errors.sender_name }"
            id="sender_name"
            v-model.trim="form.sender_name"
          />
          <!-- STAMPO GLI ERRORI -->
          <div v-if="errors.sender_name" class="invalid-feedback">
            {{ errors.sender_name }}
          </div>
          <div v-else class="form-text">Scrivi il tuo nome</div>

          <!-- Object -->
          <label for="object" class="form-label">Oggetto</label>
          <input
            type="text"
            class="form-control"
            :class="{ 'is-invalid': errors.object }"
            id="object"
            v-model.trim="form.object"
          />
          <!-- STAMPO GLI ERRORI -->
          <div v-if="errors.object" class="invalid-feedback">
            {{ errors.object }}
          </div>
          <div v-else class="form-text">Scrivi l'oggetto del messaggio</div>
        </div>

        <div class="form-group">
          <label for="sender_email" class="form-label">Indirizzo Email</label>
          <input
            type="email"
            class="form-control"
            :class="{ 'is-invalid': errors.sender_email }"
            id="sender_email"
            v-model.trim="form.sender_email"
          />
          <!-- STAMPO GLI ERRORI -->
          <div v-if="errors.sender_email" class="invalid-feedback">
            {{ errors.sender_email }}
          </div>
          <div v-else class="form-text">
            Ti Risponderemo su questo indirizzo
          </div>
        </div>
        <!-- Text-Area -->
        <div class="mb-3">
          <label for="text" class="form-label"
            >Inserisci qua il tuo messaggio</label
          >
          <textarea
            class="form-control"
            :class="{ 'is-invalid': errors.text }"
            id="text"
            rows="10"
            v-model.trim="form.text"
          ></textarea>
          <!-- STAMPO GLI ERRORI -->
          <div v-if="errors.text" class="invalid-feedback">
            {{ errors.text }}
          </div>
          <div v-else class="form-text">
            Scrivi tutto quello che deisideri sapere
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-success">Invia</button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
export default {
  name: "ContactsPage",
  // COMPONENTS
  components: {},
  // DATA
  data() {
    return {
      //DATA DENTRO AL FORM
      form: {
        sender_name: "",
        sender_email: "",
        text: "",
        object: "",
      },
      //Data degli errori possibili

      isLoading: false,
      alertMessage: null,
      errors: {},
    };
  },
  //PROPS
  //  props:["flat_id"], da mettere

  //METHODS
  methods: {
    //funziione di validazione lato frontend per nn fare ricaricare la paginae e bloccare il form
    validateForm() {
      //oggetto vuoto
      const errors = {};

      //controllo se c'è un nome
      if (!this.form.sender_name) errors.sender_name = "Il nome è obbligatorio";

      //controllo se  c'è un oggetto
      if (!this.form.object) errors.object = "L'oggetto è obbligatorio";

      //controllo se c'è un messaggio
      if (!this.form.text) errors.text = "Il messaggio è obbiglatorio";

      //controllo se c'è un email
      if (!this.form.sender_email)
        errors.sender_email = "L'email è obbiglatoria";

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
          console.log("iniviato");
          //verifico se ci sn errorri
          if (res.data.errors) {
            //creo un oggetto nuovo
            const errors = {};

            const { sender_email, text, object, sender_name } = res.data.errors;

            //se mi arriva un errore cn la chiave mail // message
            if (sender_email) errors.sender_email = sender_email[0];
            if (text) errors.text = text[0];
            if (sender_name) errors.sender_name = sender_name[0];
            if (object) errors.object = object[0];

            //prendo l'oggetto che ho creato e lo metto nei data
            this.errors = errors;
          }
          //Svuoto i campi
          else {
            this.form.sender_email = "";
            this.form.text = "";
            this.form.sender_name = "";
            this.form.object = "";
            this.alertMessage = "Messaggio inviato";
          }
        })
        .catch((err) => {
          this.errors = { http: "Si è verificato un errore" };
        })
        .then(() => {
          //quando termina la chiamata il caricamento (spengo)
          this.isLoading = false;
        });
    },
  },
  //COMPUTED
  computed: {
    hasErrors() {
      //Objeykey  restiusce le chiavi dell'oggetto in cui è dentro
      //con  lenght quantità di chiavi dell'oggetto
      return Object.keys(this.errors).length;
    },
  },
};
</script>



<!-- STYLE -->

<style lang="scss" scoped>
ul {
  list-style-type: none;
}
</style>>