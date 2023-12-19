<script setup>
import HeaderNav from '../Pages/Site/Partials/Nav.vue';
import LanguageButtons from '../Pages/Site/Partials/Head/LanguageButtons.vue';

const props = defineProps({
    pages: {
        type: Object,
        default: () => ({}),

    }
});
</script>

<template>
    <div>
        <div class="container">
            <div class="mt-4 p-5 bg-primary text-white rounded">
                <h1>Header</h1>
                <p>Lorem ipsum...</p>
            </div>
            <LanguageButtons />
        </div>

        <div class="container my-2">

        <HeaderNav 
            :pages="pages"
        />
    </div>


        <slot />
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">
                        Footer
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>