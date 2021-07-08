@extends('layouts.landing_template')
@section('title')
Detail Blog
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-90">

                <!--====== Detail Post ======-->
                <div class="detail-post">
                    <div class="bp-detail">
                        <div class="bp-detail__thumbnail">

                            <!--====== Image Code ======-->
                            <div class="aspect aspect--bg-grey aspect--1366-768">

                                <img class="aspect__img" src="{{ asset('storage/'.$post->file->path) }}" alt=""></div>
                            <!--====== End - Image Code ======-->
                        </div>
                        <div class="bp-detail__info-wrap">
                            <div class="bp-detail__stat">

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__publish-date">

                                        <a href="javascript:void(0)">

                                            <span>{{$post->created_at}}</span></a></span></span>

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__author">

                                        <a href="javascript:void(0)">Admin</a></span></span>

                                {{-- <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__category">

                                        <a href="blog-right-sidebar.html">Learning</a>

                                        <a href="blog-right-sidebar.html">News</a>

                                        <a href="blog-right-sidebar.html">Health</a>
                                    </span>
                                    </span>
                                    </div> --}}

                            <span class="bp-detail__h1">

                                <a href="javascript:void(0)">{{$post->title}}</a></span>
                            {{-- <div class="blog-t-w">

                                <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="blog-right-sidebar.html">Travel</a>

                                <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="blog-right-sidebar.html">Culture</a>

                                <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="blog-right-sidebar.html">Place</a></div> --}}
                            <p class="bp-detail__p">{!! $post->content !!}</p>
                            {{-- <div class="post-center-wrap">
                                <ul class="bp-detail__social-list">
                                    <li>

                                        <a class="s-fb--color" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li>

                                        <a class="s-tw--color" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li>

                                        <a class="s-insta--color" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li>

                                        <a class="s-wa--color" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li>

                                        <a class="s-gplus--color" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div> --}}
                            {{-- <div class="gl-l-r bp-detail__postnp">
                                <div>

                                    <a href="blog-detail.html">Previous Post</a></div>
                                <div>

                                    <a href="blog-detail.html">Next Post</a></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Detail Post ======-->
            {{-- <div class="u-s-p-b-60">
                <div class="d-meta">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-meta__comment-arena">

                                    <span class="d-meta__text u-s-m-b-36">6 thoughts on "Wait till is open"</span>
                                    <div class="d-meta__comments u-s-m-b-30">
                                        <ol>
                                            <li>

                                                <!--====== Comment ======-->
                                                <div class="d-meta__p-comment">
                                                    <div class="p-comment__wrap1">
                                                        <div class="aspect aspect--square p-comment__img-wrap">

                                                            <img src="images/blog/avatar.jpg" alt=""></div>
                                                    </div>
                                                    <div class="p-comment__wrap2">

                                                        <span class="p-comment__author">Dayle</span>

                                                        <span class="p-comment__timestamp">

                                                            <a href="#">

                                                                <span>25 March 2015 at 3:55pm</span></a></span>
                                                        <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                        <a class="p-comment__reply" href="#">Reply</a>
                                                    </div>
                                                </div>
                                                <!--====== End - Comment ======-->
                                                <ol class="comment-children">
                                                    <li>

                                                        <!--====== Comment ======-->
                                                        <div class="d-meta__p-comment">
                                                            <div class="p-comment__wrap1">
                                                                <div class="aspect aspect--square p-comment__img-wrap">

                                                                    <img src="images/blog/avatar-2.jpg" alt=""></div>
                                                            </div>
                                                            <div class="p-comment__wrap2">

                                                                <span class="p-comment__author">Dayle</span>

                                                                <span class="p-comment__timestamp">

                                                                    <a href="#">

                                                                        <span>25 March 2015 at 3:55pm</span></a></span>
                                                                <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                                <a class="p-comment__reply" href="#">Reply</a>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Comment ======-->
                                                        <ol class="comment-children">
                                                            <li>

                                                                <!--====== Comment ======-->
                                                                <div class="d-meta__p-comment">
                                                                    <div class="p-comment__wrap1">
                                                                        <div class="aspect aspect--square p-comment__img-wrap">

                                                                            <img src="images/blog/avatar-3.jpg" alt=""></div>
                                                                    </div>
                                                                    <div class="p-comment__wrap2">

                                                                        <span class="p-comment__author">Dayle</span>

                                                                        <span class="p-comment__timestamp">

                                                                            <a href="#">

                                                                                <span>25 March 2015 at 3:55pm</span></a></span>
                                                                        <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                                        <a class="p-comment__reply" href="#">Reply</a>
                                                                    </div>
                                                                </div>
                                                                <!--====== End - Comment ======-->
                                                                <ol class="comment-children">
                                                                    <li>

                                                                        <!--====== Comment ======-->
                                                                        <div class="d-meta__p-comment">
                                                                            <div class="p-comment__wrap1">
                                                                                <div class="aspect aspect--square p-comment__img-wrap">

                                                                                    <img src="images/blog/avatar-4.jpg" alt=""></div>
                                                                            </div>
                                                                            <div class="p-comment__wrap2">

                                                                                <span class="p-comment__author">Dayle</span>

                                                                                <span class="p-comment__timestamp">

                                                                                    <a href="#">

                                                                                        <span>25 March 2015 at 3:55pm</span></a></span>
                                                                                <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                                                <a class="p-comment__reply" href="#">Reply</a>
                                                                            </div>
                                                                        </div>
                                                                        <!--====== End - Comment ======-->
                                                                        <ol class="comment-children">
                                                                            <li>

                                                                                <!--====== Comment ======-->
                                                                                <div class="d-meta__p-comment">
                                                                                    <div class="p-comment__wrap1">
                                                                                        <div class="aspect aspect--square p-comment__img-wrap">

                                                                                            <img src="images/blog/avatar-5.jpg" alt=""></div>
                                                                                    </div>
                                                                                    <div class="p-comment__wrap2">

                                                                                        <span class="p-comment__author">Dayle</span>

                                                                                        <span class="p-comment__timestamp">

                                                                                            <a href="#">

                                                                                                <span>25 March 2015 at 3:55pm</span></a></span>
                                                                                        <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                                                        <a class="p-comment__reply" href="#">Reply</a>
                                                                                    </div>
                                                                                </div>
                                                                                <!--====== End - Comment ======-->
                                                                            </li>
                                                                            <li>

                                                                                <!--====== Comment ======-->
                                                                                <div class="d-meta__p-comment">
                                                                                    <div class="p-comment__wrap1">
                                                                                        <div class="aspect aspect--square p-comment__img-wrap">

                                                                                            <img src="images/blog/avatar.jpg" alt=""></div>
                                                                                    </div>
                                                                                    <div class="p-comment__wrap2">

                                                                                        <span class="p-comment__author">Dayle</span>

                                                                                        <span class="p-comment__timestamp">

                                                                                            <a href="#">

                                                                                                <span>25 March 2015 at 3:55pm</span></a></span>
                                                                                        <p class="p-comment__paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                                                                        <a class="p-comment__reply" href="#">Reply</a>
                                                                                    </div>
                                                                                </div>
                                                                                <!--====== End - Comment ======-->
                                                                            </li>
                                                                        </ol>
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </div>

                                    <span class="d-meta__text-2 u-s-m-b-6">Join the Conversation</span>

                                    <span class="d-meta__text-3 u-s-m-b-16">Your email address will not be published. Required fields are marked *</span>
                                    <form class="respond__form">
                                        <div class="respond__group">
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="comment">COMMENT *</label><textarea class="text-area text-area--primary-style" id="comment"></textarea></div>
                                            <div>
                                                <p class="u-s-m-b-30">

                                                    <label class="gl-label" for="responder-name">NAME *</label>

                                                    <input class="input-text input-text--primary-style" type="text" id="responder-name"></p>
                                                <p class="u-s-m-b-30">

                                                    <label class="gl-label" for="responder-email">EMAIL *</label>

                                                    <input class="input-text input-text--primary-style" type="text" id="responder-email"></p>
                                            </div>
                                        </div>
                                        <div>

                                            <button class="btn btn--e-brand-shadow" type="submit">POST COMMENT</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!--====== End - Section 1 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection