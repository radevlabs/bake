<?php


namespace Radevlabs\Bake\Fields;


use Illuminate\Support\Str;

class Email extends Field
{
    public function getData()
    {
        $data = parent::getData();
        if (!Str::contains($data['rule'], 'email')){
            if (empty($data['rule'])){
                $data['rule'] = 'email';
            } else{
                $data['rule'] = $data['rule'].'|email';
            }
        }

        return $data;
    }
}
