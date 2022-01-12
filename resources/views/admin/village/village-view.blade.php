@extends('admin.layout.master')
@section('header')
    <section class="content-header pl-3">
        <h1>সাধারন তথ্য</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">
                    <i class="fa fa-fw ti-home"></i> ড্যাশবোর্ড
                </a>
            </li>
            <li> গ্রাম</li>

        </ol>
    </section>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card main-chart">
                <div class="card-header panel-tabs">
                    <h5 class="h5">গ্রাম</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.web.village.village.store')}}" method="POST">
                        @csrf
                       <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label for="">শিরোনাম</label>
                            <input type="text" name="name" placeholder="শিরোনাম" required value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <span class=text-danger>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">ওয়ার্ড নং</label>
                            <select name="ward_id" required id="" class="custom-select">
                                <option disabled selected>-- সিলেক্ট করুন --</option>
                                @foreach($words as $word)
                                <option value="{{$word->id}}">{{$word->ward_no}}</option>
                                @endforeach
                            </select>
                            @error('ward_id')
                                <span class=text-danger>{{$message}}</span>
                            @enderror
                        </div>
                        
                       </div> 


                        <button class="btn btn-primary">সাবমিট</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card main-chart mt-4 mt-md-0">
                <div class="card-header panel-tabs">
                    <h5 class="h5">গ্রাম</h5>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="table-data">
                            <table class="table table-striped table-bordered responsive nowrap table-hover"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th> ক্রমিক </th>
                                        <th>শিরোনাম</th>
                                        <th>ওয়ার্ড নং</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach($villages as $village)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$village->name ?? ''}}</td>
                                        <td>{{$village->ward_no ?? ''}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn  btn-outline-secondary btn-sm dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a data-placement="left" title="এডিট করুন" data="tooltip"
                                                        class="text-primary dropdown-item" href="{{route('admin.web.village.village.edit',$village->name ?? '')}}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a data-placement="left" title="ডিলেট করুন" data="tooltip"
                                                        class="text-danger dropdown-item" href="{{route('admin.web.village.village.delete',$village->name ?? '')}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>





@stop



