<div id="sidebar">
    <div id="vueSidebar">
        <div class="inner">
            <!-- Menu -->
            <nav id="menu">
                <header class="major">
                    <h2>@lang('app.menu')</h2>
                </header>
                <ul>
                    <li><a href="{{route('contacts.index')}}">@lang('app.my_contacts')</a></li>
                    <li><a href="{{route('contacts.create')}}">@lang('app.new_contact')</a></li>
                    <li><a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">@lang('app.logout')</a></li>
                    <!-- <li><a href="">Generic</a></li>
                                <li><a href="elements.php">Elements</a></li>
                                <li>
                                    <span class="opener">Submenu</span>
                                    <ul>
                                        <li><a href="#">Lorem Dolor</a></li>
                                        <li><a href="#">Ipsum Adipiscing</a></li>
                                        <li><a href="#">Tempus Magna</a></li>
                                        <li><a href="#">Feugiat Veroeros</a></li>
                                    </ul>
                                </li> -->
                </ul>
            </nav>

            <!-- Section -->
            <section style="margin-top: 15% !important;">
                <header class="major">
                    <h2>@lang('app.dev')</h2>
                </header>
                <ul class="contact">
                    <li class="icon solid fa-user">João Vitor Silva</li>
                    <li class="icon solid fa-envelope">joao.silva1165@etec.sp.gov.br</li>
                    <li class="icon solid fa-phone">(16) 99278-1530</li>
                    <li class="icon solid fa-home">Franca - SP
                </ul>
            </section>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Footer
                        <footer id="footer">
                            <p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
                        </footer> -->

        </div>
    </div>
</div>
