<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mizoram Tourism</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Playfair+Display:wght@700&family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
  <link rel="icon" href="{{ url('/favicon.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @livewireStyles
  @yield('styles')
  @stack('styles')
  <style scoped>
    .hoverable {
      position: static;
    }

    .hoverable > a:after {
      content: url("data:image/svg+xml; utf8, <svg width='24' height='24' viewBox='0 0 24 24' fill='white' xmlns='http://www.w3.org/2000/svg'><pathd='M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z' fill='white'/></svg>");
      font-size: 20px;
      padding-left: 6px;
      position: relative;
      top: -1px;
    }

    .hoverable:hover .mega-menu {
      display: block;
    }

    .mega-menu {
      display: none;
      left: 0;
      position: absolute;
      text-align: left;
      width: 100%;
      z-index: 100;
    }

    /* #toggle Class Styles
      –––––––––––––––––––––––––––––––––––––––––––––––––– */

    .toggleable > label:after {
      content: "\25BC";
      font-size: 10px;
      padding-left: 6px;
      position: relative;
      top: -1px;
    }

    .toggle-input {
      display: none;
    }
    .toggle-input:not(checked) ~ .mega-menu {
      display: none;
    }

    .toggle-input:checked ~ .mega-menu {
      display: block;
    }

    .toggle-input:checked + label {
      color: white;
      background: #2c5282; /*@apply bg-blue-800 */
    }

    .toggle-input:checked ~ label:after {
      content: "\25B2";
      font-size: 10px;
      padding-left: 6px;
      position: relative;
      top: -1px;
    }
    .icons8-menu { 
      display: inline-block;
      width: 64px;
      height: 64px;
      background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iNjQiIGhlaWdodD0iNjQiCnZpZXdCb3g9IjAgMCA2NCA2NCIKc3R5bGU9IiBmaWxsOiNmZmZmZmY7Ij48bGluZWFyR3JhZGllbnQgaWQ9IkJUcTcyU2NhVFoxVUJtVDhvbW8ycGFfNDQwMjRfZ3IxIiB4MT0iMzIiIHgyPSIzMiIgeTE9IjUuMzMzIiB5Mj0iNTkuODY3IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgc3ByZWFkTWV0aG9kPSJyZWZsZWN0Ij48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiMxYTZkZmYiPjwvc3RvcD48c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiNjODIyZmYiPjwvc3RvcD48L2xpbmVhckdyYWRpZW50PjxwYXRoIGZpbGw9InVybCgjQlRxNzJTY2FUWjFVQm1UOG9tbzJwYV80NDAyNF9ncjEpIiBkPSJNMzIsNThDMTcuNjYzLDU4LDYsNDYuMzM3LDYsMzJTMTcuNjYzLDYsMzIsNnMyNiwxMS42NjMsMjYsMjZTNDYuMzM3LDU4LDMyLDU4eiBNMzIsOCBDMTguNzY3LDgsOCwxOC43NjcsOCwzMnMxMC43NjcsMjQsMjQsMjRzMjQtMTAuNzY3LDI0LTI0UzQ1LjIzMyw4LDMyLDh6Ij48L3BhdGg+PGxpbmVhckdyYWRpZW50IGlkPSJCVHE3MlNjYVRaMVVCbVQ4b21vMnBiXzQ0MDI0X2dyMiIgeDE9IjMyIiB4Mj0iMzIiIHkxPSI1LjMzMyIgeTI9IjU5Ljg2NyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHNwcmVhZE1ldGhvZD0icmVmbGVjdCI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWE2ZGZmIj48L3N0b3A+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjYzgyMmZmIj48L3N0b3A+PC9saW5lYXJHcmFkaWVudD48cGF0aCBmaWxsPSJ1cmwoI0JUcTcyU2NhVFoxVUJtVDhvbW8ycGJfNDQwMjRfZ3IyKSIgZD0iTTMyLDUyYy0xMS4wMjgsMC0yMC04Ljk3Mi0yMC0yMHM4Ljk3Mi0yMCwyMC0yMHMyMCw4Ljk3MiwyMCwyMFM0My4wMjgsNTIsMzIsNTJ6IE0zMiwxNCBjLTkuOTI1LDAtMTgsOC4wNzUtMTgsMThzOC4wNzUsMTgsMTgsMThzMTgtOC4wNzUsMTgtMThTNDEuOTI1LDE0LDMyLDE0eiI+PC9wYXRoPjxsaW5lYXJHcmFkaWVudCBpZD0iQlRxNzJTY2FUWjFVQm1UOG9tbzJwY180NDAyNF9ncjMiIHgxPSIzMiIgeDI9IjMyIiB5MT0iMjEuNSIgeTI9IjI2LjMzNiIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHNwcmVhZE1ldGhvZD0icmVmbGVjdCI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjNmRjN2ZmIj48L3N0b3A+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjZTZhYmZmIj48L3N0b3A+PC9saW5lYXJHcmFkaWVudD48cGF0aCBmaWxsPSJ1cmwoI0JUcTcyU2NhVFoxVUJtVDhvbW8ycGNfNDQwMjRfZ3IzKSIgZD0iTTQyLDI1YzAsMC41NTItMC40NDgsMS0xLDFIMjNjLTAuNTUyLDAtMS0wLjQ0OC0xLTF2LTJjMC0wLjU1MiwwLjQ0OC0xLDEtMWgxOCBjMC41NTIsMCwxLDAuNDQ4LDEsMVYyNXoiPjwvcGF0aD48bGluZWFyR3JhZGllbnQgaWQ9IkJUcTcyU2NhVFoxVUJtVDhvbW8ycGRfNDQwMjRfZ3I0IiB4MT0iMzIiIHgyPSIzMiIgeTE9IjI5LjMzMyIgeTI9IjM0LjUiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiBzcHJlYWRNZXRob2Q9InJlZmxlY3QiPjxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iIzZkYzdmZiI+PC9zdG9wPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iI2U2YWJmZiI+PC9zdG9wPjwvbGluZWFyR3JhZGllbnQ+PHBhdGggZmlsbD0idXJsKCNCVHE3MlNjYVRaMVVCbVQ4b21vMnBkXzQ0MDI0X2dyNCkiIGQ9Ik00MiwzM2MwLDAuNTUyLTAuNDQ4LDEtMSwxSDIzYy0wLjU1MiwwLTEtMC40NDgtMS0xdi0yYzAtMC41NTIsMC40NDgtMSwxLTFoMTggYzAuNTUyLDAsMSwwLjQ0OCwxLDFWMzN6Ij48L3BhdGg+PGxpbmVhckdyYWRpZW50IGlkPSJCVHE3MlNjYVRaMVVCbVQ4b21vMnBlXzQ0MDI0X2dyNSIgeDE9IjMyIiB4Mj0iMzIiIHkxPSIzNyIgeTI9IjQxLjMzNyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHNwcmVhZE1ldGhvZD0icmVmbGVjdCI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjNmRjN2ZmIj48L3N0b3A+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjZTZhYmZmIj48L3N0b3A+PC9saW5lYXJHcmFkaWVudD48cGF0aCBmaWxsPSJ1cmwoI0JUcTcyU2NhVFoxVUJtVDhvbW8ycGVfNDQwMjRfZ3I1KSIgZD0iTTQyLDQxYzAsMC41NTItMC40NDgsMS0xLDFIMjNjLTAuNTUyLDAtMS0wLjQ0OC0xLTF2LTJjMC0wLjU1MiwwLjQ0OC0xLDEtMWgxOCBjMC41NTIsMCwxLDAuNDQ4LDEsMVY0MXoiPjwvcGF0aD48L3N2Zz4=') 50% 50% no-repeat;
      background-size: 100%;
      }

      .location::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/location.png');
        background-size: contain;
        background-repeat: no-repeat;
      }

      .phone::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/phone.png');
        background-size: contain;
        background-repeat: no-repeat;
      }

      .mail::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/mail.png');
        background-size: contain;
        background-repeat: no-repeat;
      }
		</style>
</head>
<body class="text-light-gray">
  <x-jet-banner/>
  @livewire('front.navigation-bar')
  @yield('header')
  @yield('contents')
  @include('layouts.footer')
  @yield('scripts')
  @livewireScripts
  @stack('scripts')
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>