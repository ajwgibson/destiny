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

    // Relationship
    public function registrations()
    {
        return $this->hasMany('Registration');
    }



    // Returns the most recent registration record for this child (if any)
    private function most_recent_registration()
    {
        if ($this->registrations->count() > 0) return $this->registrations()->orderBy('created_at', 'desc')->first();
        else return null;
    }

    // Returns today's registration for this child (if any)
    public function todays_registration()
    {
        return $this->registrations()->where(DB::raw('DATE(registrations.created_at)'), '=', DB::raw('current_date'))->first();
    }

    // Returns true if this child not registered yet
    public function has_never_registered()
    {
        return $this->registrations->count() == 0;
    }



    // Returns the most recent contact name from daily registrations or the original from the order
    public function most_recent_contact_name()
    {
        $registration = $this->most_recent_registration();

        if ($registration && $registration->contact_name) return $registration->contact_name;
        else return $this->order->name();
    }

    // Returns the most recent contact number from daily registrations or the original from the order
    public function most_recent_contact_number()
    {
        $registration = $this->most_recent_registration();

        if ($registration && $registration->contact_number) return $registration->contact_number;
        else return $this->order->phone;
    }

    // Returns the most recent notes from daily registrations or the original from the order
    public function most_recent_notes()
    {
        $registration = $this->most_recent_registration();
        
        if ($registration && $registration->notes) return $registration->notes;
        else return $this->notes;
    }



    // Name
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    // Age at the start of Destiny Island
    public function age()
    {
        return $this->age_on_date(new Carbon());
    }

    // Age at the start of Destiny Island
    public function age_at_start()
    {
        return $this->age_on_date(new Carbon('2016-08-03'));
    }

    // Age at the start of Destiny Island
    private function age_on_date($date)
    {
        return $date->diffInYears($this->date_of_birth);
    }

}
