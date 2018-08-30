@include('layout.header')   

<body>
	
	@if(Session::has('global'))

		{{ Session::get('global') }}

    @endif	
		
		
	@yield('content')


	@yield('footer_scripts')
