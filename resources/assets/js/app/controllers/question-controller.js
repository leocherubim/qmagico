angular.module('forum')
	.controller('QuestionsController', ['$scope', '$routeParams', 'questionService', function($scope, $routeParams, questionService) {

		$scope.questions = [];
		$scope.question = {

		};

		// read all questions
		questionService.query(function(questions) {
			$scope.questions = questions;
		}, function(error) {
			console.log(error);
		});

		// save question
		$scope.store = function(data, forumId, userId, userName) {
			// data.forum_id = forumId;
			// data.user_id = userId;
			// data.user = {
			// 	name: userName,
			// };
			var result = {};
			result.title = data.title;
			result.forum_id = forumId;
			result.user_id = userId;
			result.user = {
				name: userName,
			}

			data.title = null;

			questionService.save(result, function() {
				$scope.questions.unshift(result);
			}, function(error) {
				console.log(error);
			});
		}

	}]);