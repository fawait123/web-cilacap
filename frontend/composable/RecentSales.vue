<script setup>
import {
    Avatar,
    AvatarFallback,
    AvatarImage,
} from '@/components/ui/avatar'

const props = defineProps({
    paslonData: { tye: Object }
})
</script>

<template>
    <div class="space-y-8">
        <div class="flex items-center" v-for="paslon in paslonData" :key="paslon.number">
            <Avatar class="h-9 w-9">
                <AvatarImage :src="paslon.picture" alt="Avatar" />
                <AvatarFallback>OM</AvatarFallback>
            </Avatar>
            <div class="ml-4 space-y-1">
                <p class="text-sm font-medium leading-none">
                    {{ paslon.name }}
                </p>
                <p class="text-sm text-muted-foreground">
                    pasangan nomor urut <span class="font-bold">0{{ paslon.number }}</span>
                </p>
            </div>
            <div class="ml-auto font-bold text-primary">
                +{{ paslon.total }}
            </div>
        </div>
    </div>
</template>
