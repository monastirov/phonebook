var LocationView = Backbone.View.extend({
    cities : [],

    initialize: function(options) {
        _.bindAll(this);
        this.cities = options.cities.toJSON();
    },

    bindings: {
        '.city': {
            observe: 'city_id',
            initialize: function($el) {
                $el.select2({ width: 250, allowClear: true });
            },
            selectOptions: {
                collection: function() {
                    return this.cities;
                },
                valuePath: 'id',
                labelPath: 'title',
                defaultOption: {
                    label: '',
                    value: null
                }
            },
            onSet: function(val) {
                this.model.set('street_id', null);
                this.$('.street').select2('val', null);
                return val;
            }
        },
        '.street': {
            observe: ['city_id', 'street_id'],
            initialize: function($el) {
                $el.select2({ width: 250, allowClear: true });
            },
            selectOptions: {
                collection: function() {
                    var cityId = this.model.get('city_id');
                    var city = _.find(this.cities, { id: cityId });

                    return city ? city.streets : '';
                },
                valuePath: 'id',
                labelPath: 'title',
                defaultOption: {
                    label: '',
                    value: null
                }
            },
            onSet: function(val) {
                this.model.set('street_id', val);
                return val;
            }
        }
    },
    render: function() {
        this.stickit();
        return this;
    }
});