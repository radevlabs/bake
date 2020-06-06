<?php


namespace Radevlabs\Bake\Components\Bread\Auth;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BakeLogout extends Component
{
    public function submit()
    {
        Auth::logout();

        return redirect(route('login'));
    }

    public function render()
    {
        return view('bake::pages.auth.logout');
    }
}
