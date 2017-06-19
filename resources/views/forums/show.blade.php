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
                    <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
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

            <div class="post-footer">
                <div class="input-group"> 
                    <input class="form-control" placeholder="Add a comment" type="text">
                    <span class="input-group-addon">
                        <a href="#"><i class="fa fa-edit"></i></a>  
                    </span>
                </div>
                <ul class="comments-list">
                    <li class="comment">
                        <a class="pull-left" href="#">
                            <img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" alt="avatar">
                        </a>
                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="user">Gavino Free</h4>
                                <h5 class="time">5 minutes ago</h5>
                            </div>
                            <p>Sure, oooooooooooooooohhhhhhhhhhhhhhhh</p>
                        </div>
                        <ul class="comments-list">
                            <li class="comment">
                                <a class="pull-left" href="#">
                                    <img class="avatar" src="http://bootdey.com/img/Content/user_3.jpg" alt="avatar">
                                </a>
                                <div class="comment-body">
                                    <div class="comment-heading">
                                        <h4 class="user">Ryan Haywood</h4>
                                        <h5 class="time">3 minutes ago</h5>
                                    </div>
                                    <p>Relax my friend</p>
                                </div>
                            </li> 
                            <li class="comment">
                                <a class="pull-left" href="#">
                                    <img class="avatar" src="http://bootdey.com/img/Content/user_2.jpg" alt="avatar">
                                </a>
                                <div class="comment-body">
                                    <div class="comment-heading">
                                        <h4 class="user">Gavino Free</h4>
                                        <h5 class="time">3 minutes ago</h5>
                                    </div>
                                    <p>Ok, cool.</p>
                                </div>
                            </li> 
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection