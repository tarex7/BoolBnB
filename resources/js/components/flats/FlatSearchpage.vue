<template>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="flat-card m-1">
            <router-link :to="`/flats/${flat.id}`">
                <img
                    class="card-img-top img-fluid"
                    :src="`storage/${flat.image}`"
                    alt="Card image cap"
                />
            </router-link>
            <div class="card-body">
                <h5 class="card-title text-custom_primary mt-2">
                    {{ flat.title }}
                </h5>
                <p class="card-text fw-bold">
                    {{ flat.price_per_day }} € a notte
                    <p v-for="service in flat.services">{{ service.label}}</p>
                </p>
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
    transform: scale(1.05);
    box-shadow: rgba($color: #000, $alpha: 0.3) 0px 0px 11px;
}

.flat-card {
    padding: 10px;
    transition: 0.5s;
    border-radius: 10px;
    object-fit: contain;


    img {
        border-radius: 10px;
       
    }

    .link {
        text-decoration: none;
    }
}
</style>
