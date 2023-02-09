<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entry
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property int $user_id
 *
 * @property User $user
 *
 * @package App\Models
 */
class Entry extends Model
{
    use SoftDeletes, HasUuids;

	protected $table = 'entries';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
