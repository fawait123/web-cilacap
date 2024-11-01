<script setup>
import {
    Avatar,
    AvatarFallback,
    AvatarImage,
} from '@/components/ui/avatar'
import { paslonDatas } from '@/database/paslon';
</script>

<template>
    <div class="space-y-8">
        <div class="flex items-center" v-for="paslon in paslonDatas" :key="paslon.number">
            <Avatar class="h-9 w-9">
                <AvatarImage :src="paslon.src" alt="Avatar" />
                <AvatarFallback>OM</AvatarFallback>
            </Avatar>
            <div class="ml-4 space-y-1">
                <p class="text-sm font-medium leading-none">
                    {{ paslon.name }}
                </p>
                <p class="text-sm text-muted-foreground">
                    pasangan nomor urut <span class="font-bold">{{ paslon.number }}</span>
                </p>
            </div>
            <div class="ml-auto font-bold text-primary">
                +{{ Math.floor(Math.random() * (3000 - 100 + 1)) + 100 }}
            </div>
        </div>
    </div>
</template>
