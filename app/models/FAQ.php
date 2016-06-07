<?php

use Carbon\Carbon;

class FAQ extends Eloquent {

    protected $table = 'faqs';
    
    protected $fillable = array(
        'question', 
        'answer', 
    );

    public static $validation_rules = array(
        'question'      => 'required',
        'answer'        => 'required',
    );

}