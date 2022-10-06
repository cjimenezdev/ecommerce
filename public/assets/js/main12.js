$(".preloader").fadeOut(1900, function () {
  $(this).remove();
  $("#page").css({ display: "block" });
});

function dragImg() {
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
/*  Show/Hidden Nav Lateral */
function show_nav_lateral() {
  let NavLateral = document.querySelector(".nav-lateral");
  let PageConten = document.querySelector(".page-content");
  if (NavLateral.classList.contains("active")) {
    NavLateral.classList.remove("active");
    PageConten.classList.remove("active");
  } else {
    NavLateral.classList.add("active");
    PageConten.classList.add("active");
  }
}
function showReg() {
  document.getElementById("login").style.display = "none";
  document.getElementById("reg").style.display = "block";
}

function showLogin() {
  document.getElementById("login").style.display = "block";
  document.getElementById("reg").style.display = "none";
}
/*  Btn go back */
function btn_go_back() {
  window.history.back();
}

/*  Show/Hidden Submenus */
const btn_submenu = document.querySelectorAll(".nav-btn-submenu");

btn_submenu.forEach((submenus) => {
  submenus.addEventListener("click", show_sub_menu);
});

function show_sub_menu() {
  let SubMenu = this.nextElementSibling;
  let iconBtn = this.children[1];
  if (SubMenu.classList.contains("show-nav-lateral-submenu")) {
    this.classList.remove("active");
    SubMenu.classList.remove("show-nav-lateral-submenu");
    iconBtn.classList.remove("fa-rotate-180");
  } else {
    this.classList.add("active");
    SubMenu.classList.add("show-nav-lateral-submenu");
    iconBtn.classList.add("fa-rotate-180");
  }
}

(function () {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
    }
  };

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach((e) => e.addEventListener(type, listener));
    } else {
      select(el, all).addEventListener(type, listener);
    }
  };

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener);
  };

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select("#navbar .scrollto", true);
  const navbarlinksActive = () => {
    let position = window.scrollY + 200;
    navbarlinks.forEach((navbarlink) => {
      if (!navbarlink.hash) return;
      let section = select(navbarlink.hash);
      if (!section) return;
      if (
        position >= section.offsetTop &&
        position <= section.offsetTop + section.offsetHeight
      ) {
        navbarlink.classList.add("active");
      } else {
        navbarlink.classList.remove("active");
      }
    });
  };
  window.addEventListener("load", navbarlinksActive);
  onscroll(document, navbarlinksActive);

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select("#header");
    let offset = header.offsetHeight;

    if (!header.classList.contains("header-scrolled")) {
      offset -= 10;
    }

    let elementPos = select(el).offsetTop;
    window.scrollTo({
      top: elementPos - offset,
      behavior: "smooth",
    });
  };

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select("#header");
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add("header-scrolled");
      } else {
        selectHeader.classList.remove("header-scrolled");
      }
    };
    window.addEventListener("load", headerScrolled);
    onscroll(document, headerScrolled);
  }

  /**
   * Back to top button
   */
  let backtotop = select(".back-to-top");
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add("active");
      } else {
        backtotop.classList.remove("active");
      }
    };
    window.addEventListener("load", toggleBacktotop);
    onscroll(document, toggleBacktotop);
  }

  /**
   * Mobile nav toggle
   */
  on("click", ".mobile-nav-toggle", function (e) {
    select("#navbar").classList.toggle("navbar-mobile");
    this.classList.toggle("bi-list");
    this.classList.toggle("bi-x");
  });

  /**
   * Mobile nav dropdowns activate
   */
  on(
    "click",
    ".navbar .dropdown > a",
    function (e) {
      if (select("#navbar").classList.contains("navbar-mobile")) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle("dropdown-active");
      }
    },
    true
  );

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on(
    "click",
    ".scrollto",
    function (e) {
      if (select(this.hash)) {
        e.preventDefault();

        let navbar = select("#navbar");
        if (navbar.classList.contains("navbar-mobile")) {
          navbar.classList.remove("navbar-mobile");
          let navbarToggle = select(".mobile-nav-toggle");
          navbarToggle.classList.toggle("bi-list");
          navbarToggle.classList.toggle("bi-x");
        }
        scrollto(this.hash);
      }
    },
    true
  );

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener("load", () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash);
      }
    }
  });

  /**
   * Brands Slider
   */
  new Swiper(".brands-slider", {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    slidesPerView: "auto",
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      480: {
        slidesPerView: 3,
        spaceBetween: 60,
      },
      640: {
        slidesPerView: 4,
        spaceBetween: 80,
      },
      992: {
        slidesPerView: 6,
        spaceBetween: 120,
      },
    },
  });

  /**
   * Gallery isotope and filter
   */
  window.addEventListener("load", () => {
    let galleryContainer = select(".gallery-container");
    if (galleryContainer) {
      let galleryIsotope = new Isotope(galleryContainer, {
        itemSelector: ".gallery-item",
        layoutMode: "fitRows",
      });

      let galleryFilters = select("#gallery-flters li", true);

      on(
        "click",
        "#gallery-flters li",
        function (e) {
          e.preventDefault();
          galleryFilters.forEach(function (el) {
            el.classList.remove("filter-active");
          });
          this.classList.add("filter-active");

          galleryIsotope.arrange({
            filter: this.getAttribute("data-filter"),
          });
          aos_init();
        },
        true
      );
    }
  });

  /**
   * Initiate gallery lightbox
   */
  const galleryLightbox = GLightbox({
    selector: ".gallery-lightbox",
  });

  /**
   * gallery details slider
   */
  new Swiper(".gallery-details-slider", {
    speed: 400,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
  });

  /**
   * Testimonials slider
   */
  new Swiper(".testimonials-slider", {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    slidesPerView: "auto",
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 40,
      },

      1200: {
        slidesPerView: 3,
      },
    },
  });

  /**
   * Animation on scroll
   */
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false,
    });
  }
  window.addEventListener("load", () => {
    aos_init();
  });
})();
