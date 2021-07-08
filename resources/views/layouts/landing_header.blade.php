<!--====== Main Header ======-->
        <header class="header--style-1 header--box-shadow">

            <!--====== Nav 1 ======-->
            <nav class="primary-nav primary-nav-wrapper--border" style="background-color: #b1bc32;">
                <div class="container">

                    <!--====== Primary Nav ======-->
                    <div class="primary-nav">

                        <!--====== Main Logo ======-->

                        <a class="main-logo" href="{{ route('user.home') }}">

                            <img src="{{ asset('storage/'.$data['ui']->content->logo->path) }}" alt="" style="max-height: 50px;">
                            {{-- <h2 class="section__heading u-c-secondary u-s-m-b-12">Fatabar Farm</h2> --}}
                        </a>
                        <!--====== End - Main Logo ======-->


                        <!--====== Search Form ======-->
                        {{-- <form class="main-form">

                            <label for="main-search"></label>

                            <input class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search" placeholder="Search">

                            <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button></form> --}}
                        <!--====== End - Search Form ======-->


                        <!--====== Dropdown Main plugin ======-->
                        <div class="menu-init" id="navigation">

                            <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cog" type="button"></button>

                            <!--====== Menu ======-->
                            <div class="ah-lg-mode">

                                <span class="ah-close">✕ Close</span>

                                <!--====== List ======-->
                                <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                                    @if (Route::has('login'))
                                    <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">

                                        <a><i class="far fa-user-circle"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:120px">
                                            @auth
                                            <li>
                                                <a href="{{ route('user.profil') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                                                    <span>Akun</span></a>
                                                </li>

                                            <li>
                                                <a href="{{ route('logout') }}"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                                    <span>Keluar</span>
                                                </a>
                                            </li>
                                            @else
                                            @if (Route::has('register'))
                                            <li>

                                                <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>

                                                    <span>Daftar</span></a></li>
                                            @endif
                                            <li>

                                                <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>

                                                    <span>Masuk</span></a></li>
                                            @endauth

                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    @endif
                                </ul>
                                <!--====== End - List ======-->
                            </div>
                            <!--====== End - Menu ======-->
                        </div>
                        <!--====== End - Dropdown Main plugin ======-->
                    </div>
                    <!--====== End - Primary Nav ======-->
                </div>
            </nav>
            <!--====== End - Nav 1 ======-->


            <!--====== Nav 2 ======-->
            <nav class="secondary-nav-wrapper" style="background-color: mediumseagreen">
                <div class="container">

                    <!--====== Secondary Nav ======-->
                    <div class="secondary-nav">
                        <!--====== Dropdown Main plugin ======-->
                        <div class="menu-init" id="navigation2">

                            <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-bars" type="button"></button>

                            <!--====== Menu ======-->
                            <div class="ah-lg-mode">

                                <span class="ah-close">✕ Close</span>

                                <!--====== List ======-->
                                <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                                    <li>

                                        <a href="{{ route('user.home') }}">HOME</a></li>
                                    <li class="has-dropdown">

                                        <a>TENTANG<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:170px">
                                            <li>
                                                <a href="{{ route('user.history') }}">Sejarah</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.visi_misi') }}">Visi Misi</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('user.location') }}">Lokasi</a></li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown">

                                        <a>PRODUK<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:170px">
                                            @foreach($data['productCategory'] as $p)
                                            <li>
                                                <a href="{{ route('user.category',$p->id) }}">{{ $p->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li>

                                        <a href="{{ route('user.blog') }}">BERITA</a></li>
                                        <li class="has-dropdown">

                                            <a>PROGRAM<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <ul>
                                                @foreach($data['program'] as $p)
                                                <li>
                                                    <a href="{{ route('user.program.detail',$p->id) }}">{{ $p->detail->title }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <!--====== End - Dropdown ======-->
                                        </li>
                                </ul>
                                <!--====== End - List ======-->
                            </div>
                            <!--====== End - Menu ======-->
                        </div>
                        <!--====== End - Dropdown Main plugin ======-->
                        @auth
                        <!--====== Dropdown Main plugin ======-->
                        <div class="menu-init" id="navigation3">

                            <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop" type="button"></button>
                            <span class="total-item-round"></span>

                            <!--====== Menu ======-->
                            <div class="ah-lg-mode">

                                <span class="ah-close">✕ Close</span>

                                <!--====== List ======-->
                                <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                                    <li class="has-dropdown">

                                        <a class="mini-cart-shop-link" href="{{ route('user.cart') }}"><i class="fas fa-shopping-bag"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                    </li>
                                </ul>
                                <!--====== End - List ======-->
                            </div>
                            <!--====== End - Menu ======-->
                        </div>
                        <!--====== End - Dropdown Main plugin ======-->
                        @endauth
                    </div>
                    <!--====== End - Secondary Nav ======-->
                </div>
            </nav>
            <!--====== End - Nav 2 ======-->
        </header>
        <!--====== End - Main Header ======

