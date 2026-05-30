<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes/admin';
import { index as playersIndex } from '@/routes/admin/players';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Players',
                href: playersIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Players" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Heading
            variant="small"
            title="Players"
            description="Player registration and management — coming in Phase 2."
        />
    </div>
</template>
