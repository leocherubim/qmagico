@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- Forum Title -->
    <h1>Fóruns</h1>

    <br>

    <table class="table">
        <thead>
            <th>Id</th>
            <th>Título</th>
            <th>Moderador</th>
            <th>Ações</th>
        </thead>

        @foreach($forums as $forum)
            <tbody>
                <td>{{$forum->id}}</td>
                <td>{{$forum->title}}</td>
                <td>{{$forum->user->name}}</td>
            </tbody>
        @endforeach

        <tfoot>
            <th>Id</th>
            <th>Título</th>
            <th>Moderador</th>
            <th>Ações</th>
        </tfoot>
    </table>

</div>
@endsection