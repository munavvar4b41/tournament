<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import SeasonForm from '@/components/admin/SeasonForm.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes/admin';
import { create, index } from '@/routes/admin/seasons';
import type { SeasonStatusOption } from '@/types/season';

type Props = {
    statusOptions: SeasonStatusOption[];
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
            {
                title: 'Create',
                href: create(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Create season" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="space-y-6 max-w-2xl">
        <Heading
            variant="small"
            title="Create season"
            description="Set up a new tournament season"
        />

        <SeasonForm :status-options="statusOptions">
            <template #actions>
                <Button variant="outline" as-child>
                    <Link :href="index()">Cancel</Link>
                </Button>
            </template>
        </SeasonForm>
        </div>
    </div>
</template>
