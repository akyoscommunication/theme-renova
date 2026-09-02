@extends('layouts.app')

@section('content')

  <div class="page-not-found container">
    <h1>La page est introuvable</h1>
    <p>Vous avez pris un raccourci... qui ne mène nulle part, <br> {{ $siteName }}</p>

    <x-button href="/" appearance="primary">
      Retour à l'accueil
    </x-button>
  </div>

@endsection
