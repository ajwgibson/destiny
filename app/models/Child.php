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
        'dancing',
        'school_year',
        'health_warning'
    );

    public static $validation_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'date_of_birth'      => 'required|date|after:05-08-2004|before:04-08-2011',
        'tshirt'             => 'required',
        'school_year'        => 'required|integer|between:2,8',
        'notes'              => 'required_with:health_warning'
    );

    public static $validation_messages = array(
        'tshirt.required'      => "The T-shirt size field is required.",
        'date_of_birth.after'  => "Children must be under 12.",
        'date_of_birth.before' => "Children must be 5 or older.",
        'school_year.min'      => "Children should be starting P2 or above.",
        'school_year.max'      => "Children should be starting Y8 or lower.",
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

    // School year as a readable value
    public function school_year()
    {
        if ($this->school_year < 8) return "Primary {$this->school_year}";
        return "Year {$this->school_year}";
    }

}
