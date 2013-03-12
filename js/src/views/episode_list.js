var EpisodeListView = Backbone.View.extend({
	
	update: function(results) {
		var fragment = document.createDocumentFragment();
		
		for(var i = 0; i < results.blocklist.length; ++i) {
			var date = new Date(Date.parse(results.blocklist[i].original_broadcast_datetime));
			var item = $(
				"<li>" + 
					"<h3>" + results.blocklist[i].hierarchical_title + "</h3>" +
					"<h4>" + results.blocklist[i].brand_title + "</h4>" +
					"<p>" + results.blocklist[i].synopsis + "</p>" +
					"<p>First broadcast <time datetime=\"" + results.blocklist[i].original_broadcast_datetime + "\">" + date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear() + "</time></p>" +
				"</li>");
			fragment.appendChild(item.get(0));
		}
		
		this.$el.empty().append(fragment);
	}
	
});