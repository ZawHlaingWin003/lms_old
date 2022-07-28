@php
    header("Cross-Origin-Embedder-Policy: require-corp");
    header("Cross-Origin-Opener-Policy: same-origin");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="{{url('js/coi-serviceworker.min.js')}}"></script> --}}

    <!-- For Client View -->
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.4.0/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.4.0/css/react-select.css" />
    
</head>
<body>
    <!-- For Component and Client View -->
    <script src="https://source.zoom.us/2.4.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.4.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.4.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.4.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.4.0/lib/vendor/lodash.min.js"></script>

    <!-- For Client View -->
    <script src="https://source.zoom.us/zoom-meeting-2.4.0.min.js"></script>
    
    <script>
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareWebSDK();
        // loads language files, also passes any error messages to the ui
        ZoomMtg.i18n.load('en-US');
        ZoomMtg.i18n.reload('en-US');
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.4.0/lib', '/av');
        
        ZoomMtg.init({
            debug: true,
            disableCORP: false,
            leaveUrl: 'https://us05web.zoom.us/meeting#/upcoming',
            success: (success) => {
                console.log(success)

                // ZoomMtg.join() will go here
                ZoomMtg.join({
                    signature: "{{ $signature }}",
                    sdkKey: "{{ $sdkkey }}",
                    userName: "{{ $username }}",
                    meetingNumber: "{{ $meetingnumber }}",
                    passWord: "{{ $password }}"
                })
            },
            error: (error) => {
                console.log(error)
            }
        });
        
        ZoomMtg.init();
        const zoomMeetingSDK = document.getElementById('zmmtg-root');
        console.log(zoomMeetingSDK);
    </script>

    


</body>
</html>