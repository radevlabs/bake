<?php


namespace Radevlabs\Bake\Fields;


class DateTimePicker extends Picker
{
    public function getData()
    {
        $data = parent::getData();
        $data['attributes']['class'] = $data['attributes']['class'].' datetimepicker';
        foreach (['datepicker', ' timepicker ', '"timepicker', ' timepicker"'] as $replace){
            $data['attributes']['class'] = str_replace($replace, '', $data['attributes']['class']);
        }

        return $data;
    }
}
