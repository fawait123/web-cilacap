<script setup>
import CardComponent from '@/composable/CardComponent.vue';
import TableComponent from '@/composable/TableComponent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import PaslonItem from './Partials/PaslonItem.vue';
import { h } from 'vue';
import { Input } from '@/components/ui/input';
import PollstationItem from './Partials/PollstationItem.vue';
import PaslonCard from './Partials/PaslonCard.vue';
import HeaderPaslon from './Partials/HeaderPaslon.vue';
import { Button } from '@/components/ui/button';
import { Save } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    regionals: { type: Array },
    paslon: { type: Array },
    errors: { type: Object, required: false }
})

const formRef = useForm(props.regionals.map((item) => {
    return {
        pollstationID: item.id,
        provinceID: item.provinceID,
        districtID: item.districtID,
        subdistrictID: item.subdistrictID,
        villageID: item.villageID,
        number: item.number,
        paslonData: props.paslon.map((item) => {
            return {
                paslonID: item.id,
                value: null,
                name: item.name
            }
        })
    }
}))

defineOptions({
    layout: AppLayout
})

const columns = props.paslon.map((item, i) => {
    return {
        accessorKey: 'number',
        header: () => h(HeaderPaslon, {
            data: item
        }),
        cell: ({ row }) => {
            const errorMessage = `${row.index}.paslonData.${i}.value`
            return h(Input, {
                placeholder: row.getValue('number') > 10 ? '0' + row.getValue('number') : '00' + row.getValue('number'),
                class: 'w-full',
                type: 'number',
                modelValue: formRef[row.index].paslonData[i].value,
                'onUpdate:modelValue': (value) => { formRef[row.index].paslonData[i].value = value },
                errorMessage: props.errors[errorMessage] || null
            })
        },
    }
})
columns.unshift({
    accessorKey: 'number',
    size: 150,
    minSize: 150,
    maxSize: Number.MAX_SAFE_INTEGER,
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

const handleSubmit = () => {
    formRef.post(route('vote.store'), {
        onFinish: () => {
            console.log('finish')
        },
        onError: () => {
            console.log('error')
        }
    })
}

</script>

<template>
    <div>
        <PaslonCard :paslon-data="props.paslon" />
        <CardComponent title="Hitung Cepat" description="Detail Perolehan Suara Desa">
            <TableComponent :data="props.regionals" :columns="columns" @onUndo="handleUndo" :showButtonUndo="true"
                :showButtonExport="false">
                <template #headerButton>
                    <Button @click="handleSubmit">
                        <Save />
                        Simpan
                    </Button>
                </template>
            </TableComponent>
        </CardComponent>
    </div>
</template>
