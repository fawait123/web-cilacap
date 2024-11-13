<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import PaslonItem from './Partials/PaslonItem.vue';
import { h } from 'vue';
import ItemName from './Partials/ItemName.vue';
import { router } from '@inertiajs/vue3';
import PaslonCard from './Partials/PaslonCard.vue';

const props = defineProps({
    subdistrictID: { type: String },
    regionals: { type: Object },
    request: { type: Object },
    paslon: { type: Array }
});

defineOptions({
    layout: AppLayout
})

const columns = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Desa'),
        cell: ({ row }) => {
            return h(ItemName, {
                name: row.getValue('name'),
                onClickName: () => router.get(route('vote', { _query: { filter: { villageID: row.original.id, subdistrictID: props.request.subdistrictID }, view: 'tps', villageID: row.original.id, subdistrictID: props.request.subdistrictID } }))
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
        accessorKey: 'total',
        header: () => h('div', { class: 'text-left font-bold' }, 'Total TPS Belum Masuk'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left text-[14px] font-bold' }, (row.original.total_tps - row.original.total))
        },
    },
    {
        accessorKey: 'vote',
        header: () => h('div', { class: 'text-left font-bold' }, 'Persentase'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-bold text-primary text-[14px]' }, `${Math.floor(row.original.total / row.original.total_tps * 100)}%`)
        },
    }
]

const handleUndo = () => {
    router.get(route('vote', { _query: { filter: { type: 'subdistrict' }, view: 'subdistrict' } }))
}
</script>

<template>
    <div>
        <PaslonCard :paslon-data="props.paslon" />
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Kecamatan">
            <TableComponent :data="props.regionals" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
                :showButtonExport="false" />
        </CardComponent>
    </div>
</template>
