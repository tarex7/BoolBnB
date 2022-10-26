<template>
  <div class="card col-3 m-4 p-2">
    <img
      class="card-img-top img-fluid"
      :src="`/storage/${flat.image}`"
      alt="Card image cap"
    />
    <div class="card-body">

      <div class="row justify-content-between">
        
        <h5 class="card-title">{{ flat.title }}</h5>
        <div class="col-12 p-0 m-0">
          <router-link
            :to="{ name: 'flat-detail', params: { id: flat.id } }"
            class="ml-5 mt-2 btn btn-primary btn-sm"
            ><i class="fa-solid fa-eye"></i> Vedi</router-link
          >
        </div>

      </div>


    </div>
  </div>
</template>

<script>
export default {
  name: "FlatCard",

  props: { flat: Object },
  methods: {},
};
</script>
<style scoped lang="scss">
.card {
  img {
    height: 250px;
  }
}
</style>