$( document ).ready(function() {
    setInterval(function() {
      var timestamp = getLatestTimestamp();
      if(timestamp > 0){
          itsAjaxTime(timestamp);
      }
    }, 10000);
});

function itsAjaxTime(timestamp)
{
    var images = $('#images');
    var url = images.data('url') + '&max_timestamp=' + timestamp;
    $.getJSON( url, function() {
      $.each(data.data, function(index, image) {
            var image_tag = '<img data-timestamp="' + image.timestamp + '" src="' + image.images.low_resolution.url + '" alt=""/><br/>';
            images.prepend(image_tag)
        });
    })
}

function getLatestTimestamp(){
    var max = 0;
    $('image').each(function() {
      var value = $(this).data('timestamp');
      max = (value > max) ? value : max;
    });

    return max;
}

