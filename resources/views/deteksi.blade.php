<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>scan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest"></script>
    <style>
        .icon-navbar {
            width: 50px;
            height: auto;
        }
        .card {
            border-style: solid;
            margin: 50px;
            margin-left: 25%;
            align-items: center;
            width: 50%;
        }
        .card-img-top {
            margin: 5px;
            width: 250px;
        }
        body {
            justify-content: center;
        }
        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 500px;
            margin: 10px 300px;
            padding: 10px;
            background-color: lightcyan;
        }
        button {
            margin-top: 10px;
            border-radius: 5px;
            padding: 3px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li>
                    <a class="navbar-brand" href="/home"><img class="icon-navbar" src="{{ asset('img/logo4.png') }}"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Back</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">
                        <img class="icon-navbar" src="{{ asset('img/IconProfile.png') }}" alt="profile">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="main">
    <div id="screen-display">
        <img src="img/sample wajah.jpeg" alt="sample" style="height: 200px;">
    </div>
    <div id="btn">
        <button id="scan">Scan Wajah</button>
    </div>
</div>
<script>
    let scan_btn = document.querySelector("#scan");
    let screen_display = document.querySelector("#screen-display");
    let btn = document.querySelector("#btn");

    scan_btn.addEventListener('click', async function () {
        screen_display.innerHTML = '<video id="video" width="240" height="240" autoplay></video>';
        let video = document.querySelector("#video");

        try {
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
            btn.innerHTML = '<button id="capture">Ambil Gambar</button>';

            document.querySelector("#capture").addEventListener('click', async function () {
                screen_display.innerHTML = '<canvas id="canvas" width="200" height="200"></canvas><img id="img" crossorigin="anonymous" src="" width="200" height="200" style="display: none;"/>';
                let canvas = document.querySelector("#canvas");
                let img = document.querySelector("#img");

                let context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                let image_data_url = canvas.toDataURL('image/jpeg');
                img.src = image_data_url;

                console.log(image_data_url);
                btn.innerHTML = '<button id="upload">Upload Gambar</button>';
                // Stop the camera
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                video.srcObject = null;

                document.querySelector("#upload").addEventListener('click', async function () {
                    const kondisi = [
                        'Aman', 'Depresi Ringan', 'Kemungkinan Depresi', 'Depresi Berat'
                    ];
                    const deskripsiKondisi = [
                        'Individu tidak menunjukkan tanda-tanda depresi yang signifikan. Disarankan untuk tetap menjaga kesehatan mental dan fisik.',
                        'Individu mungkin mengalami beberapa gejala depresi yang ringan. Disarankan untuk mencari dukungan dari teman atau keluarga dan berbicara dengan profesional kesehatan mental.',
                        'Individu memiliki kemungkinan besar mengalami depresi. Disarankan untuk segera berkonsultasi dengan profesional kesehatan mental untuk evaluasi lebih lanjut dan perawatan yang sesuai.',
                        'Individu mengalami depresi yang berat. Disarankan untuk segera mencari bantuan medis darurat dan mendapatkan dukungan dari orang-orang terdekat untuk perawatan yang intensif.'
                    ];
                    console.log('Loading model...');

                    // Memuat model
                    const modelUrl = 'modelML/model.json'; // URL relatif ke direktori publik
                    const net = await tf.loadLayersModel(modelUrl);
                    console.log('Successfully loaded model');

                    // Mengambil elemen gambar
                    const inputImage = document.getElementById('img');

                    // Memproses gambar
                    const tensor = tf.browser.fromPixels(inputImage)
                        .resizeNearestNeighbor([200, 200]) // Mengubah ukuran gambar
                        .mean(2) // Konversi menjadi grayscale
                        .expandDims(2) // Menambahkan dimensi channel
                        .toFloat()
                        .div(tf.scalar(255)); // Normalisasi

                    const InImage = tensor.expandDims(0); // Menambahkan dimensi batch

                    // Melakukan prediksi
                    const predictImage = net.predict(InImage);
                    const predictions = await predictImage.data();
                    const maxIndex = predictions.reduce((maxIndex, probability, currentIndex) => {
                        return probability > predictions[maxIndex] ? currentIndex : maxIndex;
                    }, 0);
                    const maxKondisi = kondisi[maxIndex];
                    const deskripsiMaxKondisi = deskripsiKondisi[maxIndex];


                    console.log(`Kondisi dengan probabilitas tertinggi: ${maxKondisi}`);

                    // Menampilkan hasil prediksi dengan probabilitas
                    let resultText = 'Prediksi:';
                    resultText += `<br>${maxKondisi}<br>${deskripsiMaxKondisi}`;

                    // Menampilkan hasil prediksi
                    btn.innerHTML = resultText;

                    // Kirim hasil prediksi ke server
                    fetch('/history', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Tambahkan CSRF token
                        },
                        body: JSON.stringify({
                            result: resultText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            });
        } catch (err) {
            console.error("Error accessing the camera: ", err);
        }
    });
</script>
</body>
</html>
