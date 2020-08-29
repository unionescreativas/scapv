<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Reportes</h4>
          </template>
          <template v-slot:headerAction>
            <a class="text-primary float-right" v-b-toggle.collapse-1 role="button">
              <i class="ri-code-s-slash-line" />
            </a>
          </template>
          <template v-slot:body>
            <b-row>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-primary text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Primary card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-secondary text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Secondary card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-success text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Success card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
            </b-row>

            <b-row>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-danger text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Danger card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-warning text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Warning card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
              <b-col lg="4">
                <div class="card iq-mb-3 bg-info text-white">
                  <!----><!---->
                  <div class="card-body">
                    <!----><!---->
                    <h4 class="card-title text-white">Info card title</h4>
                    <blockquote class="blockquote mb-0">
                      <p class="font-size-14">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                      </p>
                      <footer class="blockquote-footer text-white font-size-12">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </footer>
                    </blockquote>
                  </div>
                  <!----><!---->
                </div>
              </b-col>
            </b-row>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  layout: "LightLayout",
  head: () => ({
    title: "Inicio",
  }),
  mounted() {
    vito.mainIndex();
  },
};
</script>
