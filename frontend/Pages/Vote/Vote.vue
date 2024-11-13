<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { h } from 'vue';
import ItemName from './Partials/ItemName.vue';
import { router } from '@inertiajs/vue3';
import PaslonCard from './Partials/PaslonCard.vue';
import { ArrowLeftIcon, ArrowRightIcon } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

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
        accessorKey: 'type',
        header: () => h('div', { class: 'text-left font-bold' }, 'Tipe'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left text-[14px] font-bold' }, `${row.original.type == "subdistrict" ? "Kecamatan" : ""}`)
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
            <TableComponent :data="props.regionals.data" :columns="columns" :show-button-undo="false"
                :show-button-export="true" />
            <div class="flex justify-between items-center">
                <span class="font-medium text-[12px]">Menampilkan data ke <span class="font-bold">{{
                    props.regionals.from }}</span> dari <span class="font-bold">{{ props.regionals.total
                        }}</span> data</span>
                <div class="flex gap-4">
                    <Button :disabled="props.regionals.prev_page_url == null"
                        @click="router.get(props.regionals.prev_page_url)">
                        <ArrowLeftIcon />
                    </Button>
                    <Button :disabled="props.regionals.next_page_url == null"
                        @click="router.get(props.regionals.next_page_url)">
                        <ArrowRightIcon />
                    </Button>
                </div>
            </div>
        </CardComponent>
    </div>
</template>
