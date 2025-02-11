<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../" />
	<title>Polipiknik - Login</title>
	<meta charset="utf-8" />
	<meta name="description" content="." />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Keenthemes | Metronic" />
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="{{ asset('/') }}assets/media/logos/icon.png" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="{{ asset('/') }}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/') }}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank" style="font-family: Inter">
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Body-->
			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
				<!--begin::Form-->
				<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<!--begin::Wrapper-->
					<div class="w-lg-600px w-400px p-10">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
							action="{{ route('login.auth') }}">
							@csrf
							<!--begin::Heading-->
							<center>
								<img alt="Logo" src="{{ asset('/') }}assets/media/logos/logo-dark.png"
									class="h-100px h-lg-100px" />
							</center>
							<!--begin::Heading-->
							<!--begin::Separator-->
							<div class="separator separator-content my-14">
								<span class="w-125px text-gray-500 fw-semibold" style="font-size: 12pt !important">Masuk
									ke akun Anda</span>
							</div>
							<!--end::Separator-->
							<!--begin::Input group=-->
							<div class="fv-row mb-8" style="font-size: 14pt !important">
								<!--begin::Email-->
								<input type="text" placeholder="Username" name="username" autocomplete="off"
									class="form-control bg-transparent" style="font-size: 12pt !important" />
								<!--end::Email-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-3" style="font-size: 14pt !important">
								<!--begin::Password-->
								<input type="password" placeholder="Password" name="password" autocomplete="off"
									class="form-control bg-transparent" style="font-size: 12pt !important" />
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
							</div>
							<!--end::Wrapper-->
							<!--begin::Submit button-->
							<div class="d-grid mb-10">
								<button type="submit" class="btn btn-primary">
									<!--begin::Indicator label-->
									<span class="indicator-label">Masuk</span>
									<!--end::Indicator label-->
								</button>
							</div>
							<!--end::Submit button-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Form-->
			</div>
			<!--end::Body-->
			<!--begin::Aside-->
			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
				style="background-image: url({{ asset('/') }}assets/media/misc/bg-authx.png)">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
					<!--begin::Logo-->
					<a href=".{{route('dashboard')}}" class="mb-0 mb-lg-12">
						<img alt="Logo" src="{{ asset('/') }}assets/media/logos/logo.png" class="h-25px h-lg-50px" />
					</a>
					<!--end::Logo-->
					<!--begin::Image-->
					{{-- <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
						src="{{ asset('/') }}assets/media/misc/bg-auth2.png" alt="" /> --}}
					<!--end::Image-->
					<!--begin::Title-->
					<h2 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-2"
						style="font-family: Courgette">Polipiknik</h2>
					<h2 class="text-white">---</h2>

					<!--end::Title-->
					<!--begin::Text-->
					<!--end::Text-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Aside-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>
	<!--end::Root-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "{{ asset('/') }}assets/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="{{ asset('/') }}assets/plugins/global/plugins.bundle.js"></script>
	<script src="{{ asset('/') }}assets/js/scripts.bundle.js"></script>
	@if($x = Session::get('success'))
	<script type="text/javascript">
		$(function() {
				Swal.fire({
					text: '{{ $x }}',
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			})
	</script>
	@elseif($x = Session::get('error'))
	<script type="text/javascript">
		$(function() {
				Swal.fire({
					text: '{{ $x }}',
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			})      
	</script>
	@endif
	<!--end::Global Javascript Bundle-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>