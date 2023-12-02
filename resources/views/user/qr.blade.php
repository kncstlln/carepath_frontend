<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Scanner</title>
<link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    @include('user/sidebar')
    <div class="container content createRecord">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-6 justify-content-center">
                <select id="cameraSelect"></select>
                <video id="preview" willReadFrequently></video>
            </div>
        </div>
    </div>

    
    <script>
        // Start camera scanning
        let scanner;
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
                scanner.addListener('scan', function (content) {
                    // Process the scanned QR code content
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
            // Split the QR data by '&' to get individual key-value pairs
            let dataPairs = content.split('&');
            let result = {};
            
            

            // Loop through the data pairs and populate the result object
            dataPairs.forEach(pair => {
                let [key, value] = pair.split('=');
             
                
                if (value !== '') {
                    switch (key) {
                        case '1':
                            result['name'] = decodeURIComponent(value);
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
                            result['father_name'] = decodeURIComponent(value);
                            break;
                        case '7':
                            result['mother_name'] = decodeURIComponent(value);
                            break;
                        case '8':
                            result['contact_number'] = value;
                            break;
                        // Add more cases if there are more possible keys
                    }
                }
            });

            // Redirect to the specified route with the extracted variables as parameters in the URL
            let queryString = Object.keys(result).map(key => key + '=' + result[key]).join('&');
            console.log(queryString);
            let redirectURL = '/user/infants/add?' + queryString; // Adjust the URL as needed

            // Redirect the user to the specified route
            window.location.href = redirectURL;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
