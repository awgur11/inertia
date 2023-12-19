<script setup>
import SiteBase from '@/Layouts/SiteBase.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    page: {
        type: Object,
        default: () => '',

    },
    pages: {
        type: Object,
        default: () => ({}),

    }
});


</script>

<template>
    <Head title="Home page title" />

    <SiteBase :pages="pages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">
                        {{ page.language.title }}
                    </h1>
                </div>
                <div class="col-12 my-5" v-html="page.language.content">
                    
                </div>
            </div>
        </div>
    </SiteBase>
</template>