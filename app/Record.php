<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $guarded = [];
    
    public function colorStatus()
    {
        $color = 'light';
        if ($this->status == 'new'){
            $color = 'success';
        }elseif ($this->status == 'reminded'){
            $color = 'warning';
        }elseif ($this->status == 'late'){
            $color = 'danger';
        }elseif ($this->status == 'completed'){
            $color = 'secondary';
        }else{
            $color = 'light';
        }
        return '<span class="badge badge-'.$color.'">'.__('main.' . $this->status).'</span>';
    }
    
    public function dealer()
    {
        return $this->belongsTo('App\User', 'dealer_id', 'id');
    }
}
