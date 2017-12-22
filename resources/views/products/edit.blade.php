@extends('layouts.app')

@section('content')
    <div class="row">
        <a class="btn btn-default" href="{{url()->previous()}}">Back</a>
        <a class="btn btn-default" href="{{route('products.index')}}">Index</a>
    </div>
    <div class="row">
        <form action="{{route('products.update', $productArray['id'])}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$productArray['title']}}">
            </div>
            <hr>
            @foreach($productArray['variants'] as $variant)
                <h4 class="title">Variant: {{$variant['title']}}</h4>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price[{{$variant['id']}}]" class="form-control" id="price" value="{{$variant['price']}}">
                </div>
            @endforeach
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection

