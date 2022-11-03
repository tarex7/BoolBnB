<template>
  <section id="jumbotron">
    
  </section>
</template>

<script>
export default {
  name: "AppJumbotron",
  // COMPONENTS
  components: {},
  // DATA
  data() {
    return {};
  },
  //PROPS
  props: {},
  //METHODS
  methods: {},
  //COMPUTED
  computed: {},
};
</script>


<!-- STYLE -->
<style lang="scss" scoped>
#jumbotron {
  height: 700px;
  background-image: url("./../../../public/images/jumbo.png");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;

  @media screen and (max-width: 800px) {
    height: 400px;
  }
}
</style>