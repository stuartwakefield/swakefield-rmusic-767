var NoEpisodeView = Backbone.View.extend({
	
	hide: function() {
		this.$el.removeClass("show");
	},
	
	show: function() {
		this.$el.addClass("show");
	},
	
	update: function(results) {
		if(results.blocklist.length === 0) {
			this.show();
		} else {
			this.hide();
		}
	}
	
});