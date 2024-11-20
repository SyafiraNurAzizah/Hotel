@extends('layouts.app')

@push('styles')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
@endpush

@section('content')

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Contact Info</h2>
                        <p>Kami di Hotel Berlian siap membantu Anda dengan segala kebutuhan dan pertanyaan. 
                        Jangan ragu untuk menghubungi kami melalui informasi di bawah ini:</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Address:</td>
                                    <td>Jl. Mayjend Sungkono Selabaya Kalimanah Purbalingga.</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Phone:</td>
                                    <td>(+62) 881-2721-410</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td>berlianHotel@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="item">Nama</label>
                                <input type="text" id="Nama" name="Nama" class="form-control" value="{{ Auth::user() ? Auth::user()->firstname : '' }}">
                            </div>
        
                            <div class="col-lg-6">
                                <label for="noOfServings">Email</label>
                                <input type="text" id="Email" name="Email" class="form-control" value="{{ Auth::user() ? Auth::user()->email : '' }}">
                            </div>
        
                            <div class="col-lg-12">
                                <label for="servingSize">Pesan</label>
                                <input type="text-area" id="Pesan" name="Pesan" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn">Submit Now</button>

                    </form>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.554256046068!2d109.34410847357361!3d-7.403735972900789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559b9ff8d3795%3A0xa58daaef273f4e44!2sSMK%20Negeri%201%20Purbalingga!5e0!3m2!1sid!2sid!4v1731643103192!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->





    {{-- <p style="padding-top: 100px"></p>
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
    <p style="padding-bottom: 100px"></p> --}}
@endsection