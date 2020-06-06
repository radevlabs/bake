<?php


namespace Radevlabs\Bake\Fields;


use Radevlabs\Bake\Traits\Fields\Resource;

class Checkbox extends MultipleInput
{
    use Resource;

    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->multiple();

        $this->data['attributes']['class'] = 'custom-control-input';
    }
}
