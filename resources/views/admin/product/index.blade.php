@extends('admin.main')
@section('content')
@if(Auth::check())
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
    </ol>
</div>
<!-- Datatables -->
<div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
    </div>
    <div class="table-responsive p-3">
        <table class="table align-items-center table-flush" id="dataTable">
        <thead class="thead-light">
            <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @if(count($products)>0)
            @foreach($products as $product)
                <tr>
                <td><img src="{{Storage::url($product->image)}}" width="60">
                <td>{{$product->name}}</td>
                <td>{!! $product->description !!}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->category->name}}</td>
                <td>
                    <form action="{{route('product.destroy',[$product->id])}}" method="post" onsubmit="return confirmDelete()">@csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>No product found</td>
            </tr>
        @endif
        </tbody>
    </table>
    </div>
    </div>
</div>
@else
<h4 class="ml-4">Please <a href="/login">login</a> to continue</h4>
@endif 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
@endsection