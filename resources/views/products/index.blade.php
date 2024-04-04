@extends('layouts.main')
@section('contenido')
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Listado de productos
                        <a href="{{ route('products.create') }}" class="btn btn-success float-right">Agregar producto</a>
                    </div>
                    <div class="card-body">
                        @if(session('info'))     <!--Verifico si en info hay algun mensaje-->
                            <div class="alert alert-success">
                                {{session('info')}}
                            </div> <!--Muestro el msj de info-->
                        @endif
                        <table class="table table-hover table-sm">
                            <thead>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Accion</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{$product->description}}
                                    </td>
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>
                                        <a href="javascript: document.getElementById('delete-{{$product->id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm">Modificar</a>
                                        <form id="delete-{{$product->id}}" action="{{route('products.destroy', $product->id)}}" method="POST">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection