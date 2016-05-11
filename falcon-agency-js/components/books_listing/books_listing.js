module.exports = {
	template: require('./books_listing.template.html'),

	data: function () {
		return {
			viewType: 'grid',
			
			keyword: '',
			filter: {
				authors: []
			},

			books: [],

			authors: []
		}
	},
	init: function () {

	},
	ready: function () {
		
		this.initializedQueryStringData();

		this.fetchAuthors();
		this.fetchBooks();
		
		this.$watch('keyword', function() {
			
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		this.$watch('filter.authors', function() {
			
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
	},

	props: [
		'data-api-authors-url',
		'data-api-books-url'
	],

	methods: {
		initializedQueryStringData: function() {
			var queryString = this.getQueryString();
			
			if(queryString.hasOwnProperty('keyword')) {
				
				this.keyword = queryString['keyword'];
			}
			
			if(queryString.hasOwnProperty('authors[]')) {
				
				this.filter.authors =  queryString['authors[]']
			}
		},
		/**
		 * Updated by anasceym
		 * 
		 * @source http://stackoverflow.com/questions/4656843/jquery-get-querystring-from-url
		 * @returns {Array}
		 */
		getQueryString: function ()
		{
			var vars = [], hash;
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++)
			{
				hash = hashes[i].split('=');
				
				var key = decodeURIComponent(hash[0]);
				var value = decodeURI(hash[1]);
				if(!vars.hasOwnProperty(key)) {
					
					if(key.substr(key.length - 2) === '[]') {
						// Means it is an array
						vars[key] = [value];
					}
					else {

						vars[key] = value;
					}
				}
				else {
					if(typeof vars[key] == 'object') {

						vars[key].push(value);
					}
				}
			}
			
			return vars;
		},
		changeHistory: function() {
			
			var prepareQueryString = {
				keyword : this.keyword,
			}; 
			
			prepareQueryString = $.extend(prepareQueryString, { 
				authors: this.filter.authors
			});
			
			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname +'?'+ $.param(prepareQueryString).replace(/\+/g, "%20");
			window.history.pushState({path:newurl},'',newurl); 	
		},
		
		switchType: function (type, e) {

			e.preventDefault();

			this.viewType = type;
		},

		fetchAuthors: function () {

			$.ajax({
				url: this.dataApiAuthorsUrl,
				method: 'get',
				dataType: 'json',
				data: {},
				success: function (response) {
					
					if(response.hasOwnProperty('data')) {

						this.authors = response.data;
						
						setTimeout(function() {
							$(this.$els.filterauthorel).selectpicker('refresh');
						}.bind(this),500)
					}
				}.bind(this),
				error: function (response) {

				}.bind(this),
				complete: function () {
				}.bind(this) 
			});
		},
		
		fetchBooks: function() {
			
			$.ajax({
				url: this.dataApiBooksUrl,
				method: 'get',
				dataType: 'json',
				data: {
					'keyword' : this.keyword,
					'authors[]' : this.filter.authors
				},
				success: function (response) {
					
					if(response.hasOwnProperty('data')) {
						
						this.books = response.data;
					}
				}.bind(this),
				error: function (response) {

				}.bind(this),
				complete: function () {
				}.bind(this)
			});
		}
	},

	events: {}
}