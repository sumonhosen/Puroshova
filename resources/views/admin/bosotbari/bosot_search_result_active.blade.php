@extends('admin.layout.master')
@section('header')
<section class="content-header pl-3">
    <h1>এসেসমেন্ট নিবন্ধন</h1>
    <ol class="breadcrumb">
        <li>
            <a href="">
                <i class="fa fa-fw ti-home"></i> বসতবাড়ী হোল্ডিং
            </a>
        </li>
    </ol>
</section>
@stop
@section('content')

            @php
            $wards = DB::table('wards')->orderBy('id','DESC')->get();
            $latest_ward = DB::table('wards')->orderBy('id','DESC')->first();
            $villages = DB::table('villages')
            ->where('ward_id', $latest_ward->id ?? '')
            ->orderBy('villages.id', 'DESC')
            ->get()
            @endphp
                <div class="card">
                    <div class="card-header">
                        <h3 class="h5"> বসতবাড়ী হোল্ডিং নিবন্ধন <a href=""
                            class="btn btn-primary float-right"><i
                            class="fa fa-download"></i> Download</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                          <form action="{{URL::to('/bosot-search-result-active')}}" method="get" id="bosottableactive">
                             @csrf
                             <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <select id="ward_id"
                                    name="ward_id"
                                    class="form-control form-control-sm">
                                    <option value="" disabled selected>ওয়ার্ড
                                    </option>
                                    @foreach ($wards as $ward)
                                    <option value="{{$ward->id}}">{{ $ward->ward_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                               <select name="village_id" id="village_id"
                               class="form-control form-control-sm">
                               <option value="" selected="" disabled="">গ্রাম
                               </option>

                           </select>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-4">
                        <input  class="form-control form-control-sm" type="text"
                        name="mobile" id="mobile" placeholder="হোল্ডিং নং / NID / মোবাইল ..."
                        aria-label="Recipient's ">
                    </div>

                    <div class="col-lg-1 col-md-1 col-sm-1">
                       <button  class="btn btn-success btn-sm member_search"><i
                        class="fa fa-search"></i></button>
                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="table-responsive">
                          <table
                          class="table table-striped table-bordered datatable responsive nowrap table-hover yajra-datatable"
                          style="width:98%">
                          <thead>
                            <tr> 
                             <th>ক্রমিক নং</th>
                             <th>নাম</th>
                             <th>পিতা/স্বামীর নাম</th>
                             <th>মোবাইল নং</th>
                             <th>NID/জন্ম সনদ নং</th>
                             <th>ইউজার আইডি</th>
                             <th>ধরণ</th>
                             <th>একশন</th>             
                         </tr>
                     </thead>
                     <tbody>

                     </tbody>

                 </table>
             </div>


         </div>



     </div>
<!-- Quick Edit Modal -->
<div class="modal fade" id="quick-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="quick-edit-modal">কুইক এডিট করুন</h5>

            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn info-update btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Quick Edit Modal End -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('change', '#ward_id', function () {
            var ward_id = $('#ward_id').val();
            $.ajax({
                url: "{{  url('/get-village_ward') }}",

                type: "GET",
                data: {'ward_id': ward_id},
                dataType: "html",
                success: function (data) {

                    $("#village_id").html(data);


                },

            });
        });
        $(document).on('change', '#ward_id', function() {
            var id = $('#ward_id').val();
            $.ajax({
                url: "{{ url('/getvillageinfo/') }}/" + id,

                type: "GET",
                dataType: "html",
                success: function(data) {


                    if (data == 'no_data') {
                        toastr.error("Sorry, No Data Found");
                        $("#village_id").html(
                            '<option value="" selected="" disabled="">নির্বাচন করুন</option>'
                            );
                    } else {
                        $("#village_id").html(data);
                    }





                },

            });
        });

            //Quick Edit
            $(document).on("click", ".quick-edit", function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $(".member_id").val(id);
                $('#quick-edit-modal').modal('show');

                $.ajax({
                    url: "{{ url('/get-info/') }}/" + id,
                    type: "GET",
                    dataType: "html",
                    success: function (data) {
                        $("#quick-edit-modal .modal-body").html(data);

                    },

                });
            });
            //Quick Edit


            $(document).on('click', '.info-update', function (e) {
                e.preventDefault();
                var name = $('.name').val();
                var user_id = $('.user_id').val();
                var password = $('.password').val();
                var id = $('.member_id').val();


                $.ajax({
                    url: "{{ url('/update-member_info') }}",
                    type: "GET",
                    data: {
                        'id': id,
                        'name': name,
                        'user_id': user_id,
                        'password': password,

                    },
                    dataType: "html",
                    success: function (data) {

                        window.location.reload();
                        toastr.success("Successfully Informaton Updated");
                    },
                });
            });


            //  $(document).on('click', '.member_search', function(e){
            //      e.preventDefault();
            //      var ward_id = $("#ward_id").val();
            //      var village_id = $("#village_id").val();
            //      var nid = $("#nid").val();
            //      var mobile = $("#mobile").val();
            //      var holding_no = $("#holding_no").val();
            //      $.ajax({
            //                 url: "{{ url('/bosot-search-result') }}",
            //                 type: "GET",
            //                 data:{'ward_id':ward_id,'village_id':village_id, 'nid':nid, 'mobile':mobile,'holding_no':holding_no},
            //                 dataType: "html",
            //                 success: function(data) {
            //                     alert(data);
            //                 },
            //             });
            //  });
        });
    </script>



    @endsection

    @section('js')

<!--     <script type="text/javascript">
        $(function () {
          
          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url('bosot-search-result') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'father', name: 'father'},
                  {data: 'mobile', name: 'mobile'},
                  {data: 'nid', name: 'nid'},
                  {data: 'user_id', name: 'user_id'},
                  {data: 'status', name: 'status'},
                  {data: 'action', name: 'action', orderable: false, searchable: true},
              ],
               createdRow: function ( row, data, index ) {

    if ( data['status'] == 'একটিভ' ) {
        $('td', row).eq(6).html('<span class="badge badge-success">একটিভ</span>').css('text-align','center');
    } else {
        $('td', row).eq(6).html(' <span class="badge badge-danger">ডিএকটিভ</span>').css('text-align','center');
    };
},
          });
          
        });
    </script> -->
    <script>
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('bosot-search-result-active') }}",
                    type: 'GET',
                    data: function (d) {
                      d.ward_id = $('#ward_id').val();
                      d.village_id = $('#village_id').val();
                      d.mobile = $('#mobile').val();
                  },
              },
              columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'father', name: 'father'},
              {data: 'mobile', name: 'mobile'},
              {data: 'nid', name: 'nid'},
              {data: 'user_id', name: 'user_id'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: true},
              ],
              createdRow: function ( row, data, index ) {

                if ( data['status'] == '1' ) {
                    $('td', row).eq(6).html('<span class="badge badge-success">একটিভ</span>').css('text-align','center');
                } else {
                    $('td', row).eq(6).html(' <span class="badge badge-danger">পেন্ডিং</span>').css('text-align','center');
                };
            },
        });
        });
// $('#btnFiterSubmitSearch').click(function(){
// $('#laravel_datatable').DataTable().draw(true);
// });
$('#bosottableactive').on('submit', function(e) {
    e.preventDefault();
    $('.yajra-datatable').DataTable().draw();

});
</script>
@endsection