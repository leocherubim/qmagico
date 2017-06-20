describe('Questions', function() {

	var myserv, httpBackend;
  
    beforeEach(function () {
        
        module('forum');

        inject(function ($httpBackend, _myserv_) {
            myserv = _myserv_;
            httpBackend = $httpBackend;
        });
    });

});