<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button'
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
import MapComponent from '@/composable/MapComponent.vue';

defineOptions({
    layout: AppLayout
})

const props = defineProps({
    paslon: { type: Object }
})

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
                <TabsTrigger value="analytics">
                    Map View
                </TabsTrigger>
            </TabsList>
            <TabsContent value="overview" class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <CardItem title="Total Suara" :total="3000" />
                    <CardItem title="Suara Masuk" :total="2000" />
                    <CardItem title="Suara Belum Masuk" :total="1000" />
                    <CardItem title="Persentase" :total="2000 / 3000 * 100" />
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
            <TabsContent value="analytics" class="space-y-4">
                <Suspense>
                    <template #default>
                        <MapComponent />
                    </template>
                    <template #fallback>
                        <span>Loading...</span>
                    </template>
                </Suspense>
            </TabsContent>
        </Tabs>
    </div>
</template>
