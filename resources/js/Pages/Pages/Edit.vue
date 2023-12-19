<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import TextLangInput from './Partials/TextLangInput.vue';
import TextLangTextarea from './Partials/TextLangTextarea.vue';
import Checkbox from './Partials/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from 'vue';

const props = defineProps({
    page: {
        type: Object,
        default: () => ({}),
    },
});
  
const form = useForm({
    id: props.page.id,
    alt_title: props.page.alt_title,
    languages: props.page.languages,
    content: props.page.content,
    public: props.page.public == 1 ? true : false
});

const submit = () => {
    form.put(route("pages.update", props.page.id));
};
</script> 

<template>
    <Head title="page Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">
                Page Edit 
            </h2>
        </template>

        <div class="row">

            <form @submit.prevent="submit">
                     
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

                <h3 class="my-4 h3 text-center"><b>SEO block</b></h3>

                <TextLangInput
                    id="tag_title" 
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

                <div class="text-end my-2">
                    <button type="submit" class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Submit
                    </button>                        
                </div>                         
            </form>
        </div>
    </AuthenticatedLayout>
</template>