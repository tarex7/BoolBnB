<template>
  <div class="card col-3 m-4 p-0">
    <img
      class="card-img-top  p-2"
      :src="`/storage/${flat.image}`"
      alt="Card image cap" style="height:300px"
    />
    <div class="card-body">
      <input type="number" name="" id="">

      <div class="row justify-content-between">
        <div class="col-6">
        </div>
        <div class="col-6 p-1 m-1 button">
          <router-link
            :to="{ name: 'flat-detail', params: { id: flat.id } }"
            class="ml-5 mt-2 btn btn-primary btn-sm"
            ><i class="fa-solid fa-eye"></i> Vedi</router-link
          >
        </div>
      </div>
      <h5 class="card-title">{{ flat.title }}</h5>

      <p class="card-text">
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "FlatCard",
  data() {
    return {
      isLoading: false,
    };
  },
  props: { flat: Object },
  methods: {

    
  },
};
</script>

<style lang="scss">

.card {
  img {
    height: 250px;
  }
}

</style>