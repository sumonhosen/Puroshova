r equired@extends('admin.layout.master')
@section('header')
    <section class="content-header pl-3">
        <h1>ওয়েবসাইট</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">
                    <i class="fa fa-fw ti-home"></i> ডান সাইডবার
                </a>
            </li>
            <li> ব্যানার সমূহ</li>

        </ol>
    </section>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card main-chart">
                <div class="card-header panel-tabs">
                    <h5 class="h5">আপডেট ডান পাশের ব্যানার </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.web.right.banner.update',$right_banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="form-group">
                            <label for="">শিরোনাম</label>
                            <input type="text" name="title" value="{{ $right_banner->title }}" class="form-control" placeholder="শিরোনাম" required>
           
                        </div>
                        <div class="form-group">
                            <label for="">তথ্যের ধরন</label>
                            <select id="type" name="information_type" value="{{ $right_banner->information_type }}" class="custom-select" required>
                                <option value="1">ছবি</option>
                                <option value="2">বর্ণনা</option>
                            </select>
          
                        </div>
                        <div id="desc" class="form-group">
                            <label for="">বর্ণনা লিখুন</label>
                            <textarea class="form-control"  name="description" placeholder="বর্ণনা লিখুন" required>{{ $right_banner->description }}</textarea>
                        </div>     
                        <div class="form-group">
                            <label for="">300px * 300px এবং JPG ছবি</label><br>
                            <img src="{{ asset('uploads/rightside')}}/{{ $right_banner->photo}}" height="100px" width="200px">
                        </div>
                        <div id="banner" class="form-group">
                            <label for="">JPG ছবি </label>
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang">ছবি (JPG Format)</label>
          
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">সাবমিট</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


