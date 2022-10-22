<template>
  <div id="home-page">
    <SearchBar />
    <flat-list />
  </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";
import SearchBar from "../flats/SearchBar.vue";

export default {
  name: "HomePage",

  //COMPONENTS
  components: { FlatList, SearchBar },

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