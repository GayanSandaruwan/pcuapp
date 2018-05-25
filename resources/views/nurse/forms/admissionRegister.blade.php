@extends('nurse.layout.auth')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12 float-md-none mx-auto">
                <div class="card card-default" >
                    <div class="card-header success-color white-text" style="background-color: #67b168; text-align:center; font-weight: bold; font-size: 200%">Priliminary care unit- Patient Register<span class="fa fa-wheelchair"></span> </div>
                    <div class="card-body" style="padding-bottom: 0%; font-size: 12pt;" >
                        <div class="container" id="admission-report-print">
                            <div class="row justify-content-md-center">
                                <div class="col-md-12" id="table" style=" font-size: 10pt;">
                                    <table class="table table-striped" >
                                        <thead>
                                        <tr>
                                            <th>Date of Admission</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Admission No</th>
                                            <th>Address</th>
                                            <th>Presenting Complaint</th>
                                            <th>Clinical Parameters of patient</th>
                                            <th>Score</th>
                                            <th>Discharge Note</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($records as $record)
                                                <tr>
                                                    <td>
                                                        {{$record['patient']->created_at}}
                                                    </td>
                                                    <td>
                                                        {{$record['patient']->name}}
                                                    </td>
                                                    <td>
                                                        {{$record['patient']->age->y}},{{$record['patient']->age->m}},{{$record['patient']->age->d}}
                                                    </td>
                                                    <td>
                                                        {{$record['patient']->gender or "-"}}
                                                    </td>
                                                    <td>
                                                        {{$record['admission']->admission_no}}
                                                    </td>
                                                    <td>
                                                        {{$record['patient']->address or "-"}}
                                                    </td>
                                                    <td>
                                                        {{$record['assessment']->complain or "-"}}
                                                    </td>
                                                    <td>
                                                        {{$record['assessment']->resp_rate or "-"}} ,  {{$record['assessment']->resp_effort or "-"}} ,
                                                        {{$record['assessment']->o2_liters or "-"}} , {{$record['assessment']->spo2 or "-"}} ,
                                                        {{$record['assessment']->heart_rate or "-"}}, {{$record['assessment']->systolic_bp or "-"}} ,
                                                        {{$record['assessment']->crft or "-"}} , {{$record['assessment']->avpu or "-"}}

                                                    </td>
                                                    <td>
                                                        {{$record['score']['total'] or "-"}}
                                                    </td>
                                                    <td>
                                                        {{$record['assessment']->discharge_note or "-"}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-s8">
                                        <p>
                                            *Clinical Parameters : Respiratory Rate, Respiratory Effort, O2 Rate, SPO2,  Heart Rate, Systolic BP, CRFT, AVPU
                                        </p>
                                    </div>
                                </div>

                            </div>
                               </div>
                    </div>
                </div>
            </div>
            {{--<div class="" >--}}
            <div class="btn btn-default" style="position: fixed;right:5%; top: 10% " onclick="PrintElem()"><span class="fa fa-print"> Print </span></div> </div>
        {{--</div>--}}
    </div>
    </div>
    <script type="text/javascript">
        function PrintElem()
        {

            var mywindow = window.open('', 'PRINT',  "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
            var elem = document.getElementById('admission-report-print').outerHTML;
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
