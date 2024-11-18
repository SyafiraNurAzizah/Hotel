@extends('layouts.app')

@section('content')

<p style="padding-top: 100px"></p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">



                    <form method="POST" action="{{ route('contact.store') }}">

        {{ csrf_field() }}

        <h1>Beri Kami Masukan</h1>
        <div class="form-group">

            <label for="item">Nama</label>

            <input type="text" id="Nama" name="Nama" class="form-control">

        </div>



        <div class="form-group">

                    <label for="noOfServings">Email</label>

                    <input type="text" id="Email" name="Email" class="form-control">

        </div>



        <div class="form-group">

                    <label for="servingSize">Pesan</label>

                    <input type="text-area" id="Pesan" name="Pesan" class="form-control">

        </div>





        <button type="submit" class="btn btn-primary">Kirim</button>




    </form>



        </div>
    </div>
</div>
    <p style="padding-bottom: 100px"></p>
@endsection
