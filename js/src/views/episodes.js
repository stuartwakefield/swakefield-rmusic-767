var EpisodeListView = Backbone.View.extend({
	
	initialize: function() {
		this.noResultsMessage = this.$el.find("#no-episodes");
		this.list = this.$el.find("#episodes-list");
	},
	
	update: function(results) {
		var fragment = document.createDocumentFragment();
		
		if(!results.blocklist.length) {
			this.displayNoResultsMessage();
		} else {
			this.hideNoResultsMessage();
		}
		
		for(var i = 0; i < results.blocklist.length; ++i) {
			var item = $(this.renderEpisode(results.blocklist[i]));
			fragment.appendChild(item.get(0));
		}
		
		this.list.empty().append(fragment);
	},
	
	renderEpisode: function(episode) {
		var date = new Date(Date.parse(episode.original_broadcast_datetime));
		return (
			"<li>" + 
				"<h3>" + episode.hierarchical_title + "</h3>" +
				"<h4>" + episode.brand_title + "</h4>" +
				"<p>" + episode.synopsis + "</p>" +
				"<p>First broadcast <time datetime=\"" + episode.original_broadcast_datetime + "\">" + date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear() + "</time></p>" +
			"</li>"
		);
	},
	
	hideNoResultsMessage: function() {
		this.noResultsMessage.stop(true, true).removeClass("shown").fadeOut();
	},
	
	displayNoResultsMessage: function() {
		this.noResultsMessage.stop(true, true).addClass("shown").fadeIn();
	},
	
	displayError: function() {
		console.error("Episode error");
	}
	
});