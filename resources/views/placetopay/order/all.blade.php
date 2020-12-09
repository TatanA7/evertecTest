@extends('layouts.layout')

@section('sidebar')
    <div class="container">
        <div class="jumbotron">

            <h2>Listado de ordenes</h2>       
            <form action="order" method="post">
                <div class="form-row">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Email</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Articulo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="@if($order->status == 'PAYED')table-success @elseif($order->status == 'REJECTED')table-danger @elseif($order->status == 'CREATED')table-warning @endif">
                                <th scope="row">{{$order->id}}</th>
                                <td>{{$order->name.' '.$order->last_name}}</td>
                                <td>{{$order->document_type.$order->document}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->mobile_phone}}</td>
                                <td>{{$order->article." $".$order->price}}</td>
                                <td><a href="{{url('order/'.$order->order_id)}}">IR</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>			
        </div>
    </div>
@endsection
