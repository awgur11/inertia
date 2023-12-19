<script setup>
import SiteBase from '@/Layouts/SiteBase.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({}),
    },
    pages: {
        type: Object,
        default: () => ({}),

    }
});
const form = useForm({});


</script>

<template>
    <Head title="Home page title" />



    <SiteBase :pages="pages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center display-1">
                        Home page
                    </h1>
                </div>
            </div>
        </div>
    </SiteBase>
</template>