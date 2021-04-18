@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Panel</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Panel</li>
        </ol>
      </div>
    </div>
    <div class="row">
      @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block col-md-12">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! session('flash_message_error') !!}</strong>
      </div>
      @endif
      @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block col-md-12">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {!! session('flash_message_success') !!}
      </div>
      @endif
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <form class="form-horizontal" method="post" action="{{ url('/admin/panels/edit/'.$userDetails->id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="form-pos">
                    <div class="form-group i-name">
                      <input type="text" class="form-control require" name="first_name" required="" placeholder="First Name *" value="{{ $userDetails->first_name }}" required="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-pos">
                    <div class="form-group i-name">
                      <input type="text" class="form-control require" name="last_name" required="" placeholder="Last Name *" value="{{ $userDetails->last_name }}" required="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6" style="display: none;">
                  <div class="form-pos">
                    <div class="form-group i-name">
                      @php
                      $genreArray = array('Jazz', 'Rock', 'Pop', 'Folk', 'Classical', 'Heavy Metal', 'Punk Rock', 'Soul', 'Hip Hop', 'Reggae', 'Funk', 'Disco', 'Techno', 'Instrumental');
                      @endphp
                      <select class="form-control form-control-lg" name="genre">
                        <option value="">Favourite Genre</option>
                        @foreach($genreArray as $genre)
                        <option value="{{ $genre }}" @if ($genre==$userDetails->genre) selected @endif>{{ $genre }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-e">
                    <div class="form-group i-email">
                      @php
                      $countryArray = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bonaire","Bosnia &amp; Herzegovina","Botswana","Brazil","British Indian Ocean Territory","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Canary Islands","Cape Verde","Cayman Islands","Central African Republic","Chad","Channel Islands","Chile","China","Christmas Island","Cocos Island","Colombia","Comoros","Congo","Cook Islands","Costa Rica","Cote DIvoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Great Britain","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guyana","Haiti","Hawaii","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea North","Korea South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Midway Islands","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherland Antilles","Netherlands (Holland, Europe)","Nevis","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Norway","Oman","Pakistan","Palau Island","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn Island","Poland","Portugal","Puerto Rico","Qatar","Republic of Montenegro","Republic of Serbia","Reunion","Romania","Russia","Rwanda","St Barthelemy","St Eustatius","St Helena","St Kitts-Nevis","St Lucia","St Maarten","St Pierre &amp; Miquelon","St Vincent &amp; Grenadines","Saipan","Samoa","Samoa American","San Marino","Sao Tome &amp; Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tahiti","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City State","Venezuela","Vietnam","Virgin Islands (Brit)","Virgin Islands (USA)","Wake Island","Wallis & Futana Is","Yemen","Zaire","Zambia","Zimbabwe");
                      @endphp
                      <select class="form-control form-control-lg" name="country">
                        @foreach($countryArray as $country)
                        <option value="{{ $country }}" @if ($country==$userDetails->country) selected @endif>{{ $country }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-e">
                    <div class="form-group i-email">
                      {{-- @php
                      $cityArray = array('Sydney', 'Thimphu', 'Curitiba', 'Chicago', 'Brooks', 'Berlin', 'Blida', 'Ahmedabad', 'Auckland', 'Kathmandu', 'Geneva', 'Stockholm ', 'Istanbul', 'New York');
                      @endphp
                      <select class="form-control form-control-lg" name="city">
                        @foreach($cityArray as $city)
                        <option value="{{ $city }}" @if ($city==$userDetails->city) selected @endif>{{ $city }}</option>
                        @endforeach
                      </select> --}}
                      <input type="text" class="form-control form-control-lg" name="city" placeholder="City" value="{{ $userDetails->city }}">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-e">
                    <div class="form-group i-email">
                      <input type="email" class="form-control require" name="email" required="" placeholder=" demo@gmail.com *" data-valid="email" data-error="Email should be valid." readonly value="{{ $userDetails->email }}">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6" style="display: none;">
                  <div class="form-s">
                      <label for="birth-date">Birth Date</label>

                    <?php
                    $birthdate = date('m/d/Y', strtotime($userDetails->birthdate));
                    ?>
                    <div class="form-group i-dob">
                      <input type="text" class="form-control require" name="birthdate" placeholder="Date of Birth *" onfocus="(this.type='date')" value="{{ $birthdate }}">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-2">
                  <div class="custo-file">
                    <!--class:custom-file-upload-->
                    <label for="file-upload" class="custom-file-upload1">Profile Photo</label>
                   {{-- <input type="file" id="customFile" name="profile_image">--}}
                    
                    <!-- <div id="file-upload-filename"></div> -->
                    <input type="hidden" name="profile_image" id="customFile" value="">
                    <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal_panel_page" data-type="eventImage">Upload Image</span>
                  </div>
                  
                  <small>Image must be 300 x 300 pixel and format must be .jpg.</small>
                </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div id="uploaded_image" style="padding-top: 20px;">
                    <p>
                      @if(!empty($userDetails->profile_image) || $userDetails->profile_image != '' || $userDetails->profile_image != Null)
                      <img id="featured_image_preview" src="{{ asset('/uploads/'.$userDetails->profile_image) }}" alt="preview image" style="max-height: 150px;">
                       @else
                        <img id="featured_image_preview" src="{{ asset('/images/blank.jpg') }}" alt="preview image"
                             style="max-height: 150px;">
                       @endif
                    </p>
                  </div>
                </div>
            </div>
                <br>
                <div class="col-lg-12 col-md-12">
                  <div class="form-s">
                    <div class="form-group i-dob">
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Biography" name="biography" wrap="hard">{{ $userDetails->biography }}</textarea>
                    </div>
                  </div>
                </div>
               
                <!-- <div class="col-lg-12 col-md-12">
                  <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="terms_condition">
                    <label class="custom-control-label" for="customControlAutosizing">Accept Terms & Condition</label>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 mt-2">
                  <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="newsletters">
                    <label class="custom-control-label" for="customControlAutosizing1">Receive Newsletters</label>
                  </div>
                </div> -->
                <div class="row">
      <div class="col-12">
        <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
        <input type="submit" value="Update" class="btn btn-success float-right">
      </div>
    </div>
            </form>
  <!-- /.row -->
</section>
@endsection
{{--
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
  $(document).ready(function(){
      $('#customFile').change(function(){      
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#featured_image_preview').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]);   
    });
  });
  
</script>--}}
@include('admin.layouts.ImageCropperJs')