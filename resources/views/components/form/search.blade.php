@php
  /**
   * @author toannguyen.dev
   * @todo
   */
@endphp
<style type="text/css">
  .search-content .input-group {max-width: 300px;}
  .search-content .input-group .txt-search{height: 44px; border-right: none;min-width: 130px}
  .search-content .input-group-btn {padding: 0px 10px}
  .search-content .input-group-btn button {font-size: 0px;border: none;margin: 0px 10px 0px 10px}
  .search-content .input-group .input-group-addon{background-color: #fff;border-radius: 0 .25rem .25rem 0; border:1px solid #ccd6e6;border-left: none}
  #btn-clear-filter{background-color: inherit;border-radius: .25rem}
</style>
<div class="search-content">
  <div class="input-group">
    <input type="text" class="form-control txt-search" id="search_keyword" name="keyword" value="{{ request('keyword')}}" placeholder="{!! trans('app.keyword') !!}" >
    <span class="input-group-addon">
      <button type="submit" style="border: none;background-color: inherit;cursor: pointer;">
        <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="0.25" x2="0.25" y2="24" stroke="#B5CBE8" stroke-width="0.5"/>
        <path d="M28 20L24.1412 16.1377C22.8524 17.4389 21.0872 18.2222 19.1111 18.2222C15.1838 18.2222 12 15.0385 12 11.1111C12 7.18375 15.1838 4 19.1111 4C23.0385 4 26.2222 7.18375 26.2222 11.1111C26.2222 12.0649 26.0344 12.9748 25.6938 13.8059" stroke="#4D6E99" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </span>
    <div class="input-group-btn d-non" style="">
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