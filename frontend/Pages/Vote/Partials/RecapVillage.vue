<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import { pollstationData } from '@/database/regional';
import { h, ref } from 'vue';
import ItemName from './ItemName.vue';
const data = ref(pollstationData)
const props = defineProps({
    subdistrictID: { type: String }
})

const emmit = defineEmits()

const columns = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Kecamatan'),
        cell: ({ row }) => {
            return h(ItemName, {
                name: row.getValue('name')
            })
        },
    },
    {
        accessorKey: 'code',
        header: () => h('div', { class: 'text-left font-bold' }, 'Kode'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('code'))
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

const handleUndo = () => {
    emmit('handleBack')
}
</script>

<template>
    <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Desa">
        <TableComponent :data="data" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
            :showButtonExport="false" />
    </CardComponent>
</template>
