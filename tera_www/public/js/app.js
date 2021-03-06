// Generated by CoffeeScript 1.10.0
(function() {
  var app;

  app = angular.module('bingo', ['ngRoute']);

  app.config([
    '$routeProvider', function($routeProvider) {
      return $routeProvider.when('/', {
        templateUrl: 'top',
        controller: 'topController'
      }).when('/app', {
        templateUrl: 'app',
        controller: 'Index'
      }).otherwise({
        redirectTo: '/'
      });
    }
  ]);

  app.controller('Index', [
    '$scope', '$http', function($s, $h) {
      $s.init = function() {
        return $s.text = localStorage.getItem("search");
      };
      $s.search = function() {
        $s.isSearch = true;
        $s.searchData = $s.text.replace(/\ /g, ',').replace(/,,/g, ',').split(',').filter(function(x, i, self) {
          return self.indexOf(x) === i;
        });
        localStorage.setItem("search", $s.searchData);
        return $h.get('/bingo', {
          params: {
            'n[]': $s.searchData
          }
        }).then(function(res) {
          $s.result = res.data;
          return $s.isSearch = false;
        });
      };
      $s.viewBingo = function(card_id) {
        return $h.get('/bingo/' + card_id).then(function(res) {
          return $s.selectBingo = res.data;
        });
      };
      $s.cc = function(number) {
        return number === 0 || $s.searchData.indexOf(number + "") !== -1;
      };
      return $s["delete"] = function() {
        var cardId;
        cardId = $s.selectBingo[0]['card_id'];
        return $h["delete"]('/bingo/' + cardId).then(function() {
          $s.search();
          return $s.selectBingo = "";
        });
      };
    }
  ]);

  app.controller('topController', ['$scope', function($s) {}]);

}).call(this);
