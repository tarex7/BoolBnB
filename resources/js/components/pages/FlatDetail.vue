<template>
  <section id="flat-detail">
    Show Appartamenti Dettagli
    <flat-card />
  </section>
</template>

<script>
//IMPORTO FLAT CARD
import FlatCard from "../flats/FlatCard.vue";

export default {
  name: "FlatDetail",

  //COMPONENTS
  components: { FlatCard },

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