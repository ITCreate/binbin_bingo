<html ng-app="bingo">
	<head>
		<title>Laravel</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<script src="/bower_components/angular/angular.js"></script>
		<script src="/bower_components/angular-route/angular-route.js"></script>
		<script src="/js/app.js"></script>
		<style>
			#binbin {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			#binbin .container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}
            #binbin .content {
				text-align: center;
				display: inline-block;
			}

            #binbin .title {
				font-size: 96px;
				margin-bottom: 40px;
			}

            #binbin .quote {
				font-size: 24px;
			}
            #binbin .btn{
				margin-top: 20px;
			}
            #app.content{
                padding: 3em;
            }
            #app .btn{
                margin-right: 0.3em;
                margin-bottom: 1em;
            }
            #app .bottom-1{
                margin-bottom: 0.3em;
            }
            .button-secondary {
                background: rgb(66, 184, 221); /* this is a light blue */
            }

            .button-success {
                background: rgb(28, 184, 65); /* this is a green */
            }
            .button-warning {
                background: rgb(223, 117, 20); /* this is an orange */
            }
            .bingo-button{
                padding: 0.5em;
                border: 1px solid white;
            }
            .button-error {
                background: rgb(202, 60, 60); /* this is a maroon */
            }
        </style>
	</head>
	<body>
    <div>
        <div ng-view onload="init()"></div>
    </div>
    <script type="text/ng-template" id="app">
        <div id="app" class="content">
            <div class="pure-g">
                <div class="pure-u-2-3">
                    <div class="pure-g">
                        <div class="pure-u-1-1">
                            <span class="btn pure-button pure-button-disabled"
                                    ng-repeat="s in searchData">{{s}}</span>
                        </div>
                    </div>
                    <form class="pure-form">
                        <div class="pure-control-group">
                            <input class="pure-input-1" type="text" placeholder="id,id,id,id" ng-model="text">
                        </div>
                        <div class="pure-control-group">
                            <button type="submit" ng-disable="isSearch" class="pure-button" ng-click="search()">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <span ng-repeat="r in result">
                        <button class="bottom-1 pure-button pure-button-primary" ng-click="viewBingo(r.card_id)">
                            {{r.card_id}}
                            <p class="pure-button button-secondary" ng-show="r.c == 4" ng-click="viewBingo(r.card_id)">リーチ</p>
                            <p class="pure-button button-success" ng-show="r.c == 5" ng-click="viewBingo(r.card_id)">ビンゴ</p>
                        </button>
                    </span>
                </div>
                <div class="pure-u-1-3">
                    <div ng-show="selectBingo">
                        <p>card_id: <b>{{selectBingo[0]['card_id']}}</b></p>
                        <button ng-repeat="b in selectBingo track by $index"
                                class="pure-u-1-5 pure-button bingo-button" ng-class="{'button-warning': cc(b.number)}">
                            {{b.number}}
                        </button>
                        <p><button class="pure-button pure-button-error" ng-click="delete()">ビンゴ完了</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="top">
        <div id="binbin">
            <div class="container">
                <div class="content">
                    <div class="title">BinBin Bingo</div>
                    <div class="quote">ITCreate Club.</div>
                    <a href="/#/app" class="btn pure-button"><b>Next</b></a>
                </div>
            </div>
        </div>
    </script>
	</body>
</html>
