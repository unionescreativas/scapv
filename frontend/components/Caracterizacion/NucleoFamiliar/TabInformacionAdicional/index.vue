<template>
  <div>
    <ValidationProvider name="actividad" v-slot="{ errors }">
      <b-form-group label="ACTIVIDAD QUE REALIZA ACTUALMENTE:">
        <b-form-input type="text" placeholder="INGRESE ACTIVIDAD" v-model="form.actividad" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("actividad", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="ciudad_origen" v-slot="{ errors }">
      <b-form-group label="CIUDAD DE ORIGEN:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.ciudades_origen"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.ciudad_origen"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("ciudad_origen", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="pais_origen" v-slot="{ errors }">
      <b-form-group label="PAIS DE ORIGEN:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.paises_origen"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.pais_origen"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("pais_origen", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="fecha_llegada" v-slot="{ errors }">
      <b-form-group label="FECHA DE LLEGADA AL PAIS:">
        <b-form-input type="date" placeholder="INGRESE FECHA DE LLEGADA AL PAIS" v-model="form.fecha_llegada" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("fecha_llegada", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="intencion_ciudad" v-slot="{ errors }">
      <b-form-group label="INTENCIÓN DE ESTAR EN LA CIUDAD:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.intenciones_ciudad"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.intencion_ciudad"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("intencion_ciudad", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="respuesta_intencion" v-slot="{ errors }">
      <b-form-group label="RESPUESTA INTENCIÓN:">
        <b-form-input type="text" placeholder="INGRESE RESPUESTA INTENCIÓN" v-model="form.respuesta_intencion" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("respuesta_intencion", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="discapacidad" v-slot="{ errors }">
      <b-form-group label="TIENE ALGUNA DISCAPACIDAD:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.discapacidad"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("discapacidad", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="salud" v-slot="{ errors }">
      <b-form-group label="TIENE SISTEMA DE SALUD:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.salud"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">{{ errors[0].replace("salud", "") }}</div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="estudia_actualmente" v-slot="{ errors }">
      <b-form-group label="SE ENCUENTRA ESTUDIANDO ACTUALMENTE:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.estudia_actualmente"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("estudia_actualmente", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="nivel_escolaridad" v-slot="{ errors }">
      <b-form-group label="NIVEL DE ESCOLARIDAD:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.niveles_escolares"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.nivel_escolaridad"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("nivel_escolaridad", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="tipo_profesion" v-slot="{ errors }">
      <b-form-group label="PROFESIONAL EN ?:">
        <b-form-input type="text" placeholder="INGRESE PROFESIONAL EN ?" v-model="form.tipo_profesion" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("tipo_profesion", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="comunidad_lgtbi" v-slot="{ errors }">
      <b-form-group label="POBLACIÓN LGTBI:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.comunidad_lgtbi"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("comunidad_lgtbi", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="comunidad_etnica" v-slot="{ errors }">
      <b-form-group label="PERTENECE ALGUNA COMUNIDAD ETNICA ?:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.comunidad_etnica"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("comunidad_etnica", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="trabajo" v-slot="{ errors }">
      <b-form-group label="ACTUALMENTE SE ENCUENTRA LABORANDO:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.respuestas"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.trabajo"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("trabajo", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="tipo_empleo" v-slot="{ errors }">
      <b-form-group label="TIPO DE EMPLEO:">
        <v-select
          placeholder="Seleccione ..."
          :options="options.tipos_empleos"
          label="valor_campo_1"
          :reduce="(option) => option.codigo_campo"
          v-model="form.tipo_empleo"
        >
          <template slot="no-options">
            <span>Escriba para buscar ...</span>
          </template>
        </v-select>
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("tipo_empleo", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>

    <ValidationProvider name="observaciones" v-slot="{ errors }">
      <b-form-group label="OBSERVACIONES:">
        <b-form-textarea type="textarea" rows="5" placeholder="INGRESE OBSERVACIONES" v-model="form.observaciones" />
        <div style="color: var(--iq-danger-light);" v-if="errors[0]">
          {{ errors[0].replace("observaciones", "") }}
        </div>
      </b-form-group>
    </ValidationProvider>
  </div>
</template>

<script>
export default {
  props: ["form", "options"],
};
</script>
