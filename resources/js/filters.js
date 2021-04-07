import Moment from "moment";

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter("date", function (value) {
    if(!value) {
        return ''
    }
    return Moment(value).format("Do MMMM YYYY");

});

Vue.filter("datetime", function (value) {
    if(!value) {
        return ''
    }
    return Moment(value).format("Do MMMM YYYY HH:mm");
});
