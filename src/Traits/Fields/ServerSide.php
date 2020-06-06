<?php


namespace Radevlabs\Bake\Traits\Fields;


trait ServerSide
{
    public function serverside()
    {
        $this->data['serverside'] = true;

        return $this;
    }
}
