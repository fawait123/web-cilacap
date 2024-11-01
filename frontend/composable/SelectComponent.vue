<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

const props = defineProps({
    className: { type: String },
    placeholder: { type: String },
    options: { type: Array, required: true },
    defaultValue: { type: Number }
})
</script>

<template>
    <Select :default-value="props.defaultValue">
        <SelectTrigger :class="props.className">
            <SelectValue :placeholder="props.placeholder" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectItem :value="option.value" v-for="(option, i) in props.options" :key="i">
                    {{ option.label }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
