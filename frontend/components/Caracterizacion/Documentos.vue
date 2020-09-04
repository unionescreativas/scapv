<template>
  <div>
    <VueFileAgent
      ref="vueFileAgent"
      :auto="auto"
      :averageColor="averageColor"
      :theme="theme"
      :multiple="multiple"
      :deletable="deletable"
      :editable="editable"
      :meta="meta"
      :linkable="linkable"
      :sortable="sortable"
      :readonly="readonly"
      :resumable="resumable"
      :disabled="disabled"
      :compact="compact"
      :accept="valAccept"
      :capture="valCapture"
      :maxSize="valMaxSize"
      :maxFiles="valMaxFiles"
      :helpText="'Elija imágenes, videos, documentos o archivos zip.'"
      :errorText="{
        type: 'Elija imágenes, videos, documentos o archivos zip.',
        size: 'El archivo supera el tamaño permitido.',
      }"
      @editable="fileEditable($event)"
      @select="archivosSeleccionados({ payload: _self, fileRecords: $event })"
      @beforedelete="antesDeEliminar({ payload: _self, fileRecord: $event })"
      @upload="uploadEvent('upload', $event)"
      @upload:error="uploadEvent('upload:error', $event)"
      @upload:delete="uploadEvent('upload:delete', $event)"
      @upload:delete:error="uploadEvent('upload:delete:error', $event)"
      @upload:update="uploadEvent('upload:update', $event)"
      @upload:update:error="uploadEvent('upload:update:error', $event)"
      v-model="fileRecords"
    ></VueFileAgent>

    <transition name="fade">
      <b-button
        v-if="fileRecordsForUpload.length"
        class="mt-2"
        style="background-color: var(--iq-primary);"
        @click="subirDocumentos(_self)"
      >
        <i class="fa fa-cloud-upload"></i>
        <b>Cargar {{ fileRecordsForUpload.length + `${fileRecordsForUpload.length > 1 ? " Documentos" : " Documento"}` }}</b>
      </b-button>
    </transition>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Swal from "sweetalert2";

