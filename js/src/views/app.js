var AppView = Backbone.View.extend({
	
	initialize: function() {
		
		var loading = this.$el.find("#episodes-loading");
		var spinner = this.$el.find("#brands-loading");
		this.error = this.$el.find("#error");
		
		this.$el.addClass("app-engaged");
		this.endPoint = "/jsapi";
		this.endPoint = "/";
		
		var me = this;
		
		this.search = new SearchFormView(
			{ el: this.$el.find("#search") });
		
		this.brands = new BrandListView(
			{ el: this.$el.find("#brands") });
		
		this.episodes = new EpisodeListView(
			{ el: this.$el.find("#episodes") });
		
		this.listenTo(this.search, "brand-search", this.loadBrands);
		
		this.listenTo(this.search, "brand-search", function(value) {
			spinner.addClass("shown");
		});
		
		this.listenTo(this, "brand-complete", function() {
			spinner.removeClass("shown");
		});
		
		this.listenTo(this, "brand-error", this.displayError);
		
		this.listenTo(this.search, "episode-search", this.loadEpisodes);
		
		this.listenTo(this.search, "episode-search", function() {
			loading.addClass("shown");
		});
		
		this.listenTo(this, "episode-complete", function() {
			loading.removeClass("shown");
		});
		
		this.listenTo(this, "episode-error", this.displayError);
		
		this.listenTo(this.search, "search-changed", function() {
			me.brands.clear();
		});
		
		this.listenTo(this.search, "episode-search", function() {
			me.brands.clear();
		});
		
		this.listenTo(this, "brand-results", function(results) {
			me.brands.update(results);
		});
		
		this.listenTo(this.brands, "brand-search", this.loadBrands);
		
		this.listenTo(this.brands, "brand-selected", function(id) {
			me.brands.clear();
		});
		
		this.listenTo(this, "episode-results", function(results) {
			me.episodes.update(results);
		});
		
	},
	
	loadJSON: function(url) {
		if(this.xhr) this.xhr.abort();
		return this.xhr = $.getJSON(url);
	},
	
	loadEpisodes: function(value) {
		var me = this;
		
		this.loadJSON(this.endPoint + "/search/" + encodeURIComponent(value))
			.success(function(results) {
				me.trigger("episode-results", results);
			})
			.error(function(xhr, err) {
				if(err === "abort")
					me.trigger("episode-abort");
				else
					me.trigger("episode-error");
			
			})
			.complete(function() {
				me.trigger("episode-complete");
			});
	},
	
	loadBrand: function(id) {
		this.loadJSON(this.endPoint + "/brand/" + encodeURIComponent(id))
			.success(this.receiveBrands);
	},
	
	loadBrands: function(value) {
		var me = this;
		this.loadJSON(this.endPoint + "/suggest/" + encodeURIComponent(value))
			.success(function(results) {
				me.trigger("brand-results", results);
			})
			.error(function(xhr, err) {
				if(err === "abort")
					me.trigger("brand-abort");
				else
					me.trigger("brand-error");
			})
			.complete(function() {
				me.trigger("brand-complete");
			});
	},
	
	receiveBrand: function(results) {
		this.trigger("brand-results", results);
	},
	
	displayError: function() {
		this.error
			.stop(true, true)
			.text("Sorry... We couldn't complete your search please try again")
			.fadeIn()
			.delay(3000)
			.fadeOut();
	}

});