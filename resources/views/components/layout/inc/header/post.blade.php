@props(['category'])
<x-block class="container-fluid bg-white sticky-wrapper line-b" >
  <div class="container">
    <div class="row mt-1">
      <div class="col-md-6 ">
        <ul class="breadcrumb p-0 ">
          <li class="breadcrumb-item ">
            <x-logo />
          </li>
          @foreach($category->road() as $item)
            <li class="breadcrumb-item  font-medium-2  text-bold-600">
                <a  href="{{url($item->link->pretty)}}" >
                  {{  $item->name  }}
                </a>
            </li>
          @endforeach
          <li class="breadcrumb-item  font-medium-2  text-bold-600">
            <a class="nav-link" href="{{url($category->link->pretty)}}" >
                {{  $category->name }}
            </a>
          </li>
        </ul>

      </div>
      <div class="col-md-6 ">
        <div class="float-xs-right">
          <x-menu.post
            id="{{ empty($category->parent_id) ? $category->id :  $category->parent_id   }}" />
        </div>
      </div>
    </div>
  </div>
</x-block>
