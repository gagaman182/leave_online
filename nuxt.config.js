const pkg = require("./package");

const VuetifyLoaderPlugin = require("vuetify-loader/lib/plugin");

module.exports = {
    mode: "spa",

    /*
     ** Headers of the page
     */
    head: {
        title: "ระบบวันลา กลุ่มงานเวชกรรมสังคม รพ.หาดใหญ่",
        meta: [
            { charset: "utf-8" },
            { name: "viewport", content: "width=device-width, initial-scale=1" },
            {
                hid: "ระบบวันลา",
                name: "ระบบวันลา",
                content: "ระบบวันลา กลุ่มงานเวชกรรมสังคม รพ.หาดใหญ่"
            }
        ],
        link: [
            { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
            {
                rel: "stylesheet",
                href: "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"
            },
            {
                rel: "stylesheet",
                href: "https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap"
            }
        ],
        script: [{
            src: "https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.4/echarts-en.min.js"
        }]
    },

    /*
     ** Customize the progress-bar color
     */
    loading: { color: "#3adced" },

    /*
     ** Global CSS
     */
    css: [
        "~/assets/style/theme.styl",
        "~/assets/style/app.styl",
        "font-awesome/css/font-awesome.css",
        "roboto-fontface/css/roboto/roboto-fontface.css"
    ],

    /*
     ** Plugins to load before mounting the App
     */
    plugins: [
        "@/plugins/vuetify",
        "@/plugins/vee-validate",
        "@/plugins/vueexcel"
    ],

    /*
     ** Nuxt.js modules
     */
    modules: ["@nuxtjs/axios", "vue-sweetalert2/nuxt"],

    modern: true,

    axios: {
        // proxyHeaders: false
        baseURL: "http://localhost/leave_online/template/backend/"
            // baseURL: "http://192.168.5.187/leave/backend/"
    },

    /*
     ** Build configuration
     */
    build: {
        transpile: ["vuetify/lib"],
        plugins: [new VuetifyLoaderPlugin()],
        loaders: {
            stylus: {
                import: ["~assets/style/variables.styl"]
            }
        },

        /*
         ** You can extend webpack config here
         */
        extend(config, ctx) {}
    }
    // setให้สามารถ run คำสั่ง npm run generate แล้วได้ ไฟล์ dist เอาข้างในไป ใส่ใน path ที่เราต้องการ
    // router: {
    //     base: "/leave"
    // }
};