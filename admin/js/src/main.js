;(function () {
	'use strict';

/**
 * Backbone view for manage form fields
 * @class ReframerOptionsPageView
 * @since   1.0.0
 * @author Mohan Dere
 */
	var ReframerOptionsPageView = Backbone.View.extend({

		//Wrap element
	  el: "#reframer-options-page-view",

	  initialize: function() {

	  	//Cache DOM elements
	  	this.$domSelectorsInput = this.$('#dom_selectors');
	  	this.$form = this.$('form');

	    this.render();
	  },
	  render: function() {

	  	//Initialize jquery plugins
	  	this.$domSelectorsInput.tagsInput({
				width: '600px',
				'interactive':true,
				'defaultText':'add new..',
				'removeWithBackspace' : true,
			});

	  },

	});



	jQuery( document ).ready(function($) {
		//Init view once DOM is available
		new ReframerOptionsPageView();
	});


}());
