@extends('layout')

@section('head')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
@endsection
@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us" >
            <h1 style="padding-top: 50px;" >Edit Category!</h1>
            @if(session('status'))
                <p style="color: #fff; width: 100%; font-size: 18px; font-weight: 600; text-align:center; background: #5cb85c; padding: 17px 0; margin-bottom: 6px;" >{{session('status')}}</p>
            @endif

        <!-- Contact Form -->
            <div class="contact-form">
                <form action="{{route('categories.update', $category)}}" method="post">
                @method('PUT')
                @csrf
                <!-- Title -->
                    <label for="title"> <span>Name</span> </label>
                    <input type="text" id="name" name="name" value="{{$category->name}}">
                    @error('name')
                    {{-- The $attributeValue field is/must be $validationRule --}}
                    <p style="color: red; margin-bottom: 25px;">
                        {{$message}}
                    </p>
                @enderror

                <!-- Button -->
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="create-categories">
                <a href="{{route('categories.index')}}">Categories list <span>&#8594;</span></a>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection
