<?php


namespace Radevlabs\Bake\Fields;


use Illuminate\Support\Str;

abstract class Field
{
    protected $data = [
        'attributes' => [
            'class' => 'form-control',
            'multiple' => null,
            'value' => null,
            'required' => null,
            'placeholder' => null
        ],
        'inline' => true,
        'default' => null,
        'rule' => '',
        'resource' => null,
        'serverside' => false
    ];

    private $column = null;

    public function __construct($column = null)
    {
        $this->column = $column;
        $class = explode('\\', get_class($this));
        $class = end($class);
        $this->data['type'] = str_replace('_', '-', Str::snake($class));
        $this->data['attributes']['type'] = $this->data['type'];

        $this->id();
        $this->name();
        $this->label();
        $this->attributes();
    }

    public function getComponentAlias()
    {
        return 'field';
    }

    public function getData()
    {
        return $this->data;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public static function make($column)
    {
        return new static($column);
    }

    public function id($text = null)
    {
        if (empty($text)){
            $this->data['attributes']['id'] = 'auto_'.uuidstr('_');
        } else{
            $this->data['attributes']['id'] = $text;
        }

        return $this;
    }

    public function name($text = null)
    {
        if (empty($text)){
            if (empty($this->column)){
                $this->data['attributes']['name'] = uuidstr('_');
            } else{
                $this->data['attributes']['name'] = $this->column;
            }
        } else{
            $this->data['attributes']['name'] = $text;
        }

        return $this;
    }

    public function label($text = null)
    {
        if (empty($text)){
            if (empty($this->column)){
                $this->data['label'] = uuidstr('_');
            } else{
                $this->data['label'] = str_replace('_', ' ', $this->column);
                $this->data['label'] = ucfirst($this->data['label']);
            }
        } else{
            $this->data['label'] = $text;
        }

        return $this;
    }

    public function placeholder($text)
    {
        $this->data['attributes']['placeholder'] = $text;

        return $this;
    }

    public function outline()
    {
        $this->data['inline'] = false;

        return $this;
    }

    public function class($text)
    {
        $this->data['attributes']['class'] = $text;

        return $this;
    }

    public function attributes(array $attributes = [])
    {
        foreach ($attributes as $attr => $val){
            if (!array_key_exists($attr, $this->data['attributes'])
                and !Str::contains($attr, 'wire:')){
                $this->data['attributes'][$attr] = $val;
            }
        }

        return $this;
    }

    public function default($value)
    {
        $this->data['default'] = $value;

        return $this;
    }

    public function rule($rule)
    {
        $this->data['rule'] = $rule;

        return $this;
    }
}
