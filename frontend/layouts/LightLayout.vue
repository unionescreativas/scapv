<template>
  <div>
    <div id="show-overlay"></div>
    <Loader />
    <RightSideBar toggleClass="top-50 setting-toggle iq-card">
      <i class="ri-sound-module-fill font-size-18 text-primary" slot="icon" />
      <iq-card class="shadow-none">
        <template v-slot:headerTitle>
          <h4>{{ $t("customizer.colorCustomizer") }}</h4>
        </template>
        <template v-slot:headerAction>
          <b-button variant="primary" size="sm" @click="reset()">{{ $t("customizer.reset") }}</b-button>
        </template>
        <template v-slot:body>
          <b-row>
            <b-col cols="12" class="justify-content-between">
              <h4 class="text-left mb-2">{{ $t("customizer.themeColor") }}</h4>
              <div class="text-center">
                <div v-for="(item, index) in colors" :key="index" class="d-inline-flex justify-content-between">
                  <div
                    :style="`background: ${item.primary};border-radius: 50%;`"
                    @click="changeColor(item)"
                    class="p-3 mx-1"
                  ></div>
                </div>
              </div>
            </b-col>

            <div class="border mt-4 mb-4 w-100" />
            <b-col cols="12" class="justify-content-between">
              <h4 class="text-left mb-2">{{ $t("customizer.colorMode") }}</h4>
              <div class="text-center d-flex">
                <img
                  :src="require('~/assets/images/customizer/customizer-01.png')"
                  alt="light"
                  @click="light()"
                  class="img-fluid"
                  style="height: 150px; border: 2px solid var(--iq-primary);"
                />
                <img
                  :src="require('~/assets/images/customizer/customizer-03.png')"
                  alt="dark"
                  @click="dark()"
                  class="img-fluid ml-2"
                  style="height: 150px; border: 2px solid var(--iq-primary);"
                />
              </div>
            </b-col>
            <div class="border mt-4 mb-4 w-100" />
            <b-col cols="12" class="justify-content-between">
              <h4 class="text-left mb-2">{{ $t("customizer.sidebar") }}</h4>
            </b-col>
            <b-col cols="12" class="justify-content-between d-flex">
              <label>{{ $t("customizer.sidebarMini") }}</label>
              <b-form-checkbox
                class="custom-switch-color"
                color="primary"
                v-model="mini"
                @change="sidebarMini()"
                name="check-button"
                switch
                inline
              >
              </b-form-checkbox>
            </b-col>

            <div class="border mt-4 mb-4 w-100" />
            <b-col cols="12" class="justify-content-between">
              <h4 class="text-left mb-2">{{ $t("customizer.rtlMode") }}</h4>
              <div class="text-center d-flex">
                <img
                  :src="require('~/assets/images/customizer/ltr-img.png')"
                  alt="ltr"
                  @click="rtlChange(true)"
                  class="img-fluid"
                  style="height: 150px; border: 2px solid var(--iq-primary);"
                />
                <img
                  :src="require('~/assets/images/customizer/rtl-img.png')"
                  alt="rtl"
                  @click="rtlChange(false)"
                  class="img-fluid ml-2"
                  style="height: 150px; border: 2px solid var(--iq-primary);"
                />
              </div>
            </b-col>
            <div class="border mt-4 mb-4 w-100" />
            <b-col cols="12" class="justify-content-between">
              <h4 class="text-left mb-2">
                {{ $t("customizer.routeAnimation") }}
              </h4>
              <div class="text-center d-flex">
                <b-form-radio-group
                  id="radio-group-1"
                  v-model="animated"
                  :options="animateClass"
                  name="radio-options"
                ></b-form-radio-group>
              </div>
            </b-col>
          </b-row>
        </template>
      </iq-card>
    </RightSideBar>
    <div class="wrapper">
      <!-- Sidebar  -->
      <SideBarStyle1 :items="verticalMenu" :horizontal="horizontal" :logo="logo" @toggle="sidebarMini()" />
      <!-- TOP Nav Bar -->
      <NavBarStyle1
        title="Dashboard"
        :homeURL="{ name: 'dashboard1.home' }"
        @toggle="sidebarMini()"
        :logo="logo"
        :horizontal="horizontal"
        :items="horizontalMenu"
      >
        <template slot="responsiveRight">
          <ul class="navbar-nav ml-auto navbar-list">
            <li class="nav-item">
              <a class="search-toggle iq-waves-effect language-title" href="javascript:void(0)"
                ><img :src="selectedLang.image" alt="img-flaf" class="img-fluid mr-1" style="height: 16px; width: 16px;" />
                {{ selectedLang.title }} <i class="ri-arrow-down-s-line"></i
              ></a>
              <div class="iq-sub-dropdown">
                <a
                  class="iq-sub-card"
                  href="javascript:void(0)"
                  v-for="(lang, i) in langsOptions"
                  :key="`Lang${i}`"
                  @click="langChange(lang)"
                >
                  <img :src="lang.image" alt="img-flaf" class="img-fluid mr-2" />{{ lang.title }}
                </a>
              </div>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="iq-waves-effect" :class="cartCount > 0 ? 'search-toggle' : ''">
                <i class="ri-shopping-cart-2-line" />
                <span class="menu-tag ml-2">{{ cartCount }}</span>
              </a>
              <div class="iq-sub-dropdown">
                <div class="iq-card shadow-none m-0">
                  <div class="iq-card-body p-0">
                    <div class="bg-primary p-3">
                      <h5 class="mb-0 text-white">{{ $t("nav.allCarts") }}</h5>
                    </div>
                    <div class="iq-sub-card" v-for="(item, index) in cartItems" :key="index">
                      <div class="media align-items-center">
                        <div class="w-20 text-center d-none justify-content-center d-md-block">
                          <img :src="item.image" :alt="item.name" class="w-100 align-self-center mr-3" />
                        </div>
                        <div class="media-body ml-3">
                          <b-button variant=" iq-bg-danger mt-3" size="sm" class="float-right" @click="removeToCart(item)"
                            >X</b-button
                          >
                          <h6 class="mb-0">
                            {{ item.name.substring(0, 20) + "..." }}
                          </h6>
                          <p class="mb-0 font-size-12">
                            {{ item.description.substring(0, 20) + "..." }}
                          </p>
                          <p class="mb-0">
                            <b>$ {{ item.price }}</b>
                          </p>
                        </div>
                      </div>
                    </div>
                    <nuxt-link :to="{ name: 'app.e-commerce.cart' }"
                      ><b-button variant=" iq-bg-primary" block
                        ><i class="fas fa-cart-plus" />{{ $t("nav.viewCarts") }}</b-button
                      ></nuxt-link
                    >
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="search-toggle iq-waves-effect">
                <lottie :option="require('~/assets/images/small/lottie-bell')" id="lottie-beil" />
                <span class="bg-danger dots"></span>
              </a>
              <div class="iq-sub-dropdown">
                <div class="iq-card shadow-none m-0">
                  <div class="iq-card-body p-0">
                    <div class="bg-primary p-3">
                      <h5 class="mb-0 text-white">
                        {{ $t("nav.allNotifications") }}<small class="badge badge-light float-right pt-1">4</small>
                      </h5>
                    </div>
                    <a href="javascript:void(0)" class="iq-sub-card" v-for="(item, index) in notification" :key="index">
                      <div class="media align-items-center">
                        <div class="">
                          <img class="avatar-40 rounded" :src="item.image" alt="img" />
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">{{ item.name }}</h6>
                          <small class="float-right font-size-12">{{ item.date }}</small>
                          <p class="mb-0">
                            {{ item.description.substring(0, 40) + "..." }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="search-toggle iq-waves-effect">
                <lottie :option="require('~/assets/images/small/lottie-mail')" id="lottie-mail" />
                <span class="bg-primary count-mail"></span>
              </a>
              <div class="iq-sub-dropdown">
                <div class="iq-card shadow-none m-0">
                  <div class="iq-card-body p-0">
                    <div class="bg-primary p-3">
                      <h5 class="mb-0 text-white">
                        {{ $t("nav.allMessages") }}<small class="badge badge-light float-right pt-1">5</small>
                      </h5>
                    </div>
                    <a href="javascript:void(0)" class="iq-sub-card" v-for="(item, index) in message" :key="index">
                      <div class="media align-items-center">
                        <div class="">
                          <img class="avatar-40 rounded" :src="item.image" alt="img" />
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">{{ item.name }}</h6>
                          <small class="float-left font-size-12">{{ item.date }}</small>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </template>
        <template slot="right">
          <ul class="navbar-list">
            <li>
              <a href="javascript:void(0)" class="search-toggle iq-waves-effect d-flex align-items-center">
                <img :src="userProfile" class="img-fluid rounded mr-3" alt="user" />
                <div class="caption">
                  <h6 class="mb-0 line-height">Nik jone</h6>
                  <span class="font-size-12">{{ $t("nav.user.available") }}</span>
                </div>
              </a>
              <div class="iq-sub-dropdown iq-user-dropdown">
                <div class="iq-card shadow-none m-0">
                  <div class="iq-card-body p-0">
                    <div class="bg-primary p-3">
                      <h5 class="mb-0 text-white line-height">
                        Hello Nik jone
                      </h5>
                      <span class="text-white font-size-12">{{ $t("nav.user.available") }}</span>
                    </div>
                    <a href="javascript:void(0)" class="iq-sub-card iq-bg-primary-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-primary">
                          <i class="ri-file-user-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">
                            {{ $t("nav.user.profileTitle") }}
                          </h6>
                          <p class="mb-0 font-size-12">
                            {{ $t("nav.user.profileSub") }}
                          </p>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="iq-sub-card iq-bg-primary-success-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-success">
                          <i class="ri-profile-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">
                            {{ $t("nav.user.profileEditTitle") }}
                          </h6>
                          <p class="mb-0 font-size-12">
                            {{ $t("nav.user.profileEditSub") }}
                          </p>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="iq-sub-card iq-bg-primary-danger-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-danger">
                          <i class="ri-account-box-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">
                            {{ $t("nav.user.accountSettingTitle") }}
                          </h6>
                          <p class="mb-0 font-size-12">
                            {{ $t("nav.user.accountSettingSub") }}
                          </p>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="iq-sub-card iq-bg-primary-secondary-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-secondary">
                          <i class="ri-lock-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0">
                            {{ $t("nav.user.privacySettingTitle") }}
                          </h6>
                          <p class="mb-0 font-size-12">
                            {{ $t("nav.user.privacySettingSub") }}
                          </p>
                        </div>
                      </div>
                    </a>
                    <div class="d-inline-block w-100 text-center p-3">
                      <a class="iq-bg-danger iq-sign-btn" href="javascript:void(0)" @click="logout()" role="button"
                        >{{ $t("nav.user.signout") }}<i class="ri-login-box-line ml-2"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </template>
      </NavBarStyle1>
      <!-- TOP Nav Bar END -->
      <div id="content-page" class="content-page" :class="horizontal ? 'ml-0' : ''">
        <b-container fluid="" v-if="$route.name !== 'dashboard.home-2'">
          <b-row>
            <BreadCrumb />
          </b-row>
        </b-container>
        <transition
          name="router-anim"
          :enter-active-class="`animated ${animated.enter}`"
          mode="out-in"
          :leave-active-class="`animated ${animated.exit}`"
        >
          <nuxt />
        </transition>
      </div>
    </div>
    <FooterStyle1>
      <template v-slot:left>
        <li class="list-inline-item">
          <a href="javascript:void(0)">Privacy Policy</a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0)">Terms of Use</a>
        </li>
      </template>
      <template v-slot:right> Copyright 2020 <a href="javascript:void(0)">Vito</a> All Rights Reserved. </template>
    </FooterStyle1>
  </div>
</template>
<script>
import { vito } from "~/plugins/config/pluginInit";
// import { Users } from "~/plugins/FackApi/api/chat";
import horizontalMenu from "~/plugins/FackApi/json/HorizontalMenu";
import verticalMenu from "~/plugins/FackApi/json/VerticalMenu";
import userProfile from "~/assets/images/user/user-1.jpeg";
import loader from "~/assets/images/loader.gif";
import darkLoader from "~/assets/images/darkMode/dark-logo.gif";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "Layout1",
  head() {
    return {
      bodyAttrs: {
        class: "light",
      },
    };
  },
  created() {
    this.updateRadio();
    if (this.darkMode) {
      this.logo = darkLoader;
    } else {
      this.logo = loader;
    }
  },
  computed: {
    ...mapGetters({
      cartCount: "Ecommerce/cartCountState",
      cartItems: "Ecommerce/cartState",
      selectedLang: "Setting/langState",
      langsOptions: "Setting/langOptionState",
      colors: "Setting/colorState",
    }),
  },
  data() {
    return {
      horizontal: false,
      mini: false,
      darkMode: false,
      animated: { enter: "zoomIn", exit: "zoomOut" },
      animateClass: [
        { value: { enter: "zoomIn", exit: "zoomOut" }, text: "Zoom" },
        { value: { enter: "fadeInUp", exit: "fadeOutDown" }, text: "Fade" },
        {
          value: { enter: "slideInLeft", exit: "slideOutRight" },
          text: "Slide",
        },
        {
          value: { enter: "rotateInDownLeft", exit: "rotateOutDownLeft" },
          text: "Roll",
        },
      ],
      horizontalMenu: horizontalMenu,
      verticalMenu: verticalMenu,
      userProfile: userProfile,
      logo: loader,
      // usersList: Users,
      rtl: false,
      message: [
        {
          image: require("~/assets/images/user/user-01.jpg"),
          name: "Nik Emma Watson",
          date: "13 jan",
        },
        {
          image: require("~/assets/images/user/user-02.jpg"),
          name: "Greta Life",
          date: "14 Jun",
        },
        {
          image: require("~/assets/images/user/user-03.jpg"),
          name: "Barb Ackue",
          date: "16 Aug",
        },
        {
          image: require("~/assets/images/user/user-04.jpg"),
          name: "Anna Sthesia",
          date: "21 Sept",
        },
        {
          image: require("~/assets/images/user/user-05.jpg"),
          name: "Bob Frapples",
          date: "29 Sept",
        },
      ],
      notification: [
        {
          image: require("~/assets/images/user/user-01.jpg"),
          name: "Nik Emma Watson",
          date: "23 hour ago",
          description: "Enjoy smart access to videos, games",
        },
        {
          image: require("~/assets/images/user/user-02.jpg"),
          name: "Greta Life",
          date: "14 hour ago",
          description: "Google Chromecast: Enjoy a world of entertainment",
        },
        {
          image: require("~/assets/images/user/user-03.jpg"),
          name: "Barb Ackue",
          date: "16 hour ago",
          description: "Dell Inspiron Laptop: Get speed and performance from",
        },
        {
          image: require("~/assets/images/user/user-04.jpg"),
          name: "Anna Sthesia",
          date: "21 hour ago",
          description: "Deliver your favorite playlist anywhere in your home ",
        },
        {
          image: require("~/assets/images/user/user-05.jpg"),
          name: "Bob Frapples",
          date: "11 hour ago",
          description: "MacBook Air features up to 8GB of memory, a fifth-generation",
        },
      ],
    };
  },
  methods: {
    dark() {
      $("body").removeClass("light");
      $("body").addClass("dark");
      this.modeChange(true);
      this.logo = darkLoader;
    },
    light() {
      $("body").removeClass("dark");
      $("body").addClass("light");
      this.modeChange(false);
      this.logo = loader;
    },
    updateRadio() {
      this.horizontal = this.$store.getters["Setting/horizontalMenuState"];
      this.mini = this.$store.getters["Setting/miniSidebarState"];
    },
    sidebarHorizontal() {
      this.$store.dispatch("Setting/horizontalMenuAction");
      this.updateRadio();
    },
    sidebarMini() {
      vito.triggerSet();
      this.$store.dispatch("Setting/miniSidebarAction");
      this.updateRadio();
    },
    rtlChange(mode) {
      this.rtl = mode;
      if (this.rtl) {
        this.rtlRemove();
      } else {
        this.rtlAdd();
      }
      if (this.darkMode) {
        $("body").addClass("dark");
        $("body").removeClass("light");
        this.logo = darkLoader;
      } else {
        $("body").addClass("light");
        $("body").removeClass("dark");
        this.logo = loader;
      }
    },
    changeColor(code) {
      $("html").css("--iq-primary", code.primary);
      $("html").css("--iq-primary-light", code.primaryLight);
      if (this.darkMode) {
        $("html").css("--iq-bg-dark-color", code.bodyBgDark);
      } else {
        $("html").css("--iq-bg-light-color", code.bodyBgLight);
      }
    },
    reset() {
      this.changeColor({
        primary: "#827af3",
        primaryLight: "#b47af3",
        bodyBgLight: "#efeefd",
        bodyBgDark: "#1d203f",
      });
      this.animated = { enter: "zoomIn", exit: "zoomOut" };
      this.light();
    },
    langChange(lang) {
      this.langChangeState(lang);
      this.$i18n.locale = lang.value;
      $(".iq-show").removeClass("iq-show");
      if (lang.value === "ar") {
        this.rtlAdd(lang);
      } else {
        this.rtlRemove(lang);
      }
    },
    ...mapActions({
      removeToCart: "Ecommerce/removeToCartAction",
      langChangeState: "Setting/setLangAction",
      rtlAdd: "Setting/setRtlAction",
      rtlRemove: "Setting/removeRtlAction",
      modeChange: "Setting/darkModeAction",
      logout: "logout",
    }),
  },
};
</script>

<style>
@import "~/assets/css/custom.css";
@import "~/assets/css/PriceSlider.css";
</style>
