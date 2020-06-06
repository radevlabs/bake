<?php


namespace Radevlabs\Bake\Components\Bread\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class BakeLogin extends Component
{
    public $form;

    public function submit($form)
    {
        $form = form_data($form, true);
        $this->form = $form;

        Validator::make($form, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ])->validate();

        if (!Auth::attempt($form)){
            session()
                ->flash('danger', 'Your email/password is wrong');

            return redirect(route('login'));
        }

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('bake::pages.auth.login');
    }
}
