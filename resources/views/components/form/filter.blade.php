@php
  /**
   * @author toannguyen.dev
   * @todo
   */
  /*intial*/
  $filterData = $filterData ?? $filter->toData();
  $filterKeysCounter = $filterKeys = $filterKeys ?? $filter->toKeys();
  unset($filterKeysCounter['keyword']);
  $filterKeysCounter = count(array_filter($filterKeysCounter));
@endphp
<style type="text/css">
  .filter-content{display: inline-block;}
  .filter-content .btn-filter-submit{color: #223E62}
  .filter-content {max-width: 400px;cursor: pointer;min-width: 300px}
  .filter-content .filter-count {
    background-color: #3CD6B7;
    position: absolute;
    left: 30px;
    z-index: 2000;
    height: 20px;
    font-size: 10pt;
    color: #901d1d;
    width: 20px;
    padding: 4px;
  }
  .filter-content .dropdown-menu {
    position: absolute;
    width: 100%;
    /*max-width: 270px;*/
    margin: .5rem 0rem;
    padding: 12px 12px 0px 12px;
    max-height: 520px;
    overflow-y: auto;
    top: 40px;
    left: -209px;
    min-width: 306px;
    /*box-shadow: 5px 5px 5px rgb(0 0 0 / 20%);*/
    /*border: none;*/
  }
  .filter-content .dropdown-menu .dropdown-item{display: block;padding: 3px 10px;}
  .filter-content .dropdown-menu .dropdown-item:hover{background-color: unset;}
  .filter-content .dropdown-menu .dropdown-item .btn {min-width: 80px}
  .filter-content .dropdown-menu .dropdown-item .form-group{margin-bottom: 1rem }
  .filter-content .dropdown-menu .dropdown-item label{font-weight: 700}
  .filter-content .dropdown-menu .dropdown-item select{min-width: 180px; max-width: 300px}
  .filter-content .dropdown-menu .dropdown-item-end{background-color: inherit;margin: 12px -12px}
  .filter-content .dropdown-menu .dropdown-item-end .btn-filter-submit{min-width: 120px; background-color:  rgb(77, 110, 153);color: #fff;}
  .filter-content .dropdown-menu .dropdown-item-end .btn-filter-submit:hover{background-color: #223E62;}
  .filter-content .dropdown-menu label {display: flex;}
  .select2.select2-container {width: 100%!important}
  /*.filter-list, #btn-clear-filter{margin-bottom: .5rem}*/
  /*.filter-content #btn-clear-filter{margin: 0px 7px;min-width: 20px; height: 40px}*/

  .filter-content .input-group {max-width: 300px;}
  .filter-content .input-group .txt-search{height: 44px; border-right: none;min-width: 130px}
  .filter-content .input-group-btn {padding: 0px 10px}
  .filter-content .input-group-btn button {font-size: 0px;border: none;margin: 0px 10px 0px 10px}
  .filter-content .input-group .input-group-addon{background-color: #fff;border-radius: 0 .25rem .25rem 0; border:1px solid #ccd6e6;border-left: none}
  #btn-clear-filter{background-color: inherit;border-radius: .25rem}
</style>
{{-- <fieldset> --}}
  <div class="filter-content">
    <div class="input-group">
      <input type="text" class="form-control txt-search" id="search_keyword" name="keyword" value="{{ $filterKeys['keyword'] ?? '' }}" placeholder="{!! trans('app.keyword') !!}" >
      <span class="input-group-addon">
        <button type="submit" style="border: none;background-color: inherit;cursor: pointer;">
          <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <line x1="0.25" x2="0.25" y2="24" stroke="#B5CBE8" stroke-width="0.5"/>
          <path d="M28 20L24.1412 16.1377C22.8524 17.4389 21.0872 18.2222 19.1111 18.2222C15.1838 18.2222 12 15.0385 12 11.1111C12 7.18375 15.1838 4 19.1111 4C23.0385 4 26.2222 7.18375 26.2222 11.1111C26.2222 12.0649 26.0344 12.9748 25.6938 13.8059" stroke="#4D6E99" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </span>
      <div class="input-group-btn d-non" style="">
        <button type="button" class="btn p-0">
          <div class="">
            <div class="filter-box-show d-non" data-toggle="dropdown">
              <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="44" height="44" rx="2" fill="#4D6E99"/>
                <path d="M30 15L23.6 22.568V29.4L20.4 27.8V22.568L14 15H26.8" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              @if(!empty($filterKeysCounter))
                <span class="filter-count tag tag-pill tag-default">{{$filterKeysCounter}}</span>
              @endif
            </div>
            <div class="dropdown-menu box-shadow-1" role="menu" x-placement="" style="">
              @if(!empty($filterData))
                @foreach ($filterData as $_keyFilter => $_filter)
                  <div class="dropdown-item text-left" href="#">
                    <div class="form-group row">
                      <label for="{{$_keyFilter}}" class="col-12">{{__('app.'.$_keyFilter)}}</label>
                      <select class="form-control select2" id="{{$_keyFilter}}" name="{{$_keyFilter}}" >
                        @foreach($_filter as $_optItem)
                        <option value="{{ ($_optItem['value'] ?? '')}}" {{($_optItem['selected'] ?? '')}}>
                          {{str_replace('app.','', __('app.'.($_optItem['label'] ?? ''))) }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                @endforeach
              @endif
              <div class="dropdown-item-end">
                <div class="form-group row m-0">
                  <div class="col-xs-6">
                    <input type="reset" value="Mặc định" class="btn btn-dark d-none">
                  </div>
                  <div class="col-xs-6 text-xs-center">
                    <input type="submit" class="btn px-0 btn-filter-submit" value="Lọc" />
                    {{-- <i class="fa fa-filter"></i> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </button>
        <button class="btn p-0" id="btn-clear-filter" >
          <div class="" href="{{url()->current()}}">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28 16L24 20M22 22L16 28M22 22L16 16M22 22L28 28" stroke="#4D6E99" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="0.25" y="0.25" width="43.5" height="43.5" rx="1.75" stroke="#B5CBE8" stroke-width="0.5"/>
            </svg>
            
          </div>
        </button>
      </div>
    </div>
  </div>
{{-- </fieldset> --}}
<script type="text/javascript">
  $(document).ready(function() {
    $('.filter-content .dropdown-menu').on('click', function (e) {
      e.stopPropagation();
    });
  })
</script>