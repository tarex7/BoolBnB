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
      <h5 class="fs-bold">{{ flat.title }}</h5>
      <p>Prezzo: {{ flat.price_per_day }}€ per notte.</p>
      <p>{{ flat.description }}</p>
      <router-link
        :to="{ name: 'flat-detail', params: { id: flat.id } }"
        class="show-button"
      >
        <i class="fa-solid fa-eye"></i> Mostra Appartamento
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
    position: relative;

    img {
      height: 400px;
      filter: opacity(1);
      transition: all 0.5s;
    }
  }

  .flat-info {
    position: absolute;
    bottom: 50px;
    left: 30px;
    background-color: #fff;
    width: 70%;
    padding: 1rem;
    transition: all 0.5s;
    opacity: 1;

    p {
      margin: 0;
    }
  }
  .flat-description {
    height: 300px;
    padding: 30px;
    width: 70%;
    background-color: white;
    position: absolute;
    bottom: 350px;
    left: 30px;
    visibility: hidden;
    transition: all 0.5s;
    opacity: 0;
    z-index: -1;
    // transition-delay: 0.2s;
    p {
      margin: 0;
    }
    .show-button {
      background-color: black;
      border: 2px solid black;
      padding: 12px;
      position: absolute;
      bottom: 30px;
      color: white;
    }
  }
}

#flat-card:hover .flat-info {
  visibility: hidden;
  bottom: -100px;
  opacity: 0;
  color: white;
  z-index: -1;
}
#flat-card:hover .flat-description {
  visibility: visible;
  opacity: 1;
  bottom: 50px;

  z-index: 1;
}
#flat-card:hover img {
  filter: opacity(0.4);
}
</style>