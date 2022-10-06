$(".preloader").fadeOut(1900, function () {
  $(this).remove();
  $("#page").css({ display: "block" });
});

/**
 * Función aside
 */

function navToggle() {
  const menu = document.querySelector(".navbar-toggler");
  const toggler = document.querySelector(".btn-toggle");

  const sidebarMenu = document.querySelector(".nav"),
    sidebarLi = sidebarMenu.querySelectorAll("li");

  menu.addEventListener("click", () => {
    document.querySelector(".nav__bar").classList.add("show");
    document.querySelector(".nav__bar").classList.remove("hide");
  });

  toggler.addEventListener("click", () => {
    document.querySelector(".nav__bar").classList.add("hide");
    document.querySelector(".nav__bar").classList.remove("show");
  });

  //Sidenav//

  for (var i = 0; i < sidebarLi.length; i++) {
    sidebarLi[i].addEventListener("click", function () {
      var current = document.getElementsByClassName("enable");
      current[0].className = current[0].className.replace("enable", "");
      this.className += " enable";
    });
  }

  $(document).ready(function () {
    $(".nav-link").on("click", function (e) {
      var currentID = $(this).attr("id");
      sessionStorage.setItem("enable", currentID);
    });

    var activeTab = sessionStorage.getItem("enable");
    if (activeTab != "") {
      $("#" + activeTab).addClass("enable");
    } else {
      $("#" + activeTab).removeClass("enable");
    }
  });
}

/**
 * Función vista previa imagen
 */

function dropAreaImg() {
  const dropArea = document.querySelector(".drag-area"),
    dragText = dropArea.querySelector("header"),
    button = dropArea.querySelector("button"),
    input = dropArea.querySelector("input"),
    dropView = dropArea.querySelector(".preview");
  let file;
  button.onclick = () => {
    input.click();
  };
  input.addEventListener("change", function () {
    file = this.files[0];
    dropArea.classList.add("active");
    showFile();
  });

  dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.classList.add("active");
    dragText.textContent = "Release to Upload File";
  });

  dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  });

  dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    file = event.dataTransfer.files[0];
    showFile();
    validarImagen(obj);
  });

  function showFile() {
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    if (validExtensions.includes(fileType)) {
      let fileReader = new FileReader();
      fileReader.onload = () => {
        let fileURL = fileReader.result;
        let imgTag = `<img src="${fileURL}" alt="image">`;
        dropView.innerHTML = imgTag;
      };
      fileReader.readAsDataURL(file);
    } else {
      Swal.fire({
        text: "Formato de la imagen inválido",
        icon: "warning",
        showCancelButton: false,
        showDenyButton: false,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(action, config)
            .then((respuesta) => respuesta.json())
            .then((respuesta) => {
              return alertas_ajax(respuesta);
            });
        }
      });
      dropArea.classList.remove("active");
    }
  }

  function validarImagen(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
      alert("El navegador no soporta la lectura de archivos");
      return;
    }

    if (!/\.(jpg|png|gif)$/i.test(uploadFile.name)) {
      alert("El archivo a adjuntar no es una imagen");
    } else {
      var img = new Image();
      img.onload = function () {
        if (this.width.toFixed(0) != 200 && this.height.toFixed(0) != 200) {
          alert("Las medidas deben ser: 200 * 200");
        } else if (uploadFile.size > 20000) {
          alert("El peso de la imagen no puede exceder los 200kb");
        } else {
          alert("Imagen correcta :)");
        }
      };
      img.src = URL.createObjectURL(uploadFile);
    }
  }
}

var state = false;

function toggle() {
  if (state) {
    document.getElementById("login_clave").setAttribute("type", "password");
    document.getElementById("eye").style.color = "#7a797e";
    state = false;
  } else {
    document.getElementById("login_clave").setAttribute("type", "text");
    document.getElementById("eye").style.color = "#5887ef";
    state = true;
  }
}

function toggle2() {
  if (state) {
    document
      .getElementById("login_clave_1_reg")
      .setAttribute("type", "password");
    document.getElementById("eye2").style.color = "#7a797e";
    state = false;
  } else {
    document.getElementById("login_clave_1_reg").setAttribute("type", "text");
    document.getElementById("eye2").style.color = "#5887ef";
    state = true;
  }
}

function toggle3() {
  if (state) {
    document
      .getElementById("login_clave_2_reg")
      .setAttribute("type", "password");
    document.getElementById("eye3").style.color = "#7a797e";
    state = false;
  } else {
    document.getElementById("login_clave_2_reg").setAttribute("type", "text");
    document.getElementById("eye3").style.color = "#5887ef";
    state = true;
  }
}
