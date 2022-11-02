<template>
    <div id="home-page">
        <AppJumbotron />
        <div class="container-fluid">
            <div class="col-8 offset-2">
                <flat-list />
            </div>
        </div>
        <!-- FLAT LIST COMPONENTE-->
    </div>
</template>

<script>
import FlatList from "../flats/FlatList.vue";
import AppJumbotron from "../AppJumbotron.vue";
export default {
    name: "HomePage",
    //COMPONENTS
    components: { AppJumbotron, FlatList },
    // DATA
    data() {
        return {};
    },
    //PROPS
    props: {},
    //METHODS
    methods: {},
    //COMPUTED
    computed: {},
};
</script>

<!-- STYLE -->
<style lang="scss" scoped> </style>
