function hideElementsAt1199px() {
    const elementsToHide = document.querySelectorAll('.col-2, .img3');
    const screenWidth = window.innerWidth;

    if (screenWidth <= 1199) {
      elementsToHide.forEach(element => {
        element.style.display = 'none';
      });
    } else {
      elementsToHide.forEach(element => {
        element.style.display = 'block';
      });
    }
  }


  hideElementsAt1199px();
  window.addEventListener('resize', hideElementsAt1199px);