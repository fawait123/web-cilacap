<script setup>
import {
    Avatar,
    AvatarFallback,
    AvatarImage,
} from '@/components/ui/avatar'
import { Button } from '@/components/ui/button'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { router, usePage } from '@inertiajs/vue3';

const page = usePage()

</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" class="relative h-8 w-8 rounded-full">
                <Avatar class="h-10 w-10">
                    <AvatarImage src="/assets/images/default-profile.png" alt="@shadcn" />
                    <AvatarFallback>UP</AvatarFallback>
                </Avatar>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56" align="end">
            <DropdownMenuLabel class="font-normal flex">
                <div class="flex flex-col space-y-1">
                    <p class="text-sm font-medium leading-none">
                        {{ page.props.user.username }}
                    </p>
                    <p class="text-xs leading-none text-muted-foreground">
                        {{ page.props.user.role }}
                    </p>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator v-if="page.props.user.role == 'admin'" />
            <DropdownMenuGroup v-if="page.props.user.role == 'admin'">
                <DropdownMenuItem @click="router.get(route('team.index'))">
                    Kelola Team
                    <DropdownMenuShortcut>⇧⌘P</DropdownMenuShortcut>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem>
                Log out
                <DropdownMenuShortcut>⇧⌘Q</DropdownMenuShortcut>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
