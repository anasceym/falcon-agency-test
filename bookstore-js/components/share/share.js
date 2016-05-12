module.exports = {
	template: require('./share.template.html'),

	data: function () {
		return {
			
			shareMeta: {
				title: '',
				description: '',
				uploadedImgUrl: '',
				url: ''
			}
		}
	},
	init: function () {
		
		this.Dialog = require('share-dialog');
	},
	ready: function () {
		
		var shareData = JSON.parse(this.dataShare);
		
		this.shareMeta.title = shareData.title;
		this.shareMeta.description = shareData.excerpt;
		this.shareMeta.uploadedImgUrl = shareData.cover_path;
		this.shareMeta.url = shareData.show_link;
	},

	props: [
		'data-fb-app-id',
		'data-share'
	],

	methods: {
		buttonShareClickHandler: function(e, type) {
			
			e.preventDefault();
			
			switch (type) {
				case 'facebook':
					this.shareFacebook();
					break;
				case 'twitter':
					this.shareTwitter();
					break;
				case 'gplus':
					this.shareGplus();
					break;
			};	
		},
		openShareModal: function(e) {
			e.preventDefault();
			
			$(this.$els.sharemodal).modal();
		},
		shareFacebook: function () {

			var facebookDialog = this.Dialog.facebook(this.dataFbAppId, this.shareMeta.url, this.shareMeta.url);
			facebookDialog.params({
				name: this.shareMeta.title,
				title: this.shareMeta.title,
				description: this.shareMeta.description,
				link: this.shareMeta.url,
				picture: this.shareMeta.uploadedImgUrl,
				display: 'popup'
			});
			facebookDialog.open();
		},
		shareTwitter: function() {
			
			var twitterDialog = this.Dialog.twitter(this.shareMeta.url);
			twitterDialog.params({
				text: this.shareMeta.title,
				hashtags: 'SimpleBookstore,',
				via: 'simplebookstore'
			});
			twitterDialog.open();
		},
		shareGplus: function() {
			
			var gplusDialog = this.Dialog.gplus(this.shareMeta.url);
			
			gplusDialog.open();
		},
	},

	events: {}
}