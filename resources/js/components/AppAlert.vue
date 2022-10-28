<template>
  <div
    class="alert fade show"
    :class="[`alert-${type || 'info'}`, { 'alert-dismissible': dismissible }]"
    role="alert"
  >
    <slot></slot>

    <button type="button" class="close" @click="$emit('close')">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>

<script>
export default {
  name: "AppAlert",
  props: {
    type: String,
    dismissible: Boolean,
  },
};
</script>

<style>
</style>




