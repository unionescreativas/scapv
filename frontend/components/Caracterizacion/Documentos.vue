<template>
  <div>
    <VueFileAgent
      ref="vueFileAgent"
      :theme="'default'"
      :accept="'image/*, audio/*, video/*, .pdf, .doc, .xls, .xlsx, .docx, .ods, .zip, .rar'"
      :maxSize="'4024MB'"
      :maxFiles="50"
      :helpText="'Elija imágenes, videos, documentos o archivos zip.'"
      :errorText="{
        type: 'Elija imágenes, videos, documentos o archivos zip.',
        size: 'El archivo supera el tamaño permitido.',
      }"
      @select="archivosSeleccionados({ payload: _self, fileRecords: $event })"
      v-model="fileRecords"
    >
      <template v-slot:file-preview="{ index, fileRecord }">
        <div
          :key="index"
          class="file-preview-wrapper-jpg file-preview-wrapper-image file-category-image is-deletable is-editable"
          :class="{ 'is-edit-input-focused': fileInEdit == `file${index}` }"
        >
          <span class="file-preview image-preview" style="background-color: transparent;">
            <span class="file-preview-overlay"></span>

            <span
              class="thumbnail"
              style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; overflow: hidden;"
            >
              <img :src="fileRecord.urlValue ? fileRecord.urlValue : fileRecord.urlResized" class="file-preview-img" />
            </span>

            <span class="file-ext">{{ fileRecord.ext().toUpperCase() }}</span>
            <span class="file-size">{{ fileRecord.size() }}</span>

            <span class="file-delete">
              <i class="ri-close-line" @click="antesDeEliminar({ payload: _self, fileRecord })" />
            </span>

            <label class="file-name" :for="`input${index}`" @click="fileInEdit = `file${index}`">
              <input
                type="text"
                class="file-name-input"
                :id="`input${index}`"
                :value="typeof fileRecord.inputValue != 'undefined' ? fileRecord.inputValue : fileRecord.name(true)"
                @blur="antesDeEditar({ payload: _self, fileRecord }, (fileInEdit = null))"
                @input="$set(fileRecord, 'inputValue', $event.target.value)"
              />
              <span class="file-name-edit-icon">
                <i class="ri-pencil-line"></i>
              </span>
              <span class="file-name-text">{{
                typeof fileRecord.inputValue != "undefined" ? fileRecord.inputValue : fileRecord.name(true)
              }}</span>
            </label>

            <div class="file-progress">
              <span class="file-progress-bar" style="width: 0%;"></span>
            </div>
          </span>
        </div>
      </template>

      <template v-slot:after-outer>
        <transition name="fade">
          <b-button
            v-if="!subida_automatica && fileRecordsForUpload.length"
            class="mt-2"
            style="background-color: var(--iq-primary);"
            @click="subirDocumentos(_self)"
          >
            <i class="fa fa-cloud-upload"></i>
            <b
              >Cargar
              {{ fileRecordsForUpload.length + `${fileRecordsForUpload.length > 1 ? " Documentos" : " Documento"}` }}</b
            >
          </b-button>
        </transition>
      </template>
    </VueFileAgent>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Swal from "sweetalert2";

export default {
  props: {
    modulo: {
      type: String,
      required: true,
    },
    moduloid: {
      type: String,
      required: true,
    },
    subida_automatica: {
      type: Boolean,
      default: false,
      required: false,
    },
  },
  data: () => ({
    fileInEdit: null,
    fileRecords: [],
    fileRecordsForUpload: [],
  }),
  computed: {
    ...mapState("Documentos", ["documentos"]),
  },
  watch: {
    documentos: {
      deep: true,
      handler(value) {
        this.fileRecords = _.cloneDeep(value);
      },
    },
    moduloid(value) {
      this.fileRecords = [];
      this.moduloid = value;
      this.consultarDocumentos(this);
    },
  },
  methods: {
    ...mapActions("Documentos", [
      "archivosSeleccionados",
      "subirDocumentos",
      "consultarDocumentos",
      "antesDeEditar",
      "antesDeEliminar",
    ]),
  },
  created() {
    this.consultarDocumentos(this);
  },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
