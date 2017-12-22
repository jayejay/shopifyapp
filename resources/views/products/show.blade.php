@extends('layouts.app')
@section('content')

    <div class="row">
        <a class="btn btn-default" href="{{url()->previous()}}">Back</a>
        <a class="btn btn-default" href="{{route('products.index')}}">Index</a>
    </div>

    <div class="row">

        <h1>{{$productArray['title']}}</h1>

        <label for="description">Description</label>
        <div id="description">
            {{$productArray['body_html']}}
        </div>

    </div>

    <div class="row">

        <h3>Variants</h3>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Inventory Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productArray['variants'] as $variant)
                    <tr>
                        <td>{{$variant['id']}}</td>
                        <td>{{$variant['title']}}</td>
                        <td>{{$variant['price']}}</td>
                        <td>{{$variant['inventory_quantity']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection