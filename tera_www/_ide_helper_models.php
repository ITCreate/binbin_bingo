<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Bingo
 *
 * @property integer $id
 * @property string $card_id
 * @property integer $number
 * @property boolean $x
 * @property boolean $y
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereCardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereX($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bingo whereUpdatedAt($value)
 */
	class Bingo {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User {}
}

