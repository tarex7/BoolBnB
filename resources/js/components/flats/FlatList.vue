<template>
    <section id="flat-list">
        <div class="container-fluid px-3">
            <!-- AppLoader -->
            <app-loader v-if="isLoading" />

            <!-- FLAT CARD -->
            <div class="row g-3 clearfix">
                <flat-card
                    v-for="(flat, i) in flats"
                    :key="flat.id"
                    :flat="flat"
                    :flats="flats"
                    :i="i"
                />
            </div>
        </div>
    </section>
</template>

<script>
import FlatCard from "../flats/FlatCard.vue";
export default {
    name: "FlatList",
    data() {
        return {
            flats: [],
            isLoading: false,
        };
    },
    props: {
        filteredFlats: Array,
    },
    components: { FlatCard },
    methods: {
        fetchFlats() {
            this.isLoading = true;
            axios
                .get("http://localhost:8000/api/flats")
                .then((res) => {
                    this.flats = res.data;
                })
                .catch((err) => {
                    this.error = "Errore durante il fetch dei flats";
                })
                .then(() => {
                    this.isLoading = false;
                });
        },
    },
    mounted() {
         this.fetchFlats();
    },
};
</script>
<style scoped lang="scss">
#flat-list {
    padding-top: 40px;
    padding-bottom: 40px;
}
</style>
