<x-layout>
<x-slot name="title">Logbook - SME - {{ config('app.name') }}</x-slot>
          <main id="js-page-content" role="main" class="page-content">
            <ol class="breadcrumb page-breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{ config('app.name') }}</a></li>
              <li class="breadcrumb-item"><a href="#SME">SME</a></li>
              <li class="breadcrumb-item active">Logbook</li>
              <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
            </ol>
            <div class="subheader">
              <h1 class="subheader-title">
                <i class='subheader-icon fal fa-table'></i> Logbook / SME
              </h1>
            </div>
@if (session('status'))
            <div id="alert-dismissible" class="panel-container show">
              <div class="panel-content">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                  </button>
                  <strong>Well Done!</strong> {{ session('status') }}
                </div>
              </div>
            </div>
@endif
            <div class="row">
              <div class="col-xl-12">
                <div id="panel-1" class="panel">
                  <div class="panel-hdr">
                    <h2>
                      Logbook <span class="fw-300"><i>Table</i></span>
                    </h2>
                    <div class="panel-toolbar">
                      <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                      <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                      <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                  </div>
                  <div class="panel-container show">
                    <div class="panel-content">
                      <!-- datatable start -->
                      <table id="dt-logbook" class="table table-bordered table-hover table-striped w-100"></table>
                      <!-- datatable end -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
          <!-- this overlay is activated only when mobile menu is triggered -->
          <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready( function() {
            initApp.destroyNavigation(myapp_config.navHooks);
            $('a[href="{!! url()->current() !!}"]').parent().attr('class', 'active');
            initApp.buildNavigation(myapp_config.navHooks);
            
            $.fn.dataTable.ext.errMode = 'throw';
            
            dtAdvance = $('#dt-logbook').DataTable({
                responsive: true,
                fixedHeader: {
                    headerOffset: $(document.body)
                        .hasClass('header-function-fixed') ? $('header.page-header').outerHeight() : 0
                },
                paging: true,
                pageLength: 20,
                lengthChange: false,
                bInfo: false,
                order: [],
                select: 'single',
                dom: "<'row mb-3'" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f>" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>" +
                    ">" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [],
                serverSide: true,
                ajax: {
                    url: '/api/SME/logbook',
                    type: 'GET',
                    headers: {
                        Authorization: String('Bearer').concat(' ').concat($(document).find('[name="sso-token"]').attr('content'))
                    }
                },
                columns: [
                    {
                        title: 'Submission',
                        data: 'updatedAt',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return moment(data, 'DD/MM/YYYY').format('ll');
                        }
                    },
                    {
                        title: 'App Number',
                        data: 'noAplikasi',
                        className: 'text-center'
                    },
                    {
                        title: 'Debtor',
                        data: 'nama'
                    },
                    {
                        title: 'Branch',
                        data: 'namaCabang'
                    },
                    {
                        title: 'Regional',
                        data: 'namaRegional'
                    },
                    {
                        title: 'Proposal Type',
                        data: 'facilities',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return data.map((facility) => facility.typeFacility.text).join(', ');
                        }
                    },
                    {
                        title: 'Position',
                        data: 'updatedBy'
                    },
                    {
                        title: 'Status',
                        data: 'statusAplikasi',
                        className: 'text-center'
                    }
                ],
                language: {
                    infoFiltered: ''
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('pointer');
                },
                initComplete: function(settings, json) {
                    settings.oInstance.api().columns().header().to$().addClass('text-center');
                    settings.oInstance.api().table().header().classList.add('thead-dark');
                }
            })
            .on( 'select', function ( e, dt, type, indexes ) {
                window.location.href = String(@json(url()->current())).concat('/').concat(dt.data().id);
            })
        })

    </script>
@endpush
</x-layout>
