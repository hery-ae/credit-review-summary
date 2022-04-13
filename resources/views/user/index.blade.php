<x-layout>
<x-slot name="title">Users - {{ config('app.name') }}</x-slot>
					<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Users</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-table'></i> Users
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
											User <span class="fw-300"><i>Table</i></span>
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
                                            <table id="dt-user" class="table table-bordered table-hover table-striped w-100"></table>
                                            <!-- datatable end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->

@push('scripts')
    <script type="text/javascript">
        $(document).ready( function() {
            initApp.destroyNavigation(myapp_config.navHooks);
            $('a[href="{!! url()->current() !!}"]').parent().attr('class', 'active');
            initApp.buildNavigation(myapp_config.navHooks);
            
            $.fn.dataTable.ext.errMode = 'throw';
            
            dtAdvance = $('#dt-user').DataTable({
                responsive: true,
                fixedHeader: {
                    headerOffset: $(document.body)
                        .hasClass('header-function-fixed') ? $('header.page-header').outerHeight() : 0
                },
                paging: true,
                pageLength: 50,
                lengthChange: false,
                bInfo: false,
                order: [],
//@@can('create', 'App\User')
                select: {
                    style: 'multi',
                    items: 'cell'
                },
                
                dom: "<'row mb-3'" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f>" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>" +
                    ">" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        text: '<span class="fal fa-plus-square mr-1"></span>Create',
                        titleAttr: 'Create User',
                        className: 'btn btn-outline-primary waves-effect waves-themed mr-1',
                        action: function ( e, dt, node, config ) {
                            window.location.replace(@json(route('users.create')));
                        }
                    },
                    {
                        text: '<span class="fal fa-times-square mr-1"></span>Delete',
                        titleAttr: 'Delete User',
                        className: 'btn btn-outline-danger waves-effect waves-themed collapse',
                        action: function ( e, dt, node, config ) {
                            dt.button().container().siblings().remove();
                            dt.button().container().after(document.createElement('form'));
                            dt.button().container().next().attr('action', @json(route('users.destroy', ['user' => 'deletes'])));
                            dt.button().container().next().attr('method', 'post');
                            
                            dt.button().container().next().append(document.createElement('button'));
                            dt.button().container().next().children().eq(0).addClass('collapse');
                            dt.button().container().next().children().eq(0).attr('data-target', '#modal-alert');
                            
                            dt.button().container().next().append(document.createElement('input'));
                            dt.button().container().next().children().eq(1).attr('type', 'hidden');
                            dt.button().container().next().children().eq(1).attr('name', '_method');
                            dt.button().container().next().children().eq(1).val(('delete').toUpperCase());
                            
                            dt.button().container().next().append(document.createElement('input'));
                            dt.button().container().next().children().eq(2).attr('type', 'hidden');
                            dt.button().container().next().children().eq(2).attr('name', '_token');
                            dt.button().container().next().children().eq(2).val(
                                $(document).find('meta[name="csrf-token"]').attr('content')
                            );
                            
                            dt.rows({
                                selected: true
                            }).every( function ( rowIdx, tableLoop, rowLoop ) {
                                dt.button().container().next().append(document.createElement('input'));
                                dt.button().container().next().children().eq(rowLoop + 3).attr('type', 'hidden');
                                dt.button().container().next().children().eq(rowLoop + 3).attr('name', 'deletes[]');
                                dt.button().container().next().children().eq(rowLoop + 3).val(dt.row(rowIdx).data().id);
                            })
                            
                            $('#modal-alert').modal();
                        }
                    }
                ],
//@@endcan
                data: @json($users->toArray()),
                columns: [
//@@can('create', 'App\User')
                    {
                        title: '<i class="fal fa-check"></i>',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                        className: 'select-checkbox text-center',
                        width: '5%'
                    },
//@@endcan
                    {
                        title: 'E-mail',
                        data: 'email'
                    },
                    {
                        title: 'Role Permission',
                        data: 'user_roles',
                        className: 'text-capitalize text-center',
                        render: function(data, type, row, meta) {

                            return data.map( data => {
                                return data.role.name;
                            }).join(document.createElement('br').outerHTML);
                        }
                    },
                    {
                        title: 'Segmentation',
                        data: 'user_segmentations',
                        className: 'text-capitalize text-center',
                        render: function(data, type, row, meta) {

                            return data.map( data => {
                                return data.segmentation.name;
                            }).join(document.createElement('br').outerHTML);
                        }
                    },
                    {
                        title: 'Created At',
                        data: 'created_at',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return moment(data).format('llll');
                        }
                    },
                    {
                        title: 'Updated At',
                        data: 'updated_at',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return moment(data).format('llll');
                        }
                    }
                ],
                language: {
                    infoFiltered: ''
                },
//@@can('create', 'App\User')
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('pointer');
                },
//@@endcan
                initComplete: function(settings, json) {
                    settings.oInstance.api().columns().header().to$().addClass('text-center');
                    settings.oInstance.api().table().header().classList.add('thead-dark');
                }
            })
        })

    </script>
@endpush
</x-layout>
