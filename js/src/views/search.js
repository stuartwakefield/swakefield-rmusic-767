var SearchFormView = Backbone.View.extend({ 
	
	events: 
		{ "keydown :input[name=search]" : "waitAndSearch"
		, "submit form" : "search" }, 
	
	initialize: function() {
		this.field = this.$el.find(":input[name=search]");
		this.field.attr("autocomplete", "off");
	},
	
	clearTimeout: function() {
		if(this.timeout) {
			clearTimeout(this.timeout);
			this.timeout = undefined;
		}
	},
	
	waitAndSearch: function() {
		this.clearTimeout();
		if(this.field.val().length) {
			var me = this;
			this.timeout = setTimeout(function() {
				me.suggestSearch();
			}, 500);
		} else {
			this.trigger("search-blank");
		}
		this.trigger("search-changed", this.field.val());
	},
	
	suggestSearch: function() {
		if(this.field.val().length) {
			this.trigger("brand-search", this.field.val());
		}
	},
	
	search: function(e) {
		e.preventDefault();
		e.stopPropagation();
		this.clearTimeout();
		this.trigger("episode-search", this.field.val());
	}
	
});