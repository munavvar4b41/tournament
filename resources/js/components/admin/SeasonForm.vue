<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import SeasonController from '@/actions/App/Http/Controllers/Admin/SeasonController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import type { Season, SeasonStatusOption } from '@/types/season';

type Props = {
    season?: Season;
    statusOptions: SeasonStatusOption[];
};

const props = defineProps<Props>();

const formBinding = props.season
    ? SeasonController.update.form(props.season.id)
    : SeasonController.store.form();

function formatDate(value: string | null): string {
    if (!value) {
        return '';
    }

    return value.slice(0, 10);
}

function formatDateTimeLocal(value: string | null): string {
    if (!value) {
        return '';
    }

    return value.slice(0, 16);
}
</script>

<template>
    <Form v-bind="formBinding" class="space-y-6" v-slot="{ errors, processing }">
        <div class="grid gap-2">
            <Label for="name">Name</Label>
            <Input
                id="name"
                name="name"
                :default-value="season?.name"
                required
                placeholder="Summer 2026"
            />
            <InputError :message="errors.name" />
        </div>

        <div class="grid gap-2">
            <Label for="game_type">Game type</Label>
            <Input
                id="game_type"
                name="game_type"
                :default-value="season?.game_type"
                required
                placeholder="Cricket"
            />
            <InputError :message="errors.game_type" />
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="grid gap-2">
                <Label for="starts_at">Starts at</Label>
                <Input
                    id="starts_at"
                    name="starts_at"
                    type="date"
                    :default-value="formatDate(season?.starts_at ?? null)"
                />
                <InputError :message="errors.starts_at" />
            </div>

            <div class="grid gap-2">
                <Label for="ends_at">Ends at</Label>
                <Input
                    id="ends_at"
                    name="ends_at"
                    type="date"
                    :default-value="formatDate(season?.ends_at ?? null)"
                />
                <InputError :message="errors.ends_at" />
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="grid gap-2">
                <Label for="registration_opens_at">Registration opens</Label>
                <Input
                    id="registration_opens_at"
                    name="registration_opens_at"
                    type="datetime-local"
                    :default-value="
                        formatDateTimeLocal(season?.registration_opens_at ?? null)
                    "
                />
                <InputError :message="errors.registration_opens_at" />
            </div>

            <div class="grid gap-2">
                <Label for="registration_closes_at">Registration closes</Label>
                <Input
                    id="registration_closes_at"
                    name="registration_closes_at"
                    type="datetime-local"
                    :default-value="
                        formatDateTimeLocal(season?.registration_closes_at ?? null)
                    "
                />
                <InputError :message="errors.registration_closes_at" />
            </div>
        </div>

        <div class="grid gap-2">
            <Label for="status">Status</Label>
            <Select
                name="status"
                :default-value="season?.status ?? 'draft'"
            >
                <SelectTrigger id="status">
                    <SelectValue placeholder="Select status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem
                        v-for="option in statusOptions"
                        :key="option.value"
                        :value="option.value"
                    >
                        {{ option.label }}
                    </SelectItem>
                </SelectContent>
            </Select>
            <InputError :message="errors.status" />
        </div>

        <div class="flex items-center gap-4">
            <Button type="submit" :disabled="processing">
                {{ season ? 'Save changes' : 'Create season' }}
            </Button>
            <slot name="actions" />
        </div>
    </Form>
</template>
