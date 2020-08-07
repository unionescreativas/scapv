import webpack from "webpack";

export default {
    mode: "universal",
    /*
     ** Headers of the page
     */
    head: {
        htmlAttrs: {
            lang: "es",
            dir: "ltr"
        },
        title: process.env.npm_package_name || "",
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1"
            },
            { name: "viewport", content: "width=device-width, initial-scale=1" },
            {
                hid: "description",
                name: "description",
                content: process.env.npm_package_description || ""
            }
        ],
        link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
    },
    /*
     ** Customize the progress-bar color
     */
    loading: { color: "#fff" },
    /*
     ** Global CSS
     */
    css: ["~/assets/scss/style.scss"],
    /*
     ** Plugins to load before mounting the App
     */
    plugins: [
        { src: "~/plugins/general/ag-grid.js", mode: "client" },
        { src: "~/plugins/general/bootstrap-vue.js" },
        { src: "~/plugins/general/copy-clipboard.js" },
        { src: "~/plugins/general/flatpicker.js" },
        { src: "~/plugins/general/i18n.js" },
        { src: "~/plugins/general/validator.js", mode: "client" },
        { src: "~/plugins/general/vue-grid.js", mode: "client" },
        { src: "~/plugins/general/vue-select.js" }
    ],
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
        // Doc: https://auth.nuxtjs.org
        "@nuxtjs/auth"
    ],
    /*
     ** Axios module configuration
     ** See https://axios.nuxtjs.org/options
     */
    axios: {
        baseURL: ""
    },
    auth: {
        redirect: {
            login: "/iniciarSesion",
            logout: "/"
        },
        strategies: {
            local: {
                endpoints: {
                    login: {
                        url: "/iniciarSesion",
                        method: "post",
                        withCredentials: true,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json"
                        }
                    },
                    user: {
                        url: "api/usuario",
                        method: "get",
                        propertyName: false,
                        withCredentials: true,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json"
                        }
                    }
                },
                tokenRequired: false,
                tokenType: false
            }
        }
    },
    /*
     ** Build configuration
     */
    build: {
        plugins: [
            // Aquí irián los plugins globales de la app
            new webpack.ProvidePlugin({})
        ]
    }
};
