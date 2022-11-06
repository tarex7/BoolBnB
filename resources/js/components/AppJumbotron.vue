<template>
    <section id="jumbotron" class="position-relative">
        <SearchBar v-if="homepage"/>
    </section>
</template>

<script>
import SearchBar from "./SearchBar.vue";

export default {
    name: "AppJumbotron",
    // COMPONENTS
    components: { SearchBar },
    // DATA
    data() {
        return {
            
        };
    },
    //PROPS
    props: {},
    //METHODS
    methods: {},
    //COMPUTED
  computed: {
    homepage() {
        return this.$router.currentRoute.name === 'home'
      }
    },
};
</script>

<!-- STYLE -->
<style lang="scss" scoped>
#jumbotron {
    position: relative;
    height: 500px;
    background-image: url("./../../../public/images/jumbo.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;

    @media screen and (max-width: 800px) {
        height: 400px;
    }

    .searchbar {
        width: 80%;
    }

    .search-container {
        height: 100%;
    }
}
</style>
