<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bingo extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $guarded = ['created_at', 'updated_at','deleted_at'];
	//
    public function numbers()
    {
        return $this->hasMany('App\Bingo', 'card_id', 'card_id');
    }

}
