<?php


class Order extends Eloquent {

    protected $table = 'orders';

    protected $fillable = array(
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'notes',
        'photos_permitted', 
        'outings_permitted',
    );

    public static $create_contact_details_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'email'              => 'required|confirmed|email|max:254',
        'phone'              => 'required|max:20',
    );

    public static $update_contact_details_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'phone'              => 'required|max:20',
    );

    public static $permission_rules = array(
        'photos_permitted'   => 'required|boolean', 
        'outings_permitted'  => 'required|boolean',
    );


    // Relationship
    public function children()
    {
        return $this->hasMany('Child');
    }

    // Cost
    public function cost()
    {
        $cost = $this->children->count() * 10.0;
        $extra_cost = $this->children()->where('sleepover', true)->count() * 6.0;
        return $cost + $extra_cost;
    }

}
