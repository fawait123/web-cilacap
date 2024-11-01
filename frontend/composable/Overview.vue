<script setup>
import { DonutChart } from '@/components/ui/chart-donut';

const data = [
    {
        name: "PASLON 01",
        total: Math.floor(Math.random() * 5000) + 1000
    },
    {
        name: "PASLON 02",
        total: Math.floor(Math.random() * 5000) + 1000
    },
    {
        name: "PASLON 03",
        total: Math.floor(Math.random() * 5000) + 1000
    },
    {
        name: "PASLON 04",
        total: Math.floor(Math.random() * 5000) + 1000
    }
]
</script>

<template>
    <DonutChart index="name" :category="'total'" :data="data" :colors="['#7ED4AD', '#608BC1', '#D4BEE4', '#4C4B16']"
        :show-legend="true" type="pie" />
</template>
