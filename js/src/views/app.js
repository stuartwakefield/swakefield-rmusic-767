var AppView = Backbone.View.extend({
	
	initialize: function() {
		
		var loading = this.$el.find("#episodes-loading");
		var spinner = this.$el.find("#brands-loading");
		
		this.$el.addClass("app-engaged");
		
		this.search = new SearchFormView(
			{ el: this.$el.find("#search") });
		
		this.brands = new BrandListView(
			{ el: this.$el.find("#brands") });
		
		this.episodes = new EpisodeListView(
			{ el: this.$el.find("#episodes") });
		
		this.noEpisodes = new NoEpisodeView(
			{ el: this.$el.find("#no-episodes") });
		
		var me = this;
		this.search.on("suggestSearch", function(value) {
			spinner.addClass("shown");
			$.getJSON("/jsapi/suggest/" + encodeURIComponent(value), function(results) {
				spinner.removeClass("shown");
				me.trigger("suggestSearchResults", results);
			});
		});
		
		this.search.on("episodeSearch", function(value) {
			loading.addClass("shown");
			$.getJSON("/jsapi/search/" + encodeURIComponent(value), function(results) {
				loading.removeClass("shown");
				me.trigger("episodeSearchResults", results);
			});
		});
		
		this.search.on("searchChanged", function() {
			me.brands.clear();
		});
		
		this.search.on("episodeSearch", function() {
			me.brands.clear();
		});
		
		this.on("suggestSearchResults", function(results) {
			me.brands.update(results);
		});
		
		this.brands.on("brandSelected", function(id) {
			$.getJSON("/jsapi/brand/" + encodeURIComponent(id), function(results) {
				me.trigger("brandResults", results);
			});
		});
		
		this.brands.on("brandSelected", function(id) {
			me.brands.clear();
		});
		
		this.on("episodeSearchResults", function(results) {
			me.episodes.update(results);
		});
		
		this.on("episodeSearchResults", function(results) {
			me.noEpisodes.update(results);
		});
		
		
		
	}

});