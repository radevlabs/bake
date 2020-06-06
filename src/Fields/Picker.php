<?php


namespace Radevlabs\Bake\Fields;


abstract class Picker extends Field
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['attributes']['type'] = 'text';
        $this->data['type'] = 'text';
    }
}
