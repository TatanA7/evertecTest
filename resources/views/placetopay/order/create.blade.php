@extends('layouts.layout')

@section('sidebar')
    <div class="container">
    <div class="jumbotron">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Generar orden de pago</h2>       
        <form action="{{url('order')}}" method="post">
        <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputarticulo">Articulo</label>
                    <select id="inputtypedocument" class="form-control" name="article_id" required>
                        @foreach($articles as $article)
                            <option value="{{$article->id}}">{{$article->article}} = {{$article->price}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" required name="email"required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputmobile">Celular</label>
                    <input type="number" class="form-control" id="inputmobile" placeholder="Celular" max="999999999999999" min="1000000000" name="mobile_phone" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputname">Nombre</label>
                    <input type="text" class="form-control" id="inputname" placeholder="Nombre" name="name" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputlastname">Nombre</label>
                    <input type="text" class="form-control" id="inputlastname" placeholder="Apellido" name="last_name" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="inputtypedocument">Tipo D</label>
                    <select name="document_type" id="inputtypedocument" class="form-control" required>
                        <option value="CC">CC</option>
                        <option value="TI">TI</option>
                        <option value="SSN">SSN</option>
                        <option value="NIT">NIT</option>
                        <option value="PPN">PPN</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputdocument">Documento</label>
                    <input type="number" class="form-control" id="inputdocument" placeholder="nnumero documento" name="document" required >
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Apartamento, estudio, piso" name="address" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCountry">Pais</label>
                    <input type="text" class="form-control" id="inputCountry" value="Colombia" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Estado</label>
                    <select id="inputState" class="form-control" name="state" >
                        <option selected>Choose...</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">Ciudad</label>
                    <select id="inputCity" class="form-control" name="city">
                        <option selected>Choose</option>
                        
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Generar orden de compra </button>
            </form>			
        </div>
    </div>

    <script>
        states = 
            [
                {
                    "state" :   "Tolima",
                    "city"  :   "Ibagué"
                },
                { 
                    "state" :   "Antioquia",
                    "city"  :   "Medellín"
                },
                {
                    "state" :   "Cundinamarca",
                    "city"  :   "Bogotá"
                }
            ];
        

        $(document).ready(function(){
            var selection ="";
            var city = "";
            $.each(states, function(i,val){
                selection   =  "<option value="+val.state+">"+val.state+"</option>"+selection;
                city        =  "<option value="+val.city+">"+val.city+"</option>";
            });
            $("#inputState").html(selection);
            $("#inputCity").html(city);
        });
        $("#inputState").change(function(){
            let cities = states.filter(state => state.state == $("#inputState").val());
            var city = "";
            console.log(cities);

            $.each(cities, function(i,val){
                city        =  "<option value="+val.city+">"+val.city+"</option>";
            });
            $("#inputCity").html(city);
        });
    </script>

@endsection

