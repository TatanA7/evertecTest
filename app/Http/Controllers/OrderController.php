<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateOrder;
use App\Models\Article;
use App\Models\Customer;
use App\Models\PayOrder;
use App\Services\OrderService\OrderService;
use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index()
    {
        $orders = PayOrder::aboutOrder();
        $this->changeStatus($orders);
        
        $orders =  PayOrder::aboutOrder();
        return view('placetopay.order.all',["orders"=>$orders]);
    }


    public function create()
    { 
        $article = Article::all();
        return view('placetopay.order.create',["articles" => $article]);
    }


    public function store(ValidateOrder $request)
    {
        $orderData = $this->orderService->generateOrder($request->all()); 
        
        $dataMapping = $this->orderService->dataMapping((Object)$orderData);
        
        $authPTP   = $this->orderService->AuthPlaceToPay();        
        $response  = $authPTP->request($dataMapping);
        
        if ($response->isSuccessful()) {
            $order  = PayOrder::find($orderData['order_id']);
            $order->placetopay_id = $response->requestId;
            $order->placetopay_url= $response->processUrl();
            $order->status        = "CREATED" ;
            $order->save();

            return redirect($response->processUrl());
            //header('Location: ' . $response->processUrl());
        } else {
            return $response->status()->message();;
        }
    }

    
    public function show($id)
    {
        $order =  PayOrder::aboutOrder($id);
        $this->changeStatus($order);

        $order =  PayOrder::aboutOrder($id);
        return view('placetopay.order.show',["order"=>$order[0]]);
    }

    
    public function changeStatus($orders)
    {
        $authPTP   = $this->orderService->AuthPlaceToPay();  
        foreach($orders as $order){
            if($order->status == "CREATED")
                {
                    $dataPTP        = $authPTP->query($order->placetopay_id);
                    $order          = PayOrder::find($order->order_id);
                    $status         = $dataPTP->status()->toArray()['status']; 
                    switch ($status) {
                        case "APPROVED":
                            $order->status="PAYED";
                            break;
                        case "FAILED":
                            $order->status="REJECTED";
                            break;
                        case "PENDING":
                            $order->status="CREATED";
                            break;
                        default:
                            $order->status=$status;
                    }
                    $order->save();
                }
        }     
    }  

    
    public function notificationPTP(Request $request)
    {
        $order     = PayOrder::where('placetopay_id',$request->requestId)->first();
        $authPTP   = $this->orderService->AuthPlaceToPay();  
        $data      = $authPTP->query($order->placetopay_id);
        
        $status         = $data->status()->toArray(); 
        $order->status  = ($status['status'] == "APPROVED")?"PAYED":$status['status'];
        $order->save();
    }
}
