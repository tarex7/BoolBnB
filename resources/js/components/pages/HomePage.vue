<template>
    <div id="home-page" >
        <AppJumbotron />
        <SearchBar />
        <!-- <div class="container-fluid">
            <div class="col-8 offset-2">
                <flat-list  :filteredFlats="flats"/>
            </div>
        </div> -->
        <!-- FLAT LIST COMPONENTE-->
    </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";
import AppJumbotron from "../AppJumbotron.vue";
import SearchBar from "../SearchBar.vue";
export default {
    name: "HomePage",
    //COMPONENTS
  components: { AppJumbotron, FlatList, SearchBar },

  
    
    // DATA
    data() {
      return {
        flats: [],
          test:""
        };
    },
    //PROPS
    props: {},
    //METHODS
  methods: {
    getDataFromSearch(test) {
       this.test = test
      }
    },
    //COMPUTED
    computed: {},
};
</script>

<!-- STYLE -->
<style lang="scss" scoped> </style>
