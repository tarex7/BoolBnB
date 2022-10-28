<template>
  <div id="flat-card" class="col-12 col-sm-6 col-xl-4">
    <div class="flat-img">
      <img
        class="w-100 img-fluid"
        :src="`/storage/${flat.image}`"
        alt="Card image cap"
      />
    </div>
    <div class="flat-info">
      <h5 class="fs-bold">{{ flat.title }}</h5>
      <p>Prezzo: {{ flat.price_per_day }}€ per notte.</p>
    </div>
    <div class="flat-description">
      <router-link
        :to="{ name: 'flat-detail', params: { id: flat.id } }"
        class="ml-5 mt-2 btn btn-primary btn-sm"
      >
        <i class="fa-solid fa-eye"></i> Vedi
      </router-link>
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
#flat-card {
  .flat-img {
    img {
      position: relative;
      height: 400px;
      &:hover {
        filter: opacity(0.5);
      }
    }
  }
  .flat-info {
    position: absolute;
    bottom: 50px;
    left: 30px;
    background-color: #fff;
    width: 70%;
    padding: 1rem;
    h5 {
    }
    p {
      margin: 0;
    }
  }
}
</style>