<?php


namespace Radevlabs\Bake\Components\Fields;


use Illuminate\Support\Facades\Auth;

class File extends Field
{
    public $paths = [];

    public function updatedValue()
    {
        parent::updatedValue();

        $paths = [];
        foreach ($this->value as $val){
            $exploded = explode(',', $val['data'], 2);
            $type = explode('/', $exploded[0])[0];
            $type = explode(':', $type)[1];
            $val['data'] = base64_decode($exploded[1]);
            $val['name'] = Auth::id().'_'.$val['name'];
            $paths[$type] = upload_blob_file($val['data'], $val['name'], now()->format('Y-m'));
        }

        $this->paths = $paths;
    }

    public function mount($data)
    {
        $this->data = $data;

        if (!empty($data['default'])){
            if (is_array($data['default'])){
                $paths = $data['default'];
            } else{
                $paths = [$data['default']];
            }

            foreach ($paths as $path){
                $type = is_image($path)
                    ? 'image'
                    : '';

                $this->paths[$type] = $path;
            }
        }
    }
}
