$(document).ready(function() {
    function loadImages(data) {

            var response = '',
                indicator = '';
            for (var i = 0; i < data.length; i++) {
                response += '<div class="carousel-item"><img class="img-responsive fit-image" src="' + data[i].Image + '"><div class="carousel-caption"><h3>' + data[i].Title + '</h3><p>' + data[i].Content + '</p></div></div>';
                indicator += '<li data-target="#myCarousel" data-slide-to="'+i+'"></li>';
            }
            $('#galleryItems').append(response);
            $('#indicators').append(indicator);
            $('.carousel-item').first().addClass('active');
            $('.carousel-indicators > li').first().addClass('active');
            $("#myCarousel").carousel();
        }
    $.getJSON("files/js/gallerydata.json",loadImages);
});