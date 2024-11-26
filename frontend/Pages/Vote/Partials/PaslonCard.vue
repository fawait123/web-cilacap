<script setup>
import PaslonItem from './PaslonItem.vue';

const props = defineProps({
    paslonData: { type: Array }
})
</script>

<template>
    <div class="grid grid-cols-4 gap-4">
        <PaslonItem :src="paslon.picture" :name="paslon.name" :number="paslon.number" :vote="paslon.total"
            :percentage="paslon.total_vote == 0 ? 0 : (paslon.total / paslon.total_vote * 100).toFixed(2)" v-for="paslon in props.paslonData" />
    </div>
</template>
