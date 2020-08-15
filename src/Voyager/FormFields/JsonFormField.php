<?php

namespace App\Voyager\FormFields;


use TCG\Voyager\FormFields\AbstractHandler;

class JsonFormField extends AbstractHandler
{

    protected $codename = 'json';


    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.json', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
