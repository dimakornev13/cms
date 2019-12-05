<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/3/19
 * Time: 12:46 PM
 */

namespace M0xy\Cms\Voyager\FormFields;


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