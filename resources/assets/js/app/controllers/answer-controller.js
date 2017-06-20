angular.module('forum')
	.controller('AnswersController', ['$scope', '$routeParams', '$http', 'answerService', function($scope, $routeParams, $http, answerService) {

		$scope.answers = [];

		// answers initialization
		$scope.init = function(id) {
			$http.get('/api/answer/'+id)
	        .success(function(answers) {
	        	$scope.answers = answers;
	        }).error(function() {

	        });
		}        

		// save question
		$scope.store = function(data, userId, userName, questionId) {
			var result = {};
			result.question_id = questionId;
			result.user_id = userId;
			result.title = data.title;
			result.user = {
				name: userName,
			};

			data.title = null;

			answerService.save(result, function() {
				$scope.answers.unshift(result);
			}, function(error) {
				console.log(error);
			});
		}

		// delete answer
		$scope.delete = function(answer) {
			if(confirm("Confima a exclusão da tarefa?")) {
				answerService.delete({id: answer.id}, function() {
					var answerIndex = $scope.answers.indexOf(answer);
					$scope.answers.splice(answerIndex, 1);
				}, function(error) {
					console.log(error);
					window.alert('Não foi possível excluir a tarefa.');
				});
			}
		};

	}]);