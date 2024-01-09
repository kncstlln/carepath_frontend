<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    @include('admin/sidebar')
    <div class="container content createRecord">
        <div class="row justify-content-center mt-5">
            <div class="col-6 col-md-8 col-lg-6 justify-content-center">
                <select id="cameraSelect"></select>
                <video id="preview" willReadFrequently></video>
            </div>
        </div>
    </div>

    
    <script>
        let scanner;
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
                scanner.addListener('scan', function (content) {
                    processQRCodeContent(content);
                });
                let select = document.getElementById('cameraSelect');
                cameras.forEach(function(camera, index) {
                    let option = document.createElement('option');
                    option.value = index;
                    option.textContent = camera.name;
                    select.appendChild(option);
                });
                scanner.start(cameras[0]);
                select.addEventListener('change', function() {
                    scanner.start(cameras[select.value]);
                });
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        function processQRCodeContent(content) {
            let dataPairs = content.split('&');
            let result = {};

            dataPairs.forEach(pair => {
                let [key, value] = pair.split('=');


                if (value !== '') {
                    switch (key) {
                        case '1':
                            result['name'] = value;
                            break;
                        case '2':
                            result['birth_date'] = value;
                            break;
                        case '3':
                            result['gender'] = value;
                            break;
                        case '4':
                            result['weight'] = value;
                            break;
                        case '5':
                            result['length'] = value;
                            break;
                        case '6':
                            result['father_name'] = value;
                            break;
                        case '7':
                            result['mother_name'] = value;
                            break;
                        case '8':
                            result['contact_number'] = value;
                            break;
                    }
                }
            });

            let queryString = Object.keys(result).map(key => key + '=' + result[key]).join('&');
            console.log(queryString);
            let redirectURL = '/admin/infants/add?' + queryString;

            window.location.href = redirectURL;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
