@php
    $id = env('CUSTOMER_SUPPORT_USER_ID');
    $user = App\Models\User::find($id);
@endphp
@auth
    <section class="visible avenue-messenger messenger-messagingView m-body">
        <div class="chat">
            <div style="height: 70px; background: #0aad0a;">
                <div class="container py-2">
                    <div class="row align-items-center">
                        <div class="col-1">
                            <img class="d-inline" style="width: 25px" src="{{ asset('images/favicon/favicon.ico') }}">
                        </div>
                        <div class="col">
                            <span class="fs-5 fw-bold text-white">{{ $user->name }}</span><br>
                            <span class="fs-6 text-white">Customer Service</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="messagess">
                <div class="m-body messages-container app-scroll messages-content" style="">
                    <div id="messages">
                        <p class="message-hint center-el"><span>Say Hi, 👋</span></p>
                    </div>
                    {{-- Typing indicator --}}
                    <div class="typing-indicator">
                        <div class="message-card typing">
                            <div class="message">
                                <span class="typing-dots">
                                    <span class="dot dot-1"></span>
                                    <span class="dot dot-2"></span>
                                    <span class="dot dot-3"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-box">
                <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
                    <textarea type="text" class="message-input m-send app-scroll" name="message" placeholder="Type message..."></textarea>
                    {{-- this is the target user id to whom you will be chating with --}}
                    <input type="hidden" name="id" value="{{ $id }}">
                    @csrf
                    <button type="submit" class="message-submit m-send app-scroll" style="height: 28px !important"><i
                            class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </section>
    <div class="fabs">
        <a id="prime" class="fab">
            <i class="fa-solid fa-headset"></i>
        </a>
    </div>
@endauth
@guest
    <section class="visible avenue-messenger messenger-messagingView m-body">
        <div style="height: 70px; background: #0aad0a;">
            <div class="container py-2">
                <div class="row align-items-center">
                    <div class="col-1">
                        <img class="d-inline" style="width: 25px" src="{{ asset('images/favicon/favicon.ico') }}">
                    </div>
                    <div class="col">
                        <span class="fs-5 fw-bold text-white">{{ $user->name }}</span><br>
                        <span class="fs-6 text-white">Customer Service</span>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 80%" class="container d-flex flex-column align-items-center justify-content-center">
            <div class="py-3 text-center text-secondary">Silakan Login terlebih dahulu untuk menghubungi customer service kami</div>
            <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Login</a>
        </div>
    </section>
    <div class="fabs">
        <a id="prime" class="fab">
            <i class="fa-solid fa-headset"></i>
        </a>
    </div>

@endguest
