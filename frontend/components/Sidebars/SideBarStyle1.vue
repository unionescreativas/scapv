<template>
  <div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
      <nuxt-link :to="homeURL">
        <img :src="logo" class="img-fluid" alt="logo" />
        <span>SCAPV</span>
      </nuxt-link>
      <div class="iq-menu-bt-sidebar" v-if="toggleButton">
        <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu" @click="miniSidebar">
            <div class="main-circle">
              <i class="ri-arrow-left-s-line"></i>
            </div>
            <div class="hover-circle">
              <i class="ri-arrow-right-s-line"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu" :class="horizontal ? 'd-xl-none' : ''">
        <ListStyle1 :items="items" :open="true" :horizontal="horizontal" />
      </nav>
      <div class="p-3"></div>
    </div>
  </div>
  <!-- TOP Nav Bar -->
</template>

<script>
export default {
  name: "SideBarStyle1",
  props: {
    homeURL: {
      type: Object,
      default: () => ({ path: "/" }),
    },
    items: { type: Array },
    logo: {
      type: String,
      default: require("~/assets/images/logo.png"),
    },
    horizontal: { type: Boolean },
    toggleButton: { type: Boolean, default: true },
  },
  methods: {
    miniSidebar() {
      this.$emit("toggle");
    },
  },
  data() {
    return {};
  },
};
</script>
