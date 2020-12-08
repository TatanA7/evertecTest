<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $document_type
 * @property string $document
 * @property string $email
 * @property string $mobile_phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|PayOrder[] $pay_orders
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';

	protected $fillable = [
		'name',
		'last_name',
		'document_type',
		'document',
		'email',
		'mobile_phone',
		'city',
		'state',
		'address'
	];

	public static function createCustom($data)
	{
		$data = (Object)$data;
		return
			Customer::create([
				'name'			=>	$data->name,
				'last_name'		=>	$data->last_name,
				'document_type'	=>	$data->document_type,
				'document'		=>	$data->document,
				'email'			=>	$data->email,
				'mobile_phone'	=>	$data->mobile_phone,
				'city'			=>	$data->city,
				'state'			=>	$data->state,
				'address'		=>	$data->address
				
			]);
	}
	public function pay_orders()
	{
		return $this->hasMany(PayOrder::class);
	}
}
