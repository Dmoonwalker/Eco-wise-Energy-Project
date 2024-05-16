<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kitar\Dynamodb\Model\Model;

class Device extends Model
{
    use HasFactory;
    protected $connection = 'dynamodb';
    protected $table = 'iot-core-to-dynamo-db-function-for-vectar-clean-energy-VectarCleanEnergy-14JT144FQWD4Q';
    protected $primaryKey = 'DeviceId';
    
    
}
