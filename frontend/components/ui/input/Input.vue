<script setup>
import { cn } from '@/lib/utils';
import { usePage } from '@inertiajs/vue3';
import { useVModel } from '@vueuse/core';

const props = defineProps({
    defaultValue: { type: [String, Number], required: false },
    modelValue: { type: [String, Number], required: false },
    class: { type: null, required: false },
    type: { type: { String }, required: false },
    errorMessage: { type: String, required: false },
    placeholder: { type: String, required: false },
    value: { type: String, required: false },
    disabled:{type:Boolean}
});

const emits = defineEmits(['update:modelValue']);

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});

const handleEnter = (value) => {
    emits('handleEnter', value.target.value)
}

const handleOnInput = (event) => {
    emits('onInput', event)
};
</script>

<template>
    <input :disabled="props.disabled" :placeholder="props.placeholder" @input="handleOnInput" @keyup.enter="handleEnter" :type="props.type"
        v-model="modelValue" :class="cn(
            'flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',
            props.class,
        )
            " />
    <span class="text-sm text-red-500" v-if="props.errorMessage">{{ props.errorMessage }}</span>
</template>
