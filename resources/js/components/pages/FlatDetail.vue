<template>
  <div id="post-detail-page">
    <h1>Flat</h1>
    <AppLoader v-if="isLoading" />
    <div v-else-if="!isLoading && flat" :flat="flat">
      <div class="card">
        <div class="row">
          <div class="col-6 h-100">
            <img
              class="card-img-top"
              :src="`/storage/${flat.image}`"
              alt="Card image cap"
            />
          </div>
          <div class="col-6">
            <div class="card-body">
              <div class="row justify-content-between">
                <div class="col-6">
                  <h1>{{ flat.id }}</h1>
                </div>
              </div>
              <h5 class="card-title">{{ flat.title }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">test:</h6>
              <h6 class="card-subtitle mb-2 text-muted">Test:</h6>
              <p class="card-text">
                {{ flat.description }}
              </p>
            </div>
          </div>
        </div>

        <!-- <div class="card-body">
      <a href="#" class="card-link">Card link</a>
      <a href="#" class="card-link">Another link</a>
    </div> -->
      </div>
    </div>
  </div>
</template>

<script>
import FlatCard from "../flats/FlatCard.vue";
import AppLoader from "../AppLoader.vue";
export default {
  name: "FlatDetail",
  components: { AppLoader, FlatCard },
  data() {
    return {
      flat: null,
      isLoading: false,
    };
  },
  methods: {
    fetchPost() {
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
  },
  mounted() {
    this.fetchPost();
  },
};
</script>

<style scoped>
img {
  width: 100vh - 90px;
  height: 500px;
}
</style>