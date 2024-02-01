<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);

const inputRef = ref(null);

onMounted(() => {
    if (inputRef.value && inputRef.value.hasAttribute('autofocus')) {
        inputRef.value.focus();
    }
});
defineExpose({ focus: () => input.value.focus() });

</script>

<template>
    <input
        class="border-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="inputRef"
    />
</template>
