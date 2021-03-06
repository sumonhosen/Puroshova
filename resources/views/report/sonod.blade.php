<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>sonod</title>
  <style type="text/css">
 html {
            height: 100%;
        }

        body {
            font-family: 'solaimanlipi', sans-serif;
            position: relative;
            height: 100%;
            z-index: 999;

        }

        /* Create two equal columns that floats next to each other */
        .column25 {
            float: left;
            width: 25%;
        }

        .column50 {
            float: left;
            width: 49%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .container {
            background-color: #fff;
            margin: 0 auto;
            width: 8.27in;
            height: 11.69in;
            padding: .26in;
        }

        .border-1 {
            border: 0.02in solid #b26d82;
            padding: 0.053in;
        }

        .border-2 {
            border: 0.07in solid #b26d82;
            position: relative;
            padding: 15px 15px 15px 15px;
            height: 10.70in;
        }

.main-title{
font-size: 36px;
font-weight: 900;
} 
.sub-title {
font-size: 26px;
font-weight: 900;
}

.sonod-title {
  width: 160px;
  text-align: center;  
  font-size: 16px;
  background-color: #000;
  color: #fff;
  display: block;
  margin: 0 auto;
  padding: 5px 7px;
  font-weight: bold;
  border-radius: 5px;
}
.info_table tr th{
padding: 10px 0px;
font-weight: normal;
}

.info_table tr td {
  padding: 10px 5px;
  font-weight: normal;
}

  </style>
</head>
@php

$currentDate = date("l, F j, Y");
$engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
'May','June','July','August','September','October','November','December','Saturday','Sunday',
'Monday','Tuesday','Wednesday','Thursday','Friday');
$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
বুধবার','বৃহস্পতিবার','শুক্রবার' 
);
$convertedDATE = str_replace($engDATE, $bangDATE,date("d-m-Y", strtotime($data->approved_date)));
$convertedDATE2 = str_replace($engDATE, $bangDATE,date("d-m-Y", strtotime($data->dob)));
$bnid = str_replace($engDATE, $bangDATE,$data->nid);
$bsonod = str_replace($engDATE, $bangDATE,$data->applied_by);

@endphp
<body>
   <div class="watermark" style="position: absolute;width: 100%;top: 270px;left: 150px;display: block;height: 100%;z-index: 1;">
                                <img style="width: 65%;opacity: 0.15;display: block;margin: 0 auto;" src="{{asset('logo/govt.png')}}" alt="">
                            </div>
<section>
  <div class="container">
    <div class="certificate">
      
      <div class="border-1">
        <div class="border-2">
          
          <div class="row" style="margin-bottom: 8px;">
            <div class="column25">
                <img src="{{asset('logo/photo.jpg')}}" width="150" height="150" alt="" style="margin-top: 0.153in;border: 1px solid #c7c7c7;visibility: hidden;">
                @if($headings->id =='5')
                <img src="{{asset('logo/qr.png')}}" width="100" style="margin-top: 0.153in;border: 1px solid #c7c7c7;">
                @endif
            </div>
            <div class="column50" style="text-align: center;">
                      <img src="{{asset('logo/govt.png')}}" width="80" height="80" alt="">

                                            <h2 class="main-title" style="margin-bottom: 0px !important;margin-top: 0px; !important">{{ @$website_data->title_bangla }} পৌরসভা</h2>
                                            <h2 class="sub-title" style="margin-bottom: 0px !important;margin-top: 0px; !important">{{ @$website_data->title_bangla }}, ময়মনসিংহ</h2>
                                            <h3 class="sonod-title" style="margin-bottom: 0px !important;color: #fff;">  {{$headings->title??''}}</h3>
            </div>
            <div class="column25">
              <img src="{{asset('logo/mujib.png')}}" width="150" alt="" style="float: right;display: block;text-align: right;margin-top: 0.153in;">
            </div>
          </div>

          <div class="row" style="margin-bottom: 0px !important;">
            
            <div class="column50">
                <h2 style="font-size: 18px;margin-bottom: 0px !important;margin-top: 0px !important;">সনদ নং : {{$data->applied_by}}</h2>
                                    <h2 style="font-size: 22px;font-weight:bold; ;margin-bottom: 0px !important;margin-top: 0px !important;">নাগরিক তথ্যঃ</h2>
                
            </div>
            <div class="column50" style="text-align: right;">

                                    <h2 style="font-size: 18px;margin-bottom: 0px !important;margin-top: 0px !important;">ইস্যু তারিখঃ {{date("d-m-Y", strtotime($data->approved_date))}}</h2>
                
            </div>
            
          </div>
          @if($headings->id == '5')

          <div style="width: 100%;text-align: justify;font-size: 17px;font-weight: normal;">
  {{$headings->desc}}
            </div>
          @endif

            @if($headings->id != '5')

           <table class="info_table" style="text-align: left;margin-bottom: 3px;">
                                    <tr>
                                        <th width="220" align="left">১) নাম</th>
                                        <td>:</td>
                                        <td>{{$data->name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th align="left">২) পিতা / স্বামী</th>
                                        <td>:</td>
                                        <td>{{$data->father??$data->husband}}</td>
                                    </tr>
                                    <tr>
                                        <th align="left">৩) মাতা</th>
                                        <td>:</td>
                                        <td>{{$data->mother??''}}</td>
                                    </tr>
                                    <tr>
                                        <th align="left">৪) জাতীয় পরিচয়পত্র</th>
                                        <td>:</td>
                                        <td>{{$data->nid??''}}</td>
                                    </tr>
                                    <tr>
                                        <th align="left">৫) জন্ম তারিখ</th>
                                        <td>:</td>
                                        <td>{{$data->dob??''}} ইং</td>
                                    </tr>
                                    @if($data->sonod_setting_id == 1)
                                    <tr>
                                        <th align="left">৫) মৃত্যুর তারিখ</th>
                                        <td>:</td>
                                        <td>{{$data->dod??''}} ইং</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th align="left">৬) ঠিকানা</th>
                                        <td>:</td>
                                        <td>{{$data->address}}</td>
                                    </tr>
                                </table>

                                @else 

                    <table class="warish_table"
                        style="text-align: left;width: 100%;border-collapse: collapse;" border="1">
                        <tr>
                            <th style="width: 50px;">ক্রমিক</th>
                            <th>নাম</th>
                            <th style="width: 210px; padding: 0;">ভোটার আইডি/জন্ম নিবন্ধন নং</th>
                            <th style="width: 60px;">সম্পর্ক</th>
                            <th style="width: 60px;">মন্তব্য</th>
                        </tr>
                        @if(count($members)>0)
                        @php $l=1; @endphp
                        @foreach($members as $member)
                        @php 
                        $relation= DB::table('relations')->where('relation',$member->relations)->first();
                        <tr>
                            <td>{{$l++}}</td>
                            <td>{{$member->name??''}}</td>
                            <td>{{$member->nid??''}}</td>
                            <td>{{$relation->relation_name ?? ''}}</td>
                            <td>{{$member->remarks??''}}</td>
                        </tr>
                        @endforeach
                        @endif
                       
                    </table>

                                @endif

                                <div style="width: 100%;text-align: justify;font-size: 17px;font-weight: normal;">
                                       @if($headings->id != '5')
                                   {{$headings->desc}}
                                    <br><br>
                                    @endif
                                    {{$headings->endline}}
                                </div>

                                <table style="width: 100%;" >
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <!-- Mayor Sign -->
                                        <td width="250" style="text-align: center;">
                                          
                                                <img width="100" height="80" src="{{asset('logo/Signature.png')}}" alt="">
                                          
                                            <h3 style="font-size: 22px;font-weight: bold;">এবিএম আনিসুজ্জামান</h3>
                                            <h3 style="font-size: 18px;font-weight: bold;">মেয়র</h3>
                                            <h3 style="font-size: 16px;">ত্রিশাল পৌরসভা</h3>
                                            <h3 style="font-size: 16px;">ত্রিশাল, ময়মনসিংহ</h3>
                                            <h3 style="font-size: 16px;">মোবাইলঃ ০১৭২০০০০০০০</h3>
                                            <h3 style="font-size: 16px;">ইমেইলঃ trishalpourosova@gmail.com</h3>
                                        </td>
                                    </tr>
                                </table>
                               
                                <div class="row">
                                  <div class="column50">
                                     <h2 style="font-size: 18px;font-weight: bold;margin-bottom: 0px !important;margin-top: 0px !important;">  সনদ যাচাই</h2>
                                    <span>১) ভিজিট করুন : https://trishalpourosova.com</span><br>
                                            <span>২) QR কোড স্ক্যান করুন।</span>
                                  </div>
                                  @if($headings->id != '5')
                                  <div class="column50">
                                    <img style="float: right;display: block;text-align: right" width="90" height="90" src="{{asset('logo/qr.png')}}" alt="">
                                  </div>
                                  @endif
                                </div>

                                <div class="row" style="font-size: 16px;text-align: center;width: 100%;">
                                  কারিগরি সহযোগিতায়: Tech Path Limited
                                </div>
                                

          
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
