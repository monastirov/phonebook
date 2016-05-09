var AppView = Backbone.View.extend({

    el: $(".phonebook-table"),
    loader: $('#initial-loader'),

    initialize: function(options) {
        this.cityCollection = options.cityCollection;
        this.bindings();
        this.fetchCollection(this.cityCollection, {async: false}, 'Не смог загрузить города :(');
        this.fetchCollection(this.collection, {async: false}, 'Не смог загрузить записи справочника :(');
        var self = this;
        setInterval(function() {
            self.fetchCollection(self.collection, {async: true});
        }, 10000);

        this.loader.hide();
    },

    bindings: function() {
        this.collection.bind('add', this.addOneRecord, this);
        this.collection.bind('reset', this.addAllRecords, this);
        this.collection.bind('all', this.render, this);
    },

    fetchCollection: function(collection, options, errorMessage) {
        //@todo сделать нормальную обработку ошибок
        collection.fetch(options).success(function(result){
            if (result.error){
                alert(errorMessage);
            }
        }).error(function(){
            alert(errorMessage);
        });
    },

    addOneRecord: function(record) {
        var view = new RecordView({model: record, cityCollection: this.cityCollection});
        this.$el.append(view.render().el);
    },

    addAllRecords: function() {
        this.collection.each(this.addOneRecord);
    }
});
