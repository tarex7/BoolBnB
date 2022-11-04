<template>
  <div id="home-page">
      <AppJumbotron/>
      
      
      <!-- <div class="container-fluid">
      <div class="col-8 offset-2">
        <flat-list  :filteredFlats="flats"/>
        
      </div>
    </div> -->
      <!-- FLAT LIST COMPONENTE-->
      <router-view @search="getData"></router-view>

      <AppFooter />
  </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";
import AppJumbotron from "../AppJumbotron.vue";
import AppFooter from "../AppFooter.vue";
import SearchBar from "../SearchBar.vue";
import { title } from "process";

export default {
  name: "HomePage",
  //COMPONENTS
  components: { AppJumbotron, FlatList, SearchBar, AppFooter },

  // DATA
  data() {
      return {
          flats: [],
          test: "",
      };
  },
  //PROPS
  props: {
      title: String,
  },
  //METHODS
  methods: {
      getData(prop) {
          console.log(prop);
      },
  },
  //COMPUTED
  computed: {},
};
</script>

<!-- STYLE -->
<style lang="scss"></style>
