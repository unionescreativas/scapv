<template>
  <div>
    <ValidationProvider name="tipo_documento" v-slot="{ errors }">
      <b-form-group label="TIPO DE DOCUMENTO: *">
        <v-select
          placeholder="Seleccione ..."
          :options="options.tipos_documentos"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.tipo_documento"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("tipo documento", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="numero_documento" v-slot="{ errors }">
      <b-form-group label="NUMERO DE DOCUMENTO: *">
        <input
          type="text"
          class="form-control"
          placeholder="INGRESE NUMERO DE DOCUMENTO"
          v-model="form.numero_documento"
          :readonly="!!form.id"
        />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("numero_documento", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="pep" v-slot="{ errors }">
      <b-form-group label="# PERMISO ESPECIAL DE PERMANENCIA:">
        <input type="text" class="form-control" placeholder="INGRESE # PERMISO ESPECIAL DE PERMANENCIA" v-model="form.pep" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("pep", "") }}</div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="nombres" v-slot="{ errors }">
      <b-form-group label="NOMBRES: *">
        <input type="text" class="form-control" placeholder="INGRESE NOMBRES" v-model="form.nombres" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("nombres", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="apellidos" v-slot="{ errors }">
      <b-form-group label="APELLIDOS: *">
        <input type="text" class="form-control" placeholder="INGRESE APELLIDOS" v-model="form.apellidos" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("apellidos", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="fecha_expedicion" v-slot="{ errors }">
      <b-form-group label="FECHA DE EXPEDICION DEL DOCUMENTO: *">
        <input
          type="date"
          class="form-control"
          placeholder="INGRESE FECHA DE EXPEDICION DEL DOCUMENTO"
          v-model="form.fecha_expedicion"
        />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("fecha expedicion", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="fecha_vencimiento" v-slot="{ errors }">
      <b-form-group label="FECHA DE VENCIMIENTO DEL DOCUMENTO: *">
        <input
          type="date"
          class="form-control"
          placeholder="INGRESE FECHA DE VENCIMIENTO DEL DOCUMENTO"
          v-model="form.fecha_vencimiento"
        />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("fecha_vencimiento", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="fecha_nacimiento" v-slot="{ errors }">
      <b-form-group label="FECHA DE NACIMIENTO: *">
        <input
          type="date"
          class="form-control"
          placeholder="INGRESE FECHA DE NACIMIENTO"
          v-model="form.fecha_nacimiento"
          @change="calcularEdad($event.target.value)"
        />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("fecha nacimiento", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="edad" v-slot="{ errors }">
      <b-form-group label="EDAD: *">
        <input type="text" class="form-control" ref="inputEdad" v-model="form.edad" readonly />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("edad", "") }}</div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="genero" v-slot="{ errors }">
      <b-form-group label="GÉNERO: *">
        <v-select
          placeholder="Seleccione ..."
          :options="options.generos"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.genero"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("genero", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="estado_civil" v-slot="{ errors }">
      <b-form-group label="ESTADO CIVIL:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.estados_civiles"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.estado_civil"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("estado_civil", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="telefono" v-slot="{ errors }">
      <b-form-group label="TELÉFONO:">
        <input type="text" class="form-control" placeholder="INGRESE TELÉFONO" v-model="form.telefono" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("telefono", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="celular" v-slot="{ errors }">
      <b-form-group label="CELULAR:">
        <input type="text" class="form-control" placeholder="INGRESE CELULAR" v-model="form.celular" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("celular", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="correo_electronico" v-slot="{ errors }">
      <b-form-group label="CORREO ELECTRÓNICO:">
        <input type="text" class="form-control" placeholder="INGRESE CORREO ELECTRÓNICO" v-model="form.correo_electronico" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("correo_electronico", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="departamento" v-slot="{ errors }">
      <b-form-group label="DEPARTAMENTO DE RESIDENCIA: *">
        <v-select
          placeholder="Seleccione ..."
          :options="options.departamentos"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.departamento"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("departamento", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="ciudad" v-slot="{ errors }">
      <b-form-group label="CIUDAD DE RESIDENCIA: *">
        <v-select
          placeholder="Seleccione ..."
          :options="options.ciudades_residencia"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.ciudad"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("ciudad", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="barrio" v-slot="{ errors }">
      <b-form-group label="BARRIO DE RESIDENCIA: *">
        <v-select
          ref="vSelect"
          placeholder="Seleccione ..."
          :options="options.barrios"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.barrio"
          @input="autocompletarComuna"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("barrio", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="comuna" v-slot="{ errors }">
      <b-form-group label="COMUNA DE RESIDENCIA: *">
        <input
          ref="inputComuna"
          type="text"
          class="form-control"
          id="comuna"
          placeholder="INGRESE COMUNA DE RESIDENCIA"
          v-model="form.comuna"
          readonly
        />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("comuna", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="direccion" v-slot="{ errors }">
      <b-form-group label="DIRECCIÓN DE RESIDENCIA: *">
        <input type="text" class="form-control" placeholder="INGRESE DIRECCIÓN DE RESIDENCIA" v-model="form.direccion" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("direccion", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>
  </div>
</template>

<script>
import { calcularEdad } from "~/plugins/general/scripts";

export default {
  props: {
    form: {
      required: true,
      type: Object,
    },
    options: {
      required: true,
    },
  },
  methods: {
    autocompletarComuna(value) {
      let barrio = this.options.barrios.find((option) => option.codigo_campo == value);
      let comuna = barrio.valor_campo_2;
      this.$refs.inputComuna.value = comuna;
      this.form.comuna = comuna;
    },
    calcularEdad(fecha) {
      let edad = calcularEdad(fecha);
      this.$refs.inputEdad.value = edad;
      this.form.edad = edad;
    },
  },
};
</script>
