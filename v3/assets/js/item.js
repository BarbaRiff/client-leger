var divImages = document.getElementsByClassName("images")[0];
var mainImage = document.getElementById("mainImage");

divImages.addEventListener("click", function(e) {
    if (e.target.id == "mainImage") {
        return;
    } else if (e.target.className == "images") {
        return;
    } else {
        var img = e.target;
        mainImage.src = img.src;
        // mainImage.animate([ { transform: 'scale(1.2)' } ], { duration: 500, fill: 'both' });
        // $(mainImage).css("transform", "scale(1.2)");
    }
});