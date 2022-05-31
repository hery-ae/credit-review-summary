<x-layout>
<x-slot name="title">Logbook - SME - {{ config('app.name') }}</x-slot>
					<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
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
											Logbook <span class="fw-300"><i>Detail</i></span>
										</h2>
										<div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
											<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <form>
                                                <div class="form-group">
                                                    <label class="form-label" for="app-number">App Number</label>
                                                    <input type="text" class="form-control" readonly value="002/SME/CFR/092/IV/2022">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="debtor">Debtor</label>
                                                    <input type="text" class="form-control" readonly value="CV KARYA UTAMA">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="proposal-type">Proposal Type</label>
                                                    <input type="text" class="form-control" readonly value="Baru">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="proposal-type">Status</label>
                                                    <input type="text" class="form-control" readonly value="ON_PROGRESS">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-2" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
											Tracking <span class="fw-300"><i>Detail</i></span>
										</h2>
										<div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
											<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <form>
                                                <div class="form-group">
                                                    <label class="form-label" for="submission-date">Submission Date</label>
                                                    <input type="text" class="form-control" readonly value="Apr 14, 2022">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="assignment-date">Assignment Date</label>
                                                    <input type="text" class="form-control" readonly value="May 25, 2022">
                                                </div>
                                            </form>
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

        })

    </script>
@endpush
</x-layout>
