<?php


namespace Radevlabs\Bake\Fields;


use stdClass;

abstract class MultipleInput extends Field
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['multiple'] = false;
        $this->data['default'] = [];
    }

    public function getData()
    {
        if ($this->data['multiple']){
            $this->data['attributes']['name'] = $this->data['attributes']['name'].'[]';
        }

        return $this->data;
    }

    public function multiple()
    {
        $this->data['multiple'] = true;
        $this->data['attributes']['multiple'] = '';

        return $this;
    }

    public function default($value)
    {
        if (!($value instanceof stdClass or is_array($value))){
            if (empty($value)){
                $value = [];
            } else{
                $value = [$value];
            }
        }

        return parent::default($value);
    }
}
