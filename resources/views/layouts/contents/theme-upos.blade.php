@section('css-theme')
    <style type="text/css">
        html body{background-color: #F2F6FF}
        html body .content-wrapper {padding: .5rem!important; overflow-x: hidden;}
        /*html body .content-body{background-color: white;}*/
        .header-navbar .navbar-container{background-color: #F2F6FF;}
        .header-navbar.navbar-border {border-bottom: 0px solid #f2f6ff;}
        .main-menu .menu-title{color: #404e67; text-transform: uppercase;}
        /*menu all*/
        .main-menu.menu-light .navigation > li ul li > a {padding: 10px 18px 10px 30px;}
        .main-menu.menu-light .navigation > li.open .hover > a,
        .menu-collapsed .main-menu.menu-light .navigation > li.open .hover > a {background: rgba(60, 214, 183, 0.06);color:#172E4D;}
        .main-menu.menu-light .navigation > li.open .hover > a path{stroke: #172E4D;}
        /*menu first li */
        .main-menu.menu-light .navigation > li.open > a {background: inherit;}
        .main-menu li a .icon {display:inline-flex;min-width: 30px;padding-right:10px}
        .main-menu .navigation > li > a > .icon {display:none;min-width: 0px;padding-right: 0px!important;}
        .menu-collapsed .main-menu .navigation > li > a > .icon{display: inline-block; padding-right: 10px}
        .main-menu .navigation > li ul .active{color: #3CD6B7}
        .main-menu .navigation > li ul .active path{stroke: #3CD6B7}
        .main-menu a.menu-item.hr{height: 1px;padding: 0px!important;border-bottom: 2px solid whitesmoke;}
        .main-menu .navigation > .nav-item #menu-toggle-ext,
        .main-menu .navigation > .nav-item #menu-toggle-ext:hover{background-color: #fff}
        /*nar-bar*/
        .navbar-wrapper .dropdown-menu.dropdown-menu-right{border-radius: .25rem!important;}
        /*general*/
        /*view*/
        .app-view {}
        .app-view .app-view-title{margin: .5rem 0rem}
        .app-view .app-view-title .float-xs-right .btn{min-height: 41px; min-width: 100px; margin: auto 2px;}
        .app-view .container-fluid{background-color: #fff}
        /*button*/
        .btn-upos{min-height: 40px; min-width: 120px}
        .btn-default{background-color: rgba(181, 203, 232, 0.2)}
        .btn-add{background-color:#24C4A4; color: white;}
        .btn-add:hover{background-color:#00796b; color: white;}
        .btn-edit {background-color: rgba(60, 214, 183, 0.1);color: #24C4A4;}
        .btn-save{background-color:#24C4A4; color: white;}
        .lbl-smalltool .btn-edit{background-color: white;color: #fbc02d;}
        .lbl-smalltool .btn-edit:hover{color: #ffa000}
        .lbl-smalltool .btn-delete:hover{color: #d50707}
        /*card*/
        .card-upos table thead {background-color: #F2F6FF; border: 0px solid }
        .card-upos table thead tr th {border: none; cursor: pointer;}
        .card-upos table tbody tr td {border-radius: 4px; border-bottom: 3px solid #F2F6FF;}
        .card-upos table tbody tr .lbl-smalltool {white-space: nowrap;}
        .card-upos table tbody tr td {vertical-align: middle;}
        .color-upos{color: #00B5B8;}
        /*button*/
        .btn-primary{background-color: #3CD6B7!important;color: #fff!important;border:none;font-size: 13px}
        .btn-primary:hover{background-color: #24C4A4!important}
        .btn-secondary{background-color: rgba(181, 203, 232, 0.2);border: none;color: #223E62;vertical-align: middle;text-align: center;}
        .btn-secondary:hover{background-color: #5492e533;}
        .btn-export-excel{background-color: #217346; color: #fff;}
        .btn-export-excel:hover {background-color: #218746; color: #fff;}
        .btn-export-excel:focus {color: #fff;}
        .theme-default{}
        .theme-default .form-control,.theme-default .select2-selection {background-color: #F2F6FF; border:none;}
        /*.theme-default select, input, textarea{min-height:40px;height: 40px; background-color: #F2F6FF; border:none;}*/
        /*.theme-default textarea {padding: 11px 12px; }*/
        .btn-show{color: #24C4A4}
        .btn-delete {color:#FF6562;}
        /*form:: has-error*/
        .app-view form .has-error{color: #ffa87d}
        .app-view form .has-error .form-control{border:1px solid #ffa87d;}
        .app-view form .has-error .select2-container--default .select2-selection--single {border-color: #ffa87d!important;}
        /*styling*/
        .bg-primary {background-color: #3CD6B7}
        .text-primary {color: #3CD6B7}
        .btn-primary{color:#fff;background-color: #3CD6B7}
        .btn-primary:hover{background-color: red}
        /*table*/        
        .app-view.app-view-index table tbody tr td .tag{color: black;min-width: 90px;font-size: 100%;}
        .app-view.app-view-index table tbody tr td .tag.empty{background-color: inherit;border: 2px solid #24c4a4;color: #24c4a4;}
        .app-view.app-view-index table tbody tr td .tag.pending{background-color: #ffa000;}
        .app-view.app-view-index table tbody tr td .tag.available{background-color: #24c4a4;}
        .app-view.app-view-index table tbody tr td .tag.using{background-color: #24c4a4; color: white;}
        .app-view.app-view-index table tbody tr td .tag.repairing{background-color: #fbc02d;}
        .app-view.app-view-index table tbody tr td .tag.stop{background-color: #37474f;}
        .app-view.app-view-index table tbody tr td .tag.lock{background-color: inherit;}
        .app-view.app-view-index table tbody tr td .tag.exported{background-color: inherit;}
        .app-view.app-view-index table tbody tr td .tag.imported{background-color: inherit;}
        .app-view.app-view-index table tbody tr td .tag.pending{background-color: inherit;}
        .app-view.app-view-index table tbody tr td .tag.refused{background-color: inherit;}
        .app-view.app-view-index table tbody tr td .tag.canceled{background-color: #404e67;color: white;}

        .app-view .mb-h1{margin-bottom: .5rem;}
    </style>
    {{-- Override style --}}
    <style type="text/css">
        /*Select2 ReadOnly Start*/
        select[readonly].select2-hidden-accessible + .select2-container {
            pointer-events: none;
            touch-action: none;
        }

        select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
            background: #eee;
            box-shadow: none;
        }

        select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
            display: none;
        }
        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 0px 6px !important;
            margin-top: 4px !important;
            background-color: #7D9AC0 !important;
            border-color: #7D9AC0 !important;
            color: #FFFFFF;
            margin-right: 8px !important;
        }
        .select2-container--classic .select2-results__options .select2-results__option[aria-selected=true], .select2-container--default .select2-results__options .select2-results__option[aria-selected=true] {
        background-color: #7D9AC0 !important;
        color: #FFFFFF !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove,.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            background-color: transparent;
            background-color: #7D9AC0;
            /*height: 2.5px;width: 2.5px;*/
            /*color: #7D9AC0;*/
            outline: none;
        }
        .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single {
            height: 43px !important;
            padding: 5px;
            border-color: #D9D9D9 !important;
        }
        /*focus select2/form-control*/
        /* .app-view form .form-control:focus, */
        /* .select2-container--focus .select2-selection {border-color: #ffa87d !important;} */
        
        /*icheckbox*/
        .icheckbox_line-blue, .iradio_line-blue {background: #223E62!important;}
        .icheckbox_line-blue.checked, .iradio_line-blue.checked {background: #2cc194!important;}
        /*fix datatable*/
        table.datatable thead th{ white-space: nowrap;}
        table.dataTable thead th:before, table.dataTable thead th:after{display: none!important;}
        table.dataTable tbody tr {background-color: #fff;}
        table.dataTable.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,0.03);
        }
        /*headding*/
        .app-page-title .page-title-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            /*padding: 0 1rem;*/
        }
        .app-page-title .page-title-actions {
            margin-left: auto;
            /*float: right;*/
        }
        @media (max-width: 991.98px)
        .app-page-title .page-title-heading, .app-page-title .page-title-wrapper {
            margin: 0 auto;
            display: block;
        }
        /*swal-upos*/
        .swal-upos{}
        .swal-upos .swal2-title{min-height: 70px; padding-top: 20px}
        .swal-upos .swal2-popup{padding: 0px!important;min-height: 300px; max-width: 400px; border-radius: 15px!important}
        .swal-upos .swal2-actions {border-radius: 0px 0px 15px 15px!important; background-color: #f7f9fc!important;width: 100%}
        /*.swal-upos .swal2-actions:hover{box-shadow: 0 0 0 3px #ff653e;}*/
        .swal-upos .swal2-actions button {
          /*width: 100%;*/
          background-color: unset!important; 
          color: #009da0!important;
          margin: 0px;
          border-radius: unset!important;
          min-height: 55px;
        }
        .swal-upos .swal2-actions button:hover {
          background-image: unset!important;
          box-shadow: 0 2px #ff673e inset,0 -0px #f7f9fc inset, -0px 0 #f7f9fc inset, 0px 0 #f7f9fc inset;
        }
        .swal-upos .swal2-actions button:first-child{
          /*border-radius: 0px 0px 0px 25px!important;*/
        }
        .swal-upos .swal2-actions button:last-child{
          /*border-radius: 0px 0px 25px 0px!important;*/
        }
        .swal-upos .swal2-actions button.swal2-styled.swal2-default-outline:focus,
        .swal-upos .swal2-actions button.swal2-styled.swal2-confirm:focus{
          box-shadow: unset;
        }
        /*Kint*/
        .kint-rich {bottom: 100px;}
        .kint-rich.kint-folder{top: 0px!important;}
    </style>
@endsection
@section('scripts-theme')
    @parent
    <script type="text/javascript">
    </script>
@endsection
