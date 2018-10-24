<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_mytoken" content="{{csrf_token()}}" />
	<!-- Favicon icon -->
	<link rel="icon" type="image/x-icon" sizes="16x16" href="{{ ('public/assets/images/favicon.ico') }}">
	<title>{{ config('app.name') }}</title>
	<link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<!-- Custom CSS -->
	<!-- Sweet Alert -->
	<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
	<!-- Select2 -->
	<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/plugins/charts/modernizr.min.js') }}"></script>

	@yield('styles')
</head>

<body>
	@if((new Jenssegers\Agent\Agent)->isMobile() || (new Jenssegers\Agent\Agent)->isTablet())
	@include('supplier.layouts.supplierheader-mobile')
	@else
	@include('supplier.layouts.supplierheader')
	@endif
	@yield('content')

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog" id="modal-data">

		</div>
	</div>

	<!-- Bootstrap JavaScript -->
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap.js') }}"></script>

	<!-- Select2 -->
	<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
	<!-- Sweet-Alert  -->
	<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
	<!-- Notification js -->
	{{-- <script src="{{ asset('assets/plugins/notifications/notify.min.js') }}"></script> --}}
	<script src="{{ asset('assets/plugins/notifications/notify.js') }}"></script>
	<script src="{{ asset('assets/plugins/notifications/notify-metro.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	@yield('scripts')
	<script>
		function validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(String(email).toLowerCase());
		}

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;

			return true;
		}

		$(document).ready(function() {
			@if(Session::has('notify-success'))
			$.Notification.notify('success','top right','Success', '{{ Session::get('notify-success') }}');
			@endif
			@if(Session::has('notify-error'))
			$.Notification.notify('error','top right','Error', '{{ Session::get('notify-error') }}');
			@endif
			$('.datepicker').datepicker({
				autoclose: true,
				todayHighlight: true
			});

			$('.sm-select').select2({
				placeholder: "Assign To User",
				allowClear: true
			});

			$("#menu-close").click(function(e) {
				e.preventDefault();
				$("#sidebar-wrapper").toggleClass("active");
			});

			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#sidebar-wrapper").toggleClass("active");
			});
		});
	</script>

	@if((new Jenssegers\Agent\Agent)->isDesktop())
	<script type="text/javascript">

		/*****Content scroll with auto scroll with calc height***************/
		var window_height = $(window).height(),
		content_height = window_height - 300;

		$('.content-fix').height(content_height);

		$( window ).resize(function() {
			var window_height = $(window).height(),
			content_height = window_height - 300;
			$('.content-fix').height(content_height);
		});
	</script>
	@endif

</body>
</html>