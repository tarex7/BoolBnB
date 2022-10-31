<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div
                            class="collapse navbar-collapse d-flex align-items-center"
                            id="navbarSupportedContent"
                        >
                            <form
                                @submit.prevent="getGeoPosition"
                                class="form-inline my-2 my-lg-0 d-flex align-items-center"
                            >
                                <input
                                    class="form-control mr-sm-2 input"
                                    type="search"
                                    placeholder="Dove vuoi andare?"
                                    aria-label="Search"
                                    autocomplete="off"
                                    required=""
                                    id="query_address"
                                    v-model="query"
                                    @keyup="getAutocomplete"
                                    @keyup.enter="getGeoPosition"
                                />
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
                                <button
                                    class="btn btn-outline-danger my-2 my-sm-0 ms-3"
                                    type="submit"
                                >
                                    Cerca
                                </button>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ms-5"
                                            >Camere</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="room_number"
                                        id="rooms"
                                        v-model="rooms"
                                        @change="getGeoPosition"
                                    />
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ms-5"
                                            >Letti</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="beds_number"
                                        id="beds"
                                        v-model="beds"
                                        @change="getGeoPosition"
                                    />
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ms-5"
                                            >Bagni</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="bathroom_number"
                                        id="bathrooms"
                                        v-model="bathrooms"
                                        @change="getGeoPosition"
                                    />
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ms-5"
                                            >Dimensione</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="square_mt"
                                        id="sqm"
                                        v-model="sqm"
                                        @change="getGeoPosition"
                                    />
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="col-3 my-3">
                    <label for="radius" class="form-label"
                        >Cerca nel raggio di {{ radius }} km</label
                    >
                    <input type="range" class="form-range" id="radius" v-model="radius" step="10" min="0" max="50"/>
                </div>
                <div class="col-12">
                    <span v-for="service in services" :key="service.id">
                        <input
                            type="checkbox"
                            class="btn-check"
                            :id="`btn-check-${service.id}`"
                            name="service"
                            :value="service.id"
                            autocomplete="off"
                        />
                        <label
                            class="btn btn-outline-success"
                            :for="`btn-check-${service.id}`"
                            >{{ service.label }}</label
                        >
                    </span>
                </div>
                <div class="col-12">
                    <section id="flat-list">
                        <h2 class="my-3 text-center mt-5">
                            {{ this.message }}
                        </h2>

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
            beds: 1,
            sqm: 30,
            services: [],
            message: "",
            selectedServices: [],
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
        fetchServices() {
            axios
                .get("http://localhost:8000/api/services")
                .then((res) => {
                    this.services = res.data;
                })
                .catch((err) => {
                    this.error = "Errore durante il fetch dei servizi";
                })
                .then(() => {});
        },
        getAutocomplete() {
            if (this.query) {
                axios
                    .get(
                        `https://api.tomtom.com/search/2/search/${this.query}.json?key=qSUikbBmShqOxwAwrrHX28luZ27pYwPx&limit=5&countrySet=IT&language=it-IT&limit=10`
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
                                    rooms: flat.room_number,
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
                                let nodeServices = document.querySelectorAll(
                                    'input[type="checkbox"]:checked'
                                );

                                let selectedServices = [];

                                nodeServices.forEach((nodeService) => {
                                    selectedServices.push(
                                        parseInt(nodeService.value)
                                    );
                                    console.log(
                                        "tipo",
                                        typeof parseInt(nodeService.value)
                                    );
                                });

                                console.log(
                                    "selectedService",
                                    selectedServices
                                );
                                this.selectedServices = selectedServices;
                                console.log(nodeServices);

                                const tomtomResponse = response.data.results;
                                this.loading = false;

                                const flatIds = [];

                                tomtomResponse.forEach((flat) => {
                                    flatIds.push(flat.info.id);
                                });

                                console.log("flatIds", flatIds);

                                const filterdFlats = this.allFlats.filter(
                                    (flat) => {
                                        console.log(flat);

                                        return (
                                            flatIds.includes(flat.id) &&
                                            flat.room_number >= this.rooms &&
                                            flat.bathroom_number >=
                                                this.bathrooms &&
                                            flat.bed_number >= this.beds &&
                                            flat.square_mt >= this.sqm
                                        );
                                    }
                                );
                                console.log(filterdFlats);

                                if (filterdFlats.length == 0)
                                    this.message =
                                        "Non ci sono appartamenti con queste caratteristiche in questa zona";

                                const filteredByServices = [];

                                console.log(
                                    "filteredByServices",
                                    filteredByServices
                                );
                                console.log("filterdFlats", filterdFlats);

                                if (this.selectedServices.length > 0) {
                                    filterdFlats.forEach((flat) => {
                                        const servicesIds = [];

                                        flat.services.forEach((service) => {
                                            servicesIds.push(service.id);
                                        });

                                        console.log(
                                            "flat services IDs",
                                            servicesIds
                                        );
                                        console.log(
                                            "selected services",
                                            this.selectedServices
                                        );

                                        if (
                                            this.selectedServices.some(
                                                (element) => {
                                                    return servicesIds.includes(
                                                        element
                                                    );
                                                }
                                            )
                                        ) {
                                            filteredByServices.push(flat);
                                        }
                                        console.log(
                                            "filteredByServices",
                                            filteredByServices
                                        );
                                    });
                                    this.flats = filteredByServices;
                                    if (filteredByServices.length == 0)
                                        this.message =
                                            "Non ci sono appartamenti con queste caratteristiche in questa zona";
                                } else {
                                    this.flats = filterdFlats;
                                    if (filterdFlats.length == 0)
                                        this.message =
                                            "Non ci sono appartamenti con queste caratteristiche in questa zona";
                                }

                                console.log("this.flats", this.flats);
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
        this.fetchServices();
    },
    components: { FlatCard },
};
</script>

<style scoped lang="scss">
.form-control .searchbar {
    padding: 20px 50px;
}

.dropdown_menu {
    position: absolute;
    width: 100%;
    top: 80%;
    z-index: 100;

    input {
        cursor: pointer;

        &:focus {
            background-color: #3471eb;
        }
    }
}
</style>
