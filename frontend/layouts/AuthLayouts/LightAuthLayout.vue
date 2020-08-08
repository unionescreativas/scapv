<template>
  <div>
    <Loader />
    <section class="sign-in-page">
      <div class="row justify-content-center no-gutters">
        <div class="bg-white p-4 mt-4 col-sm-6">
          <div class="sign-in-from">
            <nuxt />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import logo from "~/assets/images/logo-white.png";
import { vito } from "~/plugins/config/pluginInit";
import bgImage from "~/assets/images/login/login-2.jpg";

export default {
  name: "AuthLayout",
  mounted() {
    vito.index();
  },
  data() {
    return {
      slickOptions: {
        slidesToShow: 1,
        arrows: false,
      },
      logo: logo,
      bgImageURL: bgImage,
    };
  },
};
</script>
