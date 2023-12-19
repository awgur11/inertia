<template>
    <div v-if="links.length > 2">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="btn btn-primary mx-1'"
                    v-html="link.label"
                />

                <Link
                    v-else
                    class="btn btn-outline-primary mx-1"
                    :class="{ 'btn-primary text-light': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script setup>

import { Link } from "@inertiajs/vue3";

const links = defineProps({
    links: {
        type: Object,
        default: () => ({}),
    },
});
</script>