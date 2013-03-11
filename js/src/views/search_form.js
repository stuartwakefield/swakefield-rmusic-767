var SearchFormView = Backbone.View.extend({ 
	
	events: 
		{ "keydown :input[name=search]" : "waitAndSearch"
		, "submit form" : "search" }, 
	
	initialize: function() {
		this.field = this.$el.find(":input[name=search]");
	},
	
	clearTimeout: function() {
		if(this.timeout) {
			clearTimeout(this.timeout);
			this.timeout = undefined;
		}
	},
	
	waitAndSearch: function() {
		this.clearTimeout();
		var me = this;
		this.timeout = setTimeout(function() {
			me.trigger("suggestSearch", me.field.val());
		}, 3000);
	},
	
	search: function(e) {
		e.preventDefault();
		e.stopPropagation();
		this.clearTimeout();
		this.trigger("episodeSearch", this.field.val());
	}
	
});