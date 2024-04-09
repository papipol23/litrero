@extends('layouts.master')
@section('breadcrumbs')
    {{-- <ul class="navbar-nav mr-lg-2">
        <li class="nav-item ml-0">
            <h4 class="mb-0">CREATE MESSAGE</h4>
        </li>
        <li class="nav-item">
            <div class="d-flex align-items-baseline">
                <p class="mb-0">KCCF SMS</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Message</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Create</p>
            </div>
        </li>
    </ul>
 @endsection --}}
{{-- @section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="col-8 offset-2">
                            <div class="chat-container">
                                <div class="chat-message received">
                                    @include('message.receive', [
                                        'message' => 'Yow! Chat With Me',
                                        'user' => 'KCCF SMS',
                                    ])
                               </div>
                            </div>
                            <div class="new-message">
                                <input type="text" id="new-message-input" placeholder="Type your message...">
                                <input type="submit" class="btn btn-md btn-success" value="Send">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection --}}

@section('css')
    <style>
        .chat-container {
            width: 100%;
        }

        .chat-message {
            background-color: grey;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: right;
        }

        .chat-message.received {
            background-color: rgb(107, 240, 107);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: left;
        }

        .sender {
            font-weight: bold;
            margin-bottom: 5px;

        }

        .message {
            font-size: 14px;
        }

        .new-message {
            width: 90%;
            margin-top: 20px;

            float: right;

        }

        #new-message-input {
            width: 70%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
    </style>
@endsection
@section('script')
    <script src="{{ asset('assets/custom/pusher/pusher.js') }}"></script>
    <script>
     $(document).ready(function() {
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'ap1'
    });
    const channel = pusher.subscribe('public');

    // Receive messages
    channel.bind('mrclln', function(data) {
        $.post("{{route('receive')}}", {
            _token: '{{ csrf_token() }}',
            message: data.message,
            user:data.user
        }).done(function(res) {
            $(".chat-container").append(res); // Append inside chat-container
            $(document).scrollTop($(document).height());
        });
    });

    $("form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{route('broadcast')}}",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #new-message-input").val(),
            }
        }).done(function(res) {
            $(".chat-container").append(res); // Append inside chat-container
            $("form #new-message-input").val('');
            $(document).scrollTop($(document).height());
        });
    });
});

function test(){
    Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            });
        }
    </script>
@endsection

