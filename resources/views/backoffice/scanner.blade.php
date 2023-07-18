@extends('backoffice.layout')
@section('title', 'Scanner')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <script src="{{ asset('backoffice/js/html5-qrcode.min.js') }}"></script>

            <div id="qr-reader" style="width:500px"></div>
            <div id="qr-reader-results"></div>

            <script>
                var resultContainer = document.getElementById('qr-reader-results');
                var lastResult, countResults = 0;

                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        ++countResults;
                        lastResult = decodedText;
                        // Handle on success condition with the decoded message.
                        let regex = /^[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-4[0-9a-fA-F]{3}\-(8|9|a|b|A|B)[0-9a-fA-F]{3}\-[0-9a-fA-F]{12}$/;
                        if(regex.test(decodedText)){
                            window.location.href = 'participant?id=' + decodedText;
                        }
                        console.log(`Scan result ${decodedText}`, decodedResult);
                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);

                document.getElementById("qr-reader").style.width = '100%';
            </script>

            <style>
                #html5-qrcode-button-camera-stop, #html5-qrcode-button-camera-start{
                    background: #C8102E;
                    color: white;
                    border: 0;
                    border-radius: 5px;
                    padding: 10px 25px;
                    font-weight: bold;
                }
                #html5-qrcode-anchor-scan-type-change{
                    display: none;
                }
            </style>

        </div>
    </div>
@endsection
