<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="{{ asset('cuba/assets/images/logo/logo.png') }}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="sliders"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper pl-0">
            <ul class="horizontal-menu">
                <li class="mega-menu outside d-block d-md-none">
                    <a class="nav-link" href="#" data-toggle="modal" data-original-title="test"
                        data-target="#logOutModal">
                        <i data-feather="log-out"></i>
                        <span>
                            Log out
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Dark Mode">
                            <i data-feather="moon"></i>
                        </a>
                    </div>
                </li>
                <li class="maximize">
                    <a data-toggle="tooltip" data-placement="bottom" title="Full Screen" class="text-dark"
                        href="#!" onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <li class="profile-nav onhover-dropdown p-0 ml-2 mr-0">
                    <div class="media profile-media">
                        <img class="b-r-10"
                            src="https://source.boringavatars.com/beam/120/?square&colors=FAD089,FF9C5B,F5634A,ED303C,3B8183"
                            width="40px">
                        <div class="media-body">
                            <span>Hapiz</span>
                            <p class="mb-0 font-roboto">Admin
                                <i class="middle fa fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ route('my-profile') }}" data-original-title="" title="">
                                <i data-feather="user"></i>
                                <span>Account </span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-original-title="Log Out"
                                data-target="#logOutModal">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- <button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test"
    data-target="#logOutModal">Simple</button> --}}

<div class="modal fade" id="logOutModal" tabindex="-1" role="dialog" aria-labelledby="logOutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logOutModalLabel">Yakin ingin mengakhiri sesi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                Pilih "Keluar" untuk mengakhiri sesi.
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-secondary" type="submit" form="logout-form">Keluar</button>
            </div>
        </div>
    </div>
</div>
