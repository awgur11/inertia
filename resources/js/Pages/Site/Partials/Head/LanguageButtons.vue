<script setup>

import { Link }  from "@inertiajs/vue3";

</script>

<template>
	<div class="btn-group" role="group" aria-label="Basic example">
        <Link :href="language.link" v-for="(language, index) in $page.props.languages" :key="index" type="button"  class="btn" :class="[language.current ? 'btn-primary' : 'btn-light', language.public == 1 ? '' : 'd-none']">{{ language.locale }}</Link>
    </div>
</template>