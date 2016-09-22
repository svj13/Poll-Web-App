(function () {
    'use strict';

    /* Controllers */

    var pollsControllers = angular.module('pollsControllers', []);

    /*Poll List controller that fetches information for poll-list.html */
    pollsControllers.controller('PollListCtrl', ['$scope', '$http', 
        
        function ($scope, $http) {
            //gets the information of polls from the database
            var request;
            request = $http.get('index.php/services/polls').success(function(response) {
                $scope.polls = response;
            });
            $scope.author = 'Sarah Jackson 2016';
        }]);

    /*Poll Detail Controller that fetches information for poll-detail.html */    
    pollsControllers.controller('PollDetailCtrl', ['$scope', '$http', '$routeParams',
        
        function ($scope, $http, $routeParams) {
            //gets the options for the poll when the poll is selected
            var request;
            request = $http.get('index.php/services/getPollOptions/'
                    + $routeParams.pollId).success(function(response) {
            $scope.options = response;  
            });
            
            //gets info on a single poll
            var request2;
            request2 = $http.get('index.php/services/getPoll/' 
                    + $routeParams.pollId).success(function(response) {
                $scope.poll = response;
            });
            
            //checks to see if the radio button has been selected or not
            $scope.selected = undefined;
            
            
            //will record the vote and add to the database
            $scope.vote = function() {
            
            //Checks to see if an option has been selected. It will only submit
            //data if an option has been selected and "Vote" has been clicked
            if ($scope.selected === undefined) {
                alert("You have not selected an option")   
            } else {   
                var request;
                request = $http.post('index.php/services/addVote/' 
                    + $routeParams.pollId + '/' + $scope.selected).success(function(response) {
                $scope.vote = response;
            });
                alert("Thank you for voting!");
                window.location= "#/polls";    
            }

            };
        
      }]);
  
    /*Poll Vote Controller which fetches the informtion for vote-detail.html */  
    pollsControllers.controller('PollVoteCtrl', ['$scope', '$http', '$routeParams',
        
        function ($scope, $http, $routeParams) {
           
            
            //gets info (i.e count and option id) for the votes on a particular poll
            var request;
            request = $http.get('index.php/services/getVoteCount/'
                    + $routeParams.pollId).success(function(response) {
                $scope.votes = response;
            });
            
            //gets info on a single poll
            var request2;
            request2 = $http.get('index.php/services/getPoll/' 
                    + $routeParams.pollId).success(function(response) {
                $scope.poll = response;
            });
            
         
            //gets the options for the poll when the poll is selected
                var request3;
                request3 = $http.get('index.php/services/getPollOptions/'
                    + $routeParams.pollId).success(function(response) {
                $scope.options = response;  
            });
            
            

            //will delete the votes of the relevant database
            $scope.deleteVotes = function() {
            
                var request4;
                request4 = $http.post('index.php/services/deleteVotes/' 
                    + $routeParams.pollId + '/').success(function(response) {
                $scope.delete = response;
            });
            confirm("Are you sure you want to reset the votes for this \n\
            voting poll?");
            window.location= "#/votes";   

            };
            
            
        }]);
    
    /*Poll About Controller which fetches the information for about-detail
     * for the about page tab */
    pollsControllers.controller('AboutCtrl', ['$scope', '$http', 
        function ($scope, $http) {
            var request;
            request = $http.get('index.php/services/about').success(function(response) {
                $scope.about = response;
            });
            
        }]);
  

  }())