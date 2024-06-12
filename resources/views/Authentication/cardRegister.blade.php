@extends('Authentication.layouts')

@section('card')
<div class="form-bg d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form class="form-horizontal" method="POST" action="/create-user">
                    @csrf
                    <span class="heading">Register</span>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ old('email') }}">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="inputUser" placeholder="Username" value="{{ old('name') }}">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#"  class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group">
                        <span class="text"> <a href="/" class="fw-medium">Sudah punya akun?</a></span>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
