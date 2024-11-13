<script setup>
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Edit, PlusCircle, SaveIcon, Trash } from 'lucide-vue-next';

defineOptions({
    layout: AppLayout
})
const props = defineProps({
    teams: { type: Object }
})

const formRef = useForm({
    username: '',
    name: '',
    password: '',
    role: 'user',
    access: []
})

const invoices = [
    {
        invoice: 'INV001',
        paymentStatus: 'Paid',
        totalAmount: '$250.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV002',
        paymentStatus: 'Pending',
        totalAmount: '$150.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV003',
        paymentStatus: 'Unpaid',
        totalAmount: '$350.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV004',
        paymentStatus: 'Paid',
        totalAmount: '$450.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV005',
        paymentStatus: 'Paid',
        totalAmount: '$550.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV006',
        paymentStatus: 'Pending',
        totalAmount: '$200.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV007',
        paymentStatus: 'Unpaid',
        totalAmount: '$300.00',
        paymentMethod: 'Credit Card',
    },
]
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="flex justify-between items-center">
                <span>Team</span>
                <Dialog>
                    <DialogTrigger>
                        <Button>
                            Tambah
                            <PlusCircle />
                        </Button>
                    </DialogTrigger>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Edit profile</DialogTitle>
                            <DialogDescription>
                                Make changes to your profile here. Click save when you're done.
                            </DialogDescription>
                        </DialogHeader>
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label>Nama</Label>
                                <Input placeholder="Masukan nama" />
                            </div>
                            <div class="grid gap-2">
                                <Label>Username</Label>
                                <Input placeholder="Masukan username" />
                            </div>
                            <div class="grid gap-2">
                                <Label>Password</Label>
                                <Input placeholder="Masukan password" />
                            </div>
                            <div class="grid gap-2">
                                <Label>Akses</Label>
                                <Select multiple="multiple" v-model="formRef.access">
                                    <SelectTrigger class="w-full">
                                        <SelectValue placeholder="Select a fruit" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectItem value="apple">
                                                Apple
                                            </SelectItem>
                                            <SelectItem value="banan">
                                                Banan
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>
                        <DialogFooter>
                            <Button>
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
                                <Button variant="outline">
                                    <Edit />
                                </Button>
                                <Button>
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
