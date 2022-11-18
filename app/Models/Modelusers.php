<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelusers extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ["username", "password", "email", "date", "noTelp"];
}