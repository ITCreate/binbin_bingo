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
    $s.text = localStorage.getItem("search")
  $s.search = ->
    $s.isSearch = true
    $s.searchData = $s.text.replace(" ", ',').replace(",,", ',').split(',').filter((x,i,self)->self.indexOf(x) is i)
    localStorage.setItem("search", $s.searchData)
#    console.log $s.searchData
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
#    console.log number
    number == 0 or $s.searchData.indexOf(number+"") != -1
  $s.delete = ->
    cardId = $s.selectBingo[0]['card_id']
    $h.delete('/bingo/' + cardId).then(->
      $s.search()
      $s.selectBingo = ""
    )
]

app.controller 'topController', ['$scope', ($s) ->

]