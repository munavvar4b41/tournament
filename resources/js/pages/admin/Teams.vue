<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes/admin';
import { index as teamsIndex } from '@/routes/admin/teams';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Teams',
                href: teamsIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Teams" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Heading
            variant="small"
            title="Teams"
            description="Team and manager setup — coming in Phase 3."
        />
    </div>
</template>
