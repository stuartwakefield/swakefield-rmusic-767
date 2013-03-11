var EpisodeListView = Backbone.View.extend({
	
	update: function(results) {
		var fragment = document.createDocumentFragment();
		
		for(var i = 0; i < results.blocklist.length; ++i) {
			var item = $("<li>" + results.blocklist[i].title + "</li>");
			fragment.appendChild(item.get(0));
		}
		
		this.$el.empty().append(fragment);
	}
	
});