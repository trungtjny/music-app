

function showSinglePicture(input,num) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.avatar'+num).attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }



  function showMultiplePictures(input,num) {
    
   
    if (input.files) {
      $(".multiple-images-holder-"+num).empty();
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img class="my-2 img-custom me-3" width="175" height="125">')).attr('src', event.target.result).appendTo('.multiple-images-holder-'+num);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }
    
    if($('#multiple-images-1').get(0).files.length === 0){
      $(".multiple-images-holder-"+num).append('<img class="my-3 img-custom" width="250" height="200" src="https://banksiafdn.com/wp-content/uploads/2019/10/placeholde-image.jpg">');
  
    }

}



    // Multiple images preview in browser


