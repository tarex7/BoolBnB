<template>
  <div  class="col-12">
    <div class="card" >
      <img class="card-img-top img-fluid" :src="`storage/${flat.image}`" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FlatCard",
  data() {
    return {};
  },

  props: { flat: Object, flats: Array, i: Number },
  methods: {},
};
</script>
<style scoped lang="scss">
/*#flat-card {
  position: relative;
  .flat-img {
    position: relative;

    img {
      width:100%;
      height: 300px;
      filter: opacity(1);
      transition: all 0.5s;
      object-fit: cover;
    }
    .sponsor {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #cecece;
      background-color: black;
      padding: 4px;
    }
  }

 /* .flat-info {
    position: absolute;
    bottom: 10px;
    left: 30px;
    background-color:rgba($color: #fff, $alpha: 0.75);
    width: 70%;
    padding: 1rem;
    transition: all 0.5s;
    opacity: 1;
    border-radius: 5px;
    box-shadow: #000 1px 2px 13px ;
    font-weight: bold;

    p {
      margin: 0;
    }
  }*/
 /* .flat-description {
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
      overflow: hidden;
      text-overflow: ellipsis;
      max-height: 90px;
    }*/
   /* .show-button {
      background-color: black;
      border: 2px solid black;
      padding: 12px;
      position: absolute;
      bottom: 30px;
      color: white;
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
}*/

.card {

  img {
    max-height:500px;
    max-width:500px;
    height:auto;
    width:auto;
  }
}



</style>