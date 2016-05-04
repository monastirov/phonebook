var RecordView = Backbone.View.extend({
    tagName:  "tr",
    className: "record",
    template: _.template($('script#record-template').html()),
    events: {
        "click .delete" : "clear"
    },
    initialize: function(options) {
        this.model.on('change', this.render, this);
        this.model.on('remove', this.clearView, this);
    },

    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    },

    clear: function() {
        this.model.clear();
    },

    clearView: function() {
        this.$el.html('');
    }
});
