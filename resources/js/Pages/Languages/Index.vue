<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CheckboxAjaxPublic from "@/Components/CheckboxAjaxPublic.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, watch } from 'vue';



const props = defineProps({
    languages: {
        type: Object,
        default: () => ({}),
    },
    site_locale: {
        type: String,
        default: 'ua',
    },

});


const wasChanged = ref(false);

const languages = ref(props.languages);

const languages_json = JSON.stringify(languages.value);

watch(
  () => languages.value,
  (newValue, oldValue) => {
    if (JSON.stringify(languages.value) === languages_json) {
      wasChanged.value = false;
    }
    else{
        wasChanged.value = true;
    }
  },
  { deep: true }
);

const addRow = () => {
    languages.value.push({
        locale: '',
        short: '',
        title: ''
    });
}

const deleteRow = (index) => {
    languages.value.splice(index, 1);
}

const submit = () => {
    const form = useForm({
        languages: languages.value
    });
    form.post(route("languages.store"));
}
</script>

<template>
    <Head title="languages" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Languages
            </h2>
        </template>

        

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2">
                            <button class="btn btn-primary" @click="addRow">Add</button>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">
                                            Locale
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Short
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th>
                                            Public
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(language, index) in languages" :key="language.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ index + 1 }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            <input type="text" maxlength="2" class="form-control" :readonly="site_locale == language.locale" v-model="language.locale">
                                            
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            <input type="text" maxlength="3"  class="form-control" v-model="language.short">
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            <input type="text" maxlength="20" class="form-control" v-model="language.title">
                                        </th>
                                        <th>
                                            <CheckboxAjaxPublic 
                                            :table="`languages`"
                                            :value="language.public"
                                            :id="language.id"
                                             v-if="site_locale != language.locale"
                                            />
                                        </th>
                                        <td class="px-6 py-4" v-if="site_locale != language.locale">
                                            <button class="btn btn-danger" @click="deleteRow(index)">Del</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end" v-if="wasChanged">
                                            <button class="btn btn-primary" @click="submit">Save</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>