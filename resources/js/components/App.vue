<template>
  <div class="content">
    <!-- HEADER -->
    <app-header :title="title" />

    <!-- JUMBOTRON -->
    <app-jumbotron />

    <!--FOOTER -->
    <app-footer />
  </div>
</template>

<script>
// IMPORT COMPONENTS
import AppHeader from "./AppHeader.vue";
import AppJumbotron from "./AppJumbotron.vue";
import AppFooter from "./AppFooter.vue";

export default {
  name: "App",

  // COMPONENTS
  components: { AppHeader, AppJumbotron, AppFooter },

  name: "App",
  // DATA
  data() {
    return {
      title: "BoolBnb",
    };
  },
  // MOUNTED
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
