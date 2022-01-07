<div class="sys" style="cursor: default;">
    <div>
        <span>Phiên bản</span>
        <span>{{env('APP_VERSION', false)}}</span>
    </div>
    @if(env('APP_ENV') !== 'production')
    <div>
        <span>Môi trường</span>
        <span>{{env('APP_ENV')}}</span>
    </div>
    @endif
</div>