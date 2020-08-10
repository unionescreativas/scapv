<template>
  <div class="user-actions">
    <nuxt-link to="">
      <b-button type="" data-action-type="edit" class="btn btn-default text-success">
        <i class="fa fa-pencil"></i> Edit
      </b-button>
    </nuxt-link>
    <button type="button" @click="removeData()" data-action-type="remove" class="btn btn-default text-danger">
      <i class="fa fa-trash"></i> Delete
    </button>
  </div>
</template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
  data: () => ({

  }),
  methods: {
    removeData (id) {
      vito.showSnackbar('success', 'User has been remove successfully.')
    }
  }
}
</script>
