<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['status_string'];

    public function getStatusStringAttribute(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
