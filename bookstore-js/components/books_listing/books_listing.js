module.exports = {
	template: require('./books_listing.template.html'),

	data: function () {
		return {
			viewType: 'grid',
			
			keyword: '',
			filter: {
				authors: [],
				genre: 'all'
			},
			sort: {
				type: 'title',
				direction: 'DESC'
			},

			books: [],

			authors: [],
			
			genres: [],
			
			pagination: {
				current_page: 1
			},
			
			isLoading: true
		}
	},
	init: function () {

	},
	ready: function () {
		
		this.initializedQueryStringData();

		this.fetchAuthors();
		this.fetchBooks();
		this.fetchGenres();
		
		this.$watch('keyword', function() {
			
			this.pagination.current_page = 1;
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		
		this.$watch('filter.authors', function() {
			
			this.pagination.current_page = 1;
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		
		this.$watch('filter.genre', function() {
			
			this.pagination.current_page = 1;
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		
		this.$watch('sort.type', function() {
			
			this.pagination.current_page = 1;
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		
		this.$watch('sort.direction', function() {
			
			this.pagination.current_page = 1;
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
		
		this.$watch('pagination.current_page', function() {
			
			this.fetchBooks();
			this.changeHistory();
		}.bind(this));
	},

	props: [
		'data-api-authors-url',
		'data-api-books-url',
		'data-api-genres-url',
		'data-download-pdf-url'
			
	],

	methods: {
		downloadPDF: function(e) {
			e.preventDefault();
			
			window.open(this.dataDownloadPdfUrl + this.prepareQueryString());
			
		},
		toggleSortDirection: function(e) {

			e.preventDefault();
			
			if(this.sort.direction == 'ASC') {
				
				this.sort.direction = 'DESC';
			}
			else {

				this.sort.direction = 'ASC';
			}
		},
		initializedQueryStringData: function() {
			var queryString = this.getQueryString();
			
			if(queryString.hasOwnProperty('keyword')) {
				
				this.keyword = queryString['keyword'].replace('+', ' ');
			}
			
			if(queryString.hasOwnProperty('authors[]')) {
				
				this.filter.authors =  queryString['authors[]']
			}
			
			if(queryString.hasOwnProperty('genre')) {
				
				this.filter.genre =  queryString['genre']
			}
			
			if(queryString.hasOwnProperty('page')) {
				
				this.pagination.current_page =  queryString['page']
			}
			
			if(queryString.hasOwnProperty('sort[type]')) {
				
				this.sort.type =  queryString['sort[type]'];
				
				setTimeout(function() {
					$(this.$els.sortel).selectpicker('refresh');
				}.bind(this),500)
			}
			
			if(queryString.hasOwnProperty('sort[direction]')) {
				
				var sortDirection = queryString['sort[direction]'];
				
				if(sortDirection != 'ASC' && sortDirection != 'DESC') {
					
					sortDirection = 'DESC'; 
				}
				
				this.sort.direction = sortDirection; 
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
			
			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + this.prepareQueryString();
			window.history.pushState({path:newurl},'',newurl); 	
		},
		
		prepareQueryString: function() {
			
			var prepareQueryString = {
				keyword : this.keyword,
			}; 
			
			prepareQueryString = $.extend(prepareQueryString, { 
				authors: this.filter.authors,
				genre: this.filter.genre,
				sort: this.sort,
				page: this.pagination.current_page
			});
			
			return '?'+ $.param(prepareQueryString).replace(/\+/g, "%20");
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
		
		fetchGenres: function () {

			$.ajax({
				url: this.dataApiGenresUrl,
				method: 'get',
				dataType: 'json',
				data: {},
				success: function (response) {
					
					if(response.hasOwnProperty('data')) {

						this.genres = response.data;
						
						setTimeout(function() {
							$(this.$els.filtergenreel).selectpicker('refresh');
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
			
			this.isLoading = true;
			
			$.ajax({
				url: this.dataApiBooksUrl,
				method: 'get',
				dataType: 'json',
				data: {
					'keyword' : this.keyword,
					'authors[]' : this.filter.authors,
					'sort[type]' : this.sort.type,
					'sort[direction]' : this.sort.direction,
					'page': this.pagination.current_page,
					'genre' : this.filter.genre
				},
				success: function (response) {
					
					if(response.hasOwnProperty('data')) {
						
						this.books = response.data;
					}
					if(response.hasOwnProperty('meta')) {
						
						this.pagination = response.meta.pagination;
					}
				}.bind(this),
				error: function (response) {

				}.bind(this),
				complete: function () {
					this.isLoading = false;
				}.bind(this)
			});
		},
		
		changePage: function(e, page) {
			
			e.preventDefault();
			
			if(page <= 0) {
				return;
			}
			
			if(page > this.pagination.total_pages) {
				
				return;
			}
			
			this.pagination.current_page = page;
		}
	},

	events: {}
}