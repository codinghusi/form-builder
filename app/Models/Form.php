<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Common\FormText;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Form
 *
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property string $form_text
 * @property string|null $deleted_at
 *
 * @property User $user
 * @property Collection|Paper[] $papers
 *
 * @package App\Models
 */
class Form extends Model
{
	use SoftDeletes, HasUuids;
	protected $table = 'forms';
	public $incrementing = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'user_id',
		'form_text'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function papers()
	{
		return $this->hasMany(Paper::class);
	}

    public function getParsedAttribute(): array
    {
        return FormText::parse($this->attributes['form_text']);
    }

    public function setFormTextAttribute(string $ft) {
        $this->attributes['form_text'] = htmlspecialchars_decode($ft);
    }

    public function getFormTextAttribute(string $ft): string {
        return htmlspecialchars_decode($ft);
    }
}
