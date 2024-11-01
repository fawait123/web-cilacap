<script setup>
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { VoteIcon } from 'lucide-vue-next';

const props = defineProps({
    title: { type: String },
    total: { type: Number }
})
</script>

<template>
    <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-lg font-bold">
                {{ props.title }}
            </CardTitle>
            <VoteIcon class="text-muted-foreground text-2xl" />
        </CardHeader>
        <CardContent>
            <div class="text-[30px] font-bold text-primary">
                {{ props.title == "Persentase" ? props.total.toFixed(2) + ' %' : props.total.toLocaleString('id') }}
            </div>
            <p class="text-xs text-muted-foreground">
                +20.1% from last month
            </p>
        </CardContent>
    </Card>
</template>
