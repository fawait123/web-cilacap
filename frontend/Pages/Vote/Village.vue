<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { h } from 'vue';
import { router } from '@inertiajs/vue3';
import PollstationItem from './Partials/PollstationItem.vue';
import PaslonCard from './Partials/PaslonCard.vue';

const props = defineProps({
    filter: { type: Object },
    regionals: { type: Object },
    request: { type: Object },
    paslon: { type: Array }
})

defineOptions({
    layout: AppLayout
})


const columns = [
    {
        accessorKey: 'number',
        header: () => h('div', { class: 'text-left font-bold' }, 'TPS'),
        cell: ({ row }) => {
            return h(PollstationItem, {
                name: row.getValue('number')
            })
        },
    },
    {
        accessorKey: 'number',
        header: () => h('div', { class: 'text-left font-bold' }, 'Total Suara Masuk'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-bold text-[14px]' }, `${row.original.total}`)
        },
    }
]

const handleUndo = () => {
    router.get(route('vote', { _query: { filter: { parent_id: props.filter.subdistrictID }, view: 'village', subdistrictID: props.filter.subdistrictID } }))
}

const handleButtonInputClick = () => {
    router.get(route('vote', { _query: { ...props.request, view: 'input-vote' } }));
}

</script>

<template>
    <div>
        <PaslonCard :paslon-data="props.paslon" />
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Desa">
            <TableComponent :data="props.regionals" :columns="columns" @onUndo="handleUndo"
                @handleInput="handleButtonInputClick" :showButtonUndo="true" :showButtonExport="false"
                :showButtonInput="true" />
        </CardComponent>
    </div>
</template>
