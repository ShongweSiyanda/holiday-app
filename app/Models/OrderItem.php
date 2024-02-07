<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // id amount description id_order
    use HasFactory;

    // SELECT distinct id, date, sum(amount) as total from Order o, OrderItem i where o.id = id_order
}
