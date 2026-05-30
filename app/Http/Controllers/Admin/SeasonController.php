<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSeasonRequest;
use App\Http\Requests\Admin\UpdateSeasonRequest;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SeasonController extends Controller
{
    /**
     * @return array<int, array{value: string, label: string}>
     */
    private function statusOptions(): array
    {
        return collect(SeasonStatus::cases())
            ->map(fn (SeasonStatus $status) => [
                'value' => $status->value,
                'label' => $status->label(),
            ])
            ->values()
            ->all();
    }

    public function index(Request $request): Response
    {
        $this->authorize('viewAny', Season::class);

        return Inertia::render('admin/seasons/Index', [
            'seasons' => Season::query()
                ->orderByDesc('created_at')
                ->get(),
            'canCreate' => $request->user()->can('create', Season::class),
        ]);
    }

    public function create(Request $request): Response
    {
        $this->authorize('create', Season::class);

        return Inertia::render('admin/seasons/Create', [
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    public function store(StoreSeasonRequest $request): RedirectResponse
    {
        Season::query()->create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Season created.')]);

        return to_route('admin.seasons.index');
    }

    public function edit(Season $season): Response
    {
        $this->authorize('update', $season);

        return Inertia::render('admin/seasons/Edit', [
            'season' => $season,
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    public function update(UpdateSeasonRequest $request, Season $season): RedirectResponse
    {
        $season->update($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Season updated.')]);

        return to_route('admin.seasons.index');
    }

    public function destroy(Season $season): RedirectResponse
    {
        $this->authorize('delete', $season);

        $season->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Season deleted.')]);

        return to_route('admin.seasons.index');
    }
}
