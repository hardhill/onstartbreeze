<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    use HasFactory;
    protected $appends = ['sport'];
    public function getSportAttribute(){
        return DB::table('categories')->where('id', $this->category_id)->value('sports');
    }
}
