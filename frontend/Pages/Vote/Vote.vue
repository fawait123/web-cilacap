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
        accessorKey: 'vote',
        header: () => h('div', { class: 'text-left font-bold' }, 'Suara Masuk'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, `${row.getValue('vote')} / ${row.getValue('total')}`)
        },
    },
    {
        accessorKey: 'total',
        header: () => h('div', { class: 'text-left font-bold' }, 'Suara Belum Masuk'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, (row.getValue('total') - row.getValue('vote')))
        },
    },
    {
        accessorKey: 'vote',
        header: () => h('div', { class: 'text-left font-bold' }, 'Persentase'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-bold text-primary' }, `${Math.floor(row.getValue('vote') / row.getValue('total') * 100)}%`)
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
