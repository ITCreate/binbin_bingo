<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bingo extends Model {

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
	//
    public function numbers()
    {
        return $this->hasMany('App\Bingo', 'card_id', 'card_id');
    }

}
