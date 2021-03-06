<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SISVDA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

        {{-- script --}}
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
			<script>
					 grecaptcha.ready(function() {
						 grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'DescargarDocumento'}).then(function(token) {
							if (token) {
							  document.getElementById('recaptcha').value = token;
							}
						 });
					 });
		</script>
    </head>
    <body>
        @if (session('mensaje'))
            <div class="alert">
                {{session('mensaje')}}
            </div>
         @endif

        {{-- sub menu login --}}
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links d-flex">
                    @auth
                        <a href="{{ url('/home') }}">Listado de documentos</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        {{--  @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrar</a>
                        @endif  --}}
                    @endauth
                </div>
            @endif
        </div>


        <img class="wave" src="{{ asset('img/wave.png') }}">
        <img class="wavesmall" src="{{ asset('img/wave2.png') }}">
        <div class="divtitle">
            <h1>Sistema de verificación de documentos académicos</h1>
        </div>

        {{-- body --}}
        <div class="container">
            <div class="img">
                <img src="{{ asset('img/bg.svg') }}">
            </div>
            <div class="login-content">
                <form target="_blank" action="{{route('descargarpdf')}}" method="post">
                    @csrf
                    @error('codigohash')
                        <div class="alert">
                            Ingrese un código, no deje vacío el campo
                        </div>
                    @enderror
                    <img src="{{ asset('img/Candado.png') }}">
                    <h2>Para descargar un documento ingrese el código respectivo</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                                <h5>Código</h5>
                                <input type="text" class="input" name="codigohash">
                        </div>
                    </div>
                    <input type="hidden" name="recaptcha" id="recaptcha">
                    <p align="center"><button class="btn">Descargar</button></p>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    </body>
</html>
