<template>
    <div>
        <!-- JUMBOTRON -->
        <AppJumbotron />
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center ">
                    <nav
                        class="navbar-light bg-transparent my-3 "
                    >
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
                                            class=""
                                            readonly
                                            :value="address"
                                            @click="setQuery(address)"
                                        />
                                    </li>
                                </ul>

                                <button class="btn btn-dark my-sm-0 ms-2 py-2" type="submit" id="search-btn">
                                    <i class="fa-solid text-white fa-magnifying-glass fa-lg"></i>
                                  </button>
                            </div>
                        </form>
                    </nav>
                </div>

              <div class="row">
                <div class="col-12 col-md-12 col-lg-4 filters">
                    <div class="card rounded-0">
                        <div class="card-header h4 bg-primary-cs text-white">Filtra per:</div>
                        <div
                            class="card-body d-flex justify-content-sm-between justify-content-lg-center justify-content-center my-2 row py-lg-1"
                        >
                            <!-- rooms-->
                            <div class="cs_btn my-2 col-1 w-50">
                                <div class="btn-title text-center">Camere</div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid text-white fa-minus p-2 text-white"
                                            @click="getGeoPosition();rooms--"
                                        ></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="rooms"
                                        class="w-75 input-group-text"
                                        v-model="rooms"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid text-white fa-plus p-2"
                                            @click="getGeoPosition();rooms++"
                                        ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- beds-->
                            <div class="cs_btn my-2 col-1 w-50">
                                <div class="btn-title text-center">Letti</div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid text-white fa-minus p-2"
                                            @click="getGeoPosition();beds--"
                                        ></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="beds"
                                        class="w-75 input-group-text"
                                        v-model="beds"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid text-white fa-plus p-2"
                                            @click="getGeoPosition();beds++"
                                        ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- bathrooms-->
                            <div class="cs_btn my-2 col-1 w-50">
                                <div class="btn-title text-center">Bagni</div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid text-white fa-minus p-2"
                                            @click="getGeoPosition();bathrooms--"
                                        ></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="bathrooms"
                                        class="w-75 input-group-text"
                                        v-model="bathrooms"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid text-white fa-plus p-2"
                                            @click="getGeoPosition();bathrooms++"
                                        ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- sqm-->
                            <div class="cs_btn my-2 col-1 w-50">
                                <div class="btn-title text-center">
                                    Metri<sup>2</sup>
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i
                                            class="fa-solid text-white fa-minus p-2"
                                            @click="getGeoPosition();sqm--"
                                        ></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="sqm"
                                        class="w-75 input-group-text"
                                        v-model="sqm"
                                    />
                                    <div class="plus">
                                        <i
                                            class="fa-solid text-white fa-plus p-2"
                                            @click="getGeoPosition();sqm++"
                                        ></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Radius km -->
                            <div class="col-12 mt-5">
                                <label for="customRange2" class="form-label"
                                    >Nel raggio di
                                    {{ this.radius }} km</label
                                >
                                <input
                                    type="range"
                                    class="form-range"
                                    min="0"
                                    max="50"
                                    id="customRange2"
                                    step="5"
                                    v-model="radius"
                                    @change="getGeoPosition"
                                />
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Services -->
                <div class="col-12 col-lg-8">
                    <div class="card rounded-0">
                        <h4 class="card-header bg-primary-cs text-white mb-4">Servizi</h4>
                        <div class="px-2 row row-cols-3  pb-5">
                            <div
                                class="form-check form-switch m-3 me-5 col"
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
                                <i :class="`${service.icon}  `"></i>

                                <label
                                    class="form-check-label h5"
                                    for="flexSwitchCheckChecked"
                                    ><small>{{ service.label }}</small></label
                                >
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>



                <div class="col-12">
                    <section id="flat-list">
                       
                        <h2 class="my-3 text-center mt-5">
                            {{ this.message }}
                        </h2>

                        <!-- AppLoader -->
                        <app-loader v-if="isLoading" />

                        <!-- FLAT CARD -->
                        <div class="row justify-content-start">
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
        <AppFooter class="mt-5"/>
    </div>
</template>

<script>
import AppFooter from "../AppFooter.vue";
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
                    this.flats = res.data;
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
        this.fetchServices();
        console.log("this allflats searchpage", this.allFlats);

        let data = this.$route.params.data;
        console.log("data is", data);
        this.flats = data.filterdFlats;
         this.allFlats = data.allFlats;
         this.query = data.query;
    },

    components: { FlatCard, AppJumbotron, AppFooter },
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
    border-radius: 0;
}

.plus,
.minus {
    background-color:#dc143c;
    padding: 3.3px;
    border: none;
    cursor: pointer;
    
}

label span {
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#search-btn {
    border-radius: 50%;
    height: 50px;
    width: 50px;
    background-color: crimson;
    border: 0;
    transition: .3s;
}

#search-btn:hover {
    transform: scale(1.10);
}
  
  

.filters .form-control {
    max-width: 60px;
    background-color: #fff;

    .icon {
        width: 80px;
    }
}

#query_address{
    background-color: #fff;
    height: 55px;
    border-radius: 0 20px 0 20px;
    border: 1px solid #dc143c;
    padding-right:  90px;
}

#query_address:focus {
    outline-color: #dc143c;

}

.card-header {
    border-radius: 0;
}
</style>
