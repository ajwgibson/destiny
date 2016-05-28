<?php

class Registration extends Eloquent {
    
    protected $table = 'registrations';

    protected $fillable = array('contact_name', 'contact_number', 'notes');

    public static $rules = array(
        'contact_name'   => 'required|max:100',
        'contact_number' => 'required|max:20',
    );

    // Eager loading
    protected $with = array('child');

    // Relationship
    public function child()
    {
        return $this->belongsTo('Child');
    }

    // Returns the contact details in a single string
    public function contact_details()
    {
        if ($this->contact_name) 
        {
            if ($this->contact_number) 
            {
                return "$this->contact_name ($this->contact_number)";
            } 
            else 
            {
                return $this->contact_name;
            }
        } 
        else 
        {
            if ($this->contact_number) 
            {
                return $this->contact_number;
            }
        }

        return '';
    }

}