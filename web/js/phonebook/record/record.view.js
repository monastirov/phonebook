var RecordView = Backbone.View.extend({
    tagName:  "tr",
    className: "record",
    template: _.template($('script#record-template').html()),
    events: {
        "click"   : "toggleSelected"
    },

    initialize: function(options) {
        this.model.on('change', this.render, this);
    },

    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    },
    
    clear: function() {
        this.model.clear();
    }
});
