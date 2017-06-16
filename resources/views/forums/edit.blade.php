@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- Forum Title -->
    <h1>Editar Fórum</h1>

    <br>

    <form action="{{route('forum.update', ['id'=>$currentForum->id])}}" method="PUT">

        <!-- Token Input -->
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <!-- Put Method Input -->
        <input type="hidden" name="_method" value="put">

        <!-- Title Forum -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label>Título</label>
                    <input type="text" name="title" class="form-control" value="{{$currentForum->title}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Title Forum -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label>Descrição</label>
                    <textarea name="description" class="form-control">{{$currentForum->description}}</textarea>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Register Button -->
        <button class="btn btn-primary" type="submit">Editar</button>

    </form>

</div>
@endsection