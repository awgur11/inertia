<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
// import TextInput from '@/Components/TextInput.vue';
import TextLangInput from './Partials/TextLangInput.vue';
import Checkbox from './Partials/Checkbox.vue';
import TextLangTextarea from './Partials/TextLangTextarea.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import InputError from '@/Components/InputError.vue';
// import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from 'vue';
 
const form = useForm({
    id: "",
    alt_title: "",
    languages: [
        {language: 'ua', title: '', content: ' ', tag_title: '', description: ''},
        {language: 'ru', title: '', content: ' ', tag_title: '', description: ''}
    ],
    type: 'pages',
    public: false
});

const {errors} = defineProps(['errors']);

const submit = () => {
    form.post(route("pages.store"));
};
</script> 

<template>
    <Head title="page Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Page Create 
            </h2>
        </template>

        <div class="row">
            <form @submit.prevent="submit">
                <div class="mb-2 alert alert-danger" v-if="errors !== undefined && errors['alt_title']">
                    {{ errors['alt_title'] }}
                </div>
                <input type="hidden" v-model="form.type">
                <TextLangInput
                    id="title" 
                    type="text" 
                    class="" 
                    v-model="form.languages"
                    :languages="form.languages"
                    :name="`title`" 
                    :title="`Title`"
                    :errors="form.errors"
                />

                <TextLangTextarea
                    id="content" 
                    class="" 
                    v-model="form.languages"
                    :languages="form.languages"
                    :name="`content`" 
                    :title="`Content`"
                    :use_editor="true"
                />

                <h3 class="my-4 text-center"><b>SEO block</b></h3>

                <TextLangInput
                    id="title" 
                    type="text"
                    v-model="form.languages"
                    :languages="form.languages"
                    :name="`tag_title`" 
                    :title="`Title`"
                />

                <TextLangTextarea
                    id="description" 
                    class="" 
                    v-model="form.languages"
                    :languages="form.languages"
                    :name="`description`" 
                    :title="`Tag description`"
                />

                <Checkbox  
                    :label="`Public`" 
                    v-model:checked="form.public" 
                />

                <div class="my-2 text-end">
                    <button class="btn btn-primary" type="submit" :disabled="form.processing">
                        Submit
                    </button> 
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>