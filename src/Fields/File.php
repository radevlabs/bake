<?php


namespace Radevlabs\Bake\Fields;



class File extends MultipleInput
{
    public function __construct($column = null)
    {
        parent::__construct($column);

        $this->data['attributes']['type'] = 'file';
    }

    public function getComponentAlias()
    {
        return 'file';
    }

    public function accept($accept)
    {
        $this->data['attributes']['accept'] = $accept;

        return $this;
    }

    public function getData()
    {
        $data = parent::getData();

        $data['id'] = $data['attributes']['id'];
        $data['attributes']['id'] = $data['attributes']['id'].'_input';
        $data['name'] = $data['attributes']['name'];
        unset($data['attributes']['name']);

        return $data;
    }
}
