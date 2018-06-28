@extends('layouts.externo')

@section('title')
    Keyboard Cat
@endsection

@section('content')
<div class="container p-t-md">
    <div role="main">
        <div>
            <br>
            <div class="row row-centered">
                <div class="col-md-10 col-centered">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 style="font-size: 200%">Keyboard Cat</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="text-center">
                                {{-- <iframe width="660" height="415" src="https://www.youtube.com/embed/J---aiyznGQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> --}}
                                <iframe width="660" height="415" src="https://www.youtube.com/embed/J---aiyznGQ?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p>Uma lenda, um <b>mito.</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection