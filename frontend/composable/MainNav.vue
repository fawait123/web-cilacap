<script setup>
import { cn } from '@/lib/utils'
import { router, usePage } from '@inertiajs/vue3';
const page = usePage()
</script>

<template>
    <nav :class="cn('flex items-center space-x-4 lg:space-x-6', $attrs.class ?? '')">
        <span @click="router.get(route('dashboard'))"
            :class="['text-sm font-medium transition-colors hover:text-primary cursor-pointer', page.props.route.uri == '/' ? 'text-primary' : '']">
            Dashboard
        </span>
        <span @click="router.get(route('vote'))"
            :class="['text-sm font-medium transition-colors hover:text-primary cursor-pointer', page.props.route.uri.includes('vote') ? 'text-primary' : '']">
            Perolehan Suara
        </span>
    </nav>
</template>
