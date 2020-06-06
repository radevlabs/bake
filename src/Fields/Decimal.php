<?php


namespace Radevlabs\Bake\Fields;


class Decimal extends Number
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['attributes']['step'] = '0.0001';
        $this->data['attributes']['type'] = 'number';
    }

    public function decimals(int $decimals)
    {
        $step = '0.';
        for ($c = 1; $c < $decimals; $c++) $step = $step.'0';
        $step = $step.'1';
        $this->data['attributes']['step'] = $step;

        return $this;
    }
}
