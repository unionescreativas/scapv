<template>
  <i
    class="ri-eye-fill"
    role="button"
    style="cursor: pointer; font-size: 2em; color: var(--iq-primary);"
    @click="click(data)"
  ></i>
</template>

<script>
export default {
  props: {
    data: {},
    name: {},
    click: {
      type: Function,
      default: () => {},
    },
    classes: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
