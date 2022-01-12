@extends('admin.layout.master')
@section('header')
    <section class="content-header pl-3">
        <h1>ওয়েবসাইট</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">
                    <i class="fa fa-fw ti-home"></i> কাউন্সিলর
                </a>
            </li>
            <li> কাউন্সিলর বৃন্দ</li>

        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card main-chart">
                <div class="card-header panel-tabs">
                    <h5 class="h5">কাউন্সিলর বৃন্দ</h5>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="btn btn-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.web.councilor.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">নাম</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="নাম" value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">স্থান</label>
                                <input type="text" name="place" value="{{ old('place') }}" class="form-control @error('contact') is-invalid @enderror" placeholder="স্থান" required>
                                @error('place')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">ওয়ার্ড নং</label>
                                <select name="ward_no" class="custom-select @error('ward_no') is-invalid @enderror" required>
                                    <option value="" selected disabled>-- সিলেক্ট করুন --</option>
                                    @foreach($wards as $ward)
                                        <option value="{{ $ward->ward_no}}">ওয়ার্ড  {{ $ward->ward_no }}</option>
                                    @endforeach
                              
                                </select>
                                @error('ward_no')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">মোবাইল নং</label>
                                <input type="number" class="form-control @error('contact') is-invalid @enderror" placeholder="মোবাইল নং" name="contact" value="{{ old('contact') }}" required>
                                @error('contact')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">300px * 300px এবং JPG ছবি আপলোড করুন</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="customFileLang" lang="es" name="photo" required>
                                <label class="custom-file-label" for="customFileLang">ছবি (JPG Format, 300px *
                                    300px)</label>
                                @error('photo')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea id="summernote" name="description" class="form-control @error('description') is-invalid @enderror"  placeholder="দৈর্ঘ পরিমান" required>{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <button class="btn btn-primary">সাবমিট</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    document.forms['form'].elements['name'].value    = [{{ old('name') }}];
    document.forms['form'].elements['place'].value   = [{{ old('place') }}];
    document.forms['form'].elements['word_no'].value = [{{ old('word_no') }}];
    document.forms['form'].elements['contact'].value = [{{ old('contact') }}];
    document.forms['form'].elements['phtoto'].value  = [{{ old('phtoto') }}];
    document.forms['form'].elements['description'].value  = [{{ old('description') }}];
</script>
@stop


