<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700);

        body,
        html {
            height: 100%;
            margin: 0;
            /* Asegura que no haya margen en el body */
        }

        body {
            font-family: 'Open Sans';
            font-weight: 100;
            display: flex;
            flex-direction: column;
            /* Cambiado a columna para centrar el contenido */
            justify-content: center;
            /* Centra verticalmente */
            align-items: center;
            /* Centra horizontalmente */
            overflow: hidden;
        }

        .login-form {
            min-height: 10rem;
            margin-bottom: 10%;
            margin-top: 10px;
            max-width: 50%;
            padding: .5rem;
            display: flex;
            /* Cambiado a flex */
            flex-direction: column;
            /* Alinea los elementos en columna */
            align-items: center;
            /* Centra los elementos horizontalmente */
        }

        .login-text {
            color: white;
            font-size: 1.5rem;
            margin: 0 auto;
            max-width: 50%;
            padding: .5rem;
            text-align: center;
        }

        .login-text img {
            max-width: 100%;
            /* Asegura que la imagen no exceda el ancho del contenedor */
            height: auto;
            /* Mantiene la proporción de la imagen */
            vertical-align: middle;
            /* Alinea verticalmente la imagen con el texto */
        }

        .login-username,
        .login-password {
            background: rgba(255, 255, 255, 0.35);
            border: 0 solid;
            border-bottom: 1px solid white;
            color: white;
            display: block;
            margin: 1rem;
            padding: .5rem;
            transition: 250ms background ease-in;
            width: calc(100% - 3rem);
        }

        .login-username:focus,
        .login-password:focus {
            background: white;
            color: black;
        }

        .login-forgot-pass {
            bottom: 0;
            color: white;
            cursor: pointer;
            display: block;
            font-size: 75%;
            left: 0;
            opacity: 0.6;
            padding: .5rem;
            position: absolute;
            text-align: center;
        }

        .login-forgot-pass:hover {
            opacity: 1;
        }

        .login-submit {
            border: 1px solid white;
            background: transparent;
            color: white;
            display: block;
            margin: 1rem auto;
            padding: .25rem;
        }

        .login-submit:hover,
        .login-submit:focus {
            background: white;
            color: black;
        }

        [class*=underlay] {
            left: 0;
            min-height: 100%;
            min-width: 100%;
            position: fixed;
            top: 0;
            z-index: -1;
            /* Asegura que las capas de fondo estén detrás del contenido */
        }

        .underlay-photo {
            background: url('../static/auth/login-banner-2.png');
            background-size: cover;

            z-index: -1;
        }

        .underlay-black {
            background: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }

        #texto_motivacional {
            text-align: center;
            font-size: clamp(0.4rem, 3vw, 0.8rem);
            background-color: rgba(226, 233, 243, 0.3);
            color: white;
            font-style: italic;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            width: auto;
            /* Asegura que no afecte el ancho del contenedor */
            display: none;
            /* Cambiado de inline-block */
        }
    </style>
</head>

<body>
    <div class="card" style="background: rgba(255, 255, 255, 0.35); border-radius: 20px; margin-top: 10%;">
        <div class="card-body" style="padding: 40px">
            <img src="{{ asset('../static/logo-system.png') }}" style="width: 100%; height: 6rem;">
        </div>
    </div>
    <form method="POST" action="{{ route('login') }}" class="login-form" novalidate>
        @csrf
        <div style="background-color: rgba(255,255,255,0.4); padding: 25px; border-radius: 10px;">
            <p class="login-text">
                <span class="fa-stack fa-lg">
                    <img style="border-radius: 100px;" src="{{ asset('../static/auth/user-icon.png') }}" alt="">
                </span>
            </p>
            <x-validation-errors class="mb-4" />
            <input id="email" type="email" name="email" class="login-username" value="{{ old('email') }}" autocomplete="off" placeholder="Email" required />
            <input id="password" type="password" name="password" class="login-password" placeholder="Contraseña" autocomplete="off" required />
            <input type="submit" name="Login" value="{{ __('Acceder') }}" class="login-submit" style="padding-left:.5rem; padding-right:.5rem;" />
        </div>
        <span id="texto_motivacional"></span>
    </form>

    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>

    <script src="{{ asset('../customjs/scripts/phrases.js') }}"></script>
</body>

</html>