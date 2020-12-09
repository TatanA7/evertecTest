@extends('layouts.layout')

@section('sidebar')

    <div class="container">
        <div class="jumbotron">
    
            <h2>Detalle de pago</h2>       
            
                
                    <div class="modal-content col-md-6 table-success">
                        <div class="modal-header">
                            <h5 class="modal-title">Compra  de {{$order->article." $".$order->price}}</h5>
                            
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <table class="table table-borderless"> 
                            <tbody>
                                <tr>
                                    <th scope="col-md-3">Nombre</th>
                                    <td scope="col">{{$order->name. " ".$order->last_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Documento</th>
                                    <td scope="col">{{$order->document_type. " ".$order->document}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Email</th>
                                    <td scope="col">{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Celular</th>
                                    <td scope="col">{{$order->mobile_phone}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Concepto</th>
                                    <td scope="col">{{$order->article}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Valor</th>
                                    <td scope="col">{{$order->price}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Ciudad</th>
                                    <td scope="col">{{$order->city." - ".$order->state}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Dirección</th>
                                    <td scope="col">{{$order->address}}</td>
                                </tr>
                                <tr>
                                    <th scope="col-md-3">Estado</th>
                                    <td scope="col" style="color: @if($order->status == 'PAYED')green @elseif($order->status == 'REJECTED')red @endif">
                                        <h4>
                                        @if($order->status == 'PAYED')
                                            PAGADO
                                        @elseif($order->status == 'REJECTED') 
                                            RECHAZADO
                                        @else
                                            PENDIENTE
                                        @endif</h4>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <a href="{{url('order/create')}}"><button type="button" class="btn btn-secondary" onclick="window.location.href=''">Nueva ordenar</button></a>
                            @if($order->status == "CREATED")
                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{$order->placetopay_url}}'">Pagar</button>
                            @endif
                        </div>

                    </div>
                
        </div>
    </div>
@endsection

