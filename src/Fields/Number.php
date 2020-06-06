<?php


namespace Radevlabs\Bake\Fields;


use Illuminate\Support\Str;

class Number extends Field
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['attributes']['pattern'] = '[0-9]+([,\.][0-9]+)?';
    }

    public function getData()
    {
        $data = parent::getData();
        if (!Str::contains($data['rule'], 'numeric')){
            if (empty($data['rule'])){
                $data['rule'] = 'numeric';
            } else{
                $data['rule'] = $data['rule'].'|numeric';
            }
        }

        return $data;
    }
}
