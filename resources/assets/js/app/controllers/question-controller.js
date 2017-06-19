angular.module('forum')
	.controller('QuestionsController', ['$scope', '$routeParams', 'questionService', function($scope, $routeParams, questionService, userService) {

		$scope.questions = [];
		$scope.title = '';

		// read all questions
		questionService.query(function(questions) {
			$scope.questions = questions;
		}, function(error) {
			console.log(error);
		});

		// save question
		$scope.store = function(data, forumId, userId, userName) {
			data.forum_id = forumId;
			data.user_id = userId;
			data.user = {
				name: userName,
			};

			questionService.save(data, function() {
				$scope.questions.unshift(data);
			}, function(error) {
				console.log(error);
			});
		}

	}]);