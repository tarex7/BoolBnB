
<template>
    <div class="container">
        test
        {{sponsorships}}
        <form action="/action_page.php">
            <label for="cars">Scegli la sponsorizzazione:</label>
            <select name="sponsorships" id="sponsorships">
                <option v-for="sponsorship in sponsorships" :key="sponsorship.id" :value="sponsorship">
                    {{ sponsorship.price }}
                </option>
                <option value="volvo">Volvo</option>

            </select>
        </form>

        <SponsorshipList />
    </div>

</template>
  
  <script>
  import SponsorshipList from "./SponsorshipList.vue";
  import axios from 'axios'
  export default {
    components: { SponsorshipList,},
    data(){
        return {
            loading:true,
            sponsorships:[] ,       
        }
    },
    async mounted() {
        this.loading = true
        const response= await axios.get('api/sponsorships')
        this.sponsorships = response.data.data;
    },
  };
  </script>
  
  <style lang="scss" scoped>
  </style>