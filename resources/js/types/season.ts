export type SeasonStatus =
    | 'draft'
    | 'registration_open'
    | 'registration_closed'
    | 'auction'
    | 'in_progress'
    | 'completed';

export type Season = {
    id: number;
    name: string;
    game_type: string;
    starts_at: string | null;
    ends_at: string | null;
    registration_opens_at: string | null;
    registration_closes_at: string | null;
    status: SeasonStatus;
    created_at: string;
    updated_at: string;
};

export type SeasonStatusOption = {
    value: SeasonStatus;
    label: string;
};
