@include('layout.header')   

    <div id="app">
    	@include('layout.navigation')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

		
@include('layout.footer')

	  
