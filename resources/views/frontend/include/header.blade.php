<!doctype html>
<html lang="en">

<head>
    <title>{{ @$website_data->title_bangla }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">

    <script type="text/javascript" src="{{ asset('js/admin/app.js') }}"></script>


</head>

<body id="home-page">
    <header id="header">

        <div class="container">
            <div class="header-section"
                style="background-image: url('{{ asset('img/logo-background.svg') }}')">
                <!-- Header Logo Start  -->
                <div id="my-carousel" class="carousel face" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="{{ route('index') }}">
                                <img class="d-block img-fluid" src="{{ asset('img/logo-bn.png') }}"
                                    alt="">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{ route('index') }}">
                                <img class="d-block img-fluid"
                                    src="{{ asset('img/logo-en.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Logo End  -->
            </div>
        </div>
    </header>

    <header id="nav-bar" class="sticky-top">
        <div class="container">
            <div>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <i class="fa fa-home"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ????????????????????? ????????????
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('pouro.info') }}">????????????????????? ???????????????????????????
                                        ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('munici.org') }}">????????????????????? ????????????????????????
                                        ??????????????????</a>
                                    <a class="dropdown-item" href="{{ route('munici.map') }}">????????????????????? ????????????????????????</a>
                                    <a class="dropdown-item" href="{{ route('role.honour') }}">???????????????????????? ?????????????????????
                                        ??????????????????</a>
                                    <a class="dropdown-item" href="{{ route('munici.emp') }}">????????????????????? ??????????????????????????? ???
                                        ????????????????????????</a>
                                    <a class="dropdown-item" href="{{ route('edu.info') }}">?????????????????? ??????????????? ????????????</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ??????????????? ?????????????????????
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('mayor.contact') }}">?????????????????? ????????????????????????
                                        ?????????
                                        ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('counselor') }}">???????????????????????????????????? ????????????????????????
                                        ????????? ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('uno') }}">?????????????????? ???????????????????????? ??????????????????????????????
                                        ???????????????????????? ?????????
                                        ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('info.center') }}">???????????? ?????????????????????
                                        ?????????????????????</a>
                                    <a class="dropdown-item" href="{{ route('administration') }}">????????????????????? ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('eng.dept') }}">????????????????????? ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('health') }}">??????????????????????????? ???????????????</a>
                                    <a class="dropdown-item" href="{{ route('contact') }}">?????????????????????</a>
                                </div>
                            </li>


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ????????????????????????
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('citizen_chartered') }}">?????????????????????
                                        ?????????????????????</a>
                                    <a class="dropdown-item" href="{{ route('once_eye') }}">?????? ????????????</a>
                                    <a class="dropdown-item" href="{{ route('notice') }}">???????????????</a>
                                    <a class="dropdown-item" href="{{ route('download') }}">?????????????????????</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ????????????????????????????????????
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('reg.bosot-bari') }}">?????????????????????
                                        ????????????????????? ?????????????????????</a>

                                    <a class="dropdown-item" href="{{ route('reg.osthai-nagorik') }}">????????????????????? ??????????????????
                                        ?????????????????????</a>

                                    <a class="dropdown-item" href="{{ route('reg.business-hold') }}">???????????????????????????
                                        ????????????????????? ?????????????????????</a>
                                    <a class="dropdown-item" href="{{ route('reg.business') }}">??????????????????
                                        ?????????????????????????????? ?????????????????????</a>
                                </div>
                            </li>

                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </header>
    <section id="marquee">
        <div class="container">
            <div class="marquee">
                <marquee behavior="" direction="">
                    <div>
                        @forelse($marquees as $marquee)
                            <a href="{{ $marquee->link }}">
                                <i class="fa fa-caret-right"></i>
                                {{ $marquee->title }}
                            </a>
                        @empty
                        @endforelse
                    </div>
                </marquee>
                <span class="notice">
                    <i class="mr-2 "></i>
                    ?????????????????????
                </span>
            </div>
        </div>
    </section>
