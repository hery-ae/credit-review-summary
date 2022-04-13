<x-layout>
<x-slot name="title">Users - {{ config('app.name') }}</x-slot>
					<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					<main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb d-flex align-items-center">
                            <li class="breadcrumb-item">
								<ul class="pagination">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true"><i class="fal fa-chevron-left"></i></span>
										</a>
									</li>
								</ul>
							</li>
                            <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Create</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-edit'></i> Create / Users
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-user-create" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <form action="{{ route('users.store') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="email">E-Mail</label>
                                                    <input type="email" name="email" class="form-control" pattern=".+@idn.ccb.com" required>
                                                </div>
												<div class="form-group">
                                                    <label class="form-label" for="role-permission">Role Permission</label>
@foreach ($roles as $value)
                                                    <select name="role-id[]" class="form-control mb-1 text-capitalize">
                                                        <option class="text-capitalize" value>choose</option>
@foreach ($roles as $value)
														<option class="text-capitalize" value="{{ $value->id }}">{{ $value->name }}</option>
@endforeach
                                                    </select>
@endforeach
                                                </div>
												<div class="form-group">
                                                    <label class="form-label" for="segmentation">Segmentation</label>
@foreach ($segmentations as $value)
                                                    <select name="segmentation-id[]" class="form-control mb-1 text-capitalize">
                                                        <option class="text-capitalize" value>choose</option>
@foreach ($segmentations as $value)
														<option class="text-capitalize" value="{{ $value->id }}">{{ $value->name }}</option>
@endforeach
                                                    </select>
@endforeach
                                                </div>
												<button type="submit" class="btn btn-lg btn-default">
                                                    <span class="fal fa-check mr-1"></span>
                                                    Submit
                                                </button>
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
                        //

					</script>
@endpush
</x-layout>
