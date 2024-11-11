<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { h } from 'vue';
import ItemName from './Partials/ItemName.vue';
import { router } from '@inertiajs/vue3';
import PaslonCard from './Partials/PaslonCard.vue';

const props = defineProps({
    regionals: { type: Object },
    paslon: { type: Array }
})

defineOptions({
    layout: AppLayout
})

const columns = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Kecamatan'),
        cell: ({ row }) => {
            return h(ItemName, {
                name: row.getValue('name'),
                onClickName: () => router.get(route('vote', { _query: { filter: { parent_id: row.original.id }, view: 'village', subdistrictID: row.original.id } }))
            })
        },
    },
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Total TPS / Total TPS Masuk'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left text-[14px] font-bold' }, `${row.original.total_tps} / ${row.original.total}`)
        },
    },
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Total TPS Belum Masuk'),
        cell: ({ row }) => {
            return h('span', { class: 'text-left text-[14px] font-bold' }, (row.original.total_tps - row.original.total))
        },
    },
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Persentase'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-bold text-primary text-[14px]' }, `${Math.floor(row.original.total / row.original.total_tps * 100)}%`)
        },
    }
]

</script>

<template>
    <div>

        <Head title="Detail Perolehan Suara Kabupaten Cilacap" />
        <PaslonCard :paslon-data="props.paslon" />
        <CardComponent title="Hitung Cepat" description="HDetail Perolehan Suara Kabupaten Cilacap">
            <TableComponent :data="props.regionals" :columns="columns" :show-button-undo="false"
                :show-button-export="true" />
        </CardComponent>
    </div>
</template>
