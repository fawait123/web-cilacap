<script setup>
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {
    getCoreRowModel,
    getPaginationRowModel,
    useVueTable,
    FlexRender,
} from '@tanstack/vue-table'
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { DownloadIcon, PencilIcon, Undo } from 'lucide-vue-next';


const props = defineProps({
    data: { type: Array },
    columns: { type: Array },
    showButtonUndo: { type: Boolean },
    showButtonExport: { type: Boolean },
    showButtonInput: { type: Boolean }
})

const emmit = defineEmits()

const table = useVueTable({
    data: props.data,
    columns: props.columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    initialState: {
        pagination: {
            pageSize: props.data.length
        }
    }
})

const handleUndo = () => {
    emmit('onUndo');
}

const handleClickButtonInput = () => {
    emmit('handleInput');
}
</script>

<template>
    <div>
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-3">
                <Button @click="handleUndo" v-show="props.showButtonUndo">
                    <Undo />
                    Kembali
                </Button>
            </div>
            <div class="flex gap-3 items-center">
                <Button v-show="props.showButtonExport">
                    <DownloadIcon />
                    Export
                </Button>
                <Button v-show="props.showButtonInput" @click="handleClickButtonInput">
                    <PencilIcon />
                    Input Hitung Suara
                </Button>
                <Input class="max-w-[200px]" placeholder="Masukan pencarian..." />
            </div>
        </div>
        <Table>
            <TableHeader>
                <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                    <TableHead v-for="header in headerGroup.headers" :key="header.id">
                        <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                            :props="header.getContext()" />
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="table.getRowModel().rows?.length">
                    <template v-for="row in table.getRowModel().rows" :key="row.id">
                        <TableRow :data-state="row.getIsSelected() && 'selected'">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="row.getIsExpanded()">
                            <TableCell :colspan="row.getAllCells().length">
                                {{ JSON.stringify(row.original) }}
                            </TableCell>
                        </TableRow>
                    </template>
                </template>

                <TableRow v-else>
                    <TableCell :colspan="columns.length" class="h-24 text-center">
                        No results.
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
