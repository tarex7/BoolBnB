<template>
  <section id="posts-list">
    <h2 class="my-3">Appartamenti</h2>

    <!-- AppLoader -->
    <app-loader v-if="isLoading" />
  </section>
</template>

<script>
//IMPORTO LA CARD DEI SINGOLI FLAT
// import FlatCard from "./FlatCard.vue";
export default {
  name: "FlatList",
  data() {
    return {
      //   flats: [],
      isLoading: false,
    };
  },
  //   components: { FlatCard },
  methods: {
    fetchPosts(page = 1) {
      this.isLoading = true;
      axios
        //   CHIAMATA  QUANDO PASSEREMO I DATI FLATS DAL BACKEND PER STAMPARE  SINGOLE PAGINE
        .get(`http://localhost:8000/api/flats?page=${page}`)
        .then((res) => {
          const { data } = res.data;
          this.flats = data;
        })
        .catch(() => {
          this.error = "Errore durante il fetch dei post";
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