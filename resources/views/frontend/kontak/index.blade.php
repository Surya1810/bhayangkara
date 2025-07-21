@extends('frontend.layouts.app')

@section('title')
    Kontak
@endsection

@push('css')
@endpush

@section('content')
    <!-- Judul -->
    <div class="container p-5">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1><strong>Hubungi kami</strong></h1>
            </div>
        </div>
    </div>

    <div class="container container-gap-lg card-address" style="background-color: #EFEFEf">
        <div class="row justify-content-center">
            <div class="header col-lg-6 col-md-6 col-sm-12">
                <div class="text-header-address">
                    <h3>Kantor</h3>
                    <p>Jika Anda memiliki pertanyaan lainnya, jangan ragu untuk menghubungi kami</p>
                </div>
                <div class="text-address">
                    <p>Jl. Tubagus Ismail VIII No.41 RT.002 RW.010, <br>Kelurahan Sekeloa, Kecamatan Coblong, Kota Bandung
                    </p>
                </div>
                <div class="text-footer-address">
                    <div class="list-icon">
                        <h3 class="text-danger">Email</h3>
                        <div class="text-icon"><i
                                class="small-icon fa-solid fa-envelope text-danger"></i>partnernewsbhayangkara@gmail.com
                        </div>
                    </div>
                </div>
                <h5><strong>Informasi Legalitas</strong></h5>
                <table>
                    <tbody>
                        <tr>
                            <td>AHU Perubahan</td>
                            <td>:</td>
                            <td>AHU-0086164.AH.01.02.TAHUN 2022</td>
                        </tr>
                        <tr>
                            <td>NIB</td>
                            <td>:</td>
                            <td>2009240118601</td>
                        </tr>
                        <tr>
                            <td>NPWP</td>
                            <td>:</td>
                            <td>80.368.040.4-424.000</td>
                        </tr>
                        <tr>
                            <td>No. Surat Notaris</td>
                            <td>:</td>
                            <td>777</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 gmap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5002.922394806024!2d107.6207748!3d-6.8814150000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6fde2c9f86f%3A0xf2739f470dd31307!2sJl.%20Tubagus%20Ismail%20VIII%20No.41%2C%20Sekeloa%2C%20Kecamatan%20Coblong%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040134!5e1!3m2!1sid!2sid!4v1753069048810!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="maps"></iframe>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
