var AppView = Backbone.View.extend({
	
	initialize: function() {
		
		this.$el.addClass("app-engaged");
		
		this.search = new SearchFormView(
			{ el: this.$el.find("#search") });
		
		this.brands = new BrandListView(
			{ el: this.$el.find("#brands") });
		
		var me = this;
		this.search.on("suggestSearch", function(value) {
			$.getJSON("/jsapi/suggest/" + encodeURIComponent(value), function(results) {
				me.trigger("suggestSearchResults", results);
			});
		});
		
		this.search.on("episodeSearch", function(value) {
			$.getJSON("/jsapi/search/" + encodeURIComponent(value), function(results) {
				me.trigger("episodeSearchResults", results);
			});
		});
		
		this.on("suggestSearchResults", function(results) {
			this.brands.update(results);
		});
		
		this.brands.on("brandSelected", function(id) {
			$.getJSON("/jsapi/brand/" + encodeURIComponent(id), function(results) {
				me.trigger("brandResults", results);
			});
		});
		
	}

});