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

    public static $contact_details_rules = array(
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'email'              => 'required|email|max:254',
        'phone'              => 'required|max:20',
    );

    public static $permission_rules = array(
        'photos_permitted'   => 'required|boolean', 
        'outings_permitted'  => 'required|boolean',
    );



}
