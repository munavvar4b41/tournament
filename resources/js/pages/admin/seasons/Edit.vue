<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import SeasonController from '@/actions/App/Http/Controllers/Admin/SeasonController';
import SeasonForm from '@/components/admin/SeasonForm.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes/admin';
import { edit, index } from '@/routes/admin/seasons';
import type { Season, SeasonStatusOption } from '@/types/season';

type Props = {
    season: Season;
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
                title: 'Edit',
                href: edit(0),
            },
        ],
    },
});
</script>

<template>
    <Head :title="`Edit ${season.name}`" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="space-y-6 max-w-2xl">
        <Heading
            variant="small"
            :title="`Edit ${season.name}`"
            description="Update season details"
        />

        <SeasonForm :season="season" :status-options="statusOptions">
            <template #actions>
                <Button variant="outline" as-child>
                    <Link :href="index()">Cancel</Link>
                </Button>
            </template>
        </SeasonForm>

        <Form
            v-bind="SeasonController.destroy.form(season.id)"
            class="border-t pt-6"
            v-slot="{ processing }"
        >
            <Button type="submit" variant="destructive" :disabled="processing">
                Delete season
            </Button>
        </Form>
        </div>
    </div>
</template>
