<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Common\FormText;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Paper
 *
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $title
 * @property string $values
 * @property string $form_id
 * @property string|null $deleted_at
 *
 * @property Form $form
 *
 * @package App\Models
 */
class Paper extends Model
{
	use SoftDeletes, HasUuids;
	protected $table = 'papers';
	public $incrementing = false;

	protected $fillable = [
		'title',
		'values',
		'form_id'
	];

    protected $casts = [
        'values' => 'array'
    ];

	public function form()
	{
		return $this->belongsTo(Form::class);
	}

    public function getParsedAttribute()
    {
        return $this->load('form')->form->parsed;
    }
}
