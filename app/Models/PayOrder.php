<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * Class PayOrder
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $article_id
 * @property string $placetopay_id
 * @property string $placetopay_url
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Article $article
 * @property Customer $customer
 *
 * @package App\Models
 */
class PayOrder extends Model
{
	protected $table = 'pay_orders';

	protected $casts = [
		'customer_id' => 'int',
		'article_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'article_id',
		'placetopay_id',
		'placetopay_url',
		'status'
	];

	public static function createOrder($data)
	{
		$data = (Object)$data;
		return
			PayOrder::create([
				'customer_id'	=>	$data->customer_id,
				'article_id'	=>	$data->article_id,
			]);
	}

	public static function aboutOrder($order_id=null)
	{
		$where ="";
		if(isset($order_id))
			$where = " and pay_orders.id = $order_id";
		return 
			PayOrder::join('customers','customers.id','=','pay_orders.customer_id')
					->join('articles','articles.id','=','pay_orders.article_id')
					->whereRaw("pay_orders.id is not null $where")
					->select(DB::raw('pay_orders.id order_id,pay_orders.status,pay_orders.placetopay_url,pay_orders.placetopay_id,customers.*,articles.article,articles.price'))
					->get();
	}
	
	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
