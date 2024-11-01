<script setup>

</script>

<template>
    <div class="h-screen flex justify-center items-center">
        <transition name="slide-left-right" mode="out-in">
            <slot />
        </transition>
    </div>
</template>

<style scoped>
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
