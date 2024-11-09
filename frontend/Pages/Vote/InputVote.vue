<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import PaslonItem from './Partials/PaslonItem.vue';
import { h } from 'vue';
import { paslonDatas } from '@/database/paslon';
import { Input } from '@/components/ui/input';
import PollstationItem from './Partials/PollstationItem.vue';
import PaslonCard from './Partials/PaslonCard.vue';

const props = defineProps({
    regionals: { type: Object },
    paslon: { type: Array }
})

defineOptions({
    layout: AppLayout
})

const columns = paslonDatas.map((item) => {
    return {
        accessorKey: 'number',
        header: () => h('div', { class: 'text-left font-bold' }, item.name),
        cell: ({ row }) => {
            return h(Input, {
                placeholder: row.getValue('number   '),
                class: 'w-[200px]',
                type: 'number'
            })
        },
    }
})
columns.unshift({
    accessorKey: 'number',
    header: () => h('div', { class: 'text-left font-bold' }, 'TPS'),
    cell: ({ row }) => {
        return h(PollstationItem, {
            name: row.getValue('number')
        })
    },
})



const handleUndo = () => {
    window.history.back()
}

</script>

<template>
    <div>
        <PaslonCard :paslon-data="props.paslon" />
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Desa">
            <TableComponent :data="props.regionals" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
                :showButtonExport="false" />
        </CardComponent>
    </div>
</template>
