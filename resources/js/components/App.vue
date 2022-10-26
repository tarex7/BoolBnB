<template>
  <div class="content">
    <!-- HEADER -->
    <!-- <app-header :title="title" /> -->
    <app-jumbotron />
    <main class="container my-3">
      <!-- JUMBOTRON -->
      <!-- ROTTE VIEW (CONTENUTO DINAMICO ALl'INTERNO DELLE PAGINE) -->
      <router-view></router-view>
    </main>

    <!--FOOTER -->
    <app-footer />
  </div>
</template>

<script>
// IMPORT COMPONENTS
//import AppHeader from "./AppHeader.vue";
import AppJumbotron from "./AppJumbotron.vue";
import AppFooter from "./AppFooter.vue";
export default {
  name: "App",
  // COMPONENTS
  components: {AppJumbotron, AppFooter },
  name: "App",
  // DATA
  data() {
    return {
      title: "BoolBnb",
    };
  },
  // MOUNTED
  mounted() {},
};
</script>