<?php

use Carbon\Carbon;

class Child extends Eloquent {

    protected $table = 'children';

    protected $fillable = array(
        'first_name', 
        'last_name', 
        'notes',
        'date_of_birth', 
        'school_year',
        'group_name',
    );

    public static $validation_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'date_of_birth'      => 'required|date',
    );

    // Define which properties should be treated as dates
    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'date_of_birth');
        return $dates;
    }

    // Relationship
    public function order()
    {
        return $this->belongsTo('Order');
    }

    // Age
    public function age()
    {
        $comparison = new Carbon('2016-08-03');
        return $comparison->diffInYears($this->date_of_birth);
    }

}
