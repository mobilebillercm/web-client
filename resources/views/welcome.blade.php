@extends('layouts.app')
@section('title', 'MOBILEBILEER/LOGIN')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">
                    <h1 class="text-white">WE’RE <br /> CREATIVE DESIGNERS!</h1>
                </div>

                <div class="home_btns m-top-40">
                    <a href="{{url('/login')}}">Login</a>
                    <a href="{{url('/login')}}">Register</a>
                </div>

            </div>
        </div><!--End off row-->
    </div><!--End off container -->
@endsection