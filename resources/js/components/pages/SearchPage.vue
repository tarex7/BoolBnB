<template>
    <div>
        <!-- JUMBOTRON -->

        <div class="container">
            <div class="row">
                <nav
                    class="navbar-light bg-transparent d-flex justify-content-center w-100 mt-5"
                >
                    <div class="col-12 col-md-6 col-lg-6 mt-3">
                        <form @submit.prevent="getGeoPosition">
                            <div
                                class="d-flex justify-content-between position-relative input-search my-4"
                            >
                                <input
                                    class="form-control mr-sm-2 input"
                                    type="search"
                                    placeholder="Dove vuoi andare?"
                                    aria-label="Search"
                                    autocomplete="off"
                                    id="query_address"
                                    v-model="query"
                                    @keyup="getAutocomplete"
                                    @keyup.enter="getGeoPosition"
                                />

                                <ul
                                    class="dropdown_menu list-unstyled p-1"
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
                                    class="btn btn-dark my-sm-0 ms-2 py-2"
                                    type="submit"
                                    id="search-btn"
                                >
                                    Cerca
                                </button>
                            </div>
                        </form>
                    </div>
                </nav>

                <div class="col-12 col-md-5 col-lg-3 mt-3 filters">
                    <div class="card rounded-0">
                        <div class="card-header h4">Filtra per:</div>
                        <div
                            class="card-body d-flex justify-content-sm-between justify-content-lg-center justify-content-center flex-wrap"
                        >
                            <!-- Rooms-->
                            <div class="cs_btn my-2 mx-2">
                                <div class="btn-title text-center h5">
                                    Camere
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid fa-minus p-2"
                                            @click="
                                                getGeoPosition();
                                                rooms--;
                                            "
                                        ></i>
                                    </div>
                                    <input
                                        type="number"
                                        name="rooms"
                                        id="rooms"
                                        class="w-75 input-group-text"
                                        v-model="rooms"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid fa-plus p-2"
                                            @click="
                                                getGeoPosition();
                                                rooms++;
                                            "
                                        ></i>
                                    </div>
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

                            <!-- beds-->
                            <div class="cs_btn my-2 mx-2">
                                <div class="btn-title text-center h5">
                                    Letti
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid fa-minus p-2"
                                            @click="
                                                getGeoPosition();
                                                beds--;
                                            "
                                        ></i>
                                    </div>
                                    <input
                                        type="text"
                                        @change="getGeoPosition"
                                        name="bed_number"
                                        id="beds"
                                        class="w-75 input-group-text"
                                        v-model="beds"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid fa-plus p-2"
                                            @click="
                                                getGeoPosition();
                                                beds++;
                                            "
                                        ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bathrooms-->
                    <div class="cs_btn my-2 mx-2">
                        <div class="btn-title text-center h5">Bagni</div>
                        <div
                            class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                        >
                            <div class="minus">
                                <i
                                    class="fa-solid fa-minus p-2"
                                    @click="
                                        getGeoPosition();
                                        bathrooms--;
                                    "
                                ></i>
                            </div>
                            <input
                                type="text"
                                @change="getGeoPosition"
                                name="bed_number"
                                id="number_bathroom"
                                class="w-75 input-group-text"
                                v-model="bathrooms"
                            />
                            <div class="plus">
                                <i
                                    class="fa-solid fa-plus p-2"
                                    @click="
                                        getGeoPosition();
                                        bathrooms++;
                                    "
                                ></i>
                            </div>
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

                    <!-- Square mts-->
                    <div class="cs_btn my-2 mx-2">
                        <div class="btn-title text-center h5">Metri quadri</div>
                        <input
                            type="number"
                            class="form-control"
                            name="square_mt"
                            id="sqm"
                            v-model="sqm"
                            @change="getGeoPosition"
                        />
                    </div>
                </div>
                <!-- Services -->
                <div class="px-2">
                    <div class="px-3 mt-3">
                        <h4>Servizi</h4>
                        <div class="border"></div>
                    </div>
                    <div
                        class="form-check form-switch m-3"
                        v-for="service in services"
                        :key="service.id"
                    >
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="flexSwitchCheckChecked"
                            :value="service.id"
                            @change="getGeoPosition"
                        />
                        <i :class="`${service.icon} fa-lg mx-2`"></i>

                        <label
                            class="form-check-label h5"
                            for="flexSwitchCheckChecked"
                            >{{ service.label }}</label
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5 pb-5">
            <div class="col">
                <section id="flat-list">
                    <h1>{{ this.query }}</h1>
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
                            class="col-12 col-md-4 col-lg-3 col mt-4"
                        />
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import AppJumbotron from "../AppJumbotron.vue";
import FlatCard from "../flats/FlatCard.vue";

