<template>
    <!-- TOP Nav Bar -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom" :class="horizontal ? 'd-flex align-items-center justify-content-between' : ''">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <nuxt-link :to="homeURL">
                        <img :src="logo" class="img-fluid" alt="logo" />
                        <span>Vito</span>
                    </nuxt-link>
                </div>
            </div>
            <div class="iq-menu-horizontal" v-if="horizontal">
                <div class="iq-sidebar-menu">
                    <List :items="items" class="d-flex"></List>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="navbar-left">
                    <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
                        <li v-for="(item, index) in bookmark" :key="index">
                            <nuxt-link :to="item.link" class="nav-link" style="color: var(--iq-primary);">
                                <i :class="`${item.icon}`"></i>
                            </nuxt-link>
                        </li>
                    </ul>
                    <div class="iq-search-bar">
                        <form action="#" class="searchbox">
                            <input type="text" class="text search-input" @click="openSearch" v-model="globalSearch" :placeholder="$t('nav.globalSearchPlaceholder')" />
                            <a class="search-link" href="javascript:void(0)"><i class="ri-search-line"></i></a>
                            <GlobalSearch :search="globalSearch" @closeSearch="removeClass" />
                        </form>
                    </div>
                </div>
                <b-navbar-toggle target="nav-collapse">
                    <i class="ri-menu-3-line"></i>
                </b-navbar-toggle>
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
                <b-collapse id="nav-collapse" is-nav>
                    <slot name="responsiveRight" />
                </b-collapse>
                <slot name="right" />
            </nav>
        </div>
    </div>
    <!-- TOP Nav Bar END -->
</template>
<script>
import verticalMenu from "~/plugins/FackApi/json/VerticalMenu";
import { mapGetters } from "vuex";

export default {
    name: "NavBarStyle1",
    props: {
        homeURL: {
            type: Object,
            default: () => ({ name: "layout1.dashboard" })
        },
        title: { type: String, default: "Dashboard" },
        logo: {
            type: String,
            default: require("~/assets/images/logo.png")
        },
        horizontal: { type: Boolean, default: false },
        items: { type: Array }
    },
    mounted() {
        document.addEventListener("click", this.closeSearch, true);
    },
    components: {
        List: () => import("~/components/Vito/Menus/ListStyle1"),
        GlobalSearch: () => import("~/components/Vito/Search/GlobalSearch")
    },
    computed: {
        ...mapGetters({
            bookmark: "Setting/bookmarkState"
        })
    },
    data() {
        return {
            sidebar: verticalMenu,
            globalSearch: "",
            showSearch: false,
            showMenu: false
        };
    },
    methods: {
        miniSidebar() {
            this.$emit("toggle");
        },
        openSearch() {
            this.showSearch = true;
            this.showMenu = "iq-show";
            this.globalSearch = "";
            $("#searchbox-datalink").addClass("show-data");
        },
        closeSearch(event) {
            let classList = event.target.classList;
            if (!classList.contains("searchbox") && !classList.contains("search-input")) {
                this.removeClass();
            }
        },
        removeClass() {
            this.showSearch = false;
            this.showMenu = "";
            this.globalSearch = "";
            $("#searchbox-datalink").removeClass("show-data");
        }
    }
};
</script>
