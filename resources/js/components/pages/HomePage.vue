<template>
  <div id="home-page">
    stampo tutti gli appartamenti!!!!!
    <flat-list />
  </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";

export default {
  name: "HomePage",

  //COMPONENTS
  components: { FlatList },

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