<script setup>
import mapDatas from '@/database/mapdata.json';
import { ref, onMounted } from 'vue';

// Mengatur opsi Highcharts untuk peta
const chartOptions = ref({
    chart: {
        map: null
    },
    title: {
        text: 'Highmaps basic demo'
    },
    mapNavigation: {
        enabled: true,
        buttonOptions: {
            alignTo: 'spacingBox'
        }
    },
    colorAxis: {
        min: 0,
        stops: [
            [0, '#FFCCCC'],  // Color at minimum value
            [0.5, 'hsl(var(--primary))'], // Color at mid-range
            [1, 'hsl(var(--primary))']    // Color at maximum value
        ]
    },
    series: [{
        name: 'Total Perolehan Suara',
        states: {
            hover: {
                color: 'hsl(var(--primary))'
            }
        },
        dataLabels: {
            enabled: false,
            format: '{point.name}'
        },
        allAreas: false,
        data: []
    }]
});

// Fungsi untuk memuat data peta secara dinamis
async function loadMapData() {
    try {
        chartOptions.value.chart.map = mapDatas;

        // Menambahkan data kecamatan setelah peta dimuat
        chartOptions.value.series[0].data = [
            { 'hc-key': 'kecamatan-kroya', value: 10 },
            { 'hc-key': 'kecamatan-cilacap-selatan', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-kawunganten', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-cilacap-tengah', value: 0 },
            { 'hc-key': 'kecamatan-wanareja', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-bantarsari', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-binangun', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-cimanggu', value: 0 },
            { 'hc-key': 'kecamatan-jeruk-legi', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-sidareja', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-dayeluhur', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-kadung-reja', value: 0 },
            { 'hc-key': 'kecamatan-nusawangu', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-sampang', value: 0 },
            { 'hc-key': 'kecamatan-gandrungmangu', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-maos', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-adipala', value: 0 },
            { 'hc-key': 'kecamatan-kampung-laut', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-majenang', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-cilacap-utara', value: 0 },
            { 'hc-key': 'kecamatan-kesugihan', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-karangpucung', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-cipari', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
            { 'hc-key': 'kecamatan-patimun', value: Math.floor(Math.random() * (3000 - 100 + 1)) + 100 },
        ];
    } catch (error) {
        console.error("Error loading map data:", error);
    }
}

// Memuat data peta ketika komponen dipasang
onMounted(() => {
    loadMapData();
});
</script>

<template>
    <highcharts :constructorType="'mapChart'" class="hc" :options="chartOptions" ref="chart"></highcharts>
</template>

<style>
.hc {
    width: 100%;
    height: 70vh;
}
</style>
