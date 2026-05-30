<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes/admin';
import { index as poolsIndex } from '@/routes/admin/pools';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Pools',
                href: poolsIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Pools" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Heading
            variant="small"
            title="Pools"
            description="Player pool classification — coming in Phase 4."
        />
    </div>
</template>
