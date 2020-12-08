<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * 
 * @property int $id
 * @property string $article
 * @property string $description
 * @property string $image_url
 * @property float $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|PayOrder[] $pay_orders
 *
 * @package App\Models
 */
class Article extends Model
{
	protected $table = 'articles';

	protected $casts = [
		'price' => 'float'
	];

	protected $fillable = [
		'article',
		'description',
		'image_url',
		'price'
	];

	public function pay_orders()
	{
		return $this->hasMany(PayOrder::class);
	}
}
