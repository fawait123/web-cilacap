<script setup>
import { Button } from '@/components/ui/button';
import MainNav from '@/composable/MainNav.vue';
import TeamSwitcher from '@/composable/TeamSwitcher.vue';
import UserNav from '@/composable/UserNav.vue';
import { ScanFace } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    user: { type: Object }
})
</script>

<template>
    <div class="flex-col md:flex">
        <div class="border-b">
            <div class="flex h-16 items-center px-4">
                <MainNav class="mx-6" />
                <div class="ml-auto flex items-center space-x-4">
                    <UserNav v-if="props.user" />
                    <Button @click="router.get(route('auth.login'))" v-else>
                        Masuk
                        <ScanFace />
                    </Button>
                </div>
            </div>
        </div>
        <div class="space-y-4 p-8 pt-6">
            <transition name="slide-left-right" mode="out-in">
                <slot />
            </transition>
        </div>
    </div>
</template>

<style>
/* Animasi slide dari kiri ke kanan */
.slide-left-right-enter-active,
.slide-left-right-leave-active {
    transition: transform 0.6s ease, opacity 0.6s ease;
}

.slide-left-right-enter {
    transform: translateX(-100%);
    /* Masuk dari luar kiri */
    opacity: 0;
}

.slide-left-right-leave-to {
    transform: translateX(100%);
    /* Keluar ke kanan */
    opacity: 0;
}
</style>
