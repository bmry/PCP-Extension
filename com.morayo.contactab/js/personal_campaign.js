var app = angular.module("PersonalCampaign", []);
       
app.controller("ContactCtrl", function($scope, $sce) {
	/* Avoiding to show code on loading */
	$scope.campaignlist = ['List campaign result'];
	/* Showing function window */
	
	$scope.shows = function(id){
		jQuery(".hides").hide();

		jQuery("#c"+id).show();
	};
	/* Hidding function window */
	$scope.hides = function(){
		jQuery(".hides").hide();
	};

	/* Converting to html result, angular by default, not convert string to html as result */
	$scope.convertHtml = function(dataString){
		return $sce.trustAsHtml(dataString);
	};

	/* New API function consuming */
	CRM.api3('Pcp', 'get', {
	  "sequential": 1,
	  "contact_id": CRM.vars.Pcp.contact_id
	}).done(function(result) {

		
		/* $apply, apply changes on dom instantly after api request*/
		 $scope.$apply(function(){
		// 	/* Sending values to html app angular code */
		$scope.campaignlist = result.values;
		// 	// test command console.log(result);
		});
	});

});