<div class="bg-light shadow-sm d-flex align-items-center justify-content-between fixed-top" id="navbar_top"
    style="height: 80px;padding:0 2rem ">

    <header class="header">
        <div class="container-header">
            <div class="logo">
                <div class="shrink-0 d-flex align-items-center justify-content-center "style="padding-right:2rem">
                    <a href="/" class="nav-link">
                        <x-application-logo style="width: 4rem;height: 4rem" />
                    </a>
                    <a class="mx-2 nav-link" href="/">
                        <h3>TREE ONE</h3>
                    </a>
                </div>
            </div>
            <nav class="menu">
                <div class="head">
                    <div class="logo">
                        <div
                            class="shrink-0 d-flex align-items-center justify-content-center "style="padding-right:2rem">
                            <a href="/" class="nav-link">
                                <x-application-logo style="width: 4rem;height: 4rem" />
                            </a>
                            <a class="mx-2 nav-link" href="/">
                                <h3>TREE ONE</h3>
                            </a>
                        </div>
                    </div>
                    <div type="button">
                        <svg viewBox="0 0 24 24" fill="none" class="close-menu" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M8.46967 8.46972C8.76256 8.17683 9.23744 8.17683 9.53033 8.46972L12 10.9394L14.4697 8.46973C14.7626 8.17684 15.2374 8.17684 15.5303 8.46973C15.8232 8.76262 15.8232 9.2375 15.5303 9.53039L13.0607 12.0001L15.5303 14.4697C15.8232 14.7626 15.8232 15.2375 15.5303 15.5304C15.2374 15.8233 14.7626 15.8233 14.4697 15.5304L12 13.0607L9.53034 15.5304C9.23744 15.8233 8.76257 15.8233 8.46968 15.5304C8.17678 15.2375 8.17678 14.7626 8.46968 14.4697L10.9393 12.0001L8.46967 9.53038C8.17678 9.23749 8.17678 8.76262 8.46967 8.46972Z"
                                    fill="#000000"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.31673 3.76882C10.4043 3.42374 13.5957 3.42374 16.6832 3.76882C18.5096 3.97294 19.9845 5.41159 20.1994 7.24855C20.5686 10.4055 20.5686 13.5947 20.1994 16.7516C19.9845 18.5885 18.5096 20.0272 16.6832 20.2313C13.5957 20.5764 10.4043 20.5764 7.31673 20.2313C5.49035 20.0272 4.01545 18.5885 3.8006 16.7516C3.43137 13.5947 3.43137 10.4055 3.8006 7.24855C4.01545 5.41159 5.49035 3.97294 7.31673 3.76882ZM16.5166 5.25954C13.5398 4.92683 10.4602 4.92683 7.48334 5.25954C6.33891 5.38744 5.42286 6.29069 5.29045 7.4228C4.93476 10.4639 4.93476 13.5362 5.29045 16.5773C5.42286 17.7094 6.33891 18.6127 7.48334 18.7406C10.4602 19.0733 13.5398 19.0733 16.5166 18.7406C17.6611 18.6127 18.5771 17.7094 18.7095 16.5773C19.0652 13.5362 19.0652 10.4639 18.7095 7.4228C18.5771 6.29069 17.6611 5.38744 16.5166 5.25954Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                    </div>
                </div>
                <ul>
                    <li><a href="/"
                            class="nav-link @if (request()->is('/')) {{ 'active' }} @endif">HOME</a></li>
                    <li class="dropdown nav-link @if (request()->routeIs('product')) {{ 'active' }} @endif "><a
                            href="/product">PRODUCT</a>
                        <ul class="sub-menu bg-light">
                            <li><a href="#"><span>product1</span></a></li>
                            <li class="dropdown"><a href="#"><span>product1</span></a><i
                                    class="fa-solid fa-chevron-down"></i>
                                <ul class="sub-menu sub-menu-right">
                                    <li><a href="#"><span>1.1product</span></a></li>
                                    <li><a href="#"><span>1.1product</span></a></li>

                                </ul>
                            </li>
                            <li><a href="#"><span>product1</span></a></li>

                        </ul>

                    </li>
                    <li><a href="{{ route('blog') }}"
                            class="nav-link @if (request()->routeIs('blog')) {{ 'active' }} @endif ">BLOG</a></li>
                    <li><a href="/about" class="nav-link">ABOUT</a></li>
                </ul>
            </nav>
            <div class="header-right">


                <a href="/cart">
                    <div class="cart-btn icon-btn" style="position: relative">
                        <div class="cart__quantity--number "
                            style="position: absolute;font-size: 16px;font-weight: 500;left: 0.9rem;bottom: -0.8rem ;background-color: #4a7246;padding:  0 8px;width: fit-content;height: fit-content; border-radius: 100%">
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="width: 2.5rem;height: 2.5rem;">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M16 8H17.1597C18.1999 8 19.0664 8.79732 19.1528 9.83391L19.8195 17.8339C19.9167 18.9999 18.9965 20 17.8264 20H6.1736C5.00352 20 4.08334 18.9999 4.18051 17.8339L4.84718 9.83391C4.93356 8.79732 5.80009 8 6.84027 8H8M16 8H8M16 8L16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7L8 8M16 8L16 12M8 8L8 12"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </div>

                </a>

                <div class="search-btn icon-btn" id="account-login">
                    @if (Auth::user() == null)
                        <a href="{{ route('login') }}" class="nav-link link-body-emphasis px-2">
                            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                style="width: 2rem;height: 2rem">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M16 7.992C16 3.58 12.416 0 8 0S0 3.58 0 7.992c0 2.43 1.104 4.62 2.832 6.09.016.016.032.016.032.032.144.112.288.224.448.336.08.048.144.111.224.175A7.98 7.98 0 0 0 8.016 16a7.98 7.98 0 0 0 4.48-1.375c.08-.048.144-.111.224-.16.144-.111.304-.223.448-.335.016-.016.032-.016.032-.032 1.696-1.487 2.8-3.676 2.8-6.106zm-8 7.001c-1.504 0-2.88-.48-4.016-1.279.016-.128.048-.255.08-.383a4.17 4.17 0 0 1 .416-.991c.176-.304.384-.576.64-.816.24-.24.528-.463.816-.639.304-.176.624-.304.976-.4A4.15 4.15 0 0 1 8 10.342a4.185 4.185 0 0 1 2.928 1.166c.368.368.656.8.864 1.295.112.288.192.592.24.911A7.03 7.03 0 0 1 8 14.993zm-2.448-7.4a2.49 2.49 0 0 1-.208-1.024c0-.351.064-.703.208-1.023.144-.32.336-.607.576-.847.24-.24.528-.431.848-.575.32-.144.672-.208 1.024-.208.368 0 .704.064 1.024.208.32.144.608.336.848.575.24.24.432.528.576.847.144.32.208.672.208 1.023 0 .368-.064.704-.208 1.023a2.84 2.84 0 0 1-.576.848 2.84 2.84 0 0 1-.848.575 2.715 2.715 0 0 1-2.064 0 2.84 2.84 0 0 1-.848-.575 2.526 2.526 0 0 1-.56-.848zm7.424 5.306c0-.032-.016-.048-.016-.08a5.22 5.22 0 0 0-.688-1.406 4.883 4.883 0 0 0-1.088-1.135 5.207 5.207 0 0 0-1.04-.608 2.82 2.82 0 0 0 .464-.383 4.2 4.2 0 0 0 .624-.784 3.624 3.624 0 0 0 .528-1.934 3.71 3.71 0 0 0-.288-1.47 3.799 3.799 0 0 0-.816-1.199 3.845 3.845 0 0 0-1.2-.8 3.72 3.72 0 0 0-1.472-.287 3.72 3.72 0 0 0-1.472.288 3.631 3.631 0 0 0-1.2.815 3.84 3.84 0 0 0-.8 1.199 3.71 3.71 0 0 0-.288 1.47c0 .352.048.688.144 1.007.096.336.224.64.4.927.16.288.384.544.624.784.144.144.304.271.48.383a5.12 5.12 0 0 0-1.04.624c-.416.32-.784.703-1.088 1.119a4.999 4.999 0 0 0-.688 1.406c-.016.032-.016.064-.016.08C1.776 11.636.992 9.91.992 7.992.992 4.14 4.144.991 8 .991s7.008 3.149 7.008 7.001a6.96 6.96 0 0 1-2.032 4.907z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                    @else
                        <div class="dropdown p-2">
                            <a href="#" class="d-block link-dark text-decoration-none  " id="dropdownUser1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div>

                                    <img src="{{ asset('img/animal_avatar/' . Auth::user()->avatar . '.png') }}"
                                        alt="{{ asset('img/animal_avatar/' . Auth::user()->avatar . '.png') }}"
                                        width="40" height="40" class="rounded-circle">
                                </div>

                            </a>
                            <ul class="dropdown-menu text-small dropdown-menu-end my-3"
                                aria-labelledby="dropdownUser1" style="right: 0">
                                @if (Auth::user()->is_admin == 1)
                                    <li><a class="dropdown-item"href="{{ route('admin.home') }}">Manager</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.index') }}">Ordered List</a></li>
                                <li><a class="dropdown-item" href="{{ route('awishlist') }}">WishList</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <button type="button" class="open-menu-btn">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M20 8H11M20 12H4M4 12L7 9M4 12L7 15M20 16H11" stroke="#000000"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </header>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('navbar_top').classList.add('fixed-top');
        navbar_height = document.querySelector('#navbar_top').offsetHeight;
        const main_content = document.querySelector('#main_content')
        main_content.style.paddingTop = navbar_height + 'px';

        // nav-bar
        // const underlineTagA = document.querySelector('.nav-bar').querySelector('li').querySelector('a');
        // const menu = document.querySelector('.menu');
        // // const underlineAfter window.getComputedStyle(undelineTagA, '::after');
        // menu.addEventListener('click', function(e) {
        //     // Lấy các thuộc tính đã tính toán cho pseudo-element ::after của thẻ a
        //     const underlineAfter = getComputedStyle(underlineTagA, '::after');

        //     // Thay đổi chiều rộng của pseudo-element ::after thành 100%
        //     underlineAfter.setProperty('width', '100%');
        // });
        const menu = document.querySelector('.menu');
        const openMenuBtn = document.querySelector('.open-menu-btn');
        const closeMenuBtn = document.querySelector('.close-menu');
        const chat = document.querySelector('#chat_box');
        [openMenuBtn, closeMenuBtn].forEach(
            btn => {
                btn.addEventListener("click", () => {

                    menu.classList.toggle('open');
                    menu.style.transition = "transform 0.5s ease";
                    if (menu.classList.contains("open")) {

                        chat.style.display = "none";
                    } else {
                        chat.style.display = "block";
                    }
                })
            });

        // menu.addEventListener('transitionend', function() {
        //     this.removeAttribute('style')
        // })
        // menu.querySelectorAll('.dropdown > a').forEach((arrow) => {
        //     arrow.addEventListener('click', function() {
        //         this.closest(".dropdown").classList.toggle('active')
        //     })
        // })
        // menu.querySelectorAll('.dropdown > i').forEach((arrow) => {
        //     arrow.addEventListener('click', function() {
        //         this.closest(".dropdown").classList.toggle('active')
        //     })
        // })
        const btn_account = document.querySelector('#account-login');
        const menu_login = document.querySelector('.menu-login');
        btn_account.addEventListener('click', function() {
            menu_login.classList.toggle('active')
        })
    });
</script>
