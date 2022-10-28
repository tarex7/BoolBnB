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
      <form class="contact - form" @submit.prevent="sendForm">
        <div class="form-group">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            class="form-control"
            id="email"
            v-model.trim="form.email"
          />
          <div class="form-text">Ti Risponderemo su questo indirizzo</div>
        </div>
        <!-- Text-Area -->
        <div class="mb-3">
          <label for="message" class="form-label"
            >Inserisci qua il tuo messaggio</label
          >
          <textarea
            class="form-control"
            id="message"
            rows="10"
            v-model.trim="form.message"
          ></textarea>
          <div class="form-text">Scrivi tutto quello che deisideri sapere</div>
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
        email: "",
        message: "",
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
    sendForm() {
      //quando parte la chiamata il caricamento
      this.isLoading = true;
      //faccio la chiamata alla mia rotta contact con un oggetto cn tutti i campi del form che voglio passare
      axios
        .post("http://localhost:8000/api/contact-message", this.form)
        .then(() => {
          //Svuoto i campi
          this.form.email = "";
          this.form.message = "";
          this.alertMessage = "Messaggio inviato";
        })
        .catch((err) => {
          this.errors = { http: "Si è verificato un errore" };
        })
        .then(() => {
          //quando termina la chiamata il caricamento (spengo)
          this.isLoading = false;
        });
    },

    // metodo per chiudere  tutti gli  errori  dentro al div
    resetErrorsAndMessage() {
      this.errors = {};
      this.alertMessage = null;
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