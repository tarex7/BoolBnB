<template>
  <section id="flat-list">
    <div class="container-fluid px-3">
      <h2 class="my-3">APPARTAMENTI</h2>

      <!-- AppLoader -->
      <app-loader v-if="isLoading" />

      <!-- FLAT CARD -->
      <div class="row g-3">
        <flat-card v-for="flat in flats" :key="flat.id" :flat="flat" />
      </div>
    </div>
  </section>
</template>

 <script>
import FlatCard from "../flats/FlatCard.vue";
export default {
  name: "FlatList",
  data() {
    return {
      flats: [],
      isLoading: false,
    };
  },
  components: { FlatCard },
  methods: {
    fetchPosts() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/flats")
        .then((res) => {
          this.flats = res.data;
        })
        .catch((err) => {
          this.error = "Errore durante il fetch dei flats";
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