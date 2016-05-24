<?php

use Carbon\Carbon;

class Child extends Eloquent {

    use SoftDeletingTrait;

    protected $table = 'children';
    
    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'first_name', 
        'last_name', 
        'notes',
        'date_of_birth', 
        'school_year',
        'group_name',
        'sleepover',
        'tshirt',
        'dancing'
    );

    public static $validation_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'date_of_birth'      => 'required|date',
        'tshirt'             => 'required',
    );

    public static $validation_messages = array(
        'tshirt.required'    => "The T-shirt size field is required.",
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

    // Name
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    // Age
    public function age()
    {
        $comparison = new Carbon('2016-08-03');
        return $comparison->diffInYears($this->date_of_birth);
    }

}
