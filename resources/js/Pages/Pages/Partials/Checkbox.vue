<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    label: {
    	type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template> 

<div class="form-check mb-3">
    <label>
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="form-check-input"
        /> {{ label }}
    </label>
</div>

</template>
