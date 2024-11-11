<script setup>
import MapComponent from '@/composable/MapComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout
})

const props = defineProps({
    mapData: { type: Array }
})
</script>
<template>
    <div>
        <Suspense>
            <template #default>
                <MapComponent :map-data="props.mapData" />
            </template>
            <template #fallback>
                <span>Loading...</span>
            </template>
        </Suspense>
    </div>
</template>
