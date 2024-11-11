<script setup>
const props = defineProps({
    data: { type: Object }
})
</script>

<template>
    <h6 class="font-bold">{{ props.data.name }}</h6>
</template>
