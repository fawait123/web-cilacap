<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    mapData: { type: Array }
})

// Mengatur opsi Highcharts untuk peta
const chartOptions = ref({
    chart: {
        map: null
    },
    title: {
        text: 'Monitoring Perolehan Suara'
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
            [0, '#B7B7B7'],  // Color at minimum value
            [0.5, 'hsl(var(--primary))'], // Color at mid-range
            [1, 'hsl(var(--primary))']    // Color at maximum value
        ]
    },
    series: [{
        name: 'Total TPS Masuk',
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

        chartOptions.value.chart.map = await fetch('/database/mapData.json')
            .then((res) => res.json());

        // Menambahkan data kecamatan setelah peta dimuat
        chartOptions.value.series[0].data = props.mapData.map((item) => {
            return {
                'hc-key': item['hc-key'],
                value: item.total
            }
        });
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
    height: 100vh;
}
</style>
