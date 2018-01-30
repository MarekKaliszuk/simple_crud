@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista produktów</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('message'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Opis</th>
            <th>Cena</th>
            <th>Data utworzenia</th>
            <th>Data modyfikacji</th>
            <th width="140px" class="text-center">
                <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </th>
        </tr>

        @forelse( $products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->getPrice($product->id) }} zł</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                    {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!}
                    <button type="submit" style="display: inline;" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7"><b> Brak produktów! </b></td>
            </tr>
        @endforelse
    </table>
@endsection