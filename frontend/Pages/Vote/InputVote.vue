<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import PaslonItem from './Partials/PaslonItem.vue';
import { pollstationData, villageData } from '@/database/regional';
import { h, ref } from 'vue';
import ItemName from './Partials/ItemName.vue';
import { router } from '@inertiajs/vue3';
import { paslonDatas } from '@/database/paslon';
import { Input } from '@/components/ui/input';

const props = defineProps({
    subdistrictID: { type: String },
    villageID: { type: String }
})

defineOptions({
    layout: AppLayout
})

const data = ref(pollstationData)

const columns = paslonDatas.map((item) => {
    return {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left font-bold' }, item.name),
        cell: ({ row }) => {
            return h(Input, {
                placeholder: row.getValue('name'),
                class: 'w-[200px]',
                type: 'number'
            })
        },
    }
})
columns.unshift({
    accessorKey: 'name',
    header: () => h('div', { class: 'text-left font-bold' }, 'TPS'),
    cell: ({ row }) => {
        return h(ItemName, {
            name: row.getValue('name')
        })
    },
})



const handleUndo = () => {
    router.get(`/vote/${props.subdistrictID}/${props.villageID}`)
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
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Desa">
            <TableComponent :data="data" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
                :showButtonExport="false" />
        </CardComponent>
    </div>
</template>
