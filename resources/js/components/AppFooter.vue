<template>
    <footer>
        <div class="container">
          <div class="row">
            <div class="col-6 col-md-3 mt-3 d-flex flex-column">
                <h5 class="text-uppercase">Info</h5>
                <a href="#">Come funziona BoolBnB</a>
                <a href="#">NewsRoom</a>
                <a href="#">BoolBnB Premium</a>
                <a href="#">HotelsWorld</a>
                <a href="#">Lavora con noi</a>
            </div>
            <div class="col-6 col-md-3 mt-3 d-flex flex-column">
                <h5 class="text-uppercase">Ospita</h5>
                <a href="#">Diventa un host</a>
                <a href="#">Centro risorse</a>
                <a href="#">Offri un'Esperienza</a>
                <a href="#">Community Center</a>
                <a href="#">Accessibilità</a>
            </div>
            <div class="col-6 col-md-3 mt-3 d-flex flex-column">
                <h5 class="text-uppercase">Community</h5>
                <a href="#">BoolBnB associates</a>
                <a href="#">Invita degli amici</a>
                <a href="#">Diversità e appartenenza</a>
                <a href="#">Supporto al vicinato</a>
                <a href="#">Open Home</a>
            </div>
            <div class="col-6 col-md-3 mt-3 d-flex flex-column">
                <h5 class="text-uppercase">Social</h5>
                <div class="d-flex">
                  <a href="#"><i class="fa-brands me-3 fa-facebook"></i></a>
                <a href="#"><i class="fa-brands me-3 fa-instagram"></i></a>
                <a href="#"><i class="fa-brands me-3 fa-twitter"></i></a>
                <!-- <a href="#"><i class="fa-brands fa-youtube"></i></a> -->
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "AppFooter",
    // COMPONENTS
    components: {},
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
<style lang="scss" scoped>
footer {
    background-color: #9c9c9c;
    color: #ffffff;
    padding: 40px;
    ul {
        list-style-type: none;
        padding: 0;
    }

    a {
        text-decoration: none;
        color: #fff;
    }

    h5 {
      margin-bottom: 5px;
      color: #dc143c;
    }
}
</style>
