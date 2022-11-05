<template>
    <div>
        <AppJumbotron class="mb-5" />

        <div class="container">
            <div class="row">
                <div class="col-12mt-3">
                    <div class="card filters">
                        <div class="card-header">Filtra per:</div>
                        <div class="card-body d-flex justify-content-between flex-wrap">

                            <!-- Rooms-->
                            <div class="cs_btn my-2">
                                <div class="btn-title text-center">
                                   Camere
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i class="fa-solid fa-minus p-2" @click="rooms--"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="rooms"
                                        id="rooms"
                                        class="w-75 input-group-text"
                                        v-model="rooms"
                                    />
                                    <div class="plus">
                                        <i class="fa-solid fa-plus p-2" @click="rooms++" ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- beds-->
                            <div class="cs_btn my-2">
                                <div class="btn-title text-center">
                                   Letti
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i class="fa-solid fa-minus p-2" @click="beds--"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="beds"
                                        class="w-75 input-group-text"
                                        v-model="beds"
                                    />
                                    <div class="plus">
                                        <i class="fa-solid fa-plus p-2" @click="beds++" ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Bathrooms-->
                            <div class="cs_btn my-2">
                                <div class="btn-title text-center">
                                   Bagni
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i class="fa-solid fa-minus p-2" @click="bathrooms--"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="bed_number"
                                        id="number_bathroom"
                                        class="w-75 input-group-text"
                                        v-model="bathrooms"
                                    />
                                    <div class="plus">
                                        <i class="fa-solid fa-plus p-2" @click="bathrooms++" ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Square mts-->
                            <div class="cs_btn my-2">
                                <div class="btn-title text-center">
                                   Metri quadri
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center p-0 cs_btn_body"
                                >
                                    <div class="minus">
                                        <i class="fa-solid fa-minus p-2" @click="sqm--"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="square_mt"
                                        id="square_mt"
                                        class="w-75 input-group-text"
                                        v-model="sqm"
                                    />
                                    <div class="plus">
                                        <i class="fa-solid fa-plus p-2" @click="sqm++" ></i>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5 pb-5">
                <div class="col">
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
                                class="col-12 col-md-4 col-lg-3 col mt-4"
                            />
                        </div>
                    </section>
                </div>
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
            radius: 20,
            flats: [],
            allFlats: [],
            lat: "",
            lon: "",
            resultsAPI: "",
            responseAPI: "",
            isLoading: false,
            rooms: 0,
            bathrooms: 1,
            beds: 1,
            sqm: 30,
            services: [],
            message: "",
            selectedServices: [],
            btnValue:0
        };
    },
    props: {},
    methods: {
       
        
        fetchFlats() {
            this.isLoading = true;
            axios
                .get("http://localhost:8000/api/flats")
                .then((res) => {
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
                                console.log("X", response.data.results);
                                let nodeServices = document.querySelectorAll(
                                    'input[type="checkbox"]:checked'
                                );

                                let selectedServices = [];

                                nodeServices.forEach((nodeService) => {
                                    selectedServices.push(
                                        parseInt(nodeService.value)
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
                                        console.log("ok");
                                        console.log(
                                            "flat.services",
                                            flat.services
                                        );
                                        const servicesIds = [];
                                        if (flat.services.length > 0)
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
            } else {
                this.flats = this.allFlats;
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

    mounted() {
        /* if (this.$route.params.query) {
            this.query = this.$route.params.query;
        }
        if (this.$route.params.radius) {
            this.radius = this.$route.params.radius;
        }
        //this.fetchFlats();*/
        this.fetchServices();
        this.fetchFlats();
        console.log("this flats searchpage", this.flats);

        let data = this.$route.params.data;
        let query = this.$route.params.query;
        this.query = query;
        console.log(query);
        console.log("data is", data);
        this.flats = data;
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
    // width: 70px;

    border-radius: 0;
}

.input-group {
    margin: 10px 0;
}

.form-control {
    border-radius: 0;
}

#rooms.form-control {
    max-width: 20%;
}

label span {
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cs_btn {
    max-width: 150px;
    .cs_btn_body {
        border: 1px solid lightgray;
    }
    input {
        border-radius: 0;
        border: 0;
    
    }

   .input-group-text {
    border: 0px transparent solid;
    padding: 12px;
   }

   .input-group-text:focus {
    outline: none;
   }
    .btn-title {
        padding: 4px;
    }
    .minus,
    .plus {
        background-color: lightgray;
        padding: 5px;
        cursor: pointer;
        border: 3px solid transparent;
    }
}
</style>
