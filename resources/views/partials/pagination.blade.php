<style>
    .fa, .fas, .far, .fal, .fab {
        line-height: 1.25;
    }
    .pagination {
        margin: 0;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: .25rem;
    }
    .pagination .active {
        position: relative;
        display: block;
        padding: 9px;
        margin-left: -1px;
        line-height: 1.25;
        color: #24C4A4;
        background-color: rgba(60, 214, 183, 0.06);
        min-width: 36px;
        min-height: 36px;
        padding: 9px;
        text-align: center;
        font-weight: 700;
        /*border: 1px solid #2cc194;*/
    }
    .pagination .disabled {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #2cc194;
        background-color: #ffffff;
        border: 1px solid #e9ecef;
    }
    .pagination li a {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        /*margin-left: -1px;*/
        line-height: 1.25;
        color: #24C4A4;
        background-color: #fff;
        min-width: 36px;
        min-height: 36px;
        padding: 9px;
        text-align: center;
        /*border: 1px solid #dee2e6;*/
    }
    .pagination li a:hover {
        color: #2cc194;
        font-weight: 700;
        /*border: 1px solid #24C4A4;*/
    }
    /*.pagination li i{display: none;}*/
    .pagination li.page-first a > div > span,
    .pagination li.page-last a > div > span{ display: none; }
    .pagination li.page-previous i,
    .pagination li.page-next i{ display: none; }
    .paginator .per-page {font-weight:600;display: inline-flex;min-width: 40px;}
    .paginator .per-page select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding: 10px 10px 10px 10px;
        border: none!important;
    }
    .paginator .per-page .select2-selection.select2-selection--single{min-width: 90px;}
    .paginator .pull-left {padding: 9px;}
</style>
{{-- @if ($paginator->hasPages()) --}}
    <form class="form-inline paginator" method="GET" action="{{url()->current()}}">
        <div class="pull-left">
            <span class="total-page" style="color: #4D6E99">{{__('app.sum')}}: <span style="font-weight:700;">{{$paginator->total()}}</span></span>
        </div>
        <div class="pull-right" style="display:inline-flex;">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())

                @else
                    <li class="page-first">
                        <a href="{{ $paginator->url(1) }}">
                            <div ><i class="fa fa-angle-double-left" title="Trang đầu"></i> <span>Trang đầu</span></div>
                        </a>
                    </li>
                    <li class="page-previous">
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <div><i class="fa fa-angle-left" title="Quay lại"></i><span>Quay lại</span></div>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @elseif ($page >= ($paginator->currentPage() - 3) && $page <= ($paginator->currentPage() + 3) )
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-next">
                        <a href="{{ $paginator->nextPageUrl() }}">
                            <div><i class="fa fa-angle-right" title="Trang sau"></i><span>Trang sau</span></div>
                        </a>
                    </li>
                    <li class="page-last">
                        <a href="{{ $paginator->url($paginator->lastPage()) }}">
                            <div><i class="fa fa-angle-double-right" title="Trang cuối"></i><span>Trang cuối</span></div>
                        </a>
                    </li>
                @endif
            </ul>
            @php
                $all = $paginator->total();
                $perPage = $paginator->perPage();
                $perPageList = $perPageList ?? [10=>10, 20 =>20, 50 =>50, 100 => 100, $perPage => $perPage, $all => 'Tất cả'];
                $perPage = $perPage > $all ? $all : $perPage;
                foreach ($perPageList as $key => $label) {
                    if($key > $all) {unset($perPageList[$key]); continue;}
                    $perPageList[$key] = ['value' => $key, 'label' => $label, 'selected' => ''];
                }
                $perPageList[$perPage]['selected'] = 'selected';
                asort($perPageList);
            @endphp
            <div class="px-2">
                    <div class="per-page form-group h5 m-0" style="" title="Số dòng mỗi trang">
                        <label for="perPage"></label>
                        <select class="select form-control border-bottom" id="perPage" name="per-page">
                            @foreach($perPageList as $key => $value)
                                <option value="{{$key}}" {{$value['selected'] ?? ''}} > {{$value['label'] ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
        </div>
    </form>
    <!-- Pagination -->
{{-- @endif --}}
<script type="text/javascript">
    $('#perPage').on('change', function (e) {
        let url = new URL(location.href);
        url.searchParams.append($(this).attr('name'), $(this).val());
        location.replace(url);
    })
</script>