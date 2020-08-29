<template>
  <i class="ri-delete-bin-2-line text-danger" role="button" style="cursor: pointer; font-size: 2em;" @click="click(data)"></i>
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
