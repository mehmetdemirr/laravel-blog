@extends('layouts.auth')

@section('title')
Login
@endsection

@section('css')

@endsection

@section('content')
<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">

    </div>
    <div class="app-auth-container">
        <div class="logo">
            <a href="index.html">Neptune</a>
        </div>
        <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="sign-up.html">Sign Up</a></p>

        <form action="{{ route("login") }}" method="POST">
            @csrf 
            @if($errors->any()) 
                @foreach($errors->all() as $key => $error)
                    <div class="alert alert-danger"> {{ $error }}</div>
                @endforeach
            @endif
            <div class="auth-credentials m">
                <label for="signInEmail" class="form-label">Email</label>
                <input type="email" 
                class="form-control m-b-md" 
                id="signInEmail" name="email" 
                aria-describedby="signInEmail"
                placeholder="example@neptune.com"
                value="{{ old("email") }}">

                <label for="signInPassword" class="form-label">Parola</label>
                <input type="password"
                class= "form-control"
                id="signInPassword"
                name="password"
                aria-describedby="signInPassword"
                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

                <div class="form-check mt-3">
                    <input class="form-check-input" 
                    type="checkbox"
                    value="1"
                    id="remember"
                    name="remember"
                    {{ old("remember") ? "checked" : ""}}>
                    <label class="form-check -label" for="remember"> 
                    Beni hatırla
                    </label>
                </div>

            </div>
    
            <div class="auth-submit">
                <button class="btn btn-primary" type="submit">Giriş Yap</button>
                <a href="#" class="auth-forgot-password float-end">Şifremi unuttum?</a>
            </div>
            
        </form>

        <div class="divider"></div>
        <div class="auth-alts">
            <a href="#" class="auth-alts-google"></a>
            <a href="#" class="auth-alts-facebook"></a>
            <a href="#" class="auth-alts-twitter"></a>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection