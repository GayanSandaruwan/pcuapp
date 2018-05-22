@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8 float-md-none mx-auto">
                <div class="card card-default" >
                    <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Priliminary care unit- Patient Assessment Record<span class="fa fa-wheelchair"></span> </div>
                    <div class="card-body" style="padding-bottom: 0%; font-size: 12pt;" >
                        <div class="container" id="assessment-print">
                            <div class="row"><p>Date : Time : &nbsp; {{$patient->created_at}}</p></div>
                            <div class="row"><p>Admission No : {{$admission->admission_no}}</p></div>
                            <div class="row justify-content-md-center">
                                <div class="col col-md-12">
                                    <h4 style="font-weight: bold;font-size: 16pt">Priliminary care unit- Patient Assessment Record</h4>
                                </div>
                            </div>
                            <div class="row"><p>Name : &nbsp; {{$patient->name}}</p></div>
                            <div class="row"><p>Age (on the date patient registered) : &nbsp; {{$patient->age->y}} Years {{$patient->age->m}} Months {{$patient->age->d}} Days</p></div>
                            <div class="row"><p>Gender : &nbsp; {{$patient->gender}}</p></div>
                            <div class="row"><p>Address : &nbsp; {{$patient->address}}</p></div>
                            <div class="row"><p>Contact No : {{$patient->contact_no}}</p></div>
                            <div class="row"><p>Source Of patient to PCU : &nbsp; {{$patient->area}}</p></div>
                            <div class="row"><p>Presenting complain : &nbsp; {{$assessment->complain}}</p></div>
                            <div class="row"><p>Clinical Parameters :</p></div>
                            <div class="row">
                                <div class="col-md-7" id="table" style=" font-size: 12pt;">
                                    <table class="table table-striped" >
                                        <thead>
                                        <tr>

                                            <th>Parameter</th>
                                            <th>Recorded Value</th>
                                            <th>Individual Score</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Respiratory Rate</td>
                                            <td>{{$assessment->resp_rate or "-"}}</td>
                                            <td>{{$score['resp_rate']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Respiratory Effort</td>
                                            <td>{{$assessment->resp_effort or "-"}}</td>
                                            <td>{{$score['resp_effort']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Oxygon Saturation</td>
                                            <td>{{$assessment->spo2 or "-"}}</td>
                                            <td>{{$score['spo2']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Oxygon flow rate per minute</td>
                                            <td>{{$assessment->o2_liters or "-"}}</td>
                                            <td>{{$score['o2_liters']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Heart Rate</td>
                                            <td>{{$assessment->heart_rate or "-"}}</td>
                                            <td>{{$score['heart_rate']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Systolic blood pressure</td>
                                            <td>{{$assessment->systolic_bp or "-"}}</td>
                                            <td>{{$score['systolic_bp']}}</td>
                                        </tr>
                                        <tr>
                                            <td>CRFT</td>
                                            <td>{{$assessment->crft or "-"}}</td>
                                            <td>{{$score['crft']}}</td>
                                        </tr>
                                        <tr style="border-bottom-style: double">
                                            <td>AVPU</td>
                                            <td>{{$assessment->avpu or "-"}}</td>
                                            <td>{{$score['avpu']}}</td>
                                        </tr>
                                        <tr style="font-family: bold; border-bottom-style: double">
                                            <td>Total PEWS Score</td>
                                            <td></td>
                                            <td>{{$score['total']}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <div class="container-fluid h-100" >
                                        <div class="row row h-100 justify-content-center align-items-center">
                                            <div class="col-md-11 float-md-none mx-auto " style="border-color: black; border-style: dashed">
                                                <div class="card card-default" >
                                                    <div class="card-header {{$recomendation['color_code']}} white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">{{$recomendation['response']}}</div>
                                                    <div class="card-body" style="padding-top: 10%">
                                                       <div class="row justify-content-md-center mb-3">
                                                                <label for="name" class="col-md-12 text-center">{{$recomendation['whom_to_alert']}}</label>
                                                           <label for="name" class="col-md-12 text-center">Observe {{$recomendation['observe_frequency']}}</label>

                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"><p>Assessment Recorded By : {{$nurse}}</p></div>
                            <div class="col-md-6"><p>Assessment Printed By : {{\Illuminate\Support\Facades\Auth::guard('nurse')->user()->name}}</p></div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="" >--}}
                <div class="btn btn-default" style="position: fixed;right:22%; top: 24% " onclick="PrintElem()"><span class="fa fa-print"> Print </span></div> </div>
            {{--</div>--}}
        </div>
    </div>
    <script type="text/javascript">
        function PrintElem()
        {

            var mywindow = window.open('', 'PRINT',  "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
            var elem = document.getElementById('assessment-print').outerHTML;
            var head_content = document.getElementsByTagName('head')[0].innerHTML;
            mywindow.document.write('<html><head>'+head_content+'<title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            // mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(elem);
            mywindow.document.write('</body></html>');
            var is_chrome = Boolean(window.chrome);
            mywindow.document.close(); // necessary for IE >= 10    & chrome
            // mywindow.focus(); // necessary for IE >= 10*/ & chrome
            if (is_chrome) {
                mywindow.onload = function () {
                    console.log("asdfasdfas");

                    setTimeout(function () { // wait until all resources loaded
                        mywindow.print();  // change window to winPrint
                        mywindow.close();// change window to winPrint
                    }, 200);
                };
            }
            else {

                mywindow.print();
                mywindow.close();

            }


            return true;
        }
    </script>
@endsection
