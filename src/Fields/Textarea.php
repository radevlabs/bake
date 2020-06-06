<?php


namespace Radevlabs\Bake\Fields;


class Textarea extends Field
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['type'] = 'textarea';
        unset($this->data['attributes']['type']);
    }
}
