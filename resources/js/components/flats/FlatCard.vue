<template>
    <div class="col-12  col-md-6 col-lg-3">
        <div class="flat-card m-1 border ">

            <router-link :to="`/flats/${flat.id}`">
                <img
                    class="card-img-top img-fluid"
                    :src="`storage/${flat.image}`"
                    alt="Card image cap"
                />
            </router-link>

            <div class="card-body">
                <h6 class="card-title text-custom_primary my-4">
                    {{ flat.title }}
                </h6>
                <!-- <p class="card-text fw-bold">{{ flat.address }}</p> -->
                <p class="card-text fw-bold h5">
                    {{ flat.price_per_day }} € a notte
                </p>
                <p>{{ flat.address }}</p>
                <div class="d-flex">
                  <p>Servizi: </p>
                  <p v-for="service in flat.services"><i class="mx-2" :class="service.icon"></i></p>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "FlatCard",
    data() {
        return {};
    },

    props: { flat: Object, flats: Array, i: Number },
    methods: {},
};
</script>
<style scoped lang="scss">




.flat-card:hover {
    box-shadow: rgba($color: #000, $alpha: 0.7) 0px 0px 5px;
}

.flat-card {
    padding: 12px;
    transition: 0.5s;
    border-radius: 0 20px 0 20px;
    object-fit: contain;
    display: flex;
    flex-direction: column;
    align-items: start;
    box-shadow: rgba($color: #000000, $alpha: 0.3) 0 0 1px;
    margin: 50px 0;
    
    


    img {
        border-radius: 10px;
        
       object-fit: cover;
       
    }

    .link {
        text-decoration: none;
    }
}
</style>
