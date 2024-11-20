<?php

//Obtem a variável de ambiente
$API_KEY = Env::getEnv('TINY_KEY');


?>
<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
  <script src="<?php echo INCLUDE_PATH ?>assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.115.4">
  <title><?php echo NOME_EMPRESA ?></title>

  <link rel="canonical" href="">

  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">




  <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

  <link href="<?php echo URL_STATIC ?>css/dashboard.css" rel="stylesheet">
  <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">

  <!-- TinyMCE -->
  <script src="https://cdn.tiny.cloud/1/<?php echo $API_KEY ?>/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>
  <div class="container-fluid p-0 m-auto">
    <div>
      <?php
      include('./components/themes.php');
      include('./components/svg.php');

      ?>
    </div>
    <div class="d-flex p-0">
      <?php


      include('./components/sidebar.php');

      ?>
      <main class="main w-100">
        <?php
        include('./commons/header.php');
        ?>
        <section class="section-main overflow-y-auto p-3">
          <?php

          Painel::carregarPagina();

          ?>
        </section>
        <div class="p-0">
          <?php
          include('./commons/footer.php');
          ?>
        </div>
      </main>
    </div>

  </div>


  <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo INCLUDE_PATH ?>static/js/functions.js"></script>
  <!-- <script src="<?php echo URL_STATIC ?>js/dashboard.js"></script> -->
  <script>
    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', 'postAcceptor.php');

      xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
      };

      xhr.onload = () => {
        if (xhr.status === 403) {
          reject({
            message: 'HTTP Error: ' + xhr.status,
            remove: true
          });
          return;
        }

        if (xhr.status < 200 || xhr.status >= 300) {
          try {
            const errorResponse = JSON.parse(xhr.responseText);
            if (errorResponse && errorResponse.error) {
              reject(errorResponse.error);
            } else {
              reject('HTTP Error: ' + xhr.status);
            }
          } catch (e) {
            reject('HTTP Error: ' + xhr.status);
          }
          return;
        }

        console.log(xhr.responseText.toString);
        const json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          reject('Invalid JSON: ' + xhr.responseText);
          return;
        }

        resolve(json.location);
      };

      xhr.onerror = () => {
        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
      };

      const formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      console.log("XHR: ", xhr);
      xhr.send(formData);
    });

    tinymce.init({
      selector: '#editor',
      height: 600,
      formats: {
        image: {
          block: 'img',
          classes: 'img-conteudo'
        }
      },
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      editimage_cors_hosts: ["http://localhost/", "http://localhost:3306"],
      images_upload_url: 'postAcceptor.php',
      mergetags_list: [{
          value: 'First.Name',
          title: 'First Name'
        },
        {
          value: 'Email',
          title: 'Email'
        },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
      images_upload_handler: example_image_upload_handler

    });
  </script>
  <script>
    setTimeout(function() {
      $('.alert').alert('close');
      $('#btn-alert-close').click(function() {
        $('.alert').alert('close');
      });
    }, 5000);
  </script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>