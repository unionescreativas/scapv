<template>
  <b-col cols="12">
    <iq-card>
      <b-row class="d-flex align-items-center mb-2">
        <b-col md="9">
          <div class="d-flex align-items-center">
            <h4 class="mb-0 p-3 ml-2">{{ page.name }}</h4>
            <b-breadcrumb :items="page.breadCrumb" class="bg-transparent mb-0 mt-1" />
          </div>
        </b-col>
        <b-col md="3" class="text-right">
          <b-button variant="none" class="text-primary" @click="addToBookmark(currentRoute)" v-if="!selectedBookmark"
            ><i class="ri-star-line font-size-24"></i
          ></b-button>
          <b-button variant="none" class="text-warning" @click="removeToBookmark(currentRoute)" v-else
            ><i class="ri-star-fill font-size-24"></i
          ></b-button>
        </b-col>
      </b-row>
    </iq-card>
  </b-col>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import SideBarItems from "~/plugins/FackApi/json/VerticalMenu.json";

export default {
  name: "BreadCrumb",
  props: {
    items: {
      type: Array,
    },
  },
  data: () => ({
    bookmarkSearch: "",
    currentRoute: {},
    selectedBookmark: false,
  }),
  watch: {
    $route(to, from) {
      this.checkRoute();
    },
  },
  computed: {
    ...mapGetters({
      page: "Setting/activePage",
      bookmark: "Setting/bookmarkState",
    }),
  },
  methods: {
    ...mapActions({
      addToBookmarkState: "Setting/addBookmarkAction",
      removeToBookmarkState: "Setting/removeBookmarkAction",
    }),
    removeToBookmark(item) {
      this.removeToBookmarkState(item);
      this.selectedBookmark = false;
    },
    addToBookmark(item) {
      this.addToBookmarkState(item);
      this.selectedBookmark = true;
    },
    checkRoute() {
      // let routes = SideBarItems.find((route) => !route.is_heading && !route.children && route.link.path);
      // let childRoutes = SideBarItems.forEach((route) => {
      //   if (!route.is_heading && route.children) {

      //   }
      // });
      SideBarItems.forEach((route) => {
        if (!route.is_heading) {
          if (!route.children) {
            if (route.link.path) {
              if (route.link.path == this.$route.path) {
                this.currentRoute = route;
              }
            }
          } else {
            route.children.forEach((child) => {
              if (child.link.path) {
                if (child.link.path == this.$route.path) {
                  this.currentRoute = child;
                }
              }
            });
          }
        }
      })
      // this.currentRoute = this.navList.find((item) => item.link.name === this.$route.path);
      // let book = this.bookmark.find((item) => item.link.name === this.$route.path);
      // if (book !== undefined) {
      //   this.selectedBookmark = true;
      // } else {
      //   this.selectedBookmark = false;
      // }
    },
  },
  mounted() {
    // this.currentRoute = this.navList.find((item) => item.link.name === this.$route.path);
    // let book = this.bookmark.find((item) => item.link.name === this.$route.path);
    // if (book !== undefined) {
    //   this.selectedBookmark = true;
    // }
  },
};
</script>
