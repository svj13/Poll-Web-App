(function () {
    'use strict';

    /* App Module */

    var pollsApp = angular.module('pollsApp', [
      'ngRoute',
      'pollsControllers'
    ]);

    pollsApp.config(['$routeProvider',
      function($routeProvider) {
        $routeProvider.
          when('/polls', {
            templateUrl: 'angularjs/partials/poll-list.html',
            controller: 'PollListCtrl'
          }).
          when('/polls/:pollId', {
            templateUrl: 'angularjs/partials/poll-detail.html',
            controller: 'PollDetailCtrl'
          }).
          when('/about', {
            templateUrl: 'angularjs/partials/about-detail.html',
            controller: 'AboutCtrl'
          }).
          when('/votes', {
            templateUrl: 'angularjs/partials/vote-detail.html',
            controller: 'PollListCtrl'
          }).
          when('/votes/:pollId', {
            templateUrl: 'angularjs/partials/vote-stats.html',
            controller: 'PollVoteCtrl'
          }).
          otherwise({
            redirectTo: '/polls'
          });
      }]);
}())