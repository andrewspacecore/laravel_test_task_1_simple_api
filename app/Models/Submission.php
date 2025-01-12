<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * @var string
     */
    protected $table = 'submissions';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'message' => 'string',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
