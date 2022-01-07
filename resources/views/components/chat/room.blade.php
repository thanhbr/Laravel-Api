@props(['user','group'=>'public'])
@push('css')
  <style>

    .chat .content{
      height:420px;
      overflow:auto;
      scrollbar-width: thin;
      scrollbar-color:#90A4AE #CFD8DC;
    }
    /*
    #display,#preview{
      position:absolute;
      width: 100%;
      bottom:0;
    }
    */
    .chat .content::-webkit-scrollbar {
      width: .5em;
    }

    .chat .content::-webkit-scrollbar-thumb {
      background-color: #90A4AE ;
      border-radius: 6px;
    }
  </style>
@endpush

@push('script')
{{
    Theme::js([
        'https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js',
        'https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js',
        url('vendor/me/inc/js/vendors.min.js'),
        url('vendor/me/js/core/firebase.js'),
    ])
  }}

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-firestore.js"></script>
<script>

/************setting*******/
  var index = 0;
  var name  = "{{ $user }}";
  var group = "{{ $group }}";
  var stamp =  {{ now()->timestamp }};
  var last  =  0;
  var block = [];

  var right = {
    float : ' float-xs-right ',
    css   : ' tag tag-primary ',
  }
  var left  = {
    float : ' float-xs-left ',
    css   : ' tag tag-info ',
  }
  var pre  = {
    float : ' float-xs-right ',
    css   : ' tag tag-warning ',
  }
  var loud    = $('#loud');
  var preview = $('#preview');
  var display = $('#display');
  var data    = $('#data');

  setInterval(() => {
    stamp++;
  }, 1000);

  function record(){
    return {
      'created': last,
      'group'  : group,
      'name'   : name,
      'loud'   : block
    };
  }
/**********UI********/

  function _preview(){
      out   +=  '<div class="'+ pre.float +'">'+name+'</div>';
      block.forEach(function(item){
        out +=  inc(item,pre);
      })
      preview.html(out);
      preview.fadeIn(500);
  }
  function inc(val,side){
    out =  '<div class="clearfix">'
    out +=  '<span class="' + side.float + side.css + '" >'+ val;
    out +=  '</span></div>';
    return out;
  }
  function line(item,side){
    out   = '';
    item.loud.forEach(function(val){
      out +=  inc(val,side);
    })
    return out;
  }

  function view(items){
    out = '';
    items.forEach(function(item){
      side = ( item.name == name ) ? right : left;

      out +=  '<div data-id=' +item.id+ ' class="row" >';
      out +=  '<div class="'+ side.float +'">'+item.name+'</div>';
      out +=  line(item,side);
      out +=  '</div>';
    })
    display.html(out);
    preview.fadeOut(2000);
    preview.html('');
  }

  //action press
  function press(){
    loud.keypress(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
        if(val=='') return;
        var val  =  $(this).val();
        block.push(val);
        $(this).val('');
        _preview();
      }
    });
  }

/********firebase********/
  db = firebase.firestore();
  db.settings({
    timestampsInSnapshots: true,
    cacheSizeBytes: firebase.firestore.CACHE_SIZE_UNLIMITED
  });
  collection = db.collection("kingloud");
  query      = collection.where('group','==',group);
  //query = query.where('index','>',index);

  function render(){
    query.orderBy('created').onSnapshot({
        // Listen for document metadata changes
        includeMetadataChanges: true
    },
    (querySnapshot) => {
        const rows = querySnapshot.docs.map(
          function(doc) {
            row   = doc.data();
            row.id= doc.id;
            return row;
          }
        );
        view(rows);
    });
  }

  function push(){
    if(block.length === 0) return;
    last =  stamp-1;
    collection.add(record()).then(function(result) {
      block = [];
    });
  }


/***********Run************/
  press();
  render();
  setInterval(() => {
    push();
  },
  2500);

</script>

@endpush

{{ now()->timestamp }}<br/>
<div id="now"></div>
<div class="content-header">
  {{ $group }} : {{ $user }}
</div>

<div class="fixed" style="bottom:0">
  <div class="card box col-xs-12">
    <div class="card-block content">
      <div id="display" >


      </div>
      <div id="preview">

      </div>
    </div>
    <div class="card-footer">
        <input type="text" id="loud" class="form-control" >
    </div>
  </div>

</div>