export default {
  props: ["modulo", "moduloid"],
  data: () => ({
    icons: {
      pdf: "red",
      doc: "blue",
      ods: "green",
      zip: "orange",
      db: "brown",
    },
    fileRecords: [],
    fileRecordsForUpload: [],
    auto: false,
    averageColor: false,
    meta: true,
    multiple: true,
    deletable: true,
    editable: true,
    linkable: true,
    sortable: false,
    readonly: false,
    resumable: true,
    disabled: false,
    compact: false,
    theme: "default",
    sortDirection: {
      lastModified: "ASC",
      name: "ASC",
    },
    selectedIdx: 1,
    valAccept: "image/*,audio/*,video/*,.pdf,.doc,.xls,.xlsx,.docx,.ods,.zip,.rar,",
    valCapture: "",
    valMaxSize: "4024MB",
    valMaxFiles: 50,
  }),
  computed: {
    ...mapState("Documentos", ["documentos"]),
    fileRecordsInvalid: function () {
      var fileRecordsInvalid = [];
      for (var i = 0; i < this.fileRecords.length; i++) {
        if (this.fileRecords[i].error) {
          fileRecordsInvalid.push(this.fileRecords[i]);
        }
      }
      return fileRecordsInvalid;
    },
    uploadEndpoint: function () {
      if (this.resumable && this.uploadUrl.indexOf("mocky.io") !== -1) {
        return "https://master.tus.io/files/";
      }
      return this.uploadUrl;
    },
  },
  watch: {
    documentos(value) {
      this.fileRecords = _.cloneDeep(value);
      console.log(this.$refs.vueFileAgent)
    },
    moduloid(value) {
      this.fileRecords = [];
      this.moduloid = value;
      this.consultarDocumentos(this);
    },
  },
  created() {
    this.consultarDocumentos(this);
  },
  methods: {
    ...mapActions("Documentos", [
      "archivosSeleccionados",
      "subirDocumentos",
      "consultarDocumentos",
      "antesDeEliminar",
      "eliminarDocumento",
    ]),
    fileEditable(file) {
      console.log("sirve caray");
    },
    uploadEvent(eventName, data) {
      console.log("UPLOAD EVENT ", eventName, data);
    },
    getSelectedFileRecord: function () {
      var i = this.selectedIdx;
      i = i - 1;
      if (!this.fileRecords[i]) {
        return;
      }
      return this.fileRecords[i];
    },
    removeAll: function () {
      console.log(this.fileRecords);
      this.fileRecords = [];
      this.fileRecordsForUpload = [];
    },
    setProgress: function () {
      var fileRecord = this.getSelectedFileRecord();
      if (!fileRecord) {
        return;
      }
      var prg = this.$refs.prgInput.value;
      fileRecord.progress(prg);
    },
    removeInvalid: function () {
      var fileRecordsNew = this.fileRecords.concat([]);
      for (var i = 0; i < this.fileRecordsInvalid.length; i++) {
        var idx = fileRecordsNew.indexOf(this.fileRecordsInvalid[i]);
        if (idx !== -1) {
          fileRecordsNew.splice(idx, 1);
        }
      }
      fileRecordsNew = [];
      for (i = 0; i < this.fileRecords.length; i++) {
        if (!this.fileRecords[i].error) {
          fileRecordsNew.push(this.fileRecords[i]);
        }
      }
      this.fileRecords = fileRecordsNew; // mutate at once, do not splice each
    },
    remove: function () {
      console.log("removing...");
      var i = this.selectedIdx;
      i = i - 1;
      if (!this.fileRecords[i]) {
        return;
      }
      this.fileRecords.splice(i, 1);
    },
    update: function () {
      alert("This is not a user selected file");
      var fileRecord = this.getSelectedFileRecord();
      if (!fileRecord) {
        return;
      }
      if (!(fileRecord.file && fileRecord.file instanceof File)) {
        alert("This is not a user selected file");
        return;
      }
      // this.$refs.vueFileAgent.updateUpload(
      //   this.uploadUrl,
      //   this.uploadHeaders,
      //   fileRecord
      // );
    },
    upload: function () {
      console.log("let au debug");
      var fileRecord = this.getSelectedFileRecord();
      if (!fileRecord) {
        return;
      }
      if (!(fileRecord.file && fileRecord.file instanceof File)) {
        alert("This is not a user selected file");
        return;
      }
      var i = this.fileRecordsForUpload.indexOf(fileRecord);
      if (i !== -1) {
        this.fileRecordsForUpload.splice(i, 1);
      }
      this.$refs.vueFileAgent.upload(this.uploadEndpoint, this.uploadHeaders, [fileRecord]).then(
        function (result) {
          console.log("uploded: ", result);
          console.log("after upload: ", fileRecord);
          console.log("after upload all: ", this.fileRecords);
        }.bind(this)
      );
    },
    moveIndex: function (dir) {
      console.log("moveIndex", dir);
      var index = parseInt(this.selectedIdx) - 1;
      var newIndex = index + dir;
      if (newIndex < 0) {
        newIndex = this.fileRecords.length - 1;
      }
      if (newIndex >= this.fileRecords.length) {
        newIndex = 0;
      }
      var existing = this.fileRecords[index];
      var adjacent = this.fileRecords[newIndex];
      this.selectedIdx = newIndex + 1;
      if (!existing || !adjacent) {
        return;
      }
      var fileRecords = this.fileRecords;
      fileRecords[newIndex] = existing;
      fileRecords[index] = adjacent;
      this.fileRecords = fileRecords.concat([]); // cause Vue array mutation
    },
    sortBy: function (prop) {
      // var asc = this['_is_sorted_desc_' + prop] = !this['_is_sorted_desc_' + prop];
      var direction = this.sortDirection[prop];
      this.sortDirection[prop] = direction == "DESC" ? "ASC" : "DESC";
      // console.log('sortBy', prop, this.fileRecords);
      var ret = direction == "DESC" ? -1 : 1;
      this.fileRecords = this.fileRecords.sort(function (fd1, fd2) {
        var f1 = fd1.file || fd1;
        var f2 = fd2.file || fd2;
        return f1[prop] > f2[prop] ? 1 * ret : -1 * ret;
      });
      // console.log('sortBy after', prop, this.fileRecords);
    },
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
