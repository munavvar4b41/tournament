<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    CalendarDays,
    Gavel,
    LayoutGrid,
    Layers,
    Shield,
    Trophy,
    Users,
    UsersRound,
} from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { dashboard as adminDashboard } from '@/routes/admin';
import { index as auctionIndex } from '@/routes/admin/auction';
import { index as fixturesIndex } from '@/routes/admin/fixtures';
import { index as playersIndex } from '@/routes/admin/players';
import { index as poolsIndex } from '@/routes/admin/pools';
import { index as seasonsIndex } from '@/routes/admin/seasons';
import { index as teamsIndex } from '@/routes/admin/teams';
import type { NavItem, UserRole } from '@/types';

const page = usePage();

const mainNavItems = computed<NavItem[]>(() => {
    const items: NavItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
            icon: LayoutGrid,
        },
    ];

    const role = page.props.auth.user?.role as UserRole | undefined;

    if (role === 'super_admin' || role === 'admin') {
        items.push(
            {
                title: 'Admin',
                href: adminDashboard(),
                icon: Shield,
            },
            {
                title: 'Seasons',
                href: seasonsIndex(),
                icon: Trophy,
            },
            {
                title: 'Players',
                href: playersIndex(),
                icon: Users,
            },
            {
                title: 'Teams',
                href: teamsIndex(),
                icon: UsersRound,
            },
            {
                title: 'Pools',
                href: poolsIndex(),
                icon: Layers,
            },
            {
                title: 'Auction',
                href: auctionIndex(),
                icon: Gavel,
            },
            {
                title: 'Fixtures',
                href: fixturesIndex(),
                icon: CalendarDays,
            },
        );
    }

    return items;
});
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
