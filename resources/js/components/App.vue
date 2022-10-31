<template>
  <div class="content">
    <!-- HEADER -->

    <!-- JUMBOTRON -->

    <!-- ROTTE VIEW (CONTENUTO DINAMICO ALl'INTERNO DELLE PAGINE) -->
    <router-view></router-view>

    <!--FOOTER -->
    <AppFooter />
  </div>
</template>

<script>
// IMPORT COMPONENTS
//import AppHeader from "./AppHeader.vue";

import AppFooter from "./AppFooter.vue";

export default {
  name: "App",
  // COMPONENTS
  components: { AppFooter },
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