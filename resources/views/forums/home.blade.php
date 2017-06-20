@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- Forum Title -->
    <h1>Discussões</h1>

    <br>

    <table class="table">
        <thead>
            <th class="col-sm-8">Fóruns</th>
            <th class="col-sm-2">Moderador</th>
            <th class="col-sm-2">Perguntas</th>
        </thead>

        @foreach($forums as $forum)
            <tbody>
                <td class="col-sm-8"><a href="{{route('forum.show', ['id'=>$forum->id])}}">{{$forum->title}}</a></td>
                <td class="col-sm-2">{{$forum->user->name}}</td>
                <td class="col-sm-2">
                    <span class="badge badge-inverse">{{$forum->questions->count()}}</span>
                </td>
            </tbody>
        @endforeach

    </table>

    {!! $forums->render() !!}

</div>
@endsection