<?php
namespace Mong\BackpackTest\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use CrudTrait;
    //
    protected $fillable = ['name', 'content', 'image'];
}
