;(function () {
	'use strict';

	//DOM ready callback
	jQuery( document ).ready(function($) {

		//Get plugin global data
		//And spilts string into Array
		var elms = reframer_option.dom_selectors.split(',');
		elms = _.compact( elms );

		//Elements should be exits in list
		if( !_.isEmpty( elms ) ){
			_.each(elms, function(value, key, list){

			  var $elm = $(value);

			  //If element is exist in DOM tree
			  if($elm.length){
			  	$elm.reframe();
			  }

			});
		}

	}); //END Ready

}());
