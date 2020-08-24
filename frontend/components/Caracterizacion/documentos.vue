<template>
<div>
    <VueFileAgent ref="vueFileAgent" :auto="auto" :averageColor="averageColor" :theme="theme" :multiple="multiple" :deletable="deletable" :editable="editable" :meta="true" :linkable="linkable" :sortable="sortable" :readonly="readonly" :resumable="resumable" :disabled="disabled" :compact="compact" :accept="valAccept" :capture="valCapture" :maxSize="valMaxSize" :maxFiles="valMaxFiles" :helpText="'Elija imágenes, videos, documentos o archivos zip.'" :errorText="{
      type: 'Elija imágenes, videos, documentos o archivos zip.',
      size: 'El archivo supera el tamaño permitido.'}" @editable="fileeditable($event)" @select="filesSelected($event)" @delete="fileDeleted($event)" @beforedelete="onBeforeDelete($event)" @sort="onSort($event)" @upload="uploadEvent('upload', $event)" @upload:error="uploadEvent('upload:error', $event)" @upload:delete="uploadEvent('upload:delete', $event)" @upload:delete:error="uploadEvent('upload:delete:error', $event)" @upload:update="uploadEvent('upload:update', $event)" @upload:update:error="uploadEvent('upload:update:error', $event)" v-model="fileRecords"></VueFileAgent>

    <b-button :disabled="!fileRecordsForUpload.length" variant="primary" class="mb-3 mr-1" @click="uploadFiles()">
        <i class="fa fa-cloud-upload"></i>
        Cargar {{ fileRecordsForUpload.length }} Documentos
    </b-button>
</div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    props: ["modulo", "moduloid"],
    data: function () {
        return {
            // modulo: "ayudas",
            // modulo_id: "pruebasss",
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
            editable: false,
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
        };
    },
    computed: {
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
            // if (this.resumable && this.uploadUrl.indexOf("mocky.io") !== -1) {
            //   return "https://master.tus.io/files/";
            // }
            // return this.uploadUrl;
        },
    },
    watch: {
        prueba() {
            console.log(fileRecord.name((withoutExtension = true)));
        },
    },
    methods: {
        fileeditable() {
            console.log("sirve caray");
        },
        uploadEvent(eventName, data) {
            console.log("UPLOAD EVENT ", eventName, data);
        },
        getFileRecordsInitial: function () {
            // return window.getFileRecordsInitial();
            let url = `/api/documentos?modulo_id=${this.moduloid}&modulo=${this.modulo}`;
            let documentosCargado = {};
            let consulta;

            this.$axios
                .get(url)
                .then((res) => {
                    consulta = res.data.data;
                    // console.log("consultando" + res.data.data[0].id);
                    consulta.forEach((item, index) => {
                        documentosCargado = {
                            id: consulta[index].id,
                            name: consulta[index].nombre_carga,
                            lastModified: consulta[index].updated_at,
                            sizeText: consulta[index].nombre_carga,
                            size: consulta[index].tamano,
                            type: consulta[index].aplicacion,
                            ext: consulta[index].extension,
                            url: `${process.env.API_URL}/storage${consulta[index].url_descarga}`,
                        };
                        // console.log("array creado " + documentosCargado.id);
                        this.fileRecords.push(documentosCargado);
                        // formData.append("file[" + index + "]", item.file);
                    });
                    // console.log("consultando" + this.fileRecords);
                })
                .catch((err) => {
                    console.log(err);
                });
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
            this.$refs.vueFileAgent
                .upload(this.uploadEndpoint, this.uploadHeaders, [fileRecord])
                .then(
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
        uploadFiles: function () {
            let formData = new FormData();
            formData.append("modulo_id", this.moduloid);
            formData.append("modulo", this.modulo);
            this.fileRecordsForUpload.forEach((item, index) => {
                formData.append("file[" + index + "]", item.file);
            });
            let url = "/api/documentos";
            this.$axios
                .post(url, formData, {
                    header: {
                        "Content-type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    // console.log("respuesta de carga" + res);
                    Swal.fire("Excelente!", "Datos Cargados Correctamente!", "success");
                })
                .catch((err) => {
                    console.log(err);
                });
            this.fileRecordsForUpload = [];
        },
        deleteUploadedFile: function (fileRecord) {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.deleteUpload(
                this.uploadEndpoint,
                this.uploadHeaders,
                fileRecord
            );
        },
        filesSelected: function (fileRecords) {
            console.log("filesSelected", fileRecords);
            var validFileRecords = [];
            for (var i = 0; i < fileRecords.length; i++) {
                if (!fileRecords[i].error) {
                    validFileRecords.push(fileRecords[i]);
                }
            }
            console.log("filesSelected", fileRecords, validFileRecords);
            this.fileRecordsForUpload = this.fileRecordsForUpload.concat(
                validFileRecords
            );
        },
        eliminarArchivo(fileRecord) {
            console.log(fileRecord);
            let url = `/api/documentos/${fileRecord.id}`;
            this.$axios
                .delete(url)
                .then((res) => {
                    this.fileRecords = [];
                    this.getFileRecordsInitial();
                    console.log("registro eliminado Correctamente" + res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        onBeforeDelete: function (fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                this.fileRecordsForUpload.splice(i, 1);
            } else {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Si, Borrar!",
                    cancelButtonText: "No, Borrar!",
                }).then((result) => {
                    if (result.value) {
                        this.eliminarArchivo(fileRecord);
                        Swal.fire(
                            "Eliminado!",
                            "Documento Eliminado Correctamente.",
                            "success"
                        );
                    }
                });
            }
        },
        fileDeleted: function (fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                this.fileRecordsForUpload.splice(i, 1);
            } else {
                this.deleteUploadedFile(fileRecord);
            }
        },
        onSort(event) {
            console.log(
                "sorted",
                event.oldIndex,
                event.newIndex,
                this.fileRecords.map(function (fd) {
                    return typeof fd.name == "function" ? fd.name() : fd.name;
                })
            );
        },
    },
    mounted() {
        this.getFileRecordsInitial();
    },
};
</script>
