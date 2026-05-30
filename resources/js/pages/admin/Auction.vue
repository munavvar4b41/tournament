<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes/admin';
import { index as auctionIndex } from '@/routes/admin/auction';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Admin',
                href: dashboard(),
            },
            {
                title: 'Auction',
                href: auctionIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Auction" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <Heading
            variant="small"
            title="Auction"
            description="Pool-based player auction — coming in Phase 5."
        />
    </div>
</template>
