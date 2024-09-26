<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Accomodations;

class Bookings extends Model
{
    use HasFactory;

    protected $table = "bookings";

    //definiendo la relacion de las tablas "users" y "accomodations"
    public function user(){
        //relacionamos al modelo User y la foranea de la tabla Bookings
        return $this->belongsTo(User::class, 'user_id');
    }

    public function accomodation(){
        //relacionamos al modelo User y la foranea de la tabla Bookings
        return $this->belongsTo(Accomodations::class, 'accomodation_id');
    }
}
