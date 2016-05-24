<?php

class Voucher extends Eloquent {

    use SoftDeletingTrait;

    protected $table = 'vouchers';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'discount', 
        'child_limit', 
    );

    public static $validation_rules = array(
        'discount'         => 'required|min:0|max:100',
        'child_limit'      => 'required|min:1|max:10',
    );

    // Relationship
    public function order()
    {
        return $this->belongsTo('Order');
    }

}
