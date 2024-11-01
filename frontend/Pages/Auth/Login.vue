<script setup>
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ScanFace } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';

defineOptions({
    layout: AuthLayout
})
</script>

<template>
    <Card class="w-full max-w-sm">
        <CardHeader>
            <CardTitle class="text-2xl">
                Masuk
            </CardTitle>
            <CardDescription>
                Masuk untuk membuat sesi anda.
            </CardDescription>
        </CardHeader>
        <CardContent class="grid gap-4">
            <div class="grid gap-2">
                <Label for="email">Username</Label>
                <Input id="email" type="email" placeholder="Masukan Username Anda" />
            </div>
            <div class="grid gap-2">
                <Label for="password">Password</Label>
                <Input id="password" type="password" placeholder="Masukan Password Anda" />
            </div>
        </CardContent>
        <CardFooter>
            <Button class="w-full" @click="router.get(route('dashboard'))">
                Masuk
                <ScanFace />
            </Button>
        </CardFooter>
    </Card>
</template>
