<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amount extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'invoice', 'company', 'note', 'amount','user_id','typeOfamount'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
