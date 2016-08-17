$(document).ready(function () {
    setInterval(function () {
        itsAjaxTime();
    }, 5000);
});

function itsAjaxTime() {
    var url = $('#results').data('url');
    $.getJSON(url + '&callback=?', function (data) {
        addNewImages(data);
    });
}

function addNewImages(data) {
    $.each(data.data, function (index, image) {
        if ($('#' + image.id).length == 0) {
            var img = $('<img ' +
                'id="' + image.id +
                '" src="' + image.images.low_resolution.url +
                '" alt=""/><br/>');
            img.hide().prependTo('#results').fadeIn(2000);
        }
    });
}