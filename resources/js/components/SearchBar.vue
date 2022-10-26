<template>
    <div>
        <form action="">
          <div class="group">
            <input
              autocomplete="off"
              required=""
              type="text"
              id="query_address"
              v-model="query"
              @keyup="getAutocomplete"
              @keyup.enter="getGeoPosition"
             
              class="input"
            />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Cerca per città o per indirizzo:</label>
            <ul class="dropdown_menu w-50" v-if="query.length > 0">
              <li v-for="(address, index) in autocomplete" :key="index">
                <input
                  type="text"
                  class="w-100"
                  readonly
                  :value="address"
                  @click="setQuery(address)"
                />
              </li>
            </ul>
          </div>

        </form>
    </div>
</template>


<script>
export default {
  name: 'SearchBar',

data() {
  return {
    query: "",
    autocomplete: [],
    radius:20,
  }
},

 
  methods: {
    getAutocomplete() {
      if (this.query) {
        axios
          .get(
            `https://api.tomtom.com/search/2/search/${this.query}.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&limit=5&countrySet=IT&language=it-IT`
          )
          .then((response) => {
            const results = response.data.results;
            this.autocomplete = [];
            results.forEach((result) => {
              let address = result.address.freeformAddress;
              this.autocomplete.push(address);
            });
          })
          .catch((e) => {
            console.log(e);
          });
      }
    },
    setQuery(add) {
      this.query = add;
      this.autocomplete = [];
    },
    getGeoPosition() {
      this.apartments = [];
      // Get Geodata from Axios based on input and radius(2000 standard)
      let query = this.query;
      let radius = this.radius * 1000;

      if (query) {
        this.loading = true;
        axios
          .get(
            `https://api.tomtom.com/search/2/geocode/${query}.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&limit=1&radius=${radius}`
          )
          .then((response) => {
            let lat = response.data.results[0].position.lat;
            let lon = response.data.results[0].position.lon;
            this.lat = lat;
            this.lon = lon;

            

            

            // Pass Geo data to ApiController and recieve apartements filtered as response
            axios
              .get("api/search", {
                params: {
                  lat: this.lat,
                  lon: this.lon,
                  radius: radius,
                  rooms: this.rooms,
                  beds: this.beds,
                  baths: this.baths,
                  services: this.selectedServices,
                },
              })
              .then((response) => {
                this.apartments = response.data;
                this.loading = false;
              })
              .catch((error) => console.error(error));
          })
          .catch((e) => console.error(e));
      }
    },
  },

}




</script>


<style>


</style>