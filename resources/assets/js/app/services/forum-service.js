angular.module('forumService', ['ngResource'])
	
	.factory('questionService', ['$resource', function($resource) {
	
			return $resource('/api/question/:id', null, {
				'update' : { 
					method: 'PUT'
				}
			});
		}]);