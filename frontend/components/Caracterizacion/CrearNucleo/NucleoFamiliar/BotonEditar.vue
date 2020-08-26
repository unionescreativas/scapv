<template>
  <i class="fa fa-edit fa-2x text-warning" role="button" style="cursor: pointer;" @click="click(data)"></i>
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
