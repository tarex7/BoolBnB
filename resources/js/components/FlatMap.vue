<template>
  <div class="map my-3" id="map" ref="mapRef"></div>
</template>

<script>
export default {
  name: "SingleMap",
  props: { flat: Object },
  data: function () {
    return {
      popupOffsets: {
        top: [0, 0],
        bottom: [0, -40],
        "bottom-right": [0, -70],
        "bottom-left": [0, -70],
        left: [25, -35],
        right: [-25, -35],
      },
      array: [],
    };
  },
  methods: {
    initializeMap(lon, lat) {
      this.map = tt.map({
        key: "I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh",
        container: this.$refs.mapRef,
        center: [lon, lat],
        zoom: 12,
      });
      let marker = new tt.Marker().setLngLat([lon, lat]).addTo(this.map);
      let popup = new tt.Popup({ offset: this.popupOffsets }).setHTML(
        `<b>${this.flat.title}</b><pre> prezzo per notte: ${this.flat.price_per_day} €</pre>`
      );
    },
  },
  mounted() {
    this.initializeMap(this.flat.longitude, this.flat.latitude);
  },
};
</script>

<style lang="scss" scoped>
#map {
  width: 100%;
  height: 500px;
}
</style>