<?php


namespace Radevlabs\Bake\Fields;


class WYSIWYG extends Textarea
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['type'] = 'wysiwyg';
    }
}
