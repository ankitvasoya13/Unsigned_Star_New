<!--top navi wrapper Start -->
<div id="sidebar" class="bounce-to-right">
    <div id="toggle_close">×</div>
    <div id='cssmenu'>
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo1.png') }}" alt="logo" class="music-logo"></a>
        <ul class="sidebb">
            <li class='has-sub'><a href='#'><i class="flaticon-playlist-3"></i>browse artists</a>
                <ul>
                    <li><a href="{{ url('artists') }}"><i class="flaticon-music"></i>Artists</a></li>
                    <li><a href="{{ url('top-artists') }}"><i class="flaticon-music-1"></i>Top Artists</a></li>
                    <li><a href="{{ url('featured-artists') }}"><i class="flaticon-files-and-folders"></i>Feature Artists</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="flaticon-info"></i>Charts</a></li>
            <li><a href="{{ url('success-stories') }}"><i class="flaticon-playlist-1"></i>Success</a></li>
            <li><a href="{{ url('our-panel') }}"><i class="flaticon-clock"></i>Our Panel</a></li>
            <li><a href="{{ url('stations') }}"><i class="flaticon-internet"></i>Radio</a></li>
            <li><a href="{{ url('events') }}"><i class="flaticon-playlist"></i>Events</a></li>
            <li><a href="{{ url('join') }}"><i class="flaticon-playlist"></i>Join</a></li>
            <li><a href="{{ url('about-us') }}"><i class="flaticon-internet"></i>About</a></li>
            <li><a href="{{ url('contact-us') }}"><i class="flaticon-trash"></i>Contact</a></li>
        </ul>
        <!--<div class="lang_apply_btn">
            <ul>
                <li>
                  <a href="#"> <i class="flaticon-play-button"></i>create</a>
                </li>
           </ul>
      </div>-->
    </div>
</div>
<!-- top navi wrapper end -->
<div class="m24_navi_main_wrapper ms_cover">
    <div class="container-fluid">
        <div class="m24_logo_wrapper">
            <div class="ms_logo_div">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo1.png') }}" alt="logo" class="music-logo">
                </a>
            </div>
            <div id="toggle">
                <a href="#"><i class="flaticon-menu-1"></i></a>
            </div>
        </div>

        <div class="m24_header_right_Wrapper d-none d-sm-none d-md-none d-lg-none d-xl-block">
            <div class="m24_signin_wrapper show-on-hover">
                @if(Session::has('userSession'))
                    <a> 
                        @if (Session::get('profileImg'))
                        <img src="{{ asset('uploads/'.Session::get('profileImg')) }}">                        
                        @else
                        <img src="{{ asset('uploads/avatar.png') }}">                        
                        @endif                       
                    </a>
                    <ul class="navi_2_dropdown1 dropdown-menu" role="menu" style="right: 0 !important; left:unset;">
                        <li class="parent1">
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <!-- <li class="parent1">
                            <a href="{{ url('/message') }}">Messages</a>
                        </li> -->
                        <li class="parent1">
                            <a href="{{ url('/user-logout') }}">Logout</a>
                        </li>
                    </ul>
                @else
                    <a href="#" data-toggle="modal" data-target="#login_modal">
                        <img src="{{ asset('images/pf.png') }}" alt="img">
                    </a>
                @endif
            </div>
            <div class="crm_message_dropbox_wrapper">
                <div class="nice-select budge_noti_wrapper" tabindex="0"> <span class="current budge_noti"><i class="flaticon-bell"></i></span>
                    <ul class="list pullDown">
                        <li><a href="#">3 New notifications</a></li>
                        <li>
                            <div class="crm_mess_main_box_wrapper">
                                <div class="crm_mess_img_wrapper">
                                    <img src="{{ asset('images/nt1.jpg') }}" alt="img">
                                </div>
                                <div class="crm_mess_img_cont_wrapper">
                                    <h4>Walking Promises <span>01:30PM</span></h4>
                                    <p>Ava Cornish</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crm_mess_main_box_wrapper">
                                <div class="crm_mess_img_wrapper">
                                    <img src="{{ asset('images/nt2.jpg') }}" alt="img">
                                </div>
                                <div class="crm_mess_img_cont_wrapper">
                                    <h4>Until I Met You <span>01:30PM</span></h4>
                                    <p>diu pokal</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crm_mess_main_box_wrapper">
                                <div class="crm_mess_img_wrapper">
                                    <img src="{{ asset('images/nt3.jpg') }}" alt="img">
                                </div>
                                <div class="crm_mess_img_cont_wrapper">
                                    <h4>merry with you<span>01:30PM</span></h4>
                                    <p>love song</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crm_mess_all_main_box_wrapper">
                                <p><a href="#">See All</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @if(Session::has('userType') == '1')
            <div class="crm_message_dropbox_wrapper">
                <div class="nice-select budge_noti_wrapper"><a href="{{ url('dashboard/message') }}"> <span
                            class="current budge_noti"><i class="flaticon-close-envelope"></i></span></a>
                </div>
            </div>
            @endif
        </div>

        <div class="m24_navigation_wrapper">
            <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <ul class="main_nav_ul">

                    <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">browse <i class="flaticon-down-arrow"></i></a>
                        <ul class="navi_2_dropdown">
                            <li class="parent">
                                <a href="{{ url('artists') }}"><i class="fas fa-caret-right"></i>Artists</a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('top-artists') }}"><i class="fas fa-caret-right"></i>top artists</a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('featured-artists') }}"><i class="fas fa-caret-right"></i>Feature Artists</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('stations') }}" class="gc_main_navigation">radio</a></li>
                    <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">more <i class="flaticon-down-arrow"></i></a>
                        <ul class="navi_2_dropdown">
                            <li class="parent">
                                <a href="{{ url('join') }}"><i class="fas fa-caret-right"></i>Join</a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('about-us') }}"><i class="fas fa-caret-right"></i> About </a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('our-panel') }}"><i class="fas fa-caret-right"></i> Panel </a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('contact-us') }}"><i class="fas fa-caret-right"></i> Contact </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- mainmenu end -->
            <div class="navi_searchbar_wrapper">
                <form method="GET" action="/artists" id="search">                
                <i class="flaticon-magnifying-glass"></i>
                    <input type="text" name="search" id="justAnotherInputBox" placeholder="Search for Artists.." />
                </form>
            </div>
            <div class="d-block d-sm-block d-md-block d-lg-block d-xl-none">
                <div class="search_bar">
                    <div class="res_search_bar" id="search_button"> <i class="fa fa-ellipsis-v"></i>
                    </div>
                    <div id="search_open" class="res_search_box">

                        <!-- <div class="lang_list_wrapper responsive_search_toggle">
                            <a href="#" data-toggle="modal" data-target="#myModal">languages <i class="fas fa-language"></i></a>
                        </div> -->
                        <div class="m24_signin_wrapper responsive_search_toggle">

                            <a href="#" data-toggle="modal" data-target="#login_modal"><img src="{{ asset('images/pf.png') }}" alt="img">
                                <div class="login_top_wrapper"></div>
                            </a>
                        </div>
                        <div class="crm_message_dropbox_wrapper responsive_search_toggle">
                            <div class="nice-select budge_noti_wrapper" tabindex="0"> <span class="current budge_noti"><i class="flaticon-bell"></i></span>
                                <p class="notify_para">notifications</p>

                                <ul class="list">
                                    <li><a href="#">3 New notifications </a>
                                    </li>
                                    <li>
                                        <div class="crm_mess_main_box_wrapper">
                                            <div class="crm_mess_img_wrapper">
                                                <img src="{{ asset('images/nt1.jpg') }}" alt="img">
                                            </div>
                                            <div class="crm_mess_img_cont_wrapper">
                                                <h4>Walking Promises <span>01:30PM</span></h4>
                                                <p>Ava Cornish</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="crm_mess_main_box_wrapper">
                                            <div class="crm_mess_img_wrapper">
                                                <img src="{{ asset('images/nt2.jpg') }}" alt="img">
                                            </div>
                                            <div class="crm_mess_img_cont_wrapper">
                                                <h4>Until I Met You <span>01:30PM</span></h4>
                                                <p>diu pokal</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="crm_mess_main_box_wrapper">
                                            <div class="crm_mess_img_wrapper">
                                                <img src="{{ asset('images/nt3.jpg') }}" alt="img">
                                            </div>
                                            <div class="crm_mess_img_cont_wrapper">
                                                <h4>merry with you<span>01:30PM</span></h4>
                                                <p>love song</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="crm_mess_all_main_box_wrapper">
                                            <p><a href="#">See All</a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="m24_navi_langauage_box">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="lang_list_wrapper d-none d-sm-none d-md-none d-lg-none d-xl-block">
                    <a href="#" data-toggle="modal" data-target="#myModal">languages <i class="fas fa-language"></i></a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- navi wrapper End