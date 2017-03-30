jQuery(document).ready(function() {

	jQuery.ias({
	    container : '#posts_list',
	    item: '.hentry',
	    pagination: '#posts_nav',
	    next: '.next',
	    loader: '<img src="'+templateUrl+'/img/ajax-loader.gif">',
	    triggerPageThreshold: 2,
	    trigger: 'Charger plus d’articles'
	});

});