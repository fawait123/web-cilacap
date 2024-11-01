<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'

const props = defineProps({
    title: { type: String },
    description: { type: String }
})
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>{{ props.title }}</CardTitle>
            <CardDescription>{{ props.description }}</CardDescription>
        </CardHeader>
        <CardContent>
            <slot />
        </CardContent>
        <CardFooter v-if="$slots.footer">
            <slot name="footer" />
        </CardFooter>
    </Card>
</template>
