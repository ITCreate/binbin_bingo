app = angular.module('bingo', [
  'ngRoute'
])

app.config ['$routeProvider', ($routeProvider) ->
  $routeProvider.when('/', {
     templateUrl: 'top',
    controller : 'topController'
  }).when('/app', {
    templateUrl: 'app',
    controller: 'Index'
  }).otherwise({
    redirectTo: '/'
  })
]

app.controller 'Index', ['$scope', '$http', ($s, $h)->
  $s.init = ->
#    alert("")
  $s.search = ->
    console.log "search"
    $s.isSearch = true
    $s.searchData = $s.text.split(',')
    console.log $s.searchData
    $h.get('/bingo', {
      params: {
        'n[]' : $s.searchData
      }
    }).then((res) ->
      $s.result = res.data
      $s.isSearch = false
    )
  $s.viewBingo = (card_id)->
    $h.get('/bingo/'+card_id).then((res)->
      $s.selectBingo = res.data
    )
  $s.cc = (number)->
    console.log number
    number == 0 or $s.searchData.indexOf(number+"") != -1
]

app.controller 'topController', ['$scope', ($s) ->

]