(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict

function loadCamera() {
  //Captura elemento de vídeo
  var video = document.querySelector("#webCamera");
  //As opções abaixo são necessárias para o funcionamento correto no iOS
  video.setAttribute('autoplay', '');
  video.setAttribute('muted', '');
  video.setAttribute('playsinline', '');
  //--

  //Verifica se o navegador pode capturar mídia
  if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({
              audio: false,
              video: {
                  facingMode: 'user'
              }
          })
          .then(function(stream) {
              //Definir o elemento vídeo a carregar o capturado pela webcam
              video.srcObject = stream;
          })
          .catch(function(error) {
              alert("Oooopps... Falhou :'(");
          });
  }
}

function sendSnapShot(base64) {
  var request = new XMLHttpRequest();
  request.open('POST', '/view/pessoas/cadastrar/salvar_photos.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  request.onload = function() {
      console.log(request);
      if (request.status >= 200 && request.status < 400) {
          //Colocar o caminho da imagem no SRC
          var data = JSON.parse(request.responseText);

          //verificar se houve erro
          if (data.error) {
              alert(data.error);
              return false;
          }

          //Mostrar informações
          document.querySelector("#imagemConvertida").setAttribute("src", data.img);
          document.querySelector("#imagemConvertidaSalva").setAttribute("src", data.img);
          document.getElementById("caminhoDaFotoTirada").value = data.img;
          document.querySelector("#caminhoImagem a").setAttribute("href", data.img);
          document.querySelector("#caminhoImagem a").innerHTML = data.img.split("/")[1];
      } else {
          alert("Erro ao salvar. Tipo:" + request.status);
      }
  };

  request.onerror = function() {
      alert("Erro ao salvar. Back-End inacessível.");
  }

  request.send("base_img=" + base64); // Enviar dados</code></pre>

}

function takeSnapShot() {
  //Captura elemento de vídeo
  var video = document.querySelector("#webCamera");

  //Criando um canvas que vai guardar a imagem temporariamente
  var canvas = document.createElement('canvas');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  var ctx = canvas.getContext('2d');

  //Desenhando e convertendo as dimensões
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

  //Criando o JPG
  var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.
  document.querySelector("#base_img").value = dataURI;

  sendSnapShot(dataURI); //Gerar Imagem e Salvar Caminho no Banco
}