<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function scopeByType($query, $roomTypeId = null)
    {
    	if (!is_null($roomTypeId)) {
    		$query->where('room_type_id', $roomTypeId);
    	}
    	return $query;
    }
}
