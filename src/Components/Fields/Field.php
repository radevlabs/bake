<?php


namespace Radevlabs\Bake\Components\Fields;


use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Field extends Component
{
    public $value;

    public $data;

    public function updatedValue()
    {
        if (!empty($this->data['rule'])){
            $validator = Validator::make([
                'value' => $this->value
            ], [
                'value' => $this->data['rule']
            ]);

            $classes = $this->data['attributes']['class'];
            $classes = collect(explode(' ', $classes))
                ->filter(function ($item) {
                    return !in_array($item, ['is-valid', 'is-invalid', '']);
                })->unique();
            if (!empty($this->value)){
                if ($validator->fails()){
                    $classes->push('is-invalid');
                } else{
                    $classes->push('is-valid');
                }
            }
            $this->data['attributes']['class'] = $classes->implode(' ');

            $validator->validate();
        }
    }

    public function mount($data)
    {
        $this->data = $data;

        if (!empty($data['default'])){
            $this->value = $data['default'];
        }
    }

    public function render()
    {
        return view('bake::components.fields.generate', $this->data);
    }
}
