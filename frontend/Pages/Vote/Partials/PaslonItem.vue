<script setup>
import { cn } from '@/lib/utils';

const props = defineProps({
    src: { type: null },
    number: { type: Number },
    name: { type: String },
    vote: { type: Number },
    percentage: { type: Number }
})
</script>

<template>
    <div class="overflow-hidden my-10 rounded-md bg-white shadow-md flex gap-4 shadow-slate-400">
        <div class="max-w-[120px] h-full">
            <img :src="cn(props.src)" class="object-containt" alt="Paslon">
        </div>
        <div class="w-full flex items-center gap-4">
            <h1 class="text-[40px] font-bold text-muted-foreground">{{ props.number }}</h1>
            <div class="flex flex-col gap-7">
                <h1 class="text-[16px] font-semibold">{{ props.name }}</h1>
                <div class="flex gap-2">
                    <h1 class="text-[16px] font-semibold text-slate-400">{{ props.vote }}</h1>
                    <h1 class="text-[24px] font-bold text-primary">/ {{ props.percentage }}%</h1>
                </div>
            </div>
        </div>
    </div>
</template>
