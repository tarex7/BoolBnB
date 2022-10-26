<template>
    <div>
        <div class="form-group">
            <label for="address">Indirizzo:</label>
            <div id="address-tomtom"></div>

            <input id="lat" type="text" class="form-control" name="latitude" 
                value="" hidden>
    
            <input id="lon" type="text" class="form-control" name="longitude" 
                value="" hidden>
    
    
        </div>
    </div>
</template>


<script>
export default {
    name: 'SearchBar',



    mounted() {
        var options = {
                    searchOptions: {
                        key: 'I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh',
                        language: 'it-IT',
                        limit: 10,
                    },
                    autocompleteOptions: {
                        key: 'I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh',
                        language: 'it-IT',
                    }
                };
                const latInput = document.getElementById('lat');
                const lonInput = document.getElementById('lon');
                const addressContainer = document.getElementById('address-tomtom')
            
                const testbtn = document.getElementById('test');
            
                var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
                var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
                addressContainer.append(searchBoxHTML);
                const tomtomInput = document.getElementsByClassName("tt-search-box-input")[0];
                let date = {}
                ttSearchBox.on("tomtom.searchbox.resultsfound", function(data) {
                    date = (data);
                    let position = date.data.results.fuzzySearch.results[0].position;
                    let lon = position.lng;
                    let lat = position.lat;
                    latInput.value = lat;
                    lonInput.value = lon;
                });
                tomtomInput.setAttribute("name", "address");
                tomtomInput.value = "<?php echo $flat->address; ?>";
            
                 //let axios = require('axios').default;
            
                
            
            
                addressContainer.addEventListener("input", (e) => {
                    console.log('call');
                     axios.get(
                             `https:api.tomtom.com/search/2/autocomplete/${addressContainer.value}.json?key=I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh&language=it-IT&limit=6`
                         )
                         .then((res) => {
                             console.log(res.data);
                         })
                });
    },
}






</script>


<style>


</style>