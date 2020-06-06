<?php


namespace Radevlabs\Bake\Fields;


use Radevlabs\Bake\Traits\Fields\Resource;
use Radevlabs\Bake\Traits\Fields\ServerSide;

class Select extends MultipleInput
{
    use ServerSide, Resource;
}
