<?php


namespace Radevlabs\Bake\Fields;


class TimePicker extends Picker
{
    public function getData()
    {
        $data = parent::getData();
        $data['attributes']['class'] = $data['attributes']['class'].' timepicker';
        foreach (['datetimepicker', 'datepicker'] as $replace){
            $data['attributes']['class'] = str_replace($replace, '', $data['attributes']['class']);
        }

        return $data;
    }
}
