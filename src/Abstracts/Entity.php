<?php
namespace App\Abstracts;

abstract class Entity{

    public function __construct($valuesList=null){
        $this->sync($valuesList);
    }

    public function sync($valuesList){
        if(is_array($valuesList)){
            foreach($valuesList as $field => $value){
                if(property_exists($this,$field)){
                    $this->$field=$value;
                }
            }
        }
    }

}