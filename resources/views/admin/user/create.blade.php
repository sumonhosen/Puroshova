@extends('admin.layout.master')
@section('header')
    <section class="content-header pl-3">
        <h1> ইউজার নিবন্ধন</h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-fw ti-home"></i> ড্যাশবোর্ড
            </li>
            <li>নতুন ইউজার নিবন্ধন </li>
        </ol>
    </section>
@stop
@section('content')


    <div class="content-wrapper">

        <section class="card card-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="website-form form-group">
                            <div class="card-header">
                                <h3 class="h5"> নতুন ইউজার নিবন্ধন করুন</h3>
                            </div>
                            <br>
                            <form class="needs-validation p-3" action="{{ route('user.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="row">

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">ইউজার আইডি</label>
                                        <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                            name="username" placeholder="ইউজার আইডি" value="{{ old('username') }}">

                                        @error('username')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">ইউজার রোল</label>
                                        <select id="userRole" class="form-control @error('role') is-invalid @enderror"
                                            name="role">
                                            <option value="">ইউজার রোল নির্বাচন করুন</option>
                                            @forelse($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('role')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">ইউজার নাম </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="ইউজার নাম" value="{{ old('name') }}">

                                        @error('name')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">ইউজার ইমেইল </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="ইউজার ইমেইল" value="{{ old('email') }}">

                                        @error('email')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">পাসওয়ার্ড </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="পাসওয়ার্ড" value="{{ old('password') }}">

                                        @error('password')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">যোগাযোগ নাম্বার </label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                            name="contact" placeholder="যোগাযোগ নাম্বার" value="{{ old('contact') }}">

                                        @error('contact')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4">
                                        <label for="inputName" class="col-form-label">ছবি </label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            name="photo">

                                        @error('photo')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>

                                </div>

                                <div style="padding: 10px 0px 25px">
                                    <button type="submit" class="btn btn-primary save_data">সংরক্ষণ</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
        </section>
    </div>

@endsection
