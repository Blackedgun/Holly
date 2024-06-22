function validateForm() {
    var curriculum = document.getElementById("curriculum").value;
    if (curriculum == "") {
      alert("Por favor seleccione un documento para continuar");
      return false;
    }
    return true;
  }

  function checkFormStatus() {
    var formDisabled = localStorage.getItem('formDisabled');
    var form = document.getElementById("myForm");
    var disabledMessage = document.getElementById("disabledMessage");

    if (formDisabled === 'true') {
      for (var i = 0; i < form.elements.length; i++) {
        form.elements[i].disabled = true;
      }
      disabledMessage.style.display = "block";
    } else {
      for (var i = 0; i < form.elements.length; i++) {
        form.elements[i].disabled = false;
      }
      disabledMessage.style.display = "none";
    }
  }

  // Ejecutar checkFormStatus al cargar la página
  window.onload = checkFormStatus;
