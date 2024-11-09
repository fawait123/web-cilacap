<script setup>
import { DonutChart } from '@/components/ui/chart-donut';

const props = defineProps({
    paslonData: { tye: Object }
})
</script>

<template>
    <DonutChart index="name" :category="'total'" :data="paslonData"
        :colors="['#7ED4AD', '#608BC1', '#D4BEE4', '#4C4B16']" :show-legend="true" type="pie" />
</template>
