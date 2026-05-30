<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes/admin';
import { index as fixturesIndex } from '@/routes/admin/fixtures';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Fixtures',
                href: fixturesIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Fixtures" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Heading
            variant="small"
            title="Fixtures"
            description="Match scheduling — coming in Phase 6."
        />
    </div>
</template>
