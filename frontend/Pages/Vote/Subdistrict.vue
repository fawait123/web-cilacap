<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import PaslonItem from './Partials/PaslonItem.vue';
import { villageData } from '@/database/regional';
import { h, ref } from 'vue';
import ItemName from './Partials/ItemName.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    subdistrictID: { type: String }
});

defineOptions({
    layout: AppLayout
})

const data = ref(villageData)

const columns = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, 'Desa'),
        cell: ({ row }) => {
            return h(ItemName, {
                name: row.getValue('name'),
                onClickName: () => router.get(`/vote/${props.subdistrictID}/${row.original.regionalID}`)
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
    router.get(route('vote'));
}
</script>

<template>
    <div>
        <div class="grid grid-cols-4 gap-4">
            <PaslonItem src="/assets/images/1.jpg" name="PASLON 01" number="01" vote="700" percentage="40" />
            <PaslonItem src="/assets/images/2.jpg" name="PASLON 02" number="02" vote="1922" percentage="60" />
            <PaslonItem src="/assets/images/3.jpg" name="PASLON 03" number="03" vote="800" percentage="56" />
            <PaslonItem src="/assets/images/4.jpg" name="PASLON 04" number="04" vote="2923" percentage="90" />
        </div>
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Kecamatan">
            <TableComponent :data="data" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
                :showButtonExport="false" />
        </CardComponent>
    </div>
</template>
