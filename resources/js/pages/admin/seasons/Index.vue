<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes/admin';
import { create, edit, index } from '@/routes/admin/seasons';
import type { Season } from '@/types/season';

type Props = {
    seasons: Season[];
    canCreate: boolean;
};

defineProps<Props>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Seasons',
                href: index(),
            },
        ],
    },
});

function formatDate(value: string | null): string {
    if (!value) {
        return '—';
    }

    return new Date(value).toLocaleDateString();
}

function statusLabel(status: string): string {
    return status.replace(/_/g, ' ').replace(/\b\w/g, (char) => char.toUpperCase());
}
</script>

<template>
    <Head title="Seasons" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="space-y-6">
        <div class="flex items-center justify-between gap-4">
            <Heading
                variant="small"
                title="Seasons"
                description="Manage tournament seasons"
            />
            <Button v-if="canCreate" as-child>
                <Link :href="create()">Create season</Link>
            </Button>
        </div>

        <div
            v-if="seasons.length === 0"
            class="rounded-xl border border-dashed p-8 text-center text-sm text-muted-foreground"
        >
            No seasons yet.
            <span v-if="canCreate">Create your first season to get started.</span>
        </div>

        <div v-else class="overflow-hidden rounded-xl border">
            <table class="w-full text-sm">
                <thead class="border-b bg-muted/50 text-left">
                    <tr>
                        <th class="px-4 py-3 font-medium">Name</th>
                        <th class="px-4 py-3 font-medium">Game</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Dates</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="season in seasons"
                        :key="season.id"
                        class="border-b last:border-b-0"
                    >
                        <td class="px-4 py-3 font-medium">{{ season.name }}</td>
                        <td class="px-4 py-3">{{ season.game_type }}</td>
                        <td class="px-4 py-3">
                            <Badge variant="secondary">
                                {{ statusLabel(season.status) }}
                            </Badge>
                        </td>
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ formatDate(season.starts_at) }} –
                            {{ formatDate(season.ends_at) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <Button v-if="canCreate" variant="ghost" size="sm" as-child>
                                <Link :href="edit(season.id)">Edit</Link>
                            </Button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</template>