<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable" data-offcanvas-offcanvas-mobile="on">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->

            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->

                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Chat-->
                            <div class="d-flex flex-row">
                                <!--begin::Aside-->
                                <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px offcanvas-mobile-on" id="kt_chat_aside">
                                    <!--begin::Card-->
                                    <div class="card card-custom">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin:Search-->
                                            <div class="input-group input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span class="svg-icon svg-icon-lg">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control py-4 h-auto" placeholder="Email">
                                            </div>
                                            <!--end:Search-->
                                            <!--begin:Users-->
                                            <div class="mt-7 scroll scroll-pull" style="height: auto; overflow: hidden;">
                                                <!--begin:User-->
                                                <!--end:User-->
                                                <!--begin:User-->
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                            <img alt="Pic" src="assets/media/users/300_11.jpg">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Charlie Stone</a>
                                                            <span class="text-muted font-weight-bold font-size-sm">Art Director</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span class="text-muted font-weight-bold font-size-sm">7 hrs</span>
                                                        <span class="label label-sm label-success">4</span>
                                                    </div>
                                                </div>
                                                <!--end:User-->
                                                <!--begin:User-->
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                            <img alt="Pic" src="assets/media/users/300_10.jpg">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Teresa Fox</a>
                                                            <span class="text-muted font-weight-bold font-size-sm">Web Designer</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span class="text-muted font-weight-bold font-size-sm">3 hrs</span>
                                                        <span class="label label-sm label-danger">5</span>
                                                    </div>
                                                </div>
                                                <!--end:User-->
                                                <!--begin:User-->
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                            <img alt="Pic" src="assets/media/users/300_13.jpg">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Giannis Nelson</a>
                                                            <span class="text-muted font-weight-bold font-size-sm">IT Consultant</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span class="text-muted font-weight-bold font-size-sm">2 days</span>
                                                    </div>
                                                </div>
                                                <!--end:User-->
                                                <!--begin:User-->
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                            <img alt="Pic" src="assets/media/users/300_15.jpg">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Carles Puyol</a>
                                                            <span class="text-muted font-weight-bold font-size-sm">Operator</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span class="text-muted font-weight-bold font-size-sm">5 mins</span>
                                                        <span class="label label-sm label-success">9</span>
                                                    </div>
                                                </div>
                                                <!--end:User-->
                                                <!--begin:User-->
                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                            <img alt="Pic" src="assets/media/users/300_16.jpg">
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Ana Torn</a>
                                                            <span class="text-muted font-weight-bold font-size-sm">Head Of Finance</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span class="text-muted font-weight-bold font-size-sm">2 days</span>
                                                    </div>
                                                </div>
                                                <!--end:User-->

                                                <!--begin:User-->

                                                <!--end:User-->
                                            </div>
                                            <!--end:Users-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->
                                </div><div class="offcanvas-mobile-overlay"></div>
                                <!--end::Aside-->
                                <!--begin::Content-->
                                <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
                                    <!--begin::Card-->
                                    <div class="card card-custom">
                                        <!--begin::Header-->
                                        <div class="card-header align-items-center px-4 py-3">
                                            <div class="text-left flex-grow-1">
                                                <!--begin::Aside Mobile Toggle-->
                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                                                    <span class="svg-icon svg-icon-lg">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"></path>
                                                                <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </button>
                                                <!--end::Aside Mobile Toggle-->
                                                <!--begin::Dropdown Menu-->

                                                <!--end::Dropdown Menu-->
                                            </div>
                                            <div class="text-center flex-grow-1">
                                                <div class="text-dark-75 font-weight-bold font-size-h5">User Admin</div>
                                                <div>
                                                    <span class="label label-sm label-dot label-success"></span>
                                                    <span class="font-weight-bold text-muted font-size-sm">Active</span>
                                                </div>
                                            </div>
                                            <div class="text-right flex-grow-1">
                                                <!--begin::Dropdown Menu-->

                                                <!--end::Dropdown Menu-->
                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Scroll-->

                                                <!--begin::Messages-->

                                                    <form>
                                                        <div class="col-8 offset-2">
                                                        <div class="scroll scroll-pull" data-mobile-height="350" style="height: auto; overflow: hidden;">
                                                            <div class="chat-container">
                                                                <div class="chat-message received">
                                                                    @include('message.receive', [
                                                                        'message' => 'Hey! Chat With Me',
                                                                        'user' => 'KCCF SMS',
                                                                    ])
                                                                </div>
                                                            </div></div>

                                                            <div class="new-message">
                                                                <input type="text" id="new-message-input" placeholder="Type your message...">
                                                                <input type="submit" class="btn btn-md btn-success" value="Send">

                                                                <a href="#" class="btn btn-clean btn-icon btn-md mr-1">

                                                                <a href="#" class="btn btn-clean btn-icon btn-md">

                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <!--end::Footer-->
                                                <!--end::Messages-->

                                            <!--end::Scroll-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Chat-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->

                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->

    <!-- end::User Panel-->
    <!--begin::Quick Cart-->

    <!--end::Quick Cart-->
    <!--begin::Quick Panel-->

    <!--end::Quick Panel-->
    <!--begin::Chat Panel-->

    <!--end::Chat Panel-->
    <!--begin::Scrolltop-->

    <!--end::Scrolltop-->
    <!--begin::Sticky Toolbar-->

    <!--end::Sticky Toolbar-->
    <!--begin::Demo Panel-->

    <!--end::Demo Panel-->
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/custom/chat/chat.js"></script>
    <!--end::Page Scripts-->


<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg></body>
