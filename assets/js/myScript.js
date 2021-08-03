$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop:true,
    slideMargin: 0,
    thumbItem: 9
});

$('.btn-delete').click(function (e) { 
    e.preventDefault();
    if(confirm('Bạn có chắc muốn xóa hay không?')){
        window.location.href = $(this).attr('href');
    }
});

$(".image-upload").change(function () {
    var currentImageUpload = $(this);
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            currentImageUpload.parent().find('.preview').remove(); 
            currentImageUpload.parent().append('<img src="'+e.target.result+'" class="preview"/>');
        };
        reader.readAsDataURL(this.files[0]);
    }
});
