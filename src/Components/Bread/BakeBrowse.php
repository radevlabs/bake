<?php


namespace Radevlabs\Bake\Components\Bread;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class BakeBrowse extends Bread
{
    use WithPagination;

    public $q;

    public $sortedFields;

    protected $numbering = true;

    public $perPage = 15;

    protected $perPageMenu = [
        5, 10, 15, 25,
        50, 75, 100
    ];

    public $startDate;

    public $endDate;

    protected $datetimeFilters = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function updating()
    {
        $this->resetPage();
    }

    protected function fields(): array
    {
        return builder_fields($this->resource());
    }

    public function sort($field)
    {
        $types = [
            null,
            'asc',
            'desc'
        ];

        $sortedField = $this->sortedFields[$field];
        $sortedField['counter']++;
        $sortedField['order'] = $sortedField['counter'] % 3 == 0
            ? null
            : (!empty($sortedField['order'])
                ? $sortedField['order']
                : collect($this->sortedFields)
                    ->max(function ($sField) {
                        return $sField['order'];
                    }) + 1);
        $sortedField['type'] = $types[$sortedField['counter'] % 3];

        $this->sortedFields[$field] = $sortedField;
        $counter = 0;
        $this->sortedFields = collect($this->sortedFields)
            ->sortBy('order')
            ->map(function ($sField) use (&$counter) {
                if (empty($sField['order'])) return $sField;
                $sField['order'] = ++$counter;
                return $sField;
            })->toArray();
    }

    protected function links() : array
    {
        $base = explode('.', $this->route)[0];
        return DB::table('permissions')
            ->where('route', 'like', "$base.%")
            ->where('uri', 'not like', "%{id}")
            ->where('route', '!=', $this->route)
            ->get()
            ->mapWithKeys(function ($permission, $key) {
                return [
                    route($permission->route) => <<<blade
                        <i class="fa $permission->icon"></i> $permission->name
                    blade
                ];
            })->toArray();
    }

    protected function query()
    {
        $filterDates = collect($this->sortedFields)
            ->whereNotNull('order')
            ->map(function ($sf) {
                return $sf['type'];
            });

        return DB::table($this->resource())
            ->when(!empty($this->q), function ($query) {
                $query->where(function ($query) {
                    foreach ($this->visibleFields as $field) {
                        $query->orWhere($field, 'like', "%$this->q%");
                    }
                });
            })->when(!empty($this->startDate) or !empty($this->endDate), function ($query) {
                try {
                    $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
                } catch (\Exception $exception) {
                    $startDate = false;
                }
                try {
                    $endDate = Carbon::createFromFormat('Y-m-d', $this->endDate);
                } catch (\Exception $exception) {
                    $endDate = false;
                }
                $query->when($startDate != false or $endDate != false, function ($query) use ($startDate, $endDate) {
                    $query->where(function ($query) use ($startDate, $endDate) {
                        collect($this->datetimeFilters)
                            ->filter(function ($item) {
                                return in_array($item, $this->fields());
                            })->each(function ($item) use ($startDate, $endDate, &$query) {
                                $query->where(function ($query) use ($startDate, $endDate, $item) {
                                    $query->when($startDate != false, function ($query) use ($startDate, $item) {
                                        $query->where($item, '>=', $startDate);
                                    })->when($endDate != false, function ($query) use ($endDate, $item) {
                                        $query->where($item, '<=', $endDate);
                                    });
                                });
                            });
                    });
                });
            })->when($filterDates->count() > 0, function ($query) use ($filterDates) {
                $filterDates->each(function ($type, $field) use (&$query) {
                    $query->orderBy($field, $type);
                });
            });
    }

    protected function summaryFilter()
    {
        $summary = '';
        if (!empty($this->q)){
            $summary = $summary
                .baketranslate('search', 'en').': '
                .$this->q.', ';
        }
        if (!empty($this->startDate)){
            $summary = $summary
                .baketranslate('start date', 'en').': '
                .$this->startDate.', ';
        }
        if (!empty($this->endDate)){
            $summary = $summary
                .baketranslate('end date', 'en').': '
                .$this->endDate.', ';
        }

        return substr($summary, 0, -2);
    }

    public function mount()
    {
        parent::mount();

        if (!in_array($this->perPage, $this->perPageMenu)) {
            $this->perPageMenu[] = $this->perPage;
        }

        $this->sortedFields = [];
        collect($this->visibleFields)
            ->each(function ($field) {
                $this->sortedFields[$field] = [
                    'order' => null,
                    'type' => null,
                    'counter' => 0
                ];
            });
    }

    protected function data()
    {
        $data = parent::data();
        $data['links'] = $this->links();
        $data['perPage'] = $this->perPage;
        $data['perPageMenu'] = $this->perPageMenu;
        $data['numbering'] = $this->numbering;
        $data['summaryFilter'] = $this->summaryFilter();
        $data['rows'] = $this->query()
            ->paginate($this->perPage);

        return $data;
    }

    public function render()
    {
        return view('bake::pages.bread.browse', $this->data());
    }
}
