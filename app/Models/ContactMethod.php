<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMethod extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'type', 'value', 'details'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}