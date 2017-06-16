@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- Forum Title -->
    <h1>Fóruns</h1>

    <br>

    <table class="table">
        <thead>
            <th class="col-sm-8">Fóruns</th>
            <th class="col-sm-2">Moderador</th>
            <th class="col-sm-2">Perguntas</th>
        </thead>

        @foreach($forums as $forum)
            <tbody>
                <td class="col-sm-8">{{$forum->id}}</td>
                <td class="col-sm-2">{{$forum->title}}</td>
                <td class="col-sm-2">{{$forum->user->name}}</td>
            </tbody>
        @endforeach

    </table>

</div>
@endsection