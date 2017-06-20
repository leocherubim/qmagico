angular.module('forumService', ['ngResource'])
	
	.factory('questionService', ['$resource', function($resource) {
	
			return $resource('/api/question/:id', null, {
				'update' : { 
					method: 'PUT'
				}
			});
		}])
	
	.factory('answerService', ['$resource', function($resource) {
	
			return $resource('/api/answer/:id', null, {
				'update' : { 
					method: 'PUT'
				}
			});
		}]);