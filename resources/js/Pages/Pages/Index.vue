<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "./Partials/Pagination.vue";
import CheckboxAjaxPublic from '@/Components/CheckboxAjaxPublic.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    pages: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({});



function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("pages.destroy", id));
    }
}
</script>

<template>
    <Head title="pages" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-center">
                Pages list
            </h2>
        </template>

        <div class="col-12">
            <Link :href="route('pages.create')" class="btn btn-primary">
                 Add Page
            </Link>
        </div>
        <div class="col-12 mt-2">
            <table class="table table-info table-striped">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th class="text-center">Public</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in pages.data" :key="page.id">
                        <td>
                            {{ page.id }}
                        </td>
                        <td>
                            {{ page.language.title }}
                        </td>
                        <td class="text-center">
                            <CheckboxAjaxPublic 
                                :id="page.id"
                                :value="page.public"
                                :table="`pages`"
                            />
                        </td>
                        <td>
                            <Link :href="route('pages.edit', page.id)" class="btn btn-outline-primary">
                                Edit
                            </Link>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="destroy(page.id)">
                                Delete
                            </button>
                        </td>
                        <td>
                            {{ page.created_at }}
                        </td>
                    </tr>
                </tbody>
                <tfoot v-if="pages.links.length > 2">
                    <tr>
                        <td colspan="6">
                               
                            <Pagination class="mt-6" :links="pages.links" />
                            
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
    .table td {
        vertical-align: middle;
    }
</style>