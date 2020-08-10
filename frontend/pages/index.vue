<template>
  <div>
    <data-table url="http://localhost:8000/api/ciudadanos" :columns="columns">
      <div slot="pagination" slot-scope="{ links = {}, meta = {} }">
        <nav class="row">
          <div class="col-md-6 text-left">
            <span>Showing {{meta.from}} to {{meta.to}} of {{ meta.total }} Entries</span>
          </div>
          <div class="col-md-6 text-right">
            <button :disabled="!links.prev" class="btn btn-primary" @click="url = links.prev">Prev</button>
            <button
              :disabled="!links.next"
              class="btn btn-primary ml-2"
              @click="url = links.next"
            >Next</button>
          </div>
        </nav>
      </div>
    </data-table>
  </div>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";
import DataTable from "laravel-vue-datatable";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  layout: "LightLayout",
  mounted() {
    vito.mainIndex();
  },
  data() {
    return {
      selectOptions: [],
      columns: [
        {
          label: "Name",
          name: "nombres",
          orderable: true,
        },
        {
          label: "Email",
          name: "apellidos",
          orderable: true,
        },
      ],
    };
  },
  components: {
    // eslint-disable-next-line
    vSelect,
  },
  methods: {
    updateSelectedUser(row, tableData) {
      if (row) {
        tableData.search = row.name;
      } else {
        tableData.search = "";
      }
    },
    searchUsersByName(term = "") {
      this.$axios.get(this.url + term).then((response) => {
        this.selectOptions = response.data;
      });
    },
  },
};
</script>
