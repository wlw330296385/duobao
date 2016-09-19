<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>晒单分享</title>
	<style type="text/css">
	html,body{ margin: 0; padding: 0; font-size: 12px; background: #f1f1f1; color: #333;}
	.item{ margin-bottom: 10px; background: #fff;}
	.wp{ padding:10px ;}
	#loading{ text-align: center; font-size: 14px; height: 30px; line-height: 30px;}
	
	.des{ margin: 10px 0; font-size: 14px;  background: #f9f9f9; padding: 8px 0;}
	.section{ color: #999;}
	#photos {margin: 0; padding: 0;}
	#photos li { display: inline;}
		#photos li img{ max-height: 80px;}
	</style>
	<script src="{$model_extresdir}js/jquery.js"></script>
    <script src="http://apps.bdimg.com/libs/angular.js/1.4.6/angular.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{$model_extresdir}js/ng-infinite-scroll.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
    var gid = {$gid};
	var myApp = angular.module('myApp', ['infinite-scroll']);
	myApp.filter('photo',function(){
	    return function(inputArray){
	        return inputArray.split("|");
	    }
	});
	myApp.controller('ListController', function($scope, Shows) {
	  $scope.shows = new Shows();
	});
	
	// Reddit constructor function to encapsulate HTTP and pagination logic
	myApp.factory('Shows', function($http) {
	  var Shows = function() {
	    this.items = [];
	    this.busy = false;
	    this.p = 1;
	    this.loading = 'loading...';
	  };
	
	  Shows.prototype.nextPage = function() {
	    if (this.busy) return;
	    this.busy = true;
	
	    var url = "/index.php?g=DuoBao&a=getShowsList&gid="+gid+"&p="+this.p;
	    $http.get(url).success(function(data) {
	    	var items = eval(data);
	    	if(items){
	    		for (var i = 0; i < data.length; i++) {
		        	this.items.push(data[i]);
		    	}
		    	this.p++;
	    	}else{
	    		this.loading = 'no more';
	    	}
	      this.busy = false;
	    }.bind(this));
	  };
	
	  return Shows;
	});
</script>
  </head>
  <body>
    <div id=""  ng-app="myApp">
    	<div ng-controller="ListController">
    		<div infinite-scroll='shows.nextPage()' infinite-scroll-disabled='shows.busy' infinite-scroll-distance='3'>
			  <div ng-repeat="vo in shows.items" class="item">
			  	<div class="wp">
				    <img ng-src="{{vo.userpic}}" width="60" style="float: left; margin-right: 10px;"/>
				    <div style="overflow: hidden;">
				    	<div class="">
				    		<span style="color: red;">{{vo.nickname}}</span>    <span style="float: right; color: #999;">{{vo.atime*1000 | date:'yyyy-MM-dd'}}</span>
				    		<div style="clear:both"></div>
				    	</div>
				    	
				    	<div class="des">
				    		{{vo.des}}
				    		<div class="section">
				    			第{{vo.section}}期 {{vo.name}}
				    	  </div>
				    	</div>
				    	
				    	<ul id="photos">
				    		<li ng-repeat="p in vo.photos | photo">
				    			<img ng-src="{{p}}"/>
				    		</li>
				    	</ul>
				    </div>
				    <div style="clear:both"></div>
			    </div>
			  </div>
			</div>
			<div ng-show='shows.busy' ng-bind="shows.loading" id="loading"></div>
    	</div>
    </div>
    
  </body>
</html>
