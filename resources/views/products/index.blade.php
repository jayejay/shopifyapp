@extends('layouts.app')
@section('content')
    <div class="row">

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price/Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsArray as $product)
                    <tr>
                        <td><b>{{$product['title']}}</b> ({{$product['id']}})</td>
                        <td><a href="{{route('products.show',$product['id'])}}" class="btn btn-default">show</a>
                            <a href="{{route('products.edit',$product['id'])}}" class="btn btn-default">edit</a>
                        </td>
                        @if(is_array($product['variants']))
                            @foreach($product['variants'] as $variant)
                                <tr>
                                    <td><i class="material-icons">keyboard_arrow_right</i> {{$variant['title']}}</td>
                                    <td>{{$variant['price']}}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
@endsection