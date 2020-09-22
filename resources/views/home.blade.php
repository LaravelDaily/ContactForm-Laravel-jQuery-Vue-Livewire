@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Back-end Only Version</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success my-2">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" class="form-control" />
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control" name="email" />
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="question">Question*</label>
                            <textarea class="form-control" name="question"></textarea>
                            @error('question')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">jQuery Version</div>

                <div class="card-body">
                    <div class="alert alert-success my-2 d-none" id="jquery_success_message">
                        Email successfully sent
                    </div>

                    <form method="POST" action="{{ route('submit') }}" id="jquery_form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" class="form-control jquery_field" name="name" />
                            <div class="alert alert-danger jquery_error_message d-none"
                                 id="jquery_error_name"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control jquery_field" name="email" />
                            <div class="alert alert-danger jquery_error_message d-none"
                                 id="jquery_error_email"></div>
                        </div>

                        <div class="form-group">
                            <label for="question">Question*</label>
                            <textarea class="form-control jquery_field" name="question"></textarea>
                            <div class="alert alert-danger jquery_error_message d-none"
                                id="jquery_error_question"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Vue Version</div>

                <div class="card-body">
                    <contact-form></contact-form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Livewire Version</div>

                <div class="card-body">
                    <livewire:contact>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#jquery_form').submit(function (event) {
                event.preventDefault();
                $('.jquery_error_message').addClass('d-none').text('');
                $.ajax({
                    url: '{{ route('submit') }}',
                    method: 'POST',
                    data: $('#jquery_form').serialize(),
                    success: function(response) {
                        $("#jquery_success_message").removeClass('d-none');
                        $('.jquery_field').val('');
                    },
                    error: function( data ) {
                        if (data.status === 422) {
                            let response = $.parseJSON(data.responseText);
                            $.each(response.errors, function (key, value) {
                                $('#jquery_error_' + key).removeClass('d-none').text(value);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
