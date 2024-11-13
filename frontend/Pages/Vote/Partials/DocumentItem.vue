<script setup>
import { FileText } from 'lucide-vue-next';

const props = defineProps({
    data: {
        type: Object
    }
})

const handleClick = () => {
    window.open(props.data.document.document_path, '_blank');
}
</script>

<template>
    <div v-if="props.data.document" class="flex gap-4 items-center cursor-pointer" @click="handleClick">
        <FileText class="w-[16px] text-red-500" /> <span class="font-bold text-red-500 ">
            {{ props.data.document.document_name }}
        </span>
    </div>
    <span v-else class="py-1 px-2 rounded-xl bg-blue-200 text-blue-700">Tidak ada document</span>
</template>
