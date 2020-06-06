<?php


namespace Radevlabs\Bake\Fields;


class CodeEditor extends Textarea
{
    public function __construct($column = null)
    {
        parent::__construct($column);
    }

    public function getData()
    {
        $data = parent::getData();
        $data['attributes']['class'] = $data['attributes']['class'].' codeeditor';

        return $data;
    }
}
