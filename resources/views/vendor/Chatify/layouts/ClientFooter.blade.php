@auth
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
    <script>
        // Gloabl Chatify variables from PHP to JS
        window.chatify = {
            name: "{{ config('chatify.name') }}",
            sounds: {!! json_encode(config('chatify.sounds')) !!},
            allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
            allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
            maxUploadSize: {{ Chatify::getMaxUploadSize() }},
            pusher: {!! json_encode(config('chatify.pusher')) !!},
            pusherAuthEndpoint: "{{ route('pusher.auth') }}"
        };
        window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
    </script>
    <script src="{{ asset('js/chatify/utils.js') }}"></script>
    <script src="{{ asset('js/chatify/client.js') }}"></script>
@endauth
@guest
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#prime').click(function() {
            toggleFab();
        });


        //Toggle chat and links
        function toggleFab() {
            $('.prime').toggleClass('zmdi-comment-outline');
            $('.prime').toggleClass('zmdi-close');
            $('.prime').toggleClass('is-active');
            $('.prime').toggleClass('is-visible');
            $('#prime').toggleClass('is-float');
            $('.avenue-messenger').toggleClass('visible');
            $('.fab').toggleClass('is-visible');

        }
    </script>
@endguest
