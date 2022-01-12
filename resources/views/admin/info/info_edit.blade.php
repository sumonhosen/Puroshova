                        @extends('admin.layout.master')
                        @section('header')
                            <section class="content-header pl-3">
                                <h1>ওয়েবসাইট</h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-fw ti-home"></i> পৌরসভার তথ্য
                                        </a>
                                    </li>
                                    <li> সংক্ষিপ্ত বিবরণ</li>

                                </ol>
                            </section>
                        @stop

                        @section('content')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card main-chart">
                                        <div class="card-header panel-tabs">
                                            <h5 class="h5">পেইজের তথ্যসমূহ এডিট</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('admin.web.info.info.update',$info->id)}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">শিরোনাম</label>
                                                    <input type="text" name="title" class="form-control" value="{{$info->title}}">
                                                    @error('title')
                                                        <span class=text-danger>{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">বর্ণনা</label>
                                                    <textarea rows="4" cols="50" name="description" type="text" class="form-control" >{{$info->description}}</textarea>
                                                    @error('title')
                                                        <span class=text-danger>{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-primary">সাবমিট</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                               
                            </div>





                        @stop


