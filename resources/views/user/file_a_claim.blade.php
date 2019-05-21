@extends('layout.user')
@section('head')
    @include('template.head_user_template')
    <style>
      .custom-file-control-2:lang(en):empty::after{
        content:"Video/Picture attach (<100 Mb for video)"
      }
    </style>
@endsection
@section('content')
    @include('user.header')
<div class="app-body">
  @include('user.sidebar')
      <main class="main">
        <div class="main_container_fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
               <div class="card-header">
                File a claim
              </div>
              <div class="card-body">
                <form class="createclaim">
                    <input type="hidden" name="token" value="{{$token}}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <select style="padding: 0.375rem 0.5rem;" required class="form-control" name="operation" id="exampleFormControlSelect1">
                          <option selected disabled value="">DIS Operation Reference</option>
                            @foreach($orders as $order)
                                <option value="Ref {{$order->id}}">Ref {{$order->id}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group  align-items-center">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0" >
                          <label class="custom-file-1">
                            <input required type="file" id="file" name="images" class="custom-file-input-1" accept="image/*">
                            <span class="custom-file-control-1"></span>
                          </label>
                        </div>
                      </div>
                      <div class="form-group align-items-center">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0" >
                          <label class="custom-file-2">
                            <input required type="file" id="file" name="imagesvideos" class="custom-file-input-2" accept="image/*,video/*">
                            <span class="custom-file-control-2"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <textarea required class="form-control" name="text" id="exampleFormControlTextarea1" rows="6" placeholder="Text of a claim"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 text-right">
                      <button type="submit" style="width: 14.38rem;" class="btn btn_submit btn-success">Submit</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          </div>
          <div class="row mt-3">
            <div class="col-12">
              <div class="card">
               <div class="card-header">
                Claim reference
              </div>
              <div class="card-body">
                @if(count($claims)==0)
                 <div class="row">
                   <div class="col">
                     <p style="font-family:RalewayItalic;color:##696767;">Claim reference does  not exist. Please Submit info from above. Then you can Download Claim Reference</p>
                   </div>
                 </div>
                @else
                    @foreach($claims as $claim)
                      <div class="row" style="margin: 10px 0">
                        <div class="col-lg-2 col-md-6 col-6 order-1 order-md-1 order-lg-1 mb-3">
                          {{$claim->operation}}

                        </div>
                        <div class="col-lg-7 col-md-12 order-3 order-md-3 order-lg-2 mb-3">
                          {{$claim->text}}
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 order-2 order-md-2 order-lg-3 mb-3 text-right">
                          @if(!empty($claim->files))
                            <button style="width: 100%;max-width: 14.28rem;" data-files="{{$claim->files}}" onclick="download_files(this)"  type="button" class="btn btn-secondary">Download</button>
                          @else
                            <button style="width: 14.38rem;"   type="button" class="btn btn-secondary" disabled>Download</button>
                          @endif
                        </div>
                      </div>
                    @endforeach
                @endif
              </div>
            </div>
          </div>
          </div>
        </div>
      </main>

        </div>
        @endsection
        @section('script')
            @include('template.script_user_template')
            <script>
                HTMLElement.prototype.click = function() {
                    var evt = this.ownerDocument.createEvent('MouseEvents');
                    evt.initMouseEvent('click', true, true, this.ownerDocument.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
                    this.dispatchEvent(evt);
                }

              function download_files(btn) {
                  var files_str = $(btn).attr('data-files');
                  if(files_str){
                      var arr = files_str.split(',');
                      for(var k in arr){
//                          $('.downloadfile').attr('href',arr[k]);
                          downloadFile(arr[k]);
                      }
                  }
              }
              function downloadFile(filePath){
                  var link=document.createElement('a');
                  link.href = filePath;
                  link.download = filePath;
                  console.log(link);
                  link.click();
              }

              function downloadURI(uri) {
                  var link = document.createElement("a");
//                  link.download = name;
                  link.href = uri;
                  document.body.appendChild(link);
                  link.click();
                  document.body.removeChild(link);
                  delete link;
              }
                $('form.createclaim').on('submit',function(e){
                    e.preventDefault();
                    $(".btn_submit").attr('disabled','disabled');
                    var form = $('form.createclaim')[0];
                    var formData = new FormData(form);
                    $.ajax({
                        url:"/panel/user/file-a-claim/create",
                        type:"POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            '_token': '{{ csrf_token() }}'
                        },
                        data:formData,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        success:function (data) {
		                    console.log(data);
                            if(data.success==true){
                                sweet_modal('Success','success',1000);
                                setTimeout(function () {
                                    window.location = '/panel/user/file-a-claim';
                                },1000);
                            }else{
                                sweet_modal(data.message,'error',1000);
                            }
                            $(".btn_submit").removeAttr('disabled');
                        },error:function (data) {
                            console.log(data);
                            sweet_modal('Something went wrong','error',1000);
                            $(".btn_submit").removeAttr('disabled');
                        }
                    })

                });
            </script>
        @endsection
