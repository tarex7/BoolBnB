<template>
  <div class="card col-3 m-4 p-0">
    <img
      class="card-img-top img-fluid"
      :src="`/storage/${flat.image}`"
      alt="Card image cap"
    />
    <div class="card-body">
      <div class="row justify-content-between">
        <div class="col-6">
          <h1>{{ flat.id }}</h1>
        </div>
        <!-- <div class="col-6 p-0 m-0">
          <router-link
            :to="{ name: 'post-detail', params: { slug: post.slug } }"
            class="ml-5 mt-2 btn btn-primary btn-sm"
            ><i class="fa-solid fa-eye"></i> Vedi</router-link
          >
        </div> -->
      </div>
      <h5 class="card-title">{{ flat.title }}</h5>

      <p class="card-text">
        {{ flat.description }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "FlatCard",

  props: { flat: Object },
  methods: {},
};
</script>
<style scoped lang="scss">
</style>