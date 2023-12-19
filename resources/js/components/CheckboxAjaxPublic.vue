<template>
	<input type="checkbox" :value="value" v-model="proxyChecked" @change="handleChange">
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    table: {
        type: String,
        required: true
    },
    value: {
        type: Number,
        default: false
    }
});

let proxyChecked = props.value == 1 ? true : false

const form = useForm({
    id: props.id,
    table: props.table,
    public: proxyChecked === true ? 0 : 1,
});

const handleChange = () => {
    form.post(route('set.public'), {
        preserveScroll: true,
        onSuccess: () => { proxyChecked = !proxyChecked},
        onError: () => {},
    });
};
</script>