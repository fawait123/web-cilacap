<script setup>
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ScanFace } from 'lucide-vue-next';
import { router, useForm } from '@inertiajs/vue3';

defineOptions({
    layout: AuthLayout
})

const formRef = useForm({
    username: '',
    password: ''
})

const handleLogin = () => {
    formRef.post(route('login.action'), {
        onSuccess: () => {
            router.get(route('dashboard'))
        }
    })
}
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
                <Input id="email" type="email" place v-model="formRef.username" :errorMessage="formRef.errors.username"
                    placeholder="Masukan Username Anda" />
            </div>
            <div class="grid gap-2">
                <Label for="password">Password</Label>
                <Input id="password" type="password" v-model="formRef.password" :errorMessage="formRef.errors.password"
                    placeholder="Masukan Password Anda" />
            </div>
        </CardContent>
        <CardFooter>
            <Button class="w-full" @click="handleLogin">
                Masuk
                <ScanFace />
            </Button>
        </CardFooter>
    </Card>
</template>
