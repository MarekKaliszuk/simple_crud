@extends('layout.master')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dodaj nowy produkt</h2>
            </div>

            <div class="pull-right">
                <br/>
                <a class="btn btn-primary" href="{{ route('products.index') }}"> <i class="glyphicon glyphicon-arrow-left"></i></a>
            </div>

        </div>

    </div>

    {!! Form::open(array('route' => 'products.store','method'=>'POST')) !!}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nazwa:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Nazwa produktu','class' => 'form-control', 'required')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Opis:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Opis produktu','class' => 'form-control', 'required')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cena:</strong>
                {!! Form::number('price', null, array('placeholder' => 'Cena','class' => 'form-control', 'required', 'step'=> '0.01')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Dodaj produkt</button>
        </div>

    </div>

    {!! Form::close() !!}



@endsection