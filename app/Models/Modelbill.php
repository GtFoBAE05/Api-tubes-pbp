<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbill extends Model
{
    protected $table = "bill";
    protected $primaryKey = "id";
    protected $allowedFields = ["userId", "name", "date", "amount"];
}