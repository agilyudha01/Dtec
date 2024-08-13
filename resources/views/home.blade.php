<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .icon-navbar {
      width: 50px; /* Ubah ukuran sesuai kebutuhan */
      height: auto; /* Pertahankan rasio aspek */
      }
      .card {
        border-style: solid;
        margin: 50px;
        margin-left: 25%;
        align-items: center;
        width: 50%;
      }
      .card-img-top{
        margin: 5px;
        width: 250px;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li>
                    <a class="navbar-brand" href="/home"><img class="icon-navbar" src="{{ asset('img/logo4.png') }}" ></a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/home">Home</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="/deteksi">Mulai Deteksi</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="/history">Histori</a>
                  </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link" href="/profile">
                        <img class="icon-navbar" src="{{ asset('img/IconProfile.png') }}" alt="profile">
                      </a>
                    </li>

                </ul>
              </div>
          </div>
  </nav>

  <div class="card mb-3" style="cursor: pointer;">
    <img src="img/cover1.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card mb-3" style="cursor: pointer;">
    <img src="img/cover1.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card mb-3" style="cursor: pointer;">
    <img src="img/cover1.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>


  <script>
    // JavaScript untuk menangani tindakan klik pada card
    const cards = document.querySelectorAll('.card');
      cards.forEach(card => {
        card.onclick = function() {
          location.href = "/home/article";
        }
      });
</script>
    

  </body>
</html>