<template>
    <div>
        <div class="container">
            <div class="d-flex">
                <form @submit.prevent="getGeoPosition" class="col-12 d-flex">
                    <div class="row">
                        <div class="col-12">
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
                                <ul
                                    class="dropdown_menu w-75 list-unstyled p-1"
                                    v-if="query.length > 0"
                                >
                                    <li
                                        v-for="(address, index) in autocomplete"
                                        :key="index"
                                    >
                                        <input
                                            type="text"
                                            class="w-100"
                                            readonly
                                            :value="address"
                                            @click="setQuery(address)"
                                        />
                                    </li>
                                </ul>
                                <button type="submit">Cerca</button>
                            </div>
        
                        </div>
                        <div class="col-12">
                            <div class="col-3 my-3 mx-4">
                                <p for="radius" class="form-label">
                                    Cerca nel raggio di {{ radius }} km
        
                                    <input
                                        type="range"
                                        min="0"
                                        max="100"
                                        step="10"
                                        v-model="radius"
                                        id="radius"
                                    />
                                </p>
                            </div>
        
                            <div class="d-flex position-relative">
                                <label for="rooms"
                                    >Camere
                                    <input
                                        type="text"
                                        name="room_number"
                                        id="rooms"
                                        v-model="rooms"
                                        @change="getGeoPosition"
                                    />
                                </label>
                            </div>
                            <div class="d-flex position-relative my-5">
                                <label for="bathrooms"
                                    >Bagni
                                    <input
                                        type="number"
                                        name="bathroom_number"
                                        id="bathrooms"
                                        v-model="bathrooms"
                                        @change="getGeoPosition"
                                    />
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <section id="flat-list">
                <h2 class="my-3"></h2>

                <!-- AppLoader -->
                <app-loader v-if="isLoading" />

                <!-- FLAT CARD -->
                <div class="row justify-content-between">
                    <FlatCard
                        v-for="flat in flats"
                        :key="flat.id"
                        :flat="flat"
                    />
                </div>
            </section>
        </div>

        
    </div>
</template>

<script>
import FlatCard from "./flats/FlatCard.vue";

export default {
    name: "SearchBar",
    data() {
        return {
            query: "",
            autocomplete: [],
            radius: 20,
            flats: [],
            allFlats: [],
            lat: "",
            lon: "",
            resultsAPI: "",
            responseAPI: "",
            isLoading: false,
            rooms: 1,
            bathrooms: 1,
        };
    },
    methods: {
        fetchFlats() {
            this.isLoading = true;
            axios
                .get("http://localhost:8000/api/flats")
                .then((res) => {
                    this.flats = res.data;
                    this.allFlats = res.data;
                })
                .catch((err) => {
                    this.error = "Errore durante il fetch dei flats";
                })
                .then(() => {
                    this.isLoading = false;
                });
        },
        getAutocomplete() {
            if (this.query) {
                axios
                    .get(
                        `https://api.tomtom.com/search/2/search/${this.query}.json?key=qSUikbBmShqOxwAwrrHX28luZ27pYwPx&limit=10&countrySet=IT&language=it-IT&limit=10`
                    )
                    .then((response) => {
                        const results = response.data.results;
                        // console.log(results);
                        this.autocomplete = [];
                        results.forEach((result) => {
                            let address = result.address.freeformAddress;

                            // console.log('address', address);
                            // console.log("lat:", result.position.lat);
                            // console.log("lon:", result.position.lon);

                            this.autocomplete.push(address);
                        });
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            }
        },
        setQuery(add) {
            console.log(this.query);
            this.query = add;
            this.autocomplete = [];
        },

        getGeoPosition() {
            // Get Geodata from Axios based on input and radius(2000 standard)
            let query = this.query;
            let radius = this.radius * 1000;
            if (query) {
                this.loading = true;
                axios
                    .get(
                        `https://api.tomtom.com/search/2/geocode/${query}.json?key=qSUikbBmShqOxwAwrrHX28luZ27pYwPx&limit=1&radius=${radius}`
                    )
                    .then((response) => {
                        let lat = response.data.results[0].position.lat;
                        let lon = response.data.results[0].position.lon;
                        console.log("response", response);

                        console.log("geoPoslat", lat);

                        // console.log(lat);
                        //console.log(lon);
                        // Pass Geo data to ApiController and recieve apartements filtered as response
                        let flatList = [];

                        let geometryList = [
                            {
                                type: "CIRCLE",
                                position: `${lat} , ${lon}`,
                                radius: `${radius}`,
                            },
                        ];

                        console.log(
                            "geometrylist",
                            JSON.stringify(geometryList)
                        );
                        console.log("Tutti flats:", this.allFlats);
                        this.allFlats.forEach((flat) => {
                            let flatPOI = {
                                flat: {
                                    name: flat.title,
                                },
                                address: {
                                    freeformAddress: flat.address,
                                },
                                position: {
                                    lat: flat.latitude,
                                    lon: flat.longitude,
                                },
                                info: {
                                    id: flat.id,
                                    rooms: flat.room_number
                                },
                            };

                            flatList.push(flatPOI);
                        });

                        console.log(
                            "JSON geometry:",
                            JSON.stringify(geometryList)
                        );
                        console.log("JSON flatlist", JSON.stringify(flatList));
                        axios
                            .get(
                                `https://api.tomtom.com/search/2/geometryFilter.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&geometryList=${JSON.stringify(
                                    geometryList
                                )}&poiList=${JSON.stringify(flatList)}`
                            )
                            .then((response) => {
                                console.log("response:", response.data.results);
                                const tomtomResponse = response.data.results;
                                this.loading = false;

                                const flatIds = [];

                                tomtomResponse.forEach((flat) => {
                                    flatIds.push(flat.info.id);
                                });

                                console.log('flatIds', flatIds);


                                const filterdFlats = this.allFlats.filter(
                                    (flat) => {
                                console.log(flat);

                                        return flatIds.includes(flat.id)
                                            && flat.room_number >= this.rooms
                                            && flat.bathroom_number >= this.bathrooms;
                                    }
                                );
                                console.log(filterdFlats);
                                this.flats = filterdFlats;
                            })
                            .catch((error) => console.error(error));
                    })
                    .catch((e) => console.error(e));
            }
        },

        filterFlats() {
            let flatList = [];
            console.log("lat", this.lat);
            let geometryList = [
                {
                    type: "CIRCLE",
                    position: `${this.lat} , ${this.lon}`,
                    radius: `${this.radius}`,
                },
            ];

            this.flats.forEach((flat) => {
                let flatPOI = {
                    poi: {
                        name: flat.title,
                    },
                    address: {
                        freeformAddress: flat.address,
                    },
                    position: {
                        lat: flat.lat,
                        lon: flat.lon,
                    },
                };

                flatList.push(flatPOI);
            });
            // console.log("geolist", JSON.stringify(geometryList));
            //console.log(JSON.stringify(flatList));
            axios
                .get(
                    `https://api.tomtom.com/search/2/geometryFilter.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&geometryList=${JSON.stringify(
                        geometryList
                    )}&poiList=${JSON.stringify(flatList)}`
                )
                .then((response) => {
                    console.log("response:", response.data);
                    this.flats = response.data;
                    this.loading = false;
                })
                .catch((error) => console.error(error));
        },
    },
    mounted() {
        if (this.$route.params.query) {
            this.query = this.$route.params.query;
        }
        if (this.$route.params.radius) {
            this.radius = this.$route.params.radius;
        }
        this.fetchFlats();
    },
    components: { FlatCard },
};
</script>

<style lang="scss" scoped>
.dropdown_menu {
    position: absolute;
    width: 100%;
    z-index: 100;

    input {
        cursor: pointer;

        &:focus {
            background-color: #3471eb;
        }
    }
}

.group {
    position: relative;
}

.input {
    font-size: 16px;
    padding: 10px 10px 10px 5px;
    display: block;
    width: 300px;
    border: none;
    border-bottom: 1px solid #515151;
    background: transparent;
}

.input:focus {
    outline: none;
}

label {
    color: #999;
    font-size: 18px;
    font-weight: normal;
    position: absolute;
    pointer-events: none;
    left: 5px;
    top: 10px;
    transition: 0.2s ease all;
    -moz-transition: 0.2s ease all;
    -webkit-transition: 0.2s ease all;
}

.input:focus ~ label,
.input:valid ~ label {
    top: -20px;
    font-size: 14px;
    color: #3471eb;
}

.bar {
    position: relative;
    display: block;
    width: 200px;
}

.bar:before,
.bar:after {
    content: "";
    height: 2px;
    width: 0;
    bottom: 1px;
    position: absolute;
    background: #3471eb;
    transition: 0.2s ease all;
    -moz-transition: 0.2s ease all;
    -webkit-transition: 0.2s ease all;
}

.bar:before {
    left: 50%;
}

.bar:after {
    right: 50%;
}

.input:focus ~ .bar:before,
.input:focus ~ .bar:after {
    width: 50%;
}

.highlight {
    position: absolute;
    height: 60%;
    width: 100px;
    top: 25%;
    left: 0;
    pointer-events: none;
    opacity: 0.5;
}

.input:focus ~ .highlight {
    animation: inputHighlighter 0.3s ease;
}

@keyframes inputHighlighter {
    from {
        background: #3471eb;
    }

    to {
        width: 0;
        background: transparent;
    }
}

.loader {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
}

#page-loader {
    width: 150px;
    height: 150px;

    circle {
        fill: none;
        stroke-width: 5;
        stroke-linecap: round;
        animation-name: loader;
        animation-duration: 4s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        transform-origin: center center;

        &:nth-child(1) {
            stroke: #ffc114;
            stroke-dasharray: 50;
            animation-delay: -0.2s;
        }

        &:nth-child(2) {
            stroke: #ff5248;
            stroke-dasharray: 100;
            animation-delay: -0.4s;
        }

        &:nth-child(3) {
            stroke: #19cdca;
            stroke-dasharray: 180;
            animation-delay: -0.6s;
        }

        &:nth-child(4) {
            stroke: #4e88e1;
            stroke-dasharray: 350;
            stroke-dashoffset: -100;
            animation-delay: -0.8s;
        }

        @keyframes loader {
            50% {
                transform: rotate(360deg);
            }
        }
    }
}

.card {
    border: none;
    height: 100%;
    padding: 0.5rem;
    background-color: #f8fafc;
    transition: border 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 5px;
    transition: transform 0.5s;

    &:hover {
        box-shadow: 0 0 10px 4px #d0d0d0e8;
        transform: scale(1.05);
        z-index: 1;
    }

    img {
        width: 100%;
        min-height: 160px;
        border-radius: 10px;
    }
}

.header-card {
    margin-top: 10px;
    height: 45px;
    padding: 0;
    display: flex;
    justify-content: space-between;

    .custom-title {
        color: #050505;
        font-size: 13px;
        font-weight: bold;
        display: -webkit-box;
        line-height: 1.2rem;
        overflow: hidden;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        /*     white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; */
    }
}

.costum-text {
    color: #515151;
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

form > .row {
    align-items: flex-end;
}

/* From uiverse.io by @adamgiebl */
button {
    font-family: inherit;
    font-size: 20px;
    background: #3471eb;
    color: white;
    padding: 0.2em 0.5em;
    padding-left: 0.7em;
    display: flex;
    align-items: center;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.2s;
    margin-top: 5px;
}

button span {
    display: block;
    margin-left: 0.3em;
    transition: all 0.3s ease-in-out;
}

button svg {
    display: block;
    transform-origin: center center;
    transition: transform 0.3s ease-in-out;
}

button:hover .svg-wrapper {
    animation: fly-1 0.6s ease-in-out infinite alternate;
}

button:hover svg {
    transform: translateX(1.2em) rotate(45deg) scale(1.1);
}

button:hover span {
    transform: translateX(5em);
}

button:active {
    transform: scale(0.95);
}

@keyframes fly-1 {
    from {
        transform: translateY(0.1em);
    }

    to {
        transform: translateY(-0.1em);
    }
}

.wrapper {
    min-height: calc(100vh - 173px);
}
</style>
