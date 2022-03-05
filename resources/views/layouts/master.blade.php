<!DOCTYPE html>
<html>
    
    <!-- Header. -->
    @component('parts.header', ['title' => $title, 'backgroundImagePath' => $backgroundImagePath])
    @endcomponent

    <!-- Body start -->
    <body>
        <div class="overflow-hidden -z-10 w-screen h-screen dynamic-background">
            <div class="backdrop-blur-lg z-0 w-screen h-screen ">
                <div class="bg-white/60 w-full h-full z-0">
                    <!-- TODO: Sidebar Navbar -->
                    @component('parts.navbar')
                    @endcomponent
                    <div class="olssonweb-content">
                        <!-- Content -->
                        @yield('body')
                    </div>

                    <div class="absolute bottom-0 right-0 overflow-hidden z-10 group">
                        <div class="inline-block w-full align-bottom">
                            <div class="inline-block float-right px-4">
                                <div class="justify-center text-center mb-1.5">
                                    <span class="fa-solid fa-angles-up"></span>
                                </div>
                                <div class="bg-white px-2 py-1 rounded-t-md border-x-2 border-t-2 border-red-400">
                                    <span class="fa-solid fa-laptop-code inline-block"></span>
                                    <p class="inline-block">Console</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white w-96 h-0 group-hover:h-64 transition-all duration-100 shadow-lg block border-t-8 border-red-400 rounded-tl-xl">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Footer. -->
    @component('parts.footer')
    @endcomponent

</html>