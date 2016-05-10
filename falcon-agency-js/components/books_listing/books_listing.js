module.exports = {
	template: require('./books_listing.template.html'),

	data: function() {
		return {
			viewType: 'grid',
			
			books: [
				{
					id : 1,
					title: 'Buku 1',
					excerpt: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
					cover_path: '/images/uploaded/296dc6471c37d76f54fa2c607fe67dee.jpg',
					price: '29.90'
				},
				{
					id : 2,
					title: 'Buku 2',
					excerpt: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
					cover_path: '/images/uploaded/296dc6471c37d76f54fa2c607fe67dee.jpg',
					price: '29.90'
				},
				{
					id : 3,
					title: 'Buku 3',
					excerpt: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
					cover_path: '/images/uploaded/296dc6471c37d76f54fa2c607fe67dee.jpg',
					price: '29.90'
				},
				{
					id : 4,
					title: 'Buku 4',
					excerpt: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
					cover_path: '/images/uploaded/296dc6471c37d76f54fa2c607fe67dee.jpg',
					price: '29.90'
				},
			]
		}
	},
	init: function() {

	},
	ready: function() {

		
	},

	props: [

	],

	methods: {
		
		switchType: function(type, e) {
			
			e.preventDefault();
			
			this.viewType = type;
		}
	},

	events: {
		
	}
}