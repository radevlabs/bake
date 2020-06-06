<?php


namespace Radevlabs\Bake\Fields;


class DatePicker extends Picker
{
    public function getData()
    {
        $data = parent::getData();
        $data['attributes']['class'] = $data['attributes']['class'].' datepicker';
        foreach (['datetimepicker', 'timepicker'] as $replace){
            $data['attributes']['class'] = str_replace($replace, '', $data['attributes']['class']);
        }

        return $data;
    }
}