export default {
    name: "SearchPage",
    data() {
        return {
            query: "",
            autocomplete: [],
            radius: 50,
            flats: [],
            allFlats: [],
            lat: "",
            lon: "",
            resultsAPI: "",
            responseAPI: "",
            isLoading: false,
            rooms: 1,
            bathrooms: 0,
            beds: 0,
            sqm: 0,
            services: [],
            message: "",
            selectedServices: [],
        };
    },
    props: {},
    methods: {
        fetchFlats() {
            this.isLoading = true;
            axios
                .get("http://localhost:8000/api/flats")
                .then((res) => {
                    //this.flats = res.data;
                    this.Allflats = res.data;
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
            console.log("Geo position from search page");

            //Prendo valori della query e del raggio
            let query = this.query;
            let radius = this.radius * 1000;
            //Chiamata tomtom per ricevere posizione
            if (query) {
                this.loading = true;
                axios
                    .get(
                        `https://api.tomtom.com/search/2/geocode/${query}.json?key=qSUikbBmShqOxwAwrrHX28luZ27pYwPx&limit=1&radius=${radius}`
                    )
                    .then((response) => {
                        //Prendo lat e lon
                        let lat = response.data.results[0].position.lat;
                        let lon = response.data.results[0].position.lon;

                        let flatList = [];
                        //Creo geometry list
                        let geometryList = [
                            {
                                type: "CIRCLE",
                                position: `${lat} , ${lon}`,
                                radius: `${radius}`,
                            },
                        ];

                        //stampo geometry list
                        console.log(
                            "geometrylist",
                            JSON.stringify(geometryList)
                        );

                        //creo flatPOI per ogni flat e li metto in flalist
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
                        //stampo flatlist
                        console.log("JSON flatlist", JSON.stringify(flatList));

                        //chiamata per filtrare flats in base al raggio in km

                        axios
                            .get(
                                `https://api.tomtom.com/search/2/geometryFilter.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&geometryList=${JSON.stringify(
                                    geometryList
                                )}&poiList=${JSON.stringify(flatList)}`
                            )
                            .then((response) => {
                                const filteredFlatsByTomtom =
                                    response.data.results;

                                //creo una lista di ID dei flat trovati nel raggio
                                const flatIds = [];
                                filteredFlatsByTomtom.forEach((flat) => {
                                    flatIds.push(flat.info.id);
                                });

                                let nodeServices = document.querySelectorAll(
                                    'input[type="checkbox"]'
                                );

                                //Creo lista dei servizi selezionati
                                let selectedServices = [];

                                nodeServices.forEach((nodeService) => {
                                    if (nodeService.checked)
                                        selectedServices.push(
                                            parseInt(nodeService.value)
                                        );
                                });

                                this.selectedServices = selectedServices;

                                console.log(
                                    "this.selectedServices",
                                    this.selectedServices
                                );

                                console.log("servizi", selectedServices);

                                //Creo nuova lista con i flat trovati
                                const filteredByRadius = this.allFlats.filter(
                                    (flat) => {
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

                                const filteredByServices = [];

                                if (this.selectedServices.length > 0) {
                                    filteredByRadius.forEach((flat) => {
                                        //creo lista id dei servizi del flat
                                        const servicesIds = [];

                                        flat.services.forEach((service) => {
                                            servicesIds.push(service.id);
                                        });

                                        console.log(
                                            "Id dei servizi",
                                            flat.address,
                                            servicesIds
                                        );

                                        if (
                                            this.selectedServices.every(
                                                (element) => {
                                                    return servicesIds.includes(
                                                        element
                                                    );
                                                }
                                            )
                                        ) {
                                            filteredByServices.push(flat);
                                        }
                                    });
                                    this.flats = filteredByServices;
                                } else {
                                    this.flats = filteredByRadius;
                                }
                            });
                    });
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

    created() {
        /* if (this.$route.params.query) {
            this.query = this.$route.params.query;
        }
        if (this.$route.params.radius) {
            this.radius = this.$route.params.radius;
        }*/
        this.fetchFlats();
        this.fetchServices();
        console.log("this allflats searchpage", this.allFlats);

        let data = this.$route.params.data;
        console.log("data is", data);
        this.flats = data.filterdFlats;
        this.allFlats = data.allFlats;
        this.query = data.query;
    },

    components: { FlatCard, AppJumbotron },
};
</script>

<style scoped lang="scss">
.form-control .searchbar {
    padding: 20px 50px;
}

.input-search {
    width: 100%;
    height: 45px;
}

.dropdown_menu {
    position: absolute;
    width: 100%;
    top: 60px;
    z-index: 100;

    input {
        cursor: pointer;

        &:focus {
            background-color: #3471eb;
        }
    }
}
.input-group-text {
    width: 70px;
}

.input-group {
    margin: 10px 0;
}

label span {
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.filters .form-control {
    max-width: 60px;

    .icon {
        width: 80px;
    }
}
</style>
