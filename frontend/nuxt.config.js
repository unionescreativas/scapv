require("dotenv").config();

export default {
  vue: {
    config: {
      productionTip: false,
      devtools: true,
    },
  },
  /*
   ** Nuxt rendering mode
   ** See https://nuxtjs.orgapi/configuration-mode
   */
  mode: "universal",
  /*
   ** Nuxt target
   ** See https://nuxtjs.orgapi/configuration-target
   */
  target: "static",
  /*
   ** Headers of the page
   ** See https://nuxtjs.orgapi/configuration-head
   */
  head: {
    htmlAttrs: {
      lang: "es",
      dir: "ltr",
    },
    title: "scapv" || process.env.npm_package_name,
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content: process.env.npm_package_description || "",
      },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
  },
  /*
   ** Global CSS
   */
  css: ["~/assets/scss/style.scss"],

  /*
   ** Plugins to load before mounting the App
   ** https://nuxtjs.org/guide/plugins
   */
  plugins: [
    { src: "~/plugins/general/ag-grid.js", mode: "client" },
    { src: "~/plugins/general/bootstrap-vue.js" },
    { src: "~/plugins/general/copy-clipboard.js" },
    { src: "~/plugins/general/flatpicker.js" },
    { src: "~/plugins/general/i18n.js" },
    { src: "~/plugins/general/vee-validate.js" },
    { src: "~/plugins/general/vue-grid.js", mode: "client" },
    { src: "~/plugins/general/vue-select.js" },
    { src: "~/plugins/general/vue-datatable" },
    { src: "~/plugins/general/vue-google-maps" },
    { src: "~/plugins/general/vue-chartkick.js", mode: "client" },
  ],
  /*W
   ** Auto import components
   ** See https://nuxtjs.orgapi/configuration-components
   */
  components: true,
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [],
  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    "@nuxtjs/axios",
    "@nuxtjs/auth-next",
    "@nuxtjs/router-extras",
    "@nuxtjs/dotenv",
  ],
  /*
   ** Axios module configuration
   ** See https://axios.nuxtjs.org/options
   */
  axios: {
    baseURL: process.env.API_URL,
    credentials: true,
  },
  auth: {
    strategies: {
      laravelSanctum: {
        provider: "laravel/sanctum",
        url: process.env.API_URL,
        endpoints: {
          login: { url: "/login", method: "post", propertyName: false },
          logout: { url: "/logout", method: "post", propertyName: false },
          user: { url: "/api/user", method: "get", propertyName: false },
        },
      },
    },
    redirect: {
      login: "/auth/iniciar-sesion",
      logout: "/auth/iniciar-sesion",
      callback: false,
      home: false,
    },
  },
  router: {
    middleware: ["auth"],
  },
  /*
   ** Build configuration
   ** See https://nuxtjs.orgapi/configuration-build/
   */
  build: {
    extend(config) {
      config.resolve.alias["vue"] = "vue/dist/vue.common";
    },
    transpile: ["vee-validate", "vue-bootstrap-typeahead", "vue2-google-maps"],
  },
};
