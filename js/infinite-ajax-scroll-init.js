let ias = new InfiniteAjaxScroll('#posts_list', {
	item: '.hentry',
	next: '.next',
	pagination: document.getElementById('posts_nav'),
	spinner: {
		element: '.spinner',
		delay: 600,
		show: function(element) {
		  element.style.display = 'block'; // default behaviour
		},
		hide: function(element) {
		  element.style.display = 'none'; // default behaviour
		}
	},
	trigger: {
		element: '#post_trigger',

		when: function(pageIndex) {
			return true;
		},
		show: function(element) {
		  element.style.display = 'block'; // default behaviour
		},
		hide: function(element) {
		  element.style.display = 'none'; // default behaviour
		}
	},
});

ias.on('last', function() {
  let el = document.querySelector('.no-more');

  el.style.display = 'block';
});

// A11Y Move Focus
ias.on('appended', function(event) {
  let first = event.items[0];

  first.querySelector('a').focus();
});