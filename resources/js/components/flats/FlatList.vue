<template>
  <section id="posts-list">
    <h2 class="my-3">Appartamenti</h2>

    <!-- AppLoader -->
    <app-loader v-if="isLoading" />

    <!-- Flat Card -->
    <flat-card />

    <!-- PAGINATION -->
    <app-pagination />
  </section>
</template>

<script>
//IMPORTO PAGINATION
import AppPagination from "../AppPagination.vue";
//IMPORTO LA CARD DEI SINGOLI FLAT
import FlatCard from "./FlatCard.vue";

export default {
  name: "FlatsList",
  data() {
    return {
      flats: [],
      isLoading: false,
    };
  },
  components: { FlatCard, AppPagination },

  methods: {
    fetchFlats() {
      this.isLoading = true;
      axios

        //CHIAMATA  QUANDO PASSEREMO I DATI FLATS DAL BACKEND PER STAMPARE  SINGOLE PAGINE
        .get(`http://localhost:8000/api/flats`)
        .then((res) => {
          console.log(res.data);
          const data = res.data;
          this.flats = data;
        })
        .catch(() => {
          this.error = "Errore durante il fetch degli appartamenti";
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>
<style scoped lang="scss">
</style>