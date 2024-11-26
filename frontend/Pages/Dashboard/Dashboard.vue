<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
import Overview from '@/composable/Overview.vue'
import RecentSales from '@/composable/RecentSales.vue'
import CardItem from './Partials/CardItem.vue';
import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

defineOptions({
    layout: AppLayout
})

const props = defineProps({
    paslon: { type: Object },
    data: { type: Object },
    mapData: { type: Array }
})

onMounted(()=>{
    refetchData()
})


const refetchData = ()=>{
    setInterval(()=>{
        console.log('reload data /20 detik')
        router.reload()
    },1200000)
}

</script>

<template>
    <div class="flex-1">
        <div class="flex items-center justify-between space-y-4 mb-10">
            <h2 class="text-3xl font-bold tracking-tight">
                Analisis Dashboard
            </h2>
        </div>
        <Tabs default-value="overview" class="space-y-4">
            <TabsList>
                <TabsTrigger value="overview">
                    Dashboard
                </TabsTrigger>
            </TabsList>
            <TabsContent value="overview" class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <CardItem title="Total TPS" :total="props.data.total_tps" />
                    <CardItem title="Total TPS Masuk" :total="props.data.total" />
                    <CardItem title="Total TPS Belum Masuk" :total="props.data.total_tps - props.data.total" />
                    <CardItem title="Persentase" :total="props.data.total / props.data.total_tps * 100" />
                </div>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
                    <Card class="col-span-4">
                        <CardHeader>
                            <CardTitle>Overview</CardTitle>
                        </CardHeader>
                        <CardContent class="pl-2 flex justify-center items-center">
                            <Overview :paslonData="props.paslon" />
                        </CardContent>
                    </Card>
                    <Card class="col-span-3">
                        <CardHeader>
                            <CardTitle>Urutan Suara</CardTitle>
                            <CardDescription>
                                Urutan perolehan suara berdasarkan yang tertinggi
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <RecentSales :paslonData="props.paslon" />
                        </CardContent>
                    </Card>
                </div>
            </TabsContent>
        </Tabs>
    </div>
</template>
