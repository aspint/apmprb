function mostrarOcultar(id){
    const t =  document.getElementById(id);
    if(t.classList.contains('d-none')){
        t.classList.remove('d-none');
    }else{
        t.classList.add('d-none');
    }
}


function mostrarOcultarCheckbox(checkbox, idAlterar){
    var checkBox = document.getElementById(checkbox);
    const t =  document.getElementById(idAlterar);

    if (checkBox.checked == true){
        t.classList.remove('d-none');
        checkBox.value = "true";
      } else {
        t.classList.add('d-none');
        checkBox.value = "false";
      }
}
