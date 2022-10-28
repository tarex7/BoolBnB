<template>
  <div id="home-page">
    <AppJumbotron />
    <!-- FLAT LIST COMPONENTE-->
    <flat-list />
  </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";
import AppJumbotron from "../AppJumbotron.vue";
export default {
  name: "HomePage",
  //COMPONENTS
  components: { AppJumbotron, FlatList },
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
</style>