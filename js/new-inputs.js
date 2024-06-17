function showSecondaryRadios() {
    var secondaryRadios = document.getElementById('secondaryRadios');
    secondaryRadios.classList.add('show');
  }
  
  function showImages(imageSetId) {
    // Hide all image sets first
    var imageSets = document.getElementsByClassName('imageSet');
    for (var i = 0; i < imageSets.length; i++) {
      imageSets[i].classList.remove('show');
    }
  
    // Show the selected image set
    var selectedImageSet = document.getElementById(imageSetId);
    selectedImageSet.classList.add('show');
  }