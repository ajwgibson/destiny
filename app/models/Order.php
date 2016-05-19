<?php


class Order extends Eloquent {

    const DayTicketPrice       = 10.0;
    const SleepoverTicketPrice =  6.0;

    const StatusNew         = 0;
    const StatusVerified    = 1;
    const StatusComplete    = 2;

    public static $states = array (
        self::StatusNew        => 'New',
        self::StatusVerified   => 'Verified',
        self::StatusComplete   => 'Complete'
    );

    protected $table = 'orders';

    protected $fillable = array(
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'notes',
        'photos_permitted', 
        'outings_permitted',
        'amount_extra',
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

    public static $extra_rules = array(
        'amount_extra'   => 'required|min:0|max:20', 
    );


    // Relationship
    public function children()
    {
        return $this->hasMany('Child');
    }

    // Relationship
    public function voucher()
    {
        return $this->hasOne('Voucher');
    }

    // Name
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Cost
    public function cost()
    {
        $cost = $this->children->count() * Order::DayTicketPrice;
        $extra_cost = $this->children()->where('sleepover', true)->count() * Order::SleepoverTicketPrice;
        return $cost + $extra_cost;
    }

    // Discount
    public function discount()
    {
        if ($this->voucher) {
            
            $tickets = $this->children->count();
            if ($tickets > $this->voucher->child_limit) $tickets = $this->voucher->child_limit;

            return round((($tickets * Order::DayTicketPrice * $this->voucher->discount) / 100.0), 2);

        } else {
            return 0.0;
        }
    }


    // Order total
    public function total()
    {
        return $this->cost() - $this->discount() + $this->amount_extra;
    }

    // Order total in pence
    public function total_pence()
    {
        return floor($this->total() * 100);
    }

}
