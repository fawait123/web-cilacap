<script setup>
const props = defineProps({
    name: { type: String }
})
const emmit = defineEmits()

const handleClick = () => {
    emmit('clickName')
}
</script>

<template>
    <span class="font-bold cursor-pointer text-primary" @click="handleClick">{{ props.name }}</span>
</template>
