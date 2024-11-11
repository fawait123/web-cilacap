<script setup>
const props = defineProps({
    name: { type: String }
})
</script>

<template>
    <span class="font-bold cursor-pointer text-primary" @click="handleClick">{{
        parseInt(props.name) < 10 ? `00${props.name}` : `0${props.name}` }}</span>
</template>
