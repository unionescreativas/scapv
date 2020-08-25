<template>
  <i
    class="fa fa-eye fa-2x text-primary"
    role="button"
    style="cursor: pointer;"
    @click="click({ typeForm: 'ver', ...data })"
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
