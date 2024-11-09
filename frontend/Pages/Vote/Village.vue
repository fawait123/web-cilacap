<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { pollstationData } from '@/database/regional';
import { h, ref } from 'vue';
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

const data = ref(pollstationData)

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
    window.history.back()
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
