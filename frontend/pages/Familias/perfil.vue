<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card body-class=" profile-page p-0">
          <template v-slot:body>
            <div class="profile-header">
              <div class="cover-container">
                <!-- <action-user /> -->
                <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                  <li>
                    <b-link href="javascript:void(0);">
                      <i class="ri-pencil-line"></i>
                    </b-link>
                  </li>
                  <li>
                    <b-link href="javascript:void(0);">
                      <i class="ri-settings-4-line"></i>
                    </b-link>
                  </li>
                </ul>
              </div>

              <div class="profile-info mt-5 p-4">
                <b-row>
                  <b-col md="6" sm="12">
                    <div class="user-detail pl-5">
                      <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img pr-4">
                          <b-img
                            v-bind:src="user.profile"
                            alt="profile-img"
                            fluid
                            class="avatar-130"
                          />
                        </div>
                        <div class="profile-detail d-flex align-items-center">
                          <h3>{{ ciudadano[0].nombres}}</h3>
                          <p class="m-0 pl-3">{{ ciudadano[0].apellidos }}</p>
                        </div>
                      </div>
                    </div>
                  </b-col>

                  <b-col md="6" sm="12">
                    <tab-nav
                      :pills="true"
                      id="pills-tab"
                      class="profile-feed-items d-flex justify-content-end"
                    >
                      <tab-nav-items
                        :active="false"
                        id="pills-feed-tab"
                        href="#informacion-personal"
                        role="tab"
                        :ariaSelected="false"
                        title="Información Personal"
                      />
                      <tab-nav-items
                        :active="false"
                        id="pills-activity-tab"
                        href="#otra-informacion"
                        role="tab"
                        :ariaSelected="false"
                        title="Otra Información"
                      />
                      <div
                        class="align-self-center"
                        style="cursor: pointer;"
                        title="Georreferenciación"
                      >
                        <i class="fa fa-2x fa-globe"></i>
                      </div>
                    </tab-nav>
                  </b-col>
                </b-row>
              </div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12">
        <tab-content>
          <tab-content-item
            :active="false"
            id="informacion-personal"
            aria-labelled-by="informacion-personal"
          >
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Información Personal</h4>
              </template>
              <template v-slot:body>
                <div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore adipisci praesentium nisi, dolor quia at
                  id eos. Aliquam, obcaecati! Perspiciatis placeat, magnam suscipit debitis dolores architecto ut animi
                  tenetur vero!
                </div>
              </template>
            </iq-card>
          </tab-content-item>

          <tab-content-item
            :active="false"
            id="otra-informacion"
            aria-labelled-by="otra-informacion"
          >
            <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title">Otra Información</h4>
              </template>
              <template v-slot:body>
                <div>
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus a unde neque vel asperiores deleniti
                  sunt ab ad tenetur necessitatibus expedita harum id nihil blanditiis dolorem debitis odio maiores esse
                  nostrum soluta qui, ea obcaecati et quos! Explicabo illum itaque voluptas quod provident, ipsam mollitia ex
                  commodi magni aliquid illo?
                </div>
              </template>
            </iq-card>
          </tab-content-item>
        </tab-content>
      </b-col>
      <familias />
      <ayudas />
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import ayudas from "~/components/Caracterizacion/ayudas.vue";
import familias from "~/components/Caracterizacion/familias.vue";
import { mapState } from "vuex";
export default {
  layout: "LightLayout",
  components: {
    ayudas,
    familias,
  },
  data: () => ({
    user: {
      profile: require("~/assets/images/user/avatar.png"),
      name: "Nik Jone",
      role: " - Web designer",
      about: "Lorem ipsum dolor sit amet, contur adipiscing elit.",
      email: "nikjone@demoo.com",
      phone: "001 2351 256 12",
      location: "USA",
      careated_date: "07 Jan 2020",
    },
  }),
  computed: {
    ...mapState("Familias", ["ciudadano"]),
  },
  mounted() {
    vito.index();
    console.log(this.ciudadano);
  },
};
</script>
