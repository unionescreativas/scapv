<template></template>

<script>
import { vito } from "~/plugins/config/pluginInit";

export default {
    layout: "LightLayout",
    mounted() {
        vito.mainIndex();
    }
};
</script>
