<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    private function totalCards(array $tables)
    {
        $types = collect([
            'warning',
            'danger',
            'info',
            'primary',
            'secondary',
            'success'
        ]);

        $data = [];
        foreach ($tables as $table => $icon){
            $data[] = (object)[
                'type' => 'bg-'.$types->random(),
                'icon' => $icon,
                'name' => ucwords($table),
                'total' => DB::table($table)->count()
            ];
        }

        return $data;
    }

    public function render()
    {
        $totalCards = $this->totalCards([
            'permissions' => 'fas fa-lock',
            'roles' => 'fas fa-key',
            'users' => 'fas fa-users',
            'languages' => 'fas fa-language'
        ]);

        return view('bake::livewire.dashboard', [
            'totalCards' => $totalCards
        ]);
    }
}
