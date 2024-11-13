<script setup>
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import { Edit, PlusCircle, SaveIcon, Trash } from 'lucide-vue-next';
import { DialogOverlay } from 'radix-vue';
import { ref } from 'vue';

defineOptions({
    layout: AppLayout
})
const props = defineProps({
    teams: { type: Object },
    subdistricts: { type: Array }
})
const openModal = ref(false)

const formRef = useForm({
    username: '',
    name: '',
    password: '',
    role: 'user',
    access: [],
    id: null
})

const formDelete = useForm({})

const updateOpen = (value) => {
    openModal.value = value
}

const clickEdit = (team) => {
    formRef.username = team.username
    formRef.name = team.name
    formRef.access = team.access.map((item) => item.id)
    formRef.id = team.id
    updateOpen(true)
}

const handleSubmit = () => {
    if (formRef.id != null) {
        formRef.put(route('team.update', formRef.id), {
            onSuccess: () => {
                updateOpen(false)
            },
        })
    } else {
        formRef.post(route('team.store'), {
            onSuccess: () => {
                updateOpen(false)
            },
        })
    }
}

const clickDelete = (team) => {
    formDelete.delete(route('team.destroy', team.id), {
        onSuccess: () => {
            console.log('success')
        }
    })
}
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="flex justify-between items-center">
                <span>Team</span>
                <Dialog :open="openModal" @update:open="updateOpen">
                    <DialogTrigger>
                        <Button>
                            Tambah
                            <PlusCircle />
                        </Button>
                    </DialogTrigger>
                    <DialogOverlay />
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Modal Team</DialogTitle>
                            <DialogDescription>
                                Masukan data team di bawah ini.
                            </DialogDescription>
                        </DialogHeader>
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label>Nama</Label>
                                <Input placeholder="Masukan nama" v-model="formRef.name" />
                                <span class="text-sm text-red-500" v-if="formRef.errors.name">{{ formRef.errors.name
                                    }}</span>
                            </div>
                            <div class="grid gap-2">
                                <Label>Username</Label>
                                <Input placeholder="Masukan username" v-model="formRef.username" />
                                <span class="text-sm text-red-500" v-if="formRef.errors.username">{{
                                    formRef.errors.username }}</span>
                            </div>
                            <div class="grid gap-2">
                                <Label>Password</Label>
                                <Input placeholder="Masukan password" v-model="formRef.password" />
                                <span class="text-sm text-red-500" v-if="formRef.errors.password">{{
                                    formRef.errors.password }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <span>{{ formRef.errors.access }}</span>
                                <div class="flex items-center space-x-2" v-for="(region, i) in props.subdistricts"
                                    :key="region.id">
                                    <Checkbox :checked="formRef.access.includes(region.id)" :id="region.id"
                                        :value="region.id?.toString()" :name="`access[${i}]`"
                                        @update:checked="(isChecked) => isChecked ? formRef.access.push(region.id) : formRef.access.splice(formRef.access.indexOf(region.id), 1)" />
                                    <label :for="region.id"
                                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                        {{ region.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <DialogFooter>
                            <Button @click="handleSubmit">
                                Simpan
                                <SaveIcon />
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
            </CardTitle>
            <CardDescription>
                Kelola team anda
            </CardDescription>
        </CardHeader>
        <CardContent>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Nama</TableHead>
                        <TableHead>Username</TableHead>
                        <TableHead>Akses</TableHead>
                        <TableHead>Kecamatan yang dipegang</TableHead>
                        <TableHead class="min-w-[150px]">#</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="team in props.teams.data" :key="team.id">
                        <TableCell>
                            <span class="text-[16px] font-bold">{{ team.name }}</span>
                        </TableCell>
                        <TableCell><span class="text-[16px] font-bold">{{ team.username }}</span></TableCell>
                        <TableCell>
                            <span class="py-1 px-2 rounded-2xl bg-blue-200 text-blue-700">{{ team.role }}</span>
                        </TableCell>
                        <TableCell>
                            <div class="max-w-[90%] flex     flex-wrap gap-2">
                                <span class="py-1 px-2 rounded-2xl bg-yellow-200 text-yellow-700"
                                    v-for="access in team.access" :key="access.id">{{ access.name }}</span>
                            </div>
                        </TableCell>
                        <TableCell>
                            <div class="flex gap-4" v-if="team.role != 'admin'">
                                <Button variant="outline" @click="clickEdit(team)">
                                    <Edit />
                                </Button>
                                <Button @click="clickDelete(team)">
                                    <Trash />
                                </Button>
                            </div>
                            <span class="py-1 px-2 rounded-2xl bg-red-200 text-red-700" v-else>Tidak ada aksi</span>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </CardContent>
    </Card>
</template>
