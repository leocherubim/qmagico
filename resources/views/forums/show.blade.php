@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-12" ng-controller="QuestionsController">

    	<!-- Forum -->
    	<div class = "panel panel-default">

    		<!-- Forum Title -->
		   <div class = "panel-heading">
		      <h3 class = "panel-title">{{$forum->title}}</h3>
		   </div>
		   
		   <!-- Forum Description -->
		   <div class = "panel-body">
		      {{$forum->description}}
		   </div>

		   <!-- Question Create Button -->
		   @can('admin')
			   <div class = "panel-footer">
			      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#postModal" data-whatever="@mdo">Nova Pergunta</a>
			   </div>
		   @endcan

            @include('forums.create_answer')

		</div>
		<!-- / Forum -->

        <div class="panel panel-white post panel-shadow" ng-repeat="question in questions">

            <div class="post-heading">
                <div class="pull-left image">
                    <img src="/img/professor.jpg" class="img-circle avatar" alt="user profile image">
                </div>
                <div class="pull-left meta">
                    <div class="title h5">
                        <a href="#"><b>@{{question.user.name}}</b></a>
                        criou uma pergunta.
                    </div>
                    
                </div>
            </div>

            <div class="post-description"> 
                <p>@{{question.title}}</p>
            </div>

            <div class="post-footer" ng-controller="AnswersController" ng-init="init(question.id)">

                <!-- Answer Input -->
                <div class="input-group"> 
                    <input class="form-control" ng-model="data.title" placeholder="Add a comment" type="text"
                        ng-keyup="$event.keyCode == 13 && store(data, {{Auth::user()->id}}, '{{Auth::user()->name}}', question.id)">
                    
                    <span class="input-group-addon">
                        <a ng-click="store(data, {{Auth::user()->id}}, '{{Auth::user()->name}}', question.id)"><i class="fa fa-edit"></i></a>
                    </span>
                </div>

                <!-- Answer -->
                <ul class="comments-list">
                    <li class="comment" ng-repeat="answer in answers">
                        
                        <!-- User Icon -->
                        <a class="pull-left" href="#">
                            <img class="avatar" src="/img/person.png" alt="avatar">
                        </a>

                        <!-- Delete Icon -->
                        <a class="btn pull-right" ng-click="delete(answer)">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>

                        <!-- Edit Icon -->
                        <a class="btn pull-right" data-toggle="modal" data-target="#editModal-@{{answer.id}}" data-whatever="@mdo">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        
                        @include('forums.edit_answer')

                        <div class="comment-body">

                            <!-- Name User -->
                            <div class="comment-heading">
                                <h4 class="user">@{{answer.user.name}}</h4>
                                
                            </div>

                            <!-- Answer -->
                            <p>@{{answer.title}}</p>
                        </div>
 
                    </li>
                </ul>
                <!-- / Answer -->

            </div>

        </div>
    </div>
</div>

@endsection